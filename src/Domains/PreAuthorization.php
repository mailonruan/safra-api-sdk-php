<?php

namespace AditumPayments\ApiSDK\Domains;

class PreAuthorization extends Charge {

    public const CHARGE_TYPE = "PreAuthorization";

    private $sessionId = "";

    public function __construct() {
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function toString() {
        return array("charge" => array(
                "customer" => array(
                    "name" => $this->customer->getName(),
                    "email" => $this->customer->getEmail(),
                    "address" => array(
                        "street" => $this->customer->address->getStreet(),
                        "number" => $this->customer->address->getNumber(),
                        "neighborhood" => $this->customer->address->getNeighborhood(),
                        "city" => $this->customer->address->getCity(),
                        "state" => $this->customer->address->getState(),
                        "country" => $this->customer->address->getCountry(),
                        "zipcode" => $this->customer->address->getZipcode(),
                        "complement" => $this->customer->address->getComplement()
                    ),
                    "phone" => array(
                        "countryCode"=> $this->customer->phone->getCountryCode(),
                        "areaCode" => $this->customer->phone->getAreaCode(),
                        "number" => $this->customer->phone->getNumber(),
                        "type" => $this->customer->phone->getType()
                    )
                ),
                "transactions" => [
                    array(
                        "card" => array(
                            "cardNumber" => $this->transactions->card->getCardNumber(),
                            "cvv" => $this->transactions->card->getCVV(),
                            "cardholderName" => $this->transactions->card->getCardholderName(),
                            "expirationMonth" => $this->transactions->card->getExpirationMonth(),
                            "expirationYear" => $this->transactions->card->getExpirationYear(),
                            "brandName" => $this->transactions->card->getBrandName()
                        ),
                        "installmentNumber" => $this->transactions->getInstallmentNumber(),
                        "acquirer" => $this->transactions->getAcquirer(),
                        "paymentType" => $this->transactions->getPaymentType(),
                        "amount" => $this->transactions->getAmount()
                    ),
                ],
                "source" => 1,
                "capture" => false,
                "sessionId" => $this->getSessionId()
            ));
    }

    public function toJson() {
        return json_encode($this->toString());
    }
}
