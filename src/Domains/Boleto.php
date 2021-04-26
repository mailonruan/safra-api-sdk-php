<?php

namespace AditumPayments\ApiSDK\Domains;

use AditumPayments\ApiSDK\Config\Configuration;

class Boleto extends Charge {
    public const CHARGE_TYPE = "Boleto";

    private $deadline = NULL;
    private $FineStartDate = NULL;
    private $discountDeadline = NULL;

    public function __construct() {
        $this->customer = new Customer;
        $this->transactions = new Transactions;
    }

    public function setDeadline($deadline) {
        $this->dealine = $deadline;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function toString() {
        $config = Configuration::getInstance();

        if ($this->deadline == NULL) {
            $this->deadline = new \DateTime('NOW');
            $this->deadline->modify("+{$config->getDaysToExpire()} day");
            $this->deadline = $this->deadline->format('Y-m-d');
        }

        if ($this->transactions->fine->getStartDate() == NULL) {
            $this->FineStartDate = new \DateTime('NOW');
            $this->FineStartDate->modify("+{$config->getDaysToFine()} day");
            $this->transactions->fine->setStartDate($this->FineStartDate->format('Y-m-d'));
        }

        if ($this->transactions->fine->getAmount() == NULL) {
            $this->transactions->fine->setAmount($config->getFineAmount());
        }


        if ($this->transactions->fine->getInterest() == NULL) {
            $this->transactions->fine->setInterest($config->getFineInterest());
        }

        if ($this->transactions->discount->getType() == NULL) {
            $this->transactions->discount->setType($config->getDiscountType());
        }

        if ($this->transactions->discount->getAmount() == NULL) {
            $this->transactions->discount->setAmount($config->getDiscountAmount());
        }

        if ($this->transactions->discount->getDeadline() == NULL) {
            $this->discountDeadline = new \DateTime('NOW');
            $this->discountDeadline->modify("- {$config->getDaysToDiscount()} day");
            $this->transactions->discount->setDeadline($this->discountDeadline->format('Y-m-d'));
        }

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
                            "startDate" => $this->transactions->fine->getStartDate(),
                            "amount" => $this->transactions->fine->getAmount(),
                            "interest" => $this->transactions->fine->getInterest()
                        ),
                        "discount" => array(
                            "type" => $this->transactions->discount->getType(),
                            "amount" => $this->transactions->discount->getAmount(),
                            "deadline" => $this->transactions->discount->getDeadline()
                        )
                    ),
                ],
                "source" => 1,
                "deadline" => $this->deadline
            ),
        );
    }

    public function toJson() {
        return json_encode($this->toString());
    }
}
