<?php

require __DIR__ . '/vendor/autoload.php';

$auth = new AditumPayments\ApiSDK\Authentication;
$pay = new AditumPayments\ApiSDK\Payment;
$config = AditumPayments\ApiSDK\Configuration::getInstance();

/*
// ----------------------------------------------------CONFIGURAÇÃO -------------------------------------------------------
$config->setUrl($config->getDevUrl()); // Caso não defina a url, será usada de produção
$config->setCustomerName("ceres");
$config->setCustomerEmail("ceres@aditum.co");
$config->setCnpj("83032272000109");
$config->setMerchantToken("mk_P1kT7Rngif1Xuylw0z96k3");

// ----------------------------------------------------AUTENTICAÇÃO --------------------------------------------------------
// Uso de callback
$callback1 = function($err, $token, $refreshToken) : void {
    if ($err == NULL) {
        echo $token."\n";
        $config = AditumPayments\ApiSDK\Configuration::getInstance();
        $config->setToken($token);

    } else {
        echo "httStatus: ".$err["httpStatus"]
            ."\nhttpMsg: ".$err["httpMsg"]
            ."\ncode: ".$err['code']
            ."\nmsg: ".$err['msg']
            ."\n";
    }
};

$auth->requestToken($callback1);

// Retorno de função
$res = $auth->requestToken();

if (isset($res["token"])) {
    echo $res["token"]."\n";

} else {
    echo "httStatus: ".$res["httpStatus"]
    ."\n httpMsg: ".$res["httpMsg"]
    ."\n code: ".$res['code']
    ."\n msg:".$res['msg']
    ."\n";
}

// --------------------------------------------------AUTORIZAÇÃO-------------------------------------------------------------

$data = new AditumPayments\ApiSDK\Transaction;
$data->setCardNumber("5463373320417272");
$data->setCVV("879");
$data->setCardholderName("CERES ROHANA");
$data->setExpirationMonth(10);
$data->setExpirationYear(2022);
$data->setAmount(100);
$data->setPaymentType($pay::PAYMENT_TYPE_CREDIT);

// Uso de callback
$callback2 = function($err, $chargeStatus, $data) : void {
    if ($err == NULL) {
        if ($chargeStatus == AditumPayments\ApiSDK\Payment::CHARGE_STATUS_AUTHORIZED) echo "Aprovado!\n";

    } else {
        echo "httStatus: ".$err["httpStatus"]
            ."\n httpMsg: ".$err["httpMsg"]
            ."\n code: ".$err['code']
            ."\n msg:".$err['msg']
            ."\n";
    }
};

$pay->authorization($data, $callback2);

// Retorno de função
$res = $pay->authorization($data);

if (isset($res["status"])) {
    if ($res["status"] == $pay::CHARGE_STATUS_AUTHORIZED) echo "Aprovado!\n";
} else {
    echo "httStatus: ".$res["httpStatus"]
    ."\n httpMsg: ".$res["httpMsg"]
    ."\n code: ".$res['code']
    ."\n msg:".$res['msg']
    ."\n";
}
*/