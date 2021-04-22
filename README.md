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
			."\ncode: ".$err['code']
			."\nmsg: ".$err['msg']
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
		."\n code: ".$res['code']
		."\n msg:".$res['msg']
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

## Transaction

### setCustomerName(string)
Grava o `name` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
$config->setCustomerName('ceres');
```

### getCustomerName() : string
Retorna o `name` gravado.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
echo $config->getCustomerName();
```

### setCustomerEmail(string)
Grava o `email` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
$config->setCustomerEmail('ceres');
```

### getCustomerEmail() : string
Retorna o `email` gravado.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
echo $config->getCustomerEmail();
```

### setAcquirer(string)
Altera por qual adquirente irá passar a transação.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
$config->setAcquirer(AditumPayments\ApiSDK\Transaction::SIMULADOR);
```

### getAcquirer() : string
Retorna o `acquirer` alterado.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
echo $config->getAcquirer();
```

### setInstallmentNumber(int)
Quantidade de parcelas. Só pode ser maior que 1 se o tipo de transação for crédito.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
$config->setInstallmentNumber(2);
```

### getInstallmentNumber() : int
Retorna a quantidade de parcelas.
```php
$config = AditumPayments\ApiSDK\Transaction::getInstance();
echo $config->getInstallmentNumber();
```

### getBrandCardBin(string`(opcional)`) : string
Retorna o nome da bandeira do cartão, baseado no número do cartão guardado.
```php
$transaction = new AditumPayments\ApiSDK\Transaction;

$brandName = $transaction->getBrandCardBin("5463373320417272");
if ($brandName == NULL) {
	echo  "Falha ao tentar pegar o nome da bandeira do cartão\n";
} else {
	echo $brandName."\n";
}

// =============================================================================

$transaction = new AditumPayments\ApiSDK\Transaction;

$transaction->setCardNumber("5463373320417272"); // Guarda o número do cartão

$brandName = $transaction->getBrandCardBin();
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

$data = new AditumPayments\ApiSDK\Transaction;
$data->setCustomerName("ceres");
$data->setCustomerEmail("ceres@aditum.co");
$data->setCardNumber("5463373320417272");
$data->setCVV("879");
$data->setCardholderName("CERES ROHANA");
$data->setExpirationMonth(10);
$data->setExpirationYear(2022);
$data->setAmount(100);
$data->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT);

// Só pode ser maior que 1 se o tipo de transação for crédito.
$data->setInstallmentNumber(2);

// Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM
$data->getAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); 

$callback2 = function($err, $chargeStatus, $data) : void {
if ($err == NULL) {
	if ($chargeStatus == AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED)
		echo  "Aprovado!\n";
	} else {
		echo  "httStatus: ".$err["httpStatus"]
			."\n httpMsg: ".$err["httpMsg"]
			."\n code: ".$err['code']
			."\n msg:".$err['msg']
			."\n";
	}
};

$pay->authorization($data, $callback2);
```

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;

$data = new AditumPayments\ApiSDK\Transaction;
$data->setCustomerName("ceres");
$data->setCustomerEmail("ceres@aditum.co");
$data->setCardNumber("5463373320417272");
$data->setCVV("879");
$data->setCardholderName("CERES ROHANA");
$data->setExpirationMonth(10);
$data->setExpirationYear(2022);
$data->setAmount(100);
$data->setPaymentType(AditumPayments\ApiSDK\PaymentType::CREDIT);

// Só pode ser maior que 1 se o tipo de transação for crédito.
$data->setInstallmentNumber(2);

// Valor padrão AditumPayments\ApiSDK\AcquirerCode::ADITUM_ECOM
$data->getAcquirer(AditumPayments\ApiSDK\AcquirerCode::SIMULADOR); 

$res = $pay->authorization($data);

if (isset($res["status"])) {
	if ($res["status"] == AditumPayments\ApiSDK\ChargeStatus::AUTHORIZED) 
		echo  "Aprovado!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
		."\n httpMsg: ".$res["httpMsg"]
		."\n code: ".$res['code']
		."\n msg:".$res['msg']
		."\n";
}
```

