<?php

namespace AditumPayments\ApiSDK;

class Discount {
    private $type = 0;
    private $amount = 0;
    private $deadline = "0";

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setDeadline($deadline) {
        $this->deadline = $deadline;
    }

    public function getDeadline() {
        return $this->deadline;
    }
}