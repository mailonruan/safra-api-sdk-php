<?php

require  '../vendor/autoload.php';

AditumPayments\ApiSDK\Configuration::initialize();
/* AditumPayments\ApiSDK\Configuration::setUrl(AditumPayments\ApiSDK\Configuration::DEV_URL); */
AditumPayments\ApiSDK\Configuration::setCnpj("46018667000112");
AditumPayments\ApiSDK\Configuration::setMerchantToken("mk_3FrBI1GSEEuQ5371Qie3w");
AditumPayments\ApiSDK\Configuration::setlog(true);
AditumPayments\ApiSDK\Configuration::login();

$controller = new AditumPayments\ApiSDK\Controller\Customer;
$customer = new AditumPayments\ApiSDK\Domains\Customer;

// Customer
$customer->setName("fulano");
$customer->setEmail("fulano@aditum.co");
$customer->setDocumentType(AditumPayments\ApiSDK\Enum\DocumentType::CPF);
$customer->setDocument("14533859755");

// Customer->address
$customer->address->setStreet("Avenida Salvador");
$customer->address->setNumber("5401");
$customer->address->setNeighborhood("Recreio dos bandeirantes");
$customer->address->setCity("Rio de janeiro");
$customer->address->setState("RJ");
$customer->address->setCountry("BR");
$customer->address->setZipcode("2279714");
$customer->address->setComplement("");

// Customer->phone
$customer->phone->setCountryCode("55");
$customer->phone->setAreaCode("21");
$customer->phone->setNumber("98491715");
$customer->phone->setType(AditumPayments\ApiSDK\Enum\PhoneType::MOBILE);

$res = $controller->create($customer);

echo "\n\nResposta:\n";
print_r(json_encode($res));


echo "\nhttStatus: " . $res["httpStatus"]
    . "\nhttpMsg: " . $res["httpMsg"]
    . "\n";

echo "\n";
