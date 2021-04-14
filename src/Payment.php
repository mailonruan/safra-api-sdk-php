<?php

namespace AditumPayments;

class Payment {
    public function getToken() {
        // Iniciamos a função do CURL:
        $ch = curl_init('https://payment-dev.aditum.com.br/v2/merchant/auth');

        curl_setopt_array($ch, [

            // Equivalente ao -X:
            CURLOPT_CUSTOMREQUEST => 'POST',

            // Equivalente ao -H:
            CURLOPT_HTTPHEADER => [
                'Authorization: $2y$12$R7WraaPkFpcrIbo5LwBTOubEEiiyKZPovRUOEedrUZqZ3LokFQQ.q',
                'merchantCredential: 83032272000109'
            ],

            // Permite obter o resultado
            CURLOPT_RETURNTRANSFER => 1,
        ]);

        $resposta = json_decode(curl_exec($ch), true);
        curl_close($ch);
        echo($resposta);
    }
}