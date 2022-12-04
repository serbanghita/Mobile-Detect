<?php

use Detection\MobileDetect;

$detect = new MobileDetect;

/**
 * Dump all methods (+ extended)
 * Use this script to generate comments like "@method bool isiPhone()"
 * php -a examples/dump_magic_methods.php > methods.txt
 */
foreach ($detect->getRules() as $name => $regex) {
    echo "is$name()\n";
}
