<?php

namespace AditumPayments\ApiSDK;

use AditumPayments\ApiSDK\Config\Configuration;

class Authentication {
    private $config;

    public function __construct($objectConfig = NULL) {
        $this->config = ($objectConfig) ? $objectConfig : Configuration::getInstance();
    }

    public function requestToken(...$callBack) {
        $merchantCredential = password_hash($this->config->getCnpj()."".$this->config->getMerchantToken(), PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => "{$this->config->getUrl()}merchant/auth",
            CURLOPT_HTTPHEADER => [
                "Authorization: {$merchantCredential}",
                "merchantCredential: {$this->config->getCnpj()}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
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

        if (count($callBack))
            $callBack[0](NULL, $responseJson->accessToken, $responseJson->refreshToken);
        
        return array("token" => $responseJson->accessToken, "refreshToken" => $responseJson->refreshToken);
    }

    // @TODO: A implementar
    public function requestRefreshToken() {}
}
