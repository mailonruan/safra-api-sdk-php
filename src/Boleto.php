<?php

namespace AditumPayments\ApiSDK;

class Boleto extends Charge{

    public function __construct() {
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function toJson() {
        $dateTime = new \DateTime('NOW');

        return json_encode(array(
            "charge" => array(
                "customer" => array(
                    "name" => $this->customer->getName(),
                    "email" => $this->customer->getEmail(),
                    "documentType" => $this->customer->getDocumentType(),
                    "document" =>  $this->customer->getDocument(),
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
                        "amount" => $this->transactions->getAmount(),
                        "instructions" => $this->transactions->getInstructions()
                    ),
                ],
                "source" => 1,
                "deadline" => $dateTime->format('Y-m-d')
            ),
        ));
    }
}
