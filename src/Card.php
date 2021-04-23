<?php

namespace AditumPayments\ApiSDK;

class Card {
    // Opcional
    private $brandName = "";

    // Obrigatório
    private $cardNumber = "";
    private $cvv = "";
    private $cardholderName = "";
    private $expirationMonth = "";
    private $expirationYear = "";


    public function setBrandName($brandName) {
        $this->brandName = $brandName;
    }

    public function getBrandName() {
        return $this->brandName;
    }

    public function setCardNumber($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function getCardNumber() {
        return $this->cardNumber;
    }

    public function setCVV($cvv) {
        $this->cvv = $cvv;
    }

    public function getCVV() {
        return $this->cvv;
    }

    public function setCardholderName($cardholderName) {
        $this->cardholderName = $cardholderName;
    }

    public function getCardholderName() {
        return $this->cardholderName;
    }
    
    public function setExpirationMonth($expirationMonth) {
        $this->expirationMonth = $expirationMonth;
    }

    public function getExpirationMonth() {
        return $this->expirationMonth;
    }

    public function setExpirationYear($expirationYear) {
        $this->expirationYear = $expirationYear;
    }

    public function getExpirationYear() {
        return $this->expirationYear;
    }
}