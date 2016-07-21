<?php

require_once 'vendor/autoload.php';

$hash = 'your token!!'; // Your click 2 dial token
$fromPhoneNumber = '+31(0)12345678'; // Phone number
$fromPhone = '201'; // Phone number

/** @var \koenster\Voys\Voys $voys */
$voys = new \koenster\Voys\Voys($hash, $fromPhoneNumber, $fromPhone);

$call1 = $voys->call('+31(0)12345678');

/** @var \Koenster\Voys\VoysCall $call1 */
if ($call1->isValid()) {
    $call1->getCallFromPhone();
    $call1->getCallFromPhoneNumber();
    $call1->getCallToDisplayPhoneNumber();
    $call1->getCallToPhoneNumber();
    $call1->getCallId();

    $status = $voys->getCallStatus($call1->getCallId());
    if ($status->isValid()) {
        $status->response;
    }
}