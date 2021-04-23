<?php
namespace AditumPayments\ApiSDK;

abstract class Charge {
    public $customer = NULL;
    public $transactions = NULL;

    abstract public function toJson();
}