<?php

namespace AditumPayments\ApiSDK;

class Payment {

    private $config;

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

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
    }

    public function authorization($data, ...$callBack) {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => "{$this->config->getUrl()}charge/authorization",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->config->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $data->toJson()
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            curl_close($ch);
            $arrayError = array(
                "httpStatus" => $httpCode, 
                "httpMsg" => $response, 
                "code" => $errCode, 
                "msg" => $errMsg);

            if (count($callBack)) $callBack[0]($arrayError, NULL, NULL);
            
            return $arrayError;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            $arrayError = array("code" => '-1', "httpMsg" => $responseJson->errors);
            if (count($callBack)) $callBack[0]($arrayError, NULL, NULL); 
            return $arrayError;
        }

        if (count($callBack)) {
            $callBack[0](NULL, $responseJson->charge->chargeStatus,  $responseJson->charge);
        }

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge);
    }

    // @TODO: A desenvolver
    public function boleto() {}

    // @TODO: A desenvolver
    public function checkoutByLink() {}

}
