<?php

use Detection\MobileDetect;

require __DIR__ . '/../vendor/autoload.php';

$detect = new MobileDetect;
$detect->setUserAgent(' Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; SHV-E160K/VI10.1802 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30');
//$detect->setHttpHeaders(array(
//    'HTTP_X_WAP_PROFILE' => '',
//    'HTTP_USER_AGENT'       => 'Mozilla/5.0 (Linux; U; Android 4.1.1; cs-cz; HUAWEI G510-0200 Build/HuaweiG510-0200) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
//));
//var_dump($detect->isMobile());
var_dump($detect->isTablet());
var_dump($detect->getMatchesArray());
////var_dump($detect->version('IE'));



/*********************************
 *
 * Dump all methods (+ extended)
 *
 ********************************/
//foreach ($detect->getRules() as $name => $regex) {
//    echo "is$name()\n";
//}
