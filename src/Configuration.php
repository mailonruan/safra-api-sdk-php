<?php

namespace AditumPayments\ApiSDK;

class Configuration {
    private $fileName = "config.json";

    // Charge status
    public const CHARGE_STATUS_AUTHORIZED         = "Authorized";
    public const CHARGE_STATUS_PRE_AUTHORIZED     = "PreAuthorized";
    public const CHARGE_STATUS_CANCELED           = "Canceled";
    public const CHARGE_STATUS_PARTIAL            = "Partial";
    public const CHARGE_STATUS_NOT_AUTHORIZED     = "NotAuthorized";
    public const CHARGE_STATUS_NOT_PENDING_CANCEL = "PendingCancel";

    // Payments type
    public const PAYMENT_TYPE_UNDEFINED   = 0;
    public const PAYMENT_TYPE_DEBIT       = 1;
    public const PAYMENT_TYPE_CREDIT      = 2;
    public const PAYMENT_TYPE_VOUCHER     = 3;
    public const PAYMENT_TYPE_BOLETO      = 4;
    public const PAYMENT_TYPE_TED         = 5;
    public const PAYMENT_TYPE_DOC         = 6;
    public const PAYMENT_TYPE_SAFETY_PAY  = 7;


    // Card brand name
    public const CARD_BRAND_VISA           = "Visa";
    public const CARD_BRAND_MASTER_CARD    = "MasterCard";
    public const CARD_BRAND_AMEX           = "Amex";
    public const CARD_BRAND_ELO            = "Elo";
    public const CARD_BRAND_AURA           = "Aura";
    public const CARD_BRAND_JCB            = "Jcb";
    public const CARD_BRAND_DINERS         = "Diners";
    public const CARD_BRAND_DISCOVER       = "Discover";
    public const CARD_BRAND_HIPERCARD      = "Hipercard";
    public const CARD_BRAND_ENROUTE        = "Enroute";
    public const CARD_BRAND_TICKET         = "Ticket";
    public const CARD_BRAND_SODEXO         = "Sodexo";
    public const CARD_BRAND_VR             = "Vr";
    public const CARD_BRAND_ALELO          = "Alelo";
    public const CARD_BRAND_SETRA          = "Setra";
    public const CARD_BRAND_VERO           = "Vero";
    public const CARD_BRAND_SOROCRED       = "Sorocred";
    public const CARD_BRAND_GREEN_CARD     = "GreenCard";
    public const CARD_BRAND_CABAL          = "Cabal";
    public const CARD_BRAND_BANESCARD      = "Banescard";
    public const CARD_BRAND_VERDE_CARD     = "VerdeCard";
    public const CARD_BRAND_VALE_CARD      = "ValeCard";
    public const CARD_BRAND_UNION_PAY      = "UnionPay";
    public const CARD_BRAND_UP             = "Up";
    public const CARD_BRAND_TRICARD        = "Tricard";
    public const CARD_BRAND_BIGCARD        = "Bigcard";
    public const CARD_BRAND_BEN            = "Ben";
    public const CARD_BRAND_REDE_COMPRAS   = "RedeCompras";

    public function getProdURL() {
        $json = file_get_contents($this->fileName);
        $data = json_decode($json);

        return $data->urlProd;
    }

    public function getDevURL() {
        $json = file_get_contents($this->fileName);
        $data = json_decode($json);

        return $data->urlDev;
    }

    public function setToken($token) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->token = $token;
        $json_editado = file_put_contents($this->fileName,json_encode($json));
    }

    public function getToken() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->token;
    }

    public function setCustomerName($customerName) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->customerName = $customerName;
        $json_editado = file_put_contents($this->fileName,json_encode($json)); 
    }

    public function getCustomerName() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->customerName;
    }

    public function setCustomerEmail($customerEmail) {
        $json = json_decode(file_get_contents($this->fileName));
        $json->customerEmail = $customerEmail;
        $json_editado = file_put_contents($this->fileName,json_encode($json)); 
    }

    public function getCustomerEmail() {
        $json = json_decode(file_get_contents($this->fileName));
        return $json->customerEmail;
    }
}
