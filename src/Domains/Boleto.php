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

    private function validateDiscount() {
        $config = Configuration::getInstance();

        if ($this->transactions->discount->getType() == NULL) {
            $discountType = $config->getDiscountType();
            if ($discountType == NULL) return "";

            $this->transactions->discount->setType($config->getDiscountType());
        }

        if ($this->transactions->discount->getAmount() == NULL) {
            $discountAmount = $config->getDiscountAmount();
            if ($discountAmount == NULL) return "";

            $this->transactions->discount->setAmount($config->getDiscountAmount());
        }

        if ($this->transactions->discount->getDeadline() == NULL) {
            $daysToDiscount = $config->getDaysToDiscount();
            if ($daysToDiscount) return "";

            $this->discountDeadline = new \DateTime('NOW');
            $this->discountDeadline->modify("- {$config->getDaysToDiscount()} day");
            $this->transactions->discount->setDeadline($this->discountDeadline->format('Y-m-d'));
        }

        return array(
                "type" => $this->transactions->discount->getType(),
                "amount" => $this->transactions->discount->getAmount(),
                "deadline" => $this->transactions->discount->getDeadline()
        );
        
    }

    private function validateFine() {
        $config = Configuration::getInstance();

        if ($this->transactions->fine->getStartDate() == NULL) {
            $daysToFine = $config->getDaysToFine();
            if ($daysToFine == NULL) return "";

            $this->FineStartDate = new \DateTime('NOW');
            $this->FineStartDate->modify("+{$config->getDaysToFine()} day");
            $this->transactions->fine->setStartDate($this->FineStartDate->format('Y-m-d'));
        }

        if ($this->transactions->fine->getAmount() == NULL) {
            $fineAmount = $config->getFineAmount();
            if ($fineAmount == NULL) return NULL;

            $this->transactions->fine->setAmount($config->getFineAmount());
        }


        if ($this->transactions->fine->getInterest() == NULL) {
            $fineInterest = $config->getFineInterest();
            if ($fineInterest == NULL) return "";

            $this->transactions->fine->setInterest($config->getFineInterest());
        }

        return array(
            "startDate" => $this->transactions->fine->getStartDate(),
            "amount" => $this->transactions->fine->getAmount(),
            "interest" => $this->transactions->fine->getInterest()
        );
    }

    public function toString() {
        $config = Configuration::getInstance();

        if ($this->deadline == NULL) {
            $this->deadline = new \DateTime('NOW');
            $this->deadline->modify("+{$config->getDaysToExpire()} day");
            $this->deadline = $this->deadline->format('Y-m-d');
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
                        "fine" => $this->validateFine(),
                        "discount" => $this->validateDiscount()
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
