<?php

namespace AditumPayments\ApiSDK\Domains;

class Fine {
    private $startDate = NULL;
    private $amount = NULL;
    private $interest = NULL;

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setInterest($interest) {
        $this->interest = $interest;
    }

    public function getInterest() {
        return $this->interest;
    }
}