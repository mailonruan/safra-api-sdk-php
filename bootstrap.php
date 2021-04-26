<?php

require __DIR__ . '/vendor/autoload.php';

$auth = new AditumPayments\ApiSDK\Authentication;
$pay = new AditumPayments\ApiSDK\Payment;

$config = AditumPayments\ApiSDK\Config\Configuration::getInstance();

// ----------------------------------------------------CONFIGURAÇÃO -------------------------------------------------------
$config->setUrl($config::DEV_URL); // Caso não defina a url, será usada de produção
$config->setCnpj("83032272000109");
$config->setMerchantToken("mk_P1kT7Rngif1Xuylw0z96k3");

//Boleto
$config->setDaysToExpire("1");

$config->setDaysToFine("2");
$config->setFineAmount("300");
$config->setFineInterest(10);

// $config->setDiscountType(AditumPayments\ApiSDK\Enum\DiscountType::FIXED);
// $config->setDiscountAmount(200);
// $config->setDaysToDiscount(1);

// ----------------------------------------------------AUTENTICAÇÃO --------------------------------------------------------
// Uso de callback
$callback1 = function($err, $token, $refreshToken) : void {
    if ($err == NULL) {
        echo $token."\n";
        $config = AditumPayments\ApiSDK\Config\Configuration::getInstance();
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
    ."\n";
}

// --------------------------------------------------TRANSACTION ----------------------------------------------------------
$authorization = new AditumPayments\ApiSDK\Domains\Authorization;
$authorization->transactions->card->setCardNumber("5463373320413232"); // Guarda o número do cartão

$brandName = $authorization->getBrandCardBin();
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}

// --------------------------------------------------AUTORIZAÇÃO-------------------------------------------------------------

$authorization = new AditumPayments\ApiSDK\Domains\Authorization;

// Customer
$authorization->customer->setName("fulano");
$authorization->customer->setEmail("fulano@aditum.co");

// Customer->address
$authorization->customer->address->setStreet("Avenida Salvador");
$authorization->customer->address->setNumber("5401");
$authorization->customer->address->setNeighborhood("Recreio dos bandeirantes");
$authorization->customer->address->setCity("Rio de janeiro");
$authorization->customer->address->setState("RJ");
$authorization->customer->address->setCountry("BR");
$authorization->customer->address->setZipcode("2279714");
$authorization->customer->address->setComplement("");

// Customer->phone
$authorization->customer->phone->setCountryCode("55");
$authorization->customer->phone->setAreaCode("21");
$authorization->customer->phone->setNumber("98491715");
$authorization->customer->phone->setType(AditumPayments\ApiSDK\Enum\PhoneType::MOBILE);

// Transactions
$authorization->transactions->setAmount(100);
$authorization->transactions->setPaymentType(AditumPayments\ApiSDK\Enum\PaymentType::CREDIT);
$authorization->transactions->setInstallmentNumber(2); // Só pode ser maior que 1 se o tipo de transação for crédito.
$authorization->transactions->getAcquirer(AditumPayments\ApiSDK\Enum\AcquirerCode::SIMULADOR); // Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM

// Transactions->card
$authorization->transactions->card->setCardNumber("54633733204173232");
$authorization->transactions->card->setCVV("321");
$authorization->transactions->card->setCardholderName("FULANO FULANO");
$authorization->transactions->card->setExpirationMonth(10);
$authorization->transactions->card->setExpirationYear(2022);


// Uso de callback
$callback2 = function($err, $status, $charge) : void {
    if ($err == NULL) {
        if ($status == AditumPayments\ApiSDK\Enum\ChargeStatus::AUTHORIZED) echo "Aprovado!\n";

    } else {
        echo "httStatus: ".$err["httpStatus"]
            ."\n httpMsg: ".$err["httpMsg"]
            ."\n";
    }
};

$pay->charge($authorization, $callback2);

// Retorno de função
$res = $pay->charge($authorization);

if (isset($res["status"])) {
    if ($res["status"] == AditumPayments\ApiSDK\Enum\ChargeStatus::AUTHORIZED) echo "Aprovado!\n";
} else {
    if ($res != NULL)
        echo "httStatus: ".$res["httpStatus"]
        ."\n httpMsg: ".$res["httpMsg"]
        ."\n";
}


// --------------------------------------------------BOLETO-------------------------------------------------------------

$boleto = new AditumPayments\ApiSDK\Domains\Boleto;

// $boleto->setDeadline("2021-04-26");

// Customer
$boleto->customer->setId("00002");
$boleto->customer->setName("fulano");
$boleto->customer->setEmail("fulano@aditum.co");
$boleto->customer->setDocumentType(AditumPayments\ApiSDK\Enum\DocumentType::CPF);
$boleto->customer->setDocument("14533859755");

// Customer->address
$boleto->customer->address->setStreet("Avenida Salvador");
$boleto->customer->address->setNumber("5401");
$boleto->customer->address->setNeighborhood("Recreio dos bandeirantes");
$boleto->customer->address->setCity("Rio de janeiro");
$boleto->customer->address->setState("RJ");
$boleto->customer->address->setCountry("BR");
$boleto->customer->address->setZipcode("2279714");
$boleto->customer->address->setComplement("");

// Customer->phone
$boleto->customer->phone->setCountryCode("55");
$boleto->customer->phone->setAreaCode("21");
$boleto->customer->phone->setNumber("98491715");
$boleto->customer->phone->setType(AditumPayments\ApiSDK\Enum\PhoneType::MOBILE);

// Transactions
$boleto->transactions->setAmount(30000);
$boleto->transactions->setInstructions("Crédito de teste");

// Transactions->fine
// $boleto->transactions->fine->setStartDate("2");
// $boleto->transactions->fine->setAmount(300);
// $boleto->transactions->fine->setInterest(10);

// Transactions->discount
// $boleto->transactions->discount->setType(AditumPayments\ApiSDK\Enum\DiscountType::FIXED);
// $boleto->transactions->discount->setAmount(200);
// $boleto->transactions->discount->setDeadline("1");

var_dump($boleto->toString());

// Uso de callback
$callback2 = function($err, $status, $charge) : void {
    if ($err == NULL) {
        if ($status == AditumPayments\ApiSDK\Enum\ChargeStatus::PRE_AUTHORIZED) echo "PRÉ AUTORIZADO!\n";
    } else {
        echo "httStatus: ".$err["httpStatus"]
            ."\n httpMsg: ".$err["httpMsg"]
            ."\n";
    }
};

$pay->charge($boleto, $callback2);

$id = "";

// Retorno de função
$res = $pay->charge($boleto);

if (isset($res["status"])) {
    if ($res["status"] == AditumPayments\ApiSDK\Enum\ChargeStatus::PRE_AUTHORIZED) echo "PRÉ AUTORIZADO!\n";
    $id = $res["charge"]->id;
} else {
    if ($res != NULL)
        echo "httStatus: ".$res["httpStatus"]
            ."\n httpMsg: ".$res["httpMsg"]
            ."\n";
}


// --------------------------------------------------CHARGE STATUS-------------------------------------------------------------

echo $id."\n";

// Uso de callback
$callback2 = function($err, $status, $charge) : void {
    if ($err == NULL) {
        echo $status."\n";
    } else {
        echo "httStatus: ".$err["httpStatus"]
            ."\n httpMsg: ".$err["httpMsg"]
            ."\n";
    }
};

$pay->chargeStatus($id, $callback2);

// Retorno de função
$res = $pay->chargeStatus($id);

if (isset($res["status"])) {
    echo $res["status"]."\n";
} else {
    echo "httStatus: ".$res["httpStatus"]
        ."\n httpMsg: ".$res["httpMsg"]
        ."\n";
}

