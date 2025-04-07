<?php
use Detection\Exception\MobileDetectException;
use Detection\MobileDetectStandalone;

require_once '../standalone/autoloader.php';
require_once '../src/MobileDetectStandalone.php';

$detection = new MobileDetectStandalone();
$detection->setUserAgent('iPad');

try {
    var_dump($detection);
    var_dump($detection->isMobile());
    var_dump($detection->isTablet());
} catch (MobileDetectException $e) {
    print_r($e);
}
