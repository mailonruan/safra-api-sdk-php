<?php

namespace AditumPayments\ApiSDK;

class Boleto extends Charge {
    public const CHARGE_TYPE = "Boleto";

    private $deadline;

    public function __construct() {
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function setDeadline($deadline) {
        $this->deadline = $deadline;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function toString() {
        $dateTimeFine = new \DateTime('NOW');
        $dateTimeFine->modify("+{$this->transactions->fine->getStartDate()} day");

        $dateTimeDiscount = new \DateTime('NOW');
        $dateTimeDiscount->modify("-{$this->transactions->discount->getDeadline()} day");

        return array(
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
                        "instructions" => $this->transactions->getInstructions(),
                        "fine" => array(
                            "startDate" => $dateTimeFine->format('Y-m-d'),
                            "amount" => $this->transactions->fine->getAmount(),
                            "interest" => $this->transactions->fine->getInterest()
                        ),
                        "discount" => array(
                            "type" => $this->transactions->discount->getType(),
                            "amount" => $this->transactions->discount->getAmount(),
                            "deadline" => $dateTimeDiscount->format('Y-m-d')
                        )
                    ),
                ],
                "source" => 1,
                "deadline" => $this->getDeadline()
            ),
        );
    }

    public function toJson() {
        return json_encode($this->toString());
    }
}
