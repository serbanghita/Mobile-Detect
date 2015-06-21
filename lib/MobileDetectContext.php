<?php
namespace MobileDetect;

class MobileDetectContext extends AbstractStack
{
    /**
     * A list of required keys for the factory method.
     *
     * @var array
     */
    public static $required = array(
        'deviceType',
        'userAgent'
    );
}