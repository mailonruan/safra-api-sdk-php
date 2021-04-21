<?php

namespace AditumPayments\ApiSDK;

class Configuration {
    private $urlProd = "https://payment.aditum.com.br/v2/";
    private $urlDev = "https://payment-dev.aditum.com.br/v2/";
    private $token = "";
    private $customerName = "";
    private $customerEmail = "";
    
    public static $instance;

    private function __construct() {}

    public static function getInstance($params = NULL) {
        if (!isset(self::$instance)) {
            self::$instance = new Configuration;
        }

        return self::$instance;
    }

    public function getProdURL() {
        return $this->urlProd;
    }

    public function getDevURL() {
        return $this->urlDev;
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
}
