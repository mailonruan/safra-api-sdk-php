<?php

namespace AditumPayments\ApiSDK;

class Authorization extends Charge {

    private $config;
    public const CHARGE_TYPE = "Authorization";

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function getBrandCardBin(...$args) {
        $cardNumber = substr((count($args))? $arrgs[0] : $this->transactions->card->getCardNumber(), 0, 4);

        $url = "https://portal-dev.aditum.com.br/v1/"; // @TODO: necessário remover quando estiver no novo endpoint
        $urlRequest = "{$url}card/bin/brand/{$cardNumber}";

        echo "Authorization::getBrandCardBin = Url de requisição {$urlRequest}\n";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $urlRequest,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->config->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        echo "Authorization::getBrandCardBin = Buscando nome da bandeira\n";

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            echo "Authorization::getBrandCardBin = Falha ao buscar nome da bandeira do cartão, httpCode {$httpCode}\n";
            return NULL;
        }

        curl_close($ch);

        var_dump($response);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            echo "Authorization::getBrandCardBin = Falha ao buscar nome da bandeira do cartão, response {$response}\n";
            return NULL;
        }

        echo "Authorization::getBrandCardBin = Sucesso ao buscar bandeira do cartão {$responseJson->cardBrand}\n";

        return $responseJson->cardBrand;
    }

    public function toString() {
        $brandName = $this->getBrandCardBin();
        if ($brandName == NULL) {
            echo "Authorization::toJson = Falha ao buscar nome da bandeira do cartão\n";
            return NULL;
        }

        return array("charge" => array(
                "customer" => array(
                    "name" => $this->customer->getName(),
                    "email" => $this->customer->getEmail(),
                    "address" => array(
                        "street" => $this->customer->address->getStreet(),
                        "number" => $this->customer->address->getNumber(),
                        "neighborhood" => $this->customer->address->getNeighborhood(),
                        "city" => $this->customer->address->getCity(),
                        "state" => $this->customer->address->getState(),
                        "country" => $this->customer->address->getCountry(),
                        "zipcode" => $this->customer->address->getZipcode(),
                        "complement" => $this->customer->address->getComplement()
                    ),
                    "phone" => array(
                        "countryCode"=> $this->customer->phone->getCountryCode(),
                        "areaCode" => $this->customer->phone->getAreaCode(),
                        "number" => $this->customer->phone->getNumber(),
                        "type" => $this->customer->phone->getType()
                    )
                ),
                "transactions" => [
                    array(
                        "card" => array(
                            "cardNumber" => $this->transactions->card->getCardNumber(),
                            "cvv" => $this->transactions->card->getCVV(),
                            "cardholderName" => $this->transactions->card->getCardholderName(),
                            "expirationMonth" => $this->transactions->card->getExpirationMonth(),
                            "expirationYear" => $this->transactions->card->getExpirationYear(),
                            "brandName" => $brandName
                        ),
                        "installmentNumber" => $this->transactions->getInstallmentNumber(),
                        "acquirer" => $this->transactions->getAcquirer(),
                        "paymentType" => $this->transactions->getPaymentType(),
                        "amount" => $this->transactions->getAmount()
                    ),
                ],
                "source" => 1,
                "capture" => false
            ));
    }

    public function toJson() {
        return json_encode($this->toString());
    }
}
