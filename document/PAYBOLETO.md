# Boleto
Responsável por criar uma nova cobrança em boleto.


**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Domains\Boleto;

$boleto->setDeadline("2021-04-26"); // Se fez a configuração no Config não é obrigatório

// Customer
$boleto->customer->setName("fulano");
$boleto->customer->setEmail("fulano@aditum.co");
$boleto->customer->setDocumentType(AditumPayments\ApiSDK\Enum\DomaiisDocumentType::CPF);
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
$boleto->transactions->fine->setStartDate("2024-12-12"); // Opcional
$boleto->transactions->fine->setAmount(300); // Opcional
$boleto->transactions->fine->setInterest(10); // Opcional

// Transactions->discount
$boleto->transactions->discount->setType(AditumPayments\ApiSDK\Enum\DiscountType::FIXED); // Opcional
$boleto->transactions->discount->setAmount(200); // Opcional
$boleto->transactions->discount->setDeadline("2024-12-12");  // Opcional

$res = $pay->charge($boleto);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\Enum\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}
```
#

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Domains\Boleto;

$boleto->setDeadline("2021-04-26"); // Se fez a configuração no Config não é obrigatório

// Customer
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
$boleto->transactions->fine->setStartDate("2024-12-12"); // Opcional
$boleto->transactions->fine->setAmount(300); // Opcional
$boleto->transactions->fine->setInterest(10); // Opcional

// Transactions->discount
$boleto->transactions->discount->setType(AditumPayments\ApiSDK\Enum\DiscountType::FIXED); // Opcional
$boleto->transactions->discount->setAmount(200); // Opcional
$boleto->transactions->discount->setDeadline("2024-12-12"); // Opcional

$callback = function($err, $status, $charge) : void {
	if ($err == NULL) {
		if ($status == AditumPayments\ApiSDK\Enum\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
	} else {
		echo  "httStatus: ".$err["httpStatus"]
		."\n httpMsg: ".$err["httpMsg"]
		."\n";
	}
};

$pay->charge($boleto, $callback);
```
