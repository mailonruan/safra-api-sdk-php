<?php

namespace AditumPayments\ApiSDK\Controller;

use AditumPayments\ApiSDK\Configuration;
use AditumPayments\ApiSDK\Helper\Utils;

class PreAuthorization {

    public function charge($data) {
        $brandName = Utils::getBrandCardBin($data->transactions->card->getCardNumber());
        if ($brandName == NULL) {
            Utils::log("PreAuthorization::toJson = Falha ao buscar nome da bandeira do cartão\n");
            return NULL;
        } else {
            $data->transactions->card->setBrandName($brandName);
        }
        
        Utils::log("\n\n => PreAuthorization::charge = Iniciando...\n");

        $ch = curl_init();

        $url = Configuration::getUrl()."charge/preauthorization";

        Utils::log("PreAuthorization::charge = Url de requisição {$url}\n");
        Utils::log("PreAuthorization::charge = Body da requisição:\n");
        Utils::log($data->toJson());

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer ".Configuration::getToken(),
                "Content-Length: ".strlen($data->toJson()) 
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
            
            return $arrayError;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            $arrayError = array("code" => '-1', "httpMsg" => $responseJson->errors);
            return $arrayError;
        }

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge);
    }
}