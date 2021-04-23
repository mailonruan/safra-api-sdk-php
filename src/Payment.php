<?php

namespace AditumPayments\ApiSDK;

class Payment {

    private $config;

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
    }

    public function chargeAuthorization($data, ...$callBack) {
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

    public function chargeBoleto($data, ...$callBack) {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => "{$this->config->getUrl()}charge/boleto",
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

    public function chargeStatus($id, ...$callBack) {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "{$this->config->getUrl()}charge/{$id}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer {$this->config->getToken()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1
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
    public function checkoutByLink() {}

}
