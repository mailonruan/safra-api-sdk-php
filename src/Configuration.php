<?php

namespace AditumPayments\ApiSDK;

class Configuration {
    private $url = NULL;

    private $ProdUrl = "https://payment.aditum.com.br/v2/";
    private $DevUrl = "https://payment-dev.aditum.com.br/v2/";
    private $token = "";
    private $customerName = "";
    private $customerEmail = "";
    private $cnpj = "";
    private $merchantToken = "";

    public static $instance;

    private function __construct() {}

    public static function getInstance($params = NULL) {
        if (!isset(self::$instance)) {
            self::$instance = new Configuration;
            if ($params != NULL) {
                self::$instance->setURL($params["url"]);
                self::$instance->setToken($params["token"]);
                self::$instance->setCustomerName($params["customerName"]);
                self::$instance->setCustomerEmail($params["customerEmail"]);
            }
        }

        return self::$instance;
    }

    public function getUrl() {
        return ($this->url == NULL) ? $this->getProdUrl() : $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getProdUrl() {
        return $this->ProdUrl;
    }

    public function getDevUrl() {
        return $this->DevUrl;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getToken() {
        return $this->token;
    }

    public function setCustomerName($customerName) {
        $this->customerName = $customerName;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function setCustomerEmail($customerEmail) {
        $this->customerEmail = $customerEmail;
    }

    public function getCustomerEmail() {
        return $this->customerEmail;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getMerchantToken() {
        return $this->merchantToken;
    }

    public function setMerchantToken($merchantToken) {
        $this->merchantToken = $merchantToken;
    }
}
