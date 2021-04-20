<?php

require __DIR__ . '/vendor/autoload.php';

$auth = new AditumPayments\Authentication;
$config = new AditumPayments\Configuration;
$pay = AditumPayments\Payment::getInstance(array(
    "url" =>  $config->getDevURL(),
));

// $config->setCustomerName("ceres");
// $config->setCustomerEmail("ceres@aditum.co");

// $callback1 = function($err, $token, $refreshToken) : void {
//     if ($err == NULL) {
//         // echo $token;
//         $config = new AditumPayments\Configuration;
//         $config->setToken($token);

//     } else {
//         echo 'httStatus: '.$err["httpStatus"].' httpMsg: '.$err["httpMsg"].' code: '.$err['code'].' msg:'.$err['msg'];
//     }
// };

// $data = array(
//     "url" => $config->getDevURL(),
//     "cnpj" => "83032272000109",
//     "merchantToken" => "mk_P1kT7Rngif1Xuylw0z96k3"
// );

// $auth->requestToken($data, $callback1);

// $callback2 = function($err, $chargeStatus, $data) : void {
//     if ($err == NULL) {
//         if ($chargeStatus == AditumPayments\Configuration::CHARGE_STATUS_AUTHORIZED) echo "Aprovado!";

//     } else {
//         echo 'httStatus: '.$err["httpStatus"].' httpMsg: '.$err["httpMsg"].' code: '.$err['code'].' msg:'.$err['msg'];
//     }
// };

// $data = array(
//     "cardNumber" => "5463373320417272",
//     "cvv" => "879",
//     "brandName" => AditumPayments\Configuration::CARD_BRAND_MASTER_CARD,
//     "cardholderName" => "CERES ROHANA",
//     "expirationMonth" => 10,
//     "expirationYear" => 2022,
//     "paymentType" => AditumPayments\Configuration::PAYMENT_TYPE_CREDIT,
//     "amount" => 100,
// );

//$pay->authorization($data, $callback2);

// $callback3 = function($err, $data) : void {
//     if ($err == NULL) {
//         echo $data;

//     } else {
//         echo 'httStatus: '.$err["httpStatus"].' httpMsg: '.$err["httpMsg"].' code: '.$err['code'].' msg:'.$err['msg'];
//     }
// };

// $url = "https://portal-dev.aditum.com.br/v1/";
// $pay->getBrandCardBin($url, "5162", $callback3);