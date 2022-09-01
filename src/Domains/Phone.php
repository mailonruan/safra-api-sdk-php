<?php

namespace AditumPayments\ApiSDK\Domains;

class Phone
{
    private $countryCode = "55";
    private $areaCode = "";
    private $number = "";
    private $type = 0;

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    }

    public function getAreaCode()
    {
        return $this->areaCode;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function toString()
    {
        return array(
            "countryCode" => $this->countryCode,
            "areaCode" => $this->areaCode,
            "number" => $this->number,
            "type" => $this->type
        );
    }

    public function toJson()
    {
        return json_encode($this->toString());
    }
}
