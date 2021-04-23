# Gateway Api Aditum

Implementação em php da integração do gateway da api de pagamento da **Aditum**. Facilitando o desenvolvimento, sem precisar do entendimento das regras de negócio para fazer uso da api.

# 


# Recursos

Toda a implementação foi baseada na documentação da **Aditum**, pelo link  [documentação aditum](https://sandbox.aditum.com.br/#primeiros-passos).

# Configuration

Dentro dessa classe podemos obter informações como a url de desenvolvimento e produção.

### setUrl():
Grava a `url` defina pelo usuário.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->setUrl();
```

### getUrl() : string
Retorna a `url` defina pelo usuário, se não estiver definida é retornado a url de produção.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getUrl();
```

### getProdUrl() : string
Retorna a `url` de produção.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getProdUrl();
```

### getDevUrl() : string
Retorna a `url` de desenvolvimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getDevUrl();
```

### setToken(string) 
Grava o `token` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setToken('1413413513564t32fg3g3g');
```

### getToken() : string
Retorna o `token` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getToken();
```

### setCnpj(string)
Grava o `cnpj` do estabelecimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setCnpj('3141413441341341341');

```

### getCnpj() : string
Retorna o `cnpj` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getCnpj();
```

### setMerchantToken(string)
Grava o `merchantToken` do estabelecimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setMerchantToken('41341341341');
```

### getMerchantToken() : string
Retorna o `merchantToken` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getMerchantToken();
```

# Authentication


### requestToken(callback`(opcional)`) : array()
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.

**Uso de callback:**
```php
$auth = new AditumPayments\ApiSDK\Authentication;

$callback1 = function($err, $token, $refreshToken) : void {
	if ($err == NULL) {
		echo  $token."\n";
		$config = AditumPayments\ApiSDK\Configuration::getInstance();
		$config->setToken($token);
	} else {
		echo  "httStatus: ".$err["httpStatus"]
			."\nhttpMsg: ".$err["httpMsg"]
			."\n";
	}
};

$auth->requestToken($callback1);
```
**Uso de retorno da função**
```php
$auth = new AditumPayments\ApiSDK\Authentication;

$res = $auth->requestToken();

if (isset($res["token"])) {
	echo  $res["token"]."\n";
	$config = AditumPayments\ApiSDK\Configuration::getInstance();
	$config->setToken($token);
	
} else {
	echo  "httStatus: ".$res["httpStatus"]
		."\n httpMsg: ".$res["httpMsg"]
		."\n";
}
```
#

# ChargeStatus
### Status da transação
```php
AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED;
AditumPayments\ApiSDK\ChargeStatus::PRE_AUTHORIZED;
AditumPayments\ApiSDK\ChargeStatus::CANCELED;
AditumPayments\ApiSDK\ChargeStatus::PARTIAL;
AditumPayments\ApiSDK\ChargeStatus::_AUTHORIZED;
AditumPayments\ApiSDK\ChargeStatus::NOT_PENDING_CANCEL;
```

#

# PaymentType

###  Tipos de pagamentos
```php
AditumPayments\ApiSDK\PaymentType::UNDEFINED;
AditumPayments\ApiSDK\PaymentType::DEBIT;
AditumPayments\ApiSDK\PaymentType::CREDIT;
AditumPayments\ApiSDK\PaymentType::VOUCHER;
AditumPayments\ApiSDK\PaymentType::BOLETO;
AditumPayments\ApiSDK\PaymentType::TED ;
AditumPayments\ApiSDK\PaymentType::DOC;
AditumPayments\ApiSDK\PaymentType::SAFETY_PAY;
```
#

# CardBrand

### Nomes das bandeiras
```php
AditumPayments\ApiSDK\CardBrand::VISA;
AditumPayments\ApiSDK\CardBrand::MASTER_CARD;
AditumPayments\ApiSDK\CardBrand::AMEX;
AditumPayments\ApiSDK\CardBrand::ELO;
AditumPayments\ApiSDK\CardBrand::AURA;
AditumPayments\ApiSDK\CardBrand::JCB;
AditumPayments\ApiSDK\CardBrand:: DINERS;
AditumPayments\ApiSDK\CardBrand::DISCOVER;
AditumPayments\ApiSDK\CardBrand::HIPERCARD;
AditumPayments\ApiSDK\CardBrand::ENROUTE;
AditumPayments\ApiSDK\CardBrand::TICKET;
AditumPayments\ApiSDK\CardBrand::SODEXO;
AditumPayments\ApiSDK\CardBrand::VR;
AditumPayments\ApiSDK\CardBrand::ALELO;
AditumPayments\ApiSDK\CardBrand::SETRA;
AditumPayments\ApiSDK\CardBrand::VERO;
AditumPayments\ApiSDK\CardBrand:: SOROCRED;
AditumPayments\ApiSDK\CardBrand::GREEN_CARD;
AditumPayments\ApiSDK\CardBrand::CABAL;
AditumPayments\ApiSDK\CardBrand::BANESCARD;
AditumPayments\ApiSDK\CardBrand::VERDE_CARD;
AditumPayments\ApiSDK\CardBrand::VALE_CARD;
AditumPayments\ApiSDK\CardBrand::UNION_PAY;
AditumPayments\ApiSDK\CardBrand::UP;
AditumPayments\ApiSDK\CardBrand::TRICARD;
AditumPayments\ApiSDK\CardBrand::BIGCARD;
AditumPayments\ApiSDK\CardBrand::BEN;
AditumPayments\ApiSDK\CardBrand::REDE_COMPRAS;
```

#

# AcquirerCode
### Adquirentes
```php
AditumPayments\ApiSDK\AcquirerCode::CIELO;
AditumPayments\ApiSDK\AcquirerCode::REDE;
AditumPayments\ApiSDK\AcquirerCode::STONE;
AditumPayments\ApiSDK\AcquirerCode::VBI;
AditumPayments\ApiSDK\AcquirerCode::GRANITO;
AditumPayments\ApiSDK\AcquirerCode::INFINITE_PAY;
AditumPayments\ApiSDK\AcquirerCode::SAFRA_PAY;
AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM;
AditumPayments\ApiSDK\AcquirerCode::PAGSEGURO;
AditumPayments\ApiSDK\AcquirerCode::ADITUM_TEF;
AditumPayments\ApiSDK\AcquirerCode::SAFRAPAYTEF;
AditumPayments\ApiSDK\AcquirerCode::VR_BENEFITS;
AditumPayments\ApiSDK\AcquirerCode::SIMULADOR;
```
#

# PhoneType
### Tipos de telefones
```php
AditumPayments\ApiSDK\PhoneType::RESIDENCIAL;
AditumPayments\ApiSDK\PhoneType::COMERCIAL;
AditumPayments\ApiSDK\PhoneType::VOICEMAIL;
AditumPayments\ApiSDK\PhoneType::TEMPORARY;
AditumPayments\ApiSDK\PhoneType::MOBILE;
```
# DocumentType
### Tipos de documentos
```php
AditumPayments\ApiSDK\DocumentType::CPF;
AditumPayments\ApiSDK\DocumentType::CNPJ;
```

#

## Charge: object abstract


#### Customer: object()
```php
$charge = AditumPayments\ApiSDK\Authorization;

$charge->customer->setName('fulano'); // Grava o nome do comprador.
$charge->customer->setEmail('ceres'); //Guarda o email do comprador
$charge->customer->setDocumentType(AditumPayments\ApiSDK\DocumentType::CPF);
$charge->customer->setDocument("14533859759");
```

### Customer->address: object()
```php
$charge = AditumPayments\ApiSDK\Authorization;

$charge->customer->address->setStreet("Avenida Salvador");
$charge->customer->address->setNumber("5401");
$charge->customer->address->setNeighborhood("Recreio dos bandeirantes");
$charge->customer->address->setCity("Rio de janeiro");
$charge->customer->address->setState("RJ");
$charge->customer->address->setCountry("BR");
$charge->customer->address->setZipcode("2279714");
$charge->customer->address->setComplement("");
```

### Customer->phone: object()
```php
$charge = AditumPayments\ApiSDK\Authorization;

$charge->customer->phone->setCountryCode("55");
$charge->customer->phone->setAreaCode("21");
$charge->customer->phone->setNumber("98491715");
$charge->customer->phone->setType(AditumPayments\ApiSDK\PhoneType::MOBILE);
```

### Transactions: object()
```php
$charge = AditumPayments\ApiSDK\Authorization;

$charge->transactions->setAmount(100); // Valor a ser cobrado em centavos

// Apenas para pagamento com cartão
$charge->transactions->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT); // Tipo de pagamento
$charge->transactions->setInstallmentNumber(2); // Só pode ser maior que 1 se o tipo de transação for crédito.
$charge->transactions->setAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); // Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM

// Apenas para boleto
$charge = AditumPayments\ApiSDK\Boleto;
$boleto->transactions->setInstructions("Crédito de teste");
```

### Transactions->card: object()
```php
$charge = AditumPayments\ApiSDK\Authorization;

$charge->transactions->card->setCardNumber("5463373320413232"); // PAN do cartão
$charge->transactions->card->setCVV("879"); //Número de segurança do cartão
$charge->transactions->card->setCardholderName("FULANO FULANO"); // Nome do comprador impresso no cartão
$charge->transactions->card->setExpirationMonth(10); // Mês de expiração do cartão
$charge->transactions->card->setExpirationYear(2022); // Ano de expiração do cartão
```

### getBrandCardBin(string`(opcional)`) : string
Retorna o nome da bandeira do cartão, baseado no número do cartão guardado.
```php
$charge = new AditumPayments\ApiSDK\Authorization;

$brandName = $charge->getBrandCardBin("5463373320413232");
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}

// =============================================================================

$charge = new AditumPayments\ApiSDK\Authorization;

$charge->transactions->card->setCardNumber("5463373320413232"); // Guarda o número do cartão
$brandName = $charge->getBrandCardBin();
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}
```

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

$pay->chargeAuthorization($authorization, $callback2);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;
$authorization = new AditumPayments\ApiSDK\Authorization;

// Customer
$authorization->customer->setName("fulano");
$authorization->customer->setEmail("fulano@aditum.co");

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

$res = $pay->chargeAuthorization($authorization);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED) 
		echo  "Aprovado!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
		."\n httpMsg: ".$res["httpMsg"]
		."\n";
}
```

### chargeBoleto(object`(Boleto)`,  callback`(opcional)`) : array()
Faz uma transação por boleto.

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Boleto;

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

$callback = function($err, $status, $charge) : void {
	if ($err == NULL) {
		if ($status == AditumPayments\ApiSDK\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
	} else {
		echo  "httStatus: ".$err["httpStatus"]
		."\n httpMsg: ".$err["httpMsg"]
		."\n";
	}
};

$pay->chargeBoleto($boleto, $callback);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;
$boleto = new AditumPayments\ApiSDK\Boleto;

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

$res = $pay->chargeBoleto($boleto);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\ChargeStatus::PRE_AUTHORIZED) echo  "PRÉ AUTORIZADO!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}
```

### chargeStatus(string`(chargeId)`,  callback`(opcional)`) : array()
Pega as informações de uma cobrança pelo seu GUID ID ou NSU..

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;

// Implementação do boleto...

$id = "";
$res = $pay->chargeBoleto($boleto);
if (isset($res["status"])) {
	$id = $res["charge"]->id;
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}

$callback = function($err, $status, $charge) : void {
	if ($err == NULL) {
		echo  $status."\n";;
	} else {
		echo  "httStatus: ".$err["httpStatus"]
		."\n httpMsg: ".$err["httpMsg"]
		."\n";
	}
};

$pay->chargeStatus($id, $callback);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;

// Implementação do boleto...

$id = "";
$res = $pay->chargeBoleto($boleto);
if (isset($res["status"])) {
	$id = $res["charge"]->id;
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}

$res = $pay->chargeStatus($id);

if (isset($res["status"])) {
	echo  $res["status"]."\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n";
}
```

