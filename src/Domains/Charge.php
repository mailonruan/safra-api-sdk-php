<?php
namespace AditumPayments\ApiSDK\Domains;

abstract class Charge {
    public const CHARGE_TYPE = "Undefined";

    public $customer = NULL;
    public $transactions = NULL;

    private $id = "";
    private $sessionId = "";

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    abstract public function toString();
    abstract public function toJson();
}