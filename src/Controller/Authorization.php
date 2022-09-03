<?php

namespace AditumPayments\ApiSDK\Controller;

use AditumPayments\ApiSDK\Configuration;
use AditumPayments\ApiSDK\Helper\Utils;

class Authorization
{

    public function charge($data)
    {
        Utils::log("\n\n => Authorization::charge = Iniciando...\n");
        Utils::log("Authorization::charge = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        if ($data->getCapture()) {
            $url = Configuration::getUrl() . "charge/authorization";
        } else {
            $url = Configuration::getUrl() . "charge/preauthorization";
        }

        Utils::log("Authorization::charge = Url de requisição {$url}\n");
        Utils::log("Authorization::charge = Body da requisição:\n");
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
                "msg" => $errMsg,
                "body" => $data->toJson()
            );

            return $arrayError;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            $arrayError = array("httpStatus" => '-1', "httpMsg" => $responseJson->errors);
            return $arrayError;
        }

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge);
    }

    public function get($data)
    {
        Utils::log("\n\n => Authorization::get = Iniciando...\n");
        Utils::log("Authorization::get = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        $url = Configuration::getUrl() . "charge/" . $data;

        Utils::log("Authorization::get = Url de requisição {$url}\n");

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . Configuration::getToken()
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1
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

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge);
    }

    public function cancel($data)
    {
        Utils::log("\n\n => Authorization::cancel = Iniciando...\n");
        Utils::log("Authorization::cancel = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        $url = Configuration::getUrl() . "charge/cancelation/" . $data;

        Utils::log("Authorization::cancel = Url de requisição {$url}\n");

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_PUT => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . Configuration::getToken()
            ],
            CURLOPT_TIMEOUT => 30,

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

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge);
    }

    public function capture($data)
    {
        Utils::log("\n\n => Authorization::capture = Iniciando...\n");
        Utils::log("Authorization::capture = URL " . Configuration::getURL() . "\n");

        $ch = curl_init();

        $url = Configuration::getUrl() . "charge/capture/" . $data;

        Utils::log("Authorization::capture = Url de requisição {$url}\n");

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_PUT => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . Configuration::getToken()
            ],
            CURLOPT_TIMEOUT => 30,

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

        return array("status" => $responseJson->charge->chargeStatus, "charge" => $responseJson->charge, "captured" => $responseJson->captured);
    }
}
