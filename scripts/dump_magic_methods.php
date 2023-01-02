<?php

use Detection\MobileDetect;

require_once __DIR__ . '/../src/MobileDetect.php';

$detect = new MobileDetect();

/**
 * Dump all methods (+ extended)
 * Use this script to generate comments like "@method bool isiPhone()"
 * php export/dump_magic_methods.php > methods.txt
 */
foreach ($detect->getRules() as $name => $regex) {
    echo "is$name()\n";
}
