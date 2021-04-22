<?php

namespace AditumPayments\ApiSDK;

class Transaction {

    private $config;

    private $cardNumber = "";
    private $cvv = "";
    private $cardholderName = "";
    private $expirationMonth = "";
    private $expirationYear = "";
    private $paymentType = "";
    private $amount = "";

    private $brandName = "";
    private $customerName = "";
    private $customerEmail = "";

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
    }

    public function getCardNumber() {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function getCVV() {
        return $this->cvv;
    }

    public function setCVV($cvv) {
        $this->cvv = $cvv;
    }

    public function getCardholderName() {
        return $this->cardholderName;
    }

    public function setCardholderName($cardholderName) {
        $this->cardholderName = $cardholderName;
    }

    public function getExpirationMonth() {
        return $this->expirationMonth;
    }

    public function setExpirationMonth($expirationMonth) {
        $this->expirationMonth = $expirationMonth;
    }

    public function getExpirationYear() {
        return $this->expirationYear;
    }

    public function setExpirationYear($expirationYear) {
        $this->expirationYear = $expirationYear;
    }

    public function getPaymentType() {
        return $this->paymentType;
    }

    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getBrandCardBin(...$args) {
        $cardNumber = (count($args))? $arrgs[0] : $this->getCardNumber();

        $url = "https://portal-dev.aditum.com.br/v1/"; // @TODO: necessário remover quando estiver no novo endpoint
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "{$url}card/bin/brand/{$cardNumber}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->config->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            return NULL;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) return NULL;

        return $responseJson->cardBrand;
    }

    public function toJson() {
        $brandName = $this->getBrandCardBin();
        if ($brandName == NULL) {
            echo "AditumPayments\\\ApiSDK\\Transaction::toJson -> Falha ao fazer request da bandeira do cartão\n";
            return NULL;
        }

        return json_encode(array(
            "charge" => array(
                "customer" => array(
                    "name" => $this->config->getCustomerName(),
                    "email" => $this->config->getCustomerEmail()
                ),
                "transactions" => [
                    array(
                        "card" => array(
                            "cardNumber" => $this->getCardNumber(),
                            "cvv" => $this->getCVV(),
                            "brandName" => $brandName,
                            "cardholderName" => $this->getCardholderName(),
                            "expirationMonth" => $this->getExpirationMonth(),
                            "expirationYear" => $this->getExpirationYear()
                        ),
                        "paymentType" => $this->getPaymentType(),
                        "amount" => $this->getAmount(),
                        "softDescriptor" => "TST003",
                        "merchantTransactionId" => "TST003"
                    ),
                ]
            ),
        ));
    }
}
