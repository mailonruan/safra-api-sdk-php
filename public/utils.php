<?php

require  '../vendor/autoload.php';

AditumPayments\ApiSDK\Configuration::initialize();
// AditumPayments\ApiSDK\Configuration::setUrl(AditumPayments\ApiSDK\Configuration::DEV_URL);
AditumPayments\ApiSDK\Configuration::setCnpj("31195875000110");
AditumPayments\ApiSDK\Configuration::setMerchantToken("mk_w8qeUpSxZlsdGAP67egxse");
AditumPayments\ApiSDK\Configuration::setlog(true);
AditumPayments\ApiSDK\Configuration::login();

$brandName = AditumPayments\ApiSDK\Helper\Utils::getBrandCardBin("5463373320417272");
if ($brandName == NULL) {
    echo "Authorization::toJson = Falha ao buscar nome da bandeira do cartão\n";
} else {
    echo "\n".$brandName."\n";
}

