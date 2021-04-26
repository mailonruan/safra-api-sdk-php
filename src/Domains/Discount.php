<?php

namespace AditumPayments\ApiSDK\Domains;

class Discount {
    private $type = NULL;
    private $amount = NULL;
    private $deadline = NULL;

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