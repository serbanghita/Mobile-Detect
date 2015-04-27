<?php
namespace MobileDetect\Data;

class OperatingSystemData extends AbstractData
{
    /**
     * List of mobile Operating Systems.
     *
     * @var array
     */
    protected $data = array(
        /**
         * Apple's iOS family.
         *
         */
        'iOS' => array(
            'iOS' => array(
                'isMobile' => true,
                'match' => '\biPhone.*(Mobile|OS)|\biPod|\biPad',
                'versionMatch' => array('\bOS\b [VER]', 'iPhone OS/[VER]', 'iOS [VER];'),
            ),
        ),

        /**
         * Mac family.
         */
        'Mac' => array(
            'OSX' => array(
                'isMobile' => false,
                'match' => 'Mac OS X',
                'versionMatch' => array('Mac OS X [VER]'),
            ),
        ),
    );
}