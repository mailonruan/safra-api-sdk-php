<?php

namespace AditumPayments;

class Authentication {
    public function requestToken($params, $callBack) {
        $merchantCredential = password_hash($params["cnpj"]."".$params["merchantToken"], PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_URL => "{$params['url']}merchant/auth",
            CURLOPT_HTTPHEADER => [
                "Authorization: {$merchantCredential}",
                "merchantCredential: {$params['cnpj']}"
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $response = curl_exec($ch);
        $errMsg = curl_error($ch);
        $errCode = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($errMsg || $errCode || empty($response) || (($httpCode != 200) && ($httpCode != 201))) {
            var_dump($errCode);
            curl_close($ch);
            $callBack(array(
                "httpStatus" => $httpCode, 
                "httpMsg" => $response, 
                "code" => $errCode, 
                "msg" => $errMsg), 
                NULL, NULL);
            return;
        }

        curl_close($ch);

        $responseJson = json_decode($response);

        if ($responseJson->success != true) {
            curl_close($ch);
            $callBack(array("code" => '-1', "httpMsg" => $responseJson->errors), NULL, NULL);
            return;
        }

        $callBack(NULL, $responseJson->accessToken, $responseJson->refreshToken);
    }

    // @TODO: A implementar
    public function requestRefreshToken() {}
}
