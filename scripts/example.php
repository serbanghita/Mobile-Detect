<?php
/**
 * Example using composer's autoloader.
 */

use Detection\MobileDetect;

require_once  __DIR__ . '/../vendor/autoload.php';

$detect = new MobileDetect();
// This is optional. We scan for known $_SERVER variables.
// See: https://github.com/serbanghita/Mobile-Detect/issues/948#issuecomment-1800271108
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/248.1.504392274 Mobile/15E148 Safari/604.1');

$isMobile = false;
try {
    $isMobile = $detect->isMobile();

} catch (\Detection\Exception\MobileDetectException $e) {
}

var_dump($isMobile);

$isTablet = false;
try {
    $isTablet = $detect->isTablet();
    var_dump($isTablet);
} catch (\Detection\Exception\MobileDetectException $e) {
}

var_dump($isTablet);



