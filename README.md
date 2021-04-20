# Gateway Api Aditum

Implementação em php da integração do gateway da api de pagamento da **Aditum**. Facilitando o desenvolvimento, sem precisar do entendimento das regras de negócio para fazer uso da api.

# 


# Recursos

Toda a implementação foi baseada na documentação da **Aditum**, pelo link  [documentação aditum](https://sandbox.aditum.com.br/#primeiros-passos).

## Configuration

Dentro dessa classe podemos obter informações como a url de desenvolvimento e produção.

## Status da transação
```php
AditumPayments\Configuration::CHARGE_STATUS_AUTHORIZED;
AditumPayments\Configuration::CHARGE_STATUS_PRE_AUTHORIZED;
AditumPayments\Configuration::CHARGE_STATUS_CANCELED;
AditumPayments\Configuration::CHARGE_STATUS_PARTIAL;
AditumPayments\Configuration::CHARGE_STATUS_NOT_AUTHORIZED;
AditumPayments\Configuration::CHARGE_STATUS_NOT_PENDING_CANCEL;
```

##  Tipos de pagamentos
```php
AditumPayments\Configuration::PAYMENT_TYPE_UNDEFINED;
AditumPayments\Configuration::PAYMENT_TYPE_DEBIT;
AditumPayments\Configuration::PAYMENT_TYPE_CREDIT;
AditumPayments\Configuration::PAYMENT_TYPE_VOUCHER;
AditumPayments\Configuration::PAYMENT_TYPE_BOLETO;
AditumPayments\Configuration::PAYMENT_TYPE_TED ;
AditumPayments\Configuration::PAYMENT_TYPE_DOC;
AditumPayments\Configuration::PAYMENT_TYPE_SAFETY_PAY;

```

## Nomes das bandeiras
```php
AditumPayments\Configuration::CARD_BRAND_VISA;
AditumPayments\Configuration::CARD_BRAND_MASTER_CARD;
AditumPayments\Configuration::CARD_BRAND_AMEX;
AditumPayments\Configuration::CARD_BRAND_ELO;
AditumPayments\Configuration::CARD_BRAND_AURA;
AditumPayments\Configuration::CARD_BRAND_JCB;
AditumPayments\Configuration:: CARD_BRAND_DINERS;
AditumPayments\Configuration::CARD_BRAND_DISCOVER;
AditumPayments\Configuration::CARD_BRAND_HIPERCARD;
AditumPayments\Configuration::CARD_BRAND_ENROUTE;
AditumPayments\Configuration::CARD_BRAND_TICKET;
AditumPayments\Configuration::CARD_BRAND_SODEXO;
AditumPayments\Configuration::CARD_BRAND_VR;
AditumPayments\Configuration::CARD_BRAND_ALELO;
AditumPayments\Configuration::CARD_BRAND_SETRA;
AditumPayments\Configuration::CARD_BRAND_VERO;
AditumPayments\Configuration:: CARD_BRAND_SOROCRED;
AditumPayments\Configuration::CARD_BRAND_GREEN_CARD;
AditumPayments\Configuration::CARD_BRAND_CABAL;
AditumPayments\Configuration::CARD_BRAND_BANESCARD;
AditumPayments\Configuration::CARD_BRAND_VERDE_CARD;
AditumPayments\Configuration::CARD_BRAND_VALE_CARD;
AditumPayments\Configuration::CARD_BRAND_UNION_PAY;
AditumPayments\Configuration::CARD_BRAND_UP;
AditumPayments\Configuration:: CARD_BRAND_TRICARD;
AditumPayments\Configuration::CARD_BRAND_BIGCARD;
AditumPayments\Configuration::CARD_BRAND_BEN;
AditumPayments\Configuration::CARD_BRAND_REDE_COMPRAS;
```

#

### getProdURL():
Retorna a `url` de produção.
```php
$config = new AditumPayments\Configuration;
echo $config->getProdURL();

```

### getDevURL():
Retorna a `url` de desenvolvimento.
```php
$config = new AditumPayments\Configuration;
echo $config->getDevURL();

```

### setToken($token):
Grava o `token` para ser usado em futuras requisições.
```php
$config = new AditumPayments\Configuration;
$config->setToken('1413413513564t32fg3g3g');

```

### getToken():
Retorna o `token` gravado.
```php
$config = new AditumPayments\Configuration;
echo $config->getToken();

```

### setCustomerName($name):
Grava o `name` para ser usado em futuras requisições.
```php
$config = new AditumPayments\Configuration;
$config->setCustomerName('ceres');

```

### getCustomerName():
Retorna o `name` gravado.
```php
$config = new AditumPayments\Configuration;
echo $config->getCustomerName();

```

### setCustomerEmail($email):
Grava o `email` para ser usado em futuras requisições.
```php
$config = new AditumPayments\Configuration;
$config->setCustomerEmail('ceres');

```

### getCustomerEmail():
Retorna o `email` gravado.
```php
$config = new AditumPayments\Configuration;
echo $config->getCustomerEmail();

```

## Authentication


### requestToken(arrray, function):
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.

| TYPE            |PARAM                          |
|---------------- |-------------------------------|
|Array			  | url, cnpj, merchantToken      |
|Function         | erro, token, refreshToken     |


```php
$auth = new AditumPayments\Authentication;

$callback = function($err, $token, $refreshToken) : void {
	if ($err != NULL) {
		echo  'httStatus: '.$err["httpStatus"];
		echo  'httMsg: '.$err["httMsg"];
		echo  'code: '.$err["code"];
		echo  'msg: '.$err["msg"];
	} else {
		echo  $token;
		echo  $refreshToken;
	}
};

$data = array(
	"url" => "https://payment-dev.aditum.com.br/v2/",
	"cnpj" => "83032272000103",
	"merchantToken" => "mk_P1kT7Rngif1Xuylw0z96k3"
);
$auth->requestToken($data, $callback);
```

## Payment


### authorization(arrray, function):
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.

| TYPE            |PARAM                          |
|---------------- |-------------------------------|
|Array			  | cardNumber, cvv, brandName, cardholderName, expirationMonth, expirationYear, paymentType, amount      |
|Function         | erro, chargeStatus, data				      |


```php
$pay = AditumPayments\Payment::getInstance(array(
	"url" => $config->getDevURL(),		  // Se não inicializar, o padrão será url de produção 
	"token" => "fqf2fwf2fff2f2f2..."      // Opicional, caso não tenha gravado na classe Configuration
	"customerName" => "ceres", 			  // Opicional, caso não tenha gravado na classe Configuration
	"customerEmail" => "ceres@aditum.co"  // Opicional, caso não tenha gravado na classe Configuration
));

$callback = function($err, $chargeStatus, $data) : void {
	if ($err == NULL) {
		if ($chargeStatus == AditumPayments\Configuration::CHARGE_STATUS_AUTHORIZED) 
			echo  "Aprovado!";	
	} else {
		echo  'httStatus: '.$err["httpStatus"];
		echo ' httpMsg: '.$err["httpMsg"];
		echo ' code: '.$err['code'];
		echo ' msg:'.$err['msg'];
	}
};

$data = array(
"cardNumber" => "5463373320417272",
"cvv" => "879",
"cardholderName" => "CERES ROHANA",
"expirationMonth" => 10,
"expirationYear" => 2022,
"amount" => 100,
"brandName" => AditumPayments\Configuration::CARD_BRAND_MASTER_CARD,
"paymentType" => AditumPayments\Configuration::PAYMENT_TYPE_CREDIT,
);

$pay->authorization($data, $callback);
```

### getBrandCardBin(string, string, function):
Retorna o `token` necessário para conseguir se comunicar com a api da **Aditum**.

| TYPE            |PARAM                          |
|---------------- |-------------------------------|
|string			  | url a ser feita a requisição `opcional`  |
|string           | bin do cartão, os 4 primeiros dígitos apenas |
|Function         | erro, nome da bandeira				      |


```php
$pay = AditumPayments\Payment::getInstance();

$callback = function($err,  $brandName) : void {
	if ($err == NULL) {
		echo  $brandName;	
	} else {
		echo  'httStatus: '.$err["httpStatus"];
		echo ' httpMsg: '.$err["httpMsg"];
		echo ' code: '.$err['code'];
		echo ' msg:'.$err['msg'];
	}
};

// Necessário passar essa url, até ter a implementação na nova api
$url = "https://portal-dev.aditum.com.br/v1/";
$pay->getBrandCardBin($url, "5162", $callback3);
// ou
$pay->getBrandCardBin("5162", $callback3);
```

