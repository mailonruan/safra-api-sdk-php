# Configuration

Dentro dessa classe podemos definir e obter informações como a url de desenvolvimento e produção, merchanToken e CNPJ.

```php
$config = AditumPayments\ApiSDK\Config\Configuration::getInstance();

$config->setUrl($config::DEV_URL); // Caso não defina a url, será usada de produção
$config->setCnpj("83032272000109");
$config->setMerchantToken("mk_P1kT7Rngif1Xuylw0z96k3");

//Boleto
$config->setDaysToExpire("1");

// Opcional
$config->setDaysToFine("2"); 
$config->setFineAmount("300"); 
$config->setFineInterest(10); 

// Opcional
$config->setDiscountType(AditumPayments\ApiSDK\Enum\DiscountType::FIXED); 
$config->setDiscountAmount(200);
$config->setDaysToDiscount(1);
```
