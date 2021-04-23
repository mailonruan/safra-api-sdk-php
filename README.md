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

## Charge


#### Customer: object()
```php
$authorization = AditumPayments\ApiSDK\Authorization;

$authorization->customer->setName('fulano'); // Grava o nome do comprador.
$authorization->customer->setEmail('ceres'); //Guarda o email do comprador

echo $authorization->customer->getName(); // Retorna o nome do comprador
echo $authorization->customer->getEmail(); // Retorna o email do comprador
```

### Charge: object()
```php
$authorization = AditumPayments\ApiSDK\Authorization;

$authorization->transactions->setAmount(100); // Valor a ser cobrado em centavos
$authorization->transactions->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT); // Tipo de pagamento
$authorization->transactions->setInstallmentNumber(2); // Só pode ser maior que 1 se o tipo de transação for crédito.
$authorization->transactions->getAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); // Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM

echo $authorization->transactions->getAmount(); // Retorna o valor à cobrar em centavos
echo $authorization->transactions->getPaymentType(); // Retorna o time de pagamento baseado no enum PaymentType
echo $authorization->transactions->getInstallmentNumber(); // Retorna o números de parcelas
echo $authorization->transactions->getAcquirer(); // Retorna para qual adquirente está apontando

```

### Charge->card: object()
```php
$authorization = AditumPayments\ApiSDK\Authorization;

$authorization->transactions->card->setCardNumber("5463373320413232"); // PAN do cartão
$authorization->transactions->card->setCVV("879"); //Número de segurança do cartão
$authorization->transactions->card->setCardholderName("FULANO FULANO"); // Nome do comprador impresso no cartão
$authorization->transactions->card->setExpirationMonth(10); // Mês de expiração do cartão
$authorization->transactions->card->setExpirationYear(2022); // Ano de expiração do cartão
```

### getBrandCardBin(string`(opcional)`) : string
Retorna o nome da bandeira do cartão, baseado no número do cartão guardado.
```php
$authorization = new AditumPayments\ApiSDK\Authorization;

$brandName = $authorization->getBrandCardBin("5463373320413232");
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}

// =============================================================================

$authorization = new AditumPayments\ApiSDK\Authorization;

$authorization->transactions->card->setCardNumber("5463373320413232"); // Guarda o número do cartão
$brandName = $authorization->getBrandCardBin();
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}
```

## Payment

### authorization(object`(Transaction)`,  callback`(opcional)`) : array()
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.

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

