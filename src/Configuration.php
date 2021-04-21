<?php

namespace AditumPayments\ApiSDK;

class Configuration {
    private $fileName = "config.json";

    public function getProdURL() {
        $json = file_get_contents($this->fileName);
        $data = json_decode($json);

        return $data->urlProd;
    }

    public function getDevURL() {
        $json = file_get_contents($this->fileName);
        $data = json_decode($json);

        return $data->urlDev;
    }

    public function setToken($token) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->token = $token;
        $json_editado = file_put_contents($this->fileName,json_encode($json));
    }

    public function getToken() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->token;
    }

    public function setCustomerName($customerName) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->customerName = $customerName;
        $json_editado = file_put_contents($this->fileName,json_encode($json)); 
    }

    public function getCustomerName() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->customerName;
    }

    public function setCustomerEmail($customerEmail) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->customerEmail = $customerEmail;
        $json_editado = file_put_contents($this->fileName,json_encode($json)); 
    }

    public function getCustomerEmail() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->customerEmail;
    }
}
