<?php

namespace AditumPayments\ApiSDK;

class Authorization extends Charge {

    private $config;

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function getBrandCardBin(...$args) {
        $cardNumber = (count($args))? $arrgs[0] : $this->transactions->card->getCardNumber();

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
        return json_encode(array(
            "charge" => array(
                "customer" => array(
                    "name" => $this->customer->getName(),
                    "email" => $this->customer->getEmail()
                ),
                "transactions" => [
                    array(
                        "card" => array(
                            "cardNumber" => $this->transactions->card->getCardNumber(),
                            "cvv" => $this->transactions->card->getCVV(),
                            "cardholderName" => $this->transactions->card->getCardholderName(),
                            "expirationMonth" => $this->transactions->card->getExpirationMonth(),
                            "expirationYear" => $this->transactions->card->getExpirationYear()
                        ),
                        "installmentNumber" => $this->transactions->getInstallmentNumber(),
                        "acquirer" => $this->transactions->getAcquirer(),
                        "paymentType" => $this->transactions->getPaymentType(),
                        "amount" => $this->transactions->getAmount(),
                        "softDescriptor" => "TST003",
                        "merchantTransactionId" => "TST003"
                    ),
                ]
            ),
        ));
    }
}
