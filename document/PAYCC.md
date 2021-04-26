## Payment

### chargeAuthorization(object`(Authorization)`,  callback`(opcional)`) : array()
Faz uma transação por cartão.

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;
$authorization = new AditumPayments\ApiSDK\Authorization;

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
$authorization->customer->phone->setType(AditumPayments\ApiSDK\PhoneType::MOBILE);

// Transactions
$authorization->transactions->setAmount(100);
$authorization->transactions->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT);
$authorization->transactions->setInstallmentNumber(2); // Só pode ser maior que 1 se o tipo de transação for crédito.
$authorization->transactions->getAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); // Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM

// Transactions->card
$authorization->transactions->card->setCardNumber("5463373320413232");
$authorization->transactions->card->setCVV("387");
$authorization->transactions->card->setCardholderName("FULANO FULANO");
$authorization->transactions->card->setExpirationMonth(10);
$authorization->transactions->card->setExpirationYear(2022);

$callback2 = function($err, $status, $charge) : void {
if ($err == NULL) {
	if ($status == AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED)
		echo  "Aprovado!\n";
	} else {
		echo  "httStatus: ".$err["httpStatus"]
			."\n httpMsg: ".$err["httpMsg"]
			."\n";
	}
};

$pay->charge($authorization, $callback2);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;
$authorization = new AditumPayments\ApiSDK\Authorization;

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
$authorization->customer->phone->setType(AditumPayments\ApiSDK\PhoneType::MOBILE);

// Transactions
$authorization->transactions->setAmount(100);
$authorization->transactions->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT);
$authorization->transactions->setInstallmentNumber(2); // Só pode ser maior que 1 se o tipo de transação for crédito.
$authorization->transactions->getAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); // Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM

// Transactions->card
$authorization->transactions->card->setCardNumber("5463373320413232");
$authorization->transactions->card->setCVV("387");
$authorization->transactions->card->setCardholderName("fulano fulano");
$authorization->transactions->card->setExpirationMonth(10);
$authorization->transactions->card->setExpirationYear(2022);

$res = $pay->charge($authorization);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED) 
		echo  "Aprovado!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
		."\n httpMsg: ".$res["httpMsg"]
		."\n";
}
```