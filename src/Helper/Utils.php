<?php

namespace AditumPayments\ApiSDK\Helper;

use AditumPayments\ApiSDK\Configuration;

abstract class Utils {
    public static function getBrandCardBin($cardNumber) {
        echo "\n\n => Utils::getBrandCardBin = Iniciando...\n";

        $bin = substr($cardNumber, 0, 4);

        $url = "https://portal-dev.aditum.com.br/v1/"; // @TODO: necessário remover quando estiver no novo endpoint
        $urlRequest = "{$url}card/bin/brand/{$bin}";

        echo "Utils::getBrandCardBin = Url de requisição {$urlRequest}\n";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $urlRequest,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer ".Configuration::getToken(),
                "Content-Length: 0"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        echo "Utils::getBrandCardBin = Buscando nome da bandeira\n";

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            echo "Utils::getBrandCardBin = Falha ao buscar nome da bandeira do cartão, httpCode {$httpCode}\n";
            return NULL;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            echo "Utils::getBrandCardBin = Falha ao buscar nome da bandeira do cartão, response {$response}\n";
            return NULL;
        }

        echo "Utils::getBrandCardBin = Sucesso ao buscar bandeira do cartão {$responseJson->cardBrand}\n";

        return $responseJson->cardBrand;
    }
}