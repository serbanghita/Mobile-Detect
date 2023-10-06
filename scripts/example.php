<?php
/**
 * Example using composer's autoloader.
 */

use Detection\MobileDetect;

require_once  __DIR__ . '/../vendor/autoload.php';

$detect = new MobileDetect();
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/248.1.504392274 Mobile/15E148 Safari/604.1');

try {
    $isMobile = $detect->isMobile();
    var_dump($isMobile);
} catch (\Detection\Exception\MobileDetectException $e) {
}
try {
    $isTablet = $detect->isTablet();
    var_dump($isTablet);
} catch (\Detection\Exception\MobileDetectException $e) {
}



