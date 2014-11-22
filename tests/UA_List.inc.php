<?php
/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 *
 * Compile the providers list.
 * The providers list is updated weekly.
 * You can contribute by adding new user agents and tests.
 */

// Setup.
$includeBasePath = dirname(__FILE__) . '/providers/vendors';
$list = array();

// Scan.
$dir = new DirectoryIterator($includeBasePath);
foreach ($dir as $fileInfo) {
    if ($fileInfo->isDot()) {
        continue;
    }
    $listNew = include $includeBasePath . '/' . $fileInfo->getFilename();
    if (is_array($listNew)) {
        $list = array_merge($list, $listNew);
    }
}

return $list;
