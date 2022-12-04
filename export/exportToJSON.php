<?php
/**
 * Mobile Detect Library
 * - export -
 * =====================
 *
 * Use the resulting JSON export file in other languages
 * other than PHP. Always check for 'version' key because
 * new major versions can modify the structure of the JSON file.
 *
 * The result of running this script is the export.json file.
 *
 * @license     Code and contributions have 'MIT License'
 *              More details: https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 *
 */

// Included nicejson function to beautify the result JSON file.
// This library is not mandatory.
use Detection\MobileDetect;

// Include Mobile Detect.
require_once dirname(__FILE__) . '/../src/MobileDetect.php';
$detect = new MobileDetect;

$json = [
    // The current version of Mobile Detect class that
    // is being exported.
    'version' => $detect->getScriptVersion(),

    // All headers that trigger 'isMobile' to be 'true',
    // before reaching the User-Agent match detection.
    'headerMatch' => $detect->getMobileHeaders(),

    // All possible User-Agent headers.
    'uaHttpHeaders' => $detect->getUaHttpHeaders(),

    // All the regexes that trigger 'isMobile' or 'isTablet'
    // to be true.
    'uaMatch' => [
        // If match is found, triggers 'isMobile' to be true.
        'phones'   => $detect->getPhoneDevices(),
        // Triggers 'isTablet' to be true.
        'tablets'  => $detect->getTabletDevices(),
        // If match is found, triggers 'isMobile' to be true.
        'browsers' => $detect->getBrowsers(),
        // If match is found, triggers 'isMobile' to be true.
        'os'       => $detect->getOperatingSystems()
    ]
];

$fileName = dirname(__FILE__).'/../MobileDetect.json';
// Write the JSON file to disk.11
// You can import this file in your app.
if (file_put_contents(
    $fileName,
    json_encode($json, JSON_PRETTY_PRINT)
)) {
    echo 'Done. Check '.realpath($fileName).' file.';
} else {
    echo 'Failed to write '.realpath($fileName).' to disk.';
}
