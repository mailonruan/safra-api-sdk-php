# Gateway Api Aditum

Implementação em php da integração do gateway da api de pagamento da **Aditum**. Facilitando o desenvolvimento, sem precisar do entendimento das regras de negócio para fazer uso da api.

# 


# Recursos

Toda a implementação foi baseada na documentação da **Aditum**, pelo link  [documentação aditum](https://sandbox.aditum.com.br/#primeiros-passos).

# Configuration

Dentro dessa classe podemos obter informações como a url de desenvolvimento e produção.

### getUrl():
Retorna a `url` defina pelo usuário, se não estiver definida é retornado a url de produção.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getUrl();

```

### setUrl():
Grava a `url` defina pelo usuário.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->setUrl();

```

### getProdUrl():
Retorna a `url` de produção.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getProdUrl();

```

### getDevUrl():
Retorna a `url` de desenvolvimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getDevUrl();

```

### setToken($token):
Grava o `token` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setToken('1413413513564t32fg3g3g');

```

### getToken():
Retorna o `token` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getToken();

```

### setCustomerName($name):
Grava o `name` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setCustomerName('ceres');

```

### getCustomerName():
Retorna o `name` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getCustomerName();

```

### setCustomerEmail($email):
Grava o `email` para ser usado em futuras requisições.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setCustomerEmail('ceres');

```

### getCustomerEmail():
Retorna o `email` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getCustomerEmail();

```

### setCnpj($cnpj):
Grava o `cnpj` do estabelecimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setCnpj('3141413441341341341');

```

### getCnpj():
Retorna o `cnpj` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getCnpj();

```

### setMerchantToken($merchantToken):
Grava o `merchantToken` do estabelecimento.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
$config->setMerchantToken('41341341341');

```

### getMerchantToken():
Retorna o `merchantToken` gravado.
```php
$config = AditumPayments\ApiSDK\Configuration::getInstance();
echo $config->getMerchantToken();

```

# Authentication


### requestToken(callback`(opcional)`):
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
**Uso de retorno de função**
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

## Payment

### Status da transação
```php
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_AUTHORIZED;
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_PRE_AUTHORIZED;
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_CANCELED;
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_PARTIAL;
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_NOT_AUTHORIZED;
AditumPayments\ApiSDK\Payment::CHARGE_STATUS_NOT_PENDING_CANCEL;
```

###  Tipos de pagamentos
```php
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_UNDEFINED;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_DEBIT;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_CREDIT;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_VOUCHER;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_BOLETO;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_TED ;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_DOC;
AditumPayments\ApiSDK\Payment::PAYMENT_TYPE_SAFETY_PAY;

```

### Nomes das bandeiras
```php
AditumPayments\ApiSDK\Payment::CARD_BRAND_VISA;
AditumPayments\ApiSDK\Payment::CARD_BRAND_MASTER_CARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_AMEX;
AditumPayments\ApiSDK\Payment::CARD_BRAND_ELO;
AditumPayments\ApiSDK\Payment::CARD_BRAND_AURA;
AditumPayments\ApiSDK\Payment::CARD_BRAND_JCB;
AditumPayments\ApiSDK\Payment:: CARD_BRAND_DINERS;
AditumPayments\ApiSDK\Payment::CARD_BRAND_DISCOVER;
AditumPayments\ApiSDK\Payment::CARD_BRAND_HIPERCARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_ENROUTE;
AditumPayments\ApiSDK\Payment::CARD_BRAND_TICKET;
AditumPayments\ApiSDK\Payment::CARD_BRAND_SODEXO;
AditumPayments\ApiSDK\Payment::CARD_BRAND_VR;
AditumPayments\ApiSDK\Payment::CARD_BRAND_ALELO;
AditumPayments\ApiSDK\Payment::CARD_BRAND_SETRA;
AditumPayments\ApiSDK\Payment::CARD_BRAND_VERO;
AditumPayments\ApiSDK\Payment:: CARD_BRAND_SOROCRED;
AditumPayments\ApiSDK\Payment::CARD_BRAND_GREEN_CARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_CABAL;
AditumPayments\ApiSDK\Payment::CARD_BRAND_BANESCARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_VERDE_CARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_VALE_CARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_UNION_PAY;
AditumPayments\ApiSDK\Payment::CARD_BRAND_UP;
AditumPayments\ApiSDK\Payment:: CARD_BRAND_TRICARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_BIGCARD;
AditumPayments\ApiSDK\Payment::CARD_BRAND_BEN;
AditumPayments\ApiSDK\Payment::CARD_BRAND_REDE_COMPRAS;
```

#

### authorization(object`(Transaction)`,  callback`(opcional)`):
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.			      |

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;

$data = new AditumPayments\ApiSDK\Transaction;
$data->setCardNumber("5463373320417272");
$data->setCVV("879");
$data->setCardholderName("CERES ROHANA");
$data->setExpirationMonth(10);
$data->setExpirationYear(2022);
$data->setAmount(100);
$data->setPaymentType($pay::PAYMENT_TYPE_CREDIT);

$callback2 = function($err, $chargeStatus, $data) : void {
if ($err == NULL) {
	if ($chargeStatus == AditumPayments\ApiSDK\Payment::CHARGE_STATUS_AUTHORIZED)
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

**Uso de retorno de função**
```php
$pay = AditumPayments\ApiSDK\Payment;

$data = new AditumPayments\ApiSDK\Transaction;
$data->setCardNumber("5463373320417272");
$data->setCVV("879");
$data->setCardholderName("CERES ROHANA");
$data->setExpirationMonth(10);
$data->setExpirationYear(2022);
$data->setAmount(100);
$data->setPaymentType($pay::PAYMENT_TYPE_CREDIT);

$res = $pay->authorization($data);

if (isset($res["status"])) {
	if ($res["status"] == $pay::CHARGE_STATUS_AUTHORIZED) 
		echo  "Aprovado!\n";
} else {
	echo  "httStatus: ".$res["httpStatus"]
	."\n httpMsg: ".$res["httpMsg"]
	."\n code: ".$res['code']
	."\n msg:".$res['msg']
	."\n";
}
```

