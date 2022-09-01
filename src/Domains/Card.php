<?php

namespace AditumPayments\ApiSDK\Domains;

class Card
{
    // Opcional
    private $brandName = "";

    // Obrigatório
    private $customerId = "";
    private $cardNumber = "";
    private $cvv = "";
    private $cardholderName = "";
    private $expirationMonth = "";
    private $expirationYear = "";
    private $cardholderDocument = "";

    public function __construct()
    {
        $this->address = new Address;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    public function getBrandName()
    {
        return $this->brandName;
    }

    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    public function setCVV($cvv)
    {
        $this->cvv = $cvv;
    }

    public function getCVV()
    {
        return $this->cvv;
    }

    public function setCardholderName($cardholderName)
    {
        $this->cardholderName = $cardholderName;
    }

    public function getCardholderName()
    {
        return $this->cardholderName;
    }

    public function setExpirationMonth($expirationMonth)
    {
        $this->expirationMonth = $expirationMonth;
    }

    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    public function setExpirationYear($expirationYear)
    {
        $this->expirationYear = $expirationYear;
    }

    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    public function setCardholderDocument($cardholderDocument)
    {
        $this->cardholderDocument = $cardholderDocument;
    }

    public function getCardholderDocument()
    {
        return $this->cardholderDocument;
    }

    public function toString()
    {
        return array(
            "customerId" => $this->customerId,
            "card" => array(
                "cardNumber" => $this->cardNumber,
                "cvv" => $this->cvv,
                "cardholderName" => $this->cardholderName,
                "expirationMonth" => $this->expirationMonth,
                "expirationYear" => $this->expirationYear,
                "brandName" => $this->brandName,
                "cardholderDocument" => $this->cardholderDocument,
                "billingAddress" => $this->address->toString()
            )
        );
    }

    public function toJson()
    {
        return json_encode($this->toString());
    }
}
