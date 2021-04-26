# Status do pagamento
Pega as informações de uma cobrança pelo seu GUID ID ou NSU..

**Uso de retorno da função**
```php
$pay = AditumPayments\ApiSDK\Payment;

// Implementação do boleto...

$id = "";

$res = $pay->charge($boleto);
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

#

**Uso de callback:**
```php
$pay = AditumPayments\ApiSDK\Payment;

// Implementação do boleto...

$id = "";

$res = $pay->charge($boleto);
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
