### chargeBoleto(object`(Boleto)`,  callback`(opcional)`) : array()
Faz uma transação por boleto.

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Boleto;

$boleto->setDeadline("2021-04-26");

// Customer
$boleto->customer->setName("fulano");
$boleto->customer->setEmail("fulano@aditum.co");
$boleto->customer->setDocumentType(AditumPayments\ApiSDK\DocumentType::CPF);
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
$boleto->customer->phone->setType(AditumPayments\ApiSDK\PhoneType::MOBILE);

// Transactions
$boleto->transactions->setAmount(30000);
$boleto->transactions->setInstructions("Crédito de teste");

// Transactions->fine
$boleto->transactions->fine->setStartDate("2");
$boleto->transactions->fine->setAmount(300);
$boleto->transactions->fine->setInterest(10);

// Transactions->discount
$boleto->transactions->discount->setType(AditumPayments\ApiSDK\DiscountType::FIXED);
$boleto->transactions->discount->setAmount(200);
$boleto->transactions->discount->setDeadline("1");

$callback = function($err, $status, $charge) : void {
	if ($err == NULL) {
		if ($status == AditumPayments\ApiSDK\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
	} else {
		echo  "httStatus: ".$err["httpStatus"]
		."\n httpMsg: ".$err["httpMsg"]
		."\n";
	}
};

$pay->charge($boleto, $callback);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Boleto;

$boleto->setDeadline("2021-04-26");

// Customer
$boleto->customer->setName("fulano");
$boleto->customer->setEmail("fulano@aditum.co");
$boleto->customer->setDocumentType(AditumPayments\ApiSDK\DocumentType::CPF);
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
$boleto->customer->phone->setType(AditumPayments\ApiSDK\PhoneType::MOBILE);

// Transactions
$boleto->transactions->setAmount(30000);
$boleto->transactions->setInstructions("Crédito de teste");
$boleto->transactions->fine->setStartDate("2024-12-12");

// Transactions->fine
$boleto->transactions->fine->setStartDate("2");
$boleto->transactions->fine->setAmount(300);
$boleto->transactions->fine->setInterest(10);

// Transactions->discount
$boleto->transactions->discount->setType(AditumPayments\ApiSDK\DiscountType::FIXED);
$boleto->transactions->discount->setAmount(200);
$boleto->transactions->discount->setDeadline("1");

$res = $pay->charge($boleto);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}
```