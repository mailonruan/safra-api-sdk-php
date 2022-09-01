<?php

namespace AditumPayments\ApiSDK\Controller;

use AditumPayments\ApiSDK\Configuration;
use AditumPayments\ApiSDK\Helper\Utils;

class Customer
{
    public function create($data)
    {
        Utils::log("\n\n => Customer::create = Iniciando...\n");
        Utils::log("Customer::create = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        $url = Configuration::getUrl() . "customer";

        Utils::log("Customer::create = Url de requisição {$url}\n");
        Utils::log("Customer::create = Body da requisição:\n");
        Utils::log($data->toJson());

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . Configuration::getToken(),
                "Content-Length: " . strlen($data->toJson())
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $data->toJson()
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            curl_close($ch);
            $arrayError = array(
                "httpStatus" => $httpCode,
                "httpMsg" => $response,
                "code" => $errCode,
                "msg" => $errMsg
            );

            return $arrayError;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            $arrayError = array("httpStatus" => '-1', "httpMsg" => $responseJson->errors);
            return $arrayError;
        }

        return $responseJson->customer;
    }

    public function get($data)
    {
        Utils::log("\n\n => Customer::get = Iniciando...\n");
        Utils::log("Customer::get = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        $url = Configuration::getUrl() . "customer?document=" . $data;

        Utils::log("Customer::get = Url de requisição {$url}\n");

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . Configuration::getToken()
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($errMsg || $errCode || empty($response) ||  (($httpCode != 200) && ($httpCode != 201))) {
            curl_close($ch);
            $arrayError = array(
                "httpStatus" => $httpCode,
                "httpMsg" => $response,
                "code" => $errCode,
                "msg" => $errMsg
            );

            return $arrayError;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            $arrayError = array("httpStatus" => '-1', "httpMsg" => $responseJson->errors);
            return $arrayError;
        }

        return $responseJson->customer;
    }
}
