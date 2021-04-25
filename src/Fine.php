<?php

namespace AditumPayments\ApiSDK;

class Fine {
    private $startDate = "1";
    private $amount = 0;
    private $interest = 0;

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