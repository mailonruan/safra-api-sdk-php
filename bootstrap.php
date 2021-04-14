<?php

require __DIR__ . '/vendor/autoload.php';

$payment = new AditumPayments\Payment;

$payment->getToken();
