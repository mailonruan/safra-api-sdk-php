<?php

namespace AditumPayments\ApiSDK\Domains;

use AditumPayments\ApiSDK\Enum\AcquirerCode;
use AditumPayments\ApiSDK\Enum\PaymentType;
use AditumPayments\ApiSDK\Enum\InstallmentType;

class Transactions
{
    private $amount = "";
    private $installmentNumber = 1;
    private $instructions = "";
    private $installmentType = InstallmentType::NONE;
    private $softDescriptor = "";
    private $acquirer = AcquirerCode::SAFRA_PAY;
    private $paymentType = PaymentType::CREDIT;
    private $cardId = "";
    private $cardCVV = "";

    public function __construct()
    {
    }

    public function setCardId($cardId)
    {
        $this->cardId = $cardId;
    }

    public function getCardId()
    {
        return $this->cardId;
    }

    public function setCardCVV($cardCVV)
    {
        $this->cardCVV = $cardCVV;
    }

    public function getCardCVV()
    {
        return $this->cardCVV;
    }

    public function setAmount($amount)
    {
        /* in cents */
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setSoftDescriptor($softDescriptor)
    {
        $this->softDescriptor = $softDescriptor;
    }

    public function getSoftDescriptor()
    {
        return $this->softDescriptor;
    }

    public function setInstallmentNumber($installmentNumber)
    {
        if ($installmentNumber > 1) {
            $this->installmentType = InstallmentType::MERCHANT;
        } else {
            $this->installmentType = InstallmentType::NONE;
        }
        $this->installmentNumber = $installmentNumber;
    }

    public function getInstallmentNumber()
    {
        return $this->installmentNumber;
    }

    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function setInstallmentType($installmentType)
    {
        $this->installmentType = $installmentType;
    }

    public function getInstallmentType()
    {
        return $this->installmentType;
    }

    public function toString()
    {
        return array(
            "card" => array(
                "id" => $this->cardId,
                "cvv" => $this->cardCVV
            ),
            "installmentNumber" => $this->installmentNumber,
            "paymentType" => $this->paymentType,
            "amount" => $this->amount,
            "installmentType" => $this->installmentType,
            "softDescriptor" => $this->softDescriptor ? $this->softDescriptor : "",
            "acquirer" => $this->acquirer
        );
    }

    public function toJson()
    {
        return json_encode($this->toString());
    }
}
