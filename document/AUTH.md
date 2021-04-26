# Authentication

A autenticação é a forma que deve ser utilizada para gerar um Token de acesso, para que você consiga utilizar os endpoints.

**Uso de retorno da função**
```php
$auth = new AditumPayments\ApiSDK\Authentication;

$res = $auth->requestToken();

if (isset($res["token"])) {
	echo  $res["token"]."\n";
	
} else {
	echo  "httStatus: ".$res["httpStatus"]
		."\n httpMsg: ".$res["httpMsg"]
		."\n";
}
```
#

**Uso de callback:**
```php
$auth = new AditumPayments\ApiSDK\Authentication;

$callback = function($err, $token, $refreshToken) : void {
	if ($err == NULL) {
		echo  $token."\n";

	} else {
		echo  "httStatus: ".$err["httpStatus"]
			."\nhttpMsg: ".$err["httpMsg"]
			."\n";
	}
};

$auth->requestToken($callback);
```
