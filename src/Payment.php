<?php

namespace AditumPayments\ApiSDK;

class Payment {

    private $token = NULL;
    private $url = NULL;
    private $customerName = NULL;
    private $customerEmail = NULL;

    public static $instance;

    // Charge status
    public const CHARGE_STATUS_AUTHORIZED         = "Authorized";
    public const CHARGE_STATUS_PRE_AUTHORIZED     = "PreAuthorized";
    public const CHARGE_STATUS_CANCELED           = "Canceled";
    public const CHARGE_STATUS_PARTIAL            = "Partial";
    public const CHARGE_STATUS_NOT_AUTHORIZED     = "NotAuthorized";
    public const CHARGE_STATUS_NOT_PENDING_CANCEL = "PendingCancel";

    // Payments type
    public const PAYMENT_TYPE_UNDEFINED   = 0;
    public const PAYMENT_TYPE_DEBIT       = 1;
    public const PAYMENT_TYPE_CREDIT      = 2;
    public const PAYMENT_TYPE_VOUCHER     = 3;
    public const PAYMENT_TYPE_BOLETO      = 4;
    public const PAYMENT_TYPE_TED         = 5;
    public const PAYMENT_TYPE_DOC         = 6;
    public const PAYMENT_TYPE_SAFETY_PAY  = 7;


    // Card brand name
    public const CARD_BRAND_VISA           = "Visa";
    public const CARD_BRAND_MASTER_CARD    = "MasterCard";
    public const CARD_BRAND_AMEX           = "Amex";
    public const CARD_BRAND_ELO            = "Elo";
    public const CARD_BRAND_AURA           = "Aura";
    public const CARD_BRAND_JCB            = "Jcb";
    public const CARD_BRAND_DINERS         = "Diners";
    public const CARD_BRAND_DISCOVER       = "Discover";
    public const CARD_BRAND_HIPERCARD      = "Hipercard";
    public const CARD_BRAND_ENROUTE        = "Enroute";
    public const CARD_BRAND_TICKET         = "Ticket";
    public const CARD_BRAND_SODEXO         = "Sodexo";
    public const CARD_BRAND_VR             = "Vr";
    public const CARD_BRAND_ALELO          = "Alelo";
    public const CARD_BRAND_SETRA          = "Setra";
    public const CARD_BRAND_VERO           = "Vero";
    public const CARD_BRAND_SOROCRED       = "Sorocred";
    public const CARD_BRAND_GREEN_CARD     = "GreenCard";
    public const CARD_BRAND_CABAL          = "Cabal";
    public const CARD_BRAND_BANESCARD      = "Banescard";
    public const CARD_BRAND_VERDE_CARD     = "VerdeCard";
    public const CARD_BRAND_VALE_CARD      = "ValeCard";
    public const CARD_BRAND_UNION_PAY      = "UnionPay";
    public const CARD_BRAND_UP             = "Up";
    public const CARD_BRAND_TRICARD        = "Tricard";
    public const CARD_BRAND_BIGCARD        = "Bigcard";
    public const CARD_BRAND_BEN            = "Ben";
    public const CARD_BRAND_REDE_COMPRAS   = "RedeCompras";

    private function __construct() {}

    public static function getInstance($params = NULL) {
        if (!isset(self::$instance)) {
            self::$instance = new Payment;
            if ($params != NULL) {
                if (isset($params['token']))
                    self::$instance->token = $params['token'];
                if (isset($params['url']))
                    self::$instance->url = $params['url'];
                if (isset($params['customerName']))
                    self::$instance->customerName = $params['customerName'];
                if (isset($params['customerEmail']))
                    self::$instance->customerName = $params['customerEmail'];
            }
        }

        return self::$instance;
    }

    public function authorization($params, $callBack) {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => "{$this->getUrl()}charge/authorization",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => json_encode(array(
                "charge" => array(
                    "customer" => array(
                        "name" => $this->getCustomerName(),
                        "email" => $this->getCustomerEmail()
                    ),
                    "transactions" => [
                        array(
                            "card" => array(
                                "cardNumber" => $params["cardNumber"],
                                "cvv" => $params["cvv"],
                                "brandName" => $params["brandName"],
                                "cardholderName" => $params["cardholderName"],
                                "expirationMonth" => $params["expirationMonth"],
                                "expirationYear" => $params["expirationYear"]
                            ),
                            "paymentType" => $params["paymentType"],
                            "amount" => $params["amount"],
                            "softDescriptor" => "TST003",
                            "merchantTransactionId" => "TST003"
                        ),
                    ]
                ),
            ))
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            var_dump($errCode);
            curl_close($ch);
            $callBack(array(
                "httpStatus" => $httpCode, 
                "httpMsg" => $response, 
                "code" => $errCode, 
                "msg" => $errMsg), 
                NULL, NULL);
            return;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            curl_close($ch);
            $callBack(array("code" => '-1', "httpMsg" => $responseJson->errors), NULL, NULL);
            return;
        }

        $callBack(NULL, $responseJson->charge->chargeStatus,  $responseJson->charge);
    }

    // @TODO: A desenvolver
    public function boleto() {}

    // @TODO: A desenvolver
    public function checkoutByLink() {}

    public function getBrandCardBin(...$args) {
        $url = NULL;
        $bin = NULL;
        $callBack = NULL;

        $count = 0;

        if (count($args) == 3) {
            $url = $args[$count];
            $count++;
        } else {
            $url =  $this->getUrl();
        }

        $bin = $args[$count];
        $callBack = $args[$count + 1];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "{$url}card/bin/brand/{$bin}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            var_dump($errCode);
            curl_close($ch);
            $callBack(array(
                "httpStatus" => $httpCode, 
                "httpMsg" => $response, 
                "code" => $errCode, 
                "msg" => $errMsg), 
                NULL);
            return;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            curl_close($ch);
            $callBack(array("code" => '-1', "httpMsg" => $responseJson->errors), NULL);
            return;
        }

        $callBack(NULL, $responseJson->cardBrand);
    }

    private function getUrl() {
        if ($this->url == NULL) {
            $config = new Configuration;
            return $config->getProdURL();
        }

        return $this->url;
    }

    private function getToken() {
        if ($this->token == NULL) {
            $config = new Configuration;
            return $config->getToken();
        }

        return $this->token;
    }

    private function getCustomerName() {
        if ($this->customerName == NULL) {
            $config = new Configuration;
            return $config->getCustomerName();
        }

        return $this->customerName;
    }

    private function getCustomerEmail() {
        if ($this->customerEmail == NULL) {
            $config = new Configuration;
            return $config->getCustomerEmail();
        }

        return $this->customerEmail;
    }
}
