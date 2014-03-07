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
if( file_exists(dirname(__FILE__).'/nicejson/nicejson.php') ) {
	include_once dirname(__FILE__).'/nicejson/nicejson.php';
}

// Include Mobile Detect.
require_once dirname(__FILE__).'/../Mobile_Detect.php';
$detect = new Mobile_Detect;

$json = array(
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
				'uaMatch' => array(
					// If match is found, triggers 'isMobile' to be true.
					'phones'   => $detect->getPhoneDevices(),
					// Triggers 'isTablet' to be true.
					'tablets'  => $detect->getTabletDevices(),
					// If match is found, triggers 'isMobile' to be true.
					'browsers' => $detect->getBrowsers(),
					// If match is found, triggers 'isMobile' to be true.
					'os'       => $detect->getOperatingSystems()
				)

			);

$jsonString = function_exists('json_format') ? json_format($json) : json_encode($json);

// Write the JSON file to disk.
// You can import this file in your app.
$fileName = dirname(__FILE__).'/../Mobile_Detect.json';
$handle = fopen($fileName, 'w');
$fwrite = fwrite($handle, $jsonString);
fclose($handle);

if($fwrite){
	echo 'Done. Check '.realpath($fileName).' file.';
} else {
	echo 'Failed to write '.realpath($fileName).' to disk.';
}