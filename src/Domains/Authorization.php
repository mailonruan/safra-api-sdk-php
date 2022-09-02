<?php

namespace AditumPayments\ApiSDK\Domains;

class Authorization extends Charge
{

    public const CHARGE_TYPE = "Authorization";

    private $capture = true;

    public function __construct()
    {
        $this->products = new Products;
        $this->customer = new Customer;
        $this->transaction = new Transactions;
    }

    public function setCapture($capture = true)
    {
        $this->capture = $capture;
    }

    public function getCapture()
    {
        return $this->capture;
    }

    public function toString()
    {
        return array("charge" => array(
            "products" => $this->products->toString(),
            "customer" => $this->customer->toString(),
            "transactions" => [
                $this->transaction->toString(),
            ],
            "source" => 1,
            "capture" => $this->capture,
            "sessionId" => $this->getSessionId(),
        ));
    }

    public function toJson()
    {
        return json_encode($this->toString());
    }
}
