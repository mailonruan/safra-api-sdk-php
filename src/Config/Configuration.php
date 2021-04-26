<?php

namespace AditumPayments\ApiSDK\Config;

class Configuration {
    private $url = NULL;

    private $token = "";
    private $cnpj = "";
    private $merchantToken = "";

    // Boleto
    private $daysToExpire = "1";

    private $daysToFine = "1";
    private $fineAmount = "0";
    private $fineInterest = NULL;

    private $discountType = NULL;
    private $discountAmount = "0";
    private $daysToDiscount = "1";

    public const PROD_URL = "https://payment.aditum.com.br/v2/";
    public const DEV_URL  = "https://payment-dev.aditum.com.br/v2/";

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

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return ($this->url == NULL) ? $this::PROD_URL : $this->url;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getToken() {
        return $this->token;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setMerchantToken($merchantToken) {
        $this->merchantToken = $merchantToken;
    }

    public function getMerchantToken() {
        return $this->merchantToken;
    }

    public function setDaysToExpire($daysToExpire) {
        $this->daysToExpire = $daysToExpire;
    }

    public function getDaysToExpire() {
        return $this->daysToExpire;
    }

    public function setDaysToFine($daysToFine) {
        $this->daysToFine = $daysToFine;
    }

    public function getDaysToFine() {
        return $this->daysToFine;
    }

    public function setFineAmount($fineAmount) {
        $this->fineAmount = $fineAmount;
    }

    public function getFineAmount() {
        return $this->fineAmount;
    }

    public function setFineInterest($fineInterest) {
        $this->fineInterest = $fineInterest;
    }

    public function getFineInterest() {
        return $this->fineInterest;
    }


    public function setDiscountType($discountType) {
        $this->discountType = $discountType;
    }

    public function getDiscountType() {
        return $this->discountType;
    }

    public function setDiscountAmount($discountAmount) {
        $this->discountAmount = $discountAmount;
    }

    public function getDiscountAmount() {
        return $this->discountAmount;
    }

    public function setDaysToDiscount($daysToDiscount) {
        $this->daysToDiscount = $daysToDiscount;
    }

    public function getDaysToDiscount() {
        return $this->daysToDiscount;
    }
}
