<?php

declare(strict_types=1);

use Detection\MobileDetect;

require __DIR__ . '/../vendor/autoload.php';

$detect = new MobileDetect();

/**
 * Dump all methods (+ extended)
 * Use this script to generate comments like "@method bool isiPhone()"
 * php export/dump_magic_methods.php > methods.txt
 */
foreach ($detect->getRules() as $name => $regex) {
    echo "is$name()\n";
}
