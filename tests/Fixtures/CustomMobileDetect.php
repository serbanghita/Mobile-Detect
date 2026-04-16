<?php

namespace DetectionTests\Fixtures;

use Detection\MobileDetect;

/**
 * A subclass that adds custom detection rules to verify LSB (late static binding) works.
 */
class CustomMobileDetect extends MobileDetect
{
    protected static array $phoneDevices = [
        'CustomPhone' => 'CustomPhone[/]',
    ];

    protected static array $tabletDevices = [
        'CustomTablet' => 'CustomTablet[/]',
    ];

    protected static array $properties = [
        'CustomPhone' => 'CustomPhone/[VER]',
        'CustomTablet' => 'CustomTablet/[VER]',
    ];
}
