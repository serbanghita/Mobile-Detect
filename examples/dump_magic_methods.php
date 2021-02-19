<?php
$detect = new Mobile_Detect;

/**
 * Dump all methods (+ extended)
 * Use this script to generate comments like "@method bool isiPhone()"
 * php -a examples/dump_magic_methods.php > methods.txt
 */
$detect->setDetectionType(Mobile_Detect::DETECTION_TYPE_EXTENDED);
foreach($detect->getRules() as $name => $regex) {
    echo "is$name()\n";
}