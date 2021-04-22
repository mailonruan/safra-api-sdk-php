<?php

namespace AditumPayments\ApiSDK;

class Configuration {
    private $url = NULL;

    private $ProdUrl = "https://payment.aditum.com.br/v2/";
    private $DevUrl = "https://payment-dev.aditum.com.br/v2/";
    private $token = "";
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
