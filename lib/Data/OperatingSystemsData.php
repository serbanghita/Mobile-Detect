<?php
namespace MobileDetect\Data;

class OperatingSystemsData extends AbstractData
{
    /**
     * List of mobile Operating Systems.
     *
     * @var array
     */
    protected $data = array(
        /**
         * Android OS family.
         *
         */
        'Android' => array(
            'Android' => array(
                'vendor' => 'Google',
                'model' => 'Android',
                'isMobile' => true,
                'identityMatches' => 'Android',
                'matchType' => 'strpos',
                'versionMatches' => array('Android [VER]'),
            ),
        ),
        /**
         * Apple's iOS family.
         *
         */
        'iOS' => array(
            'iOS' => array(
                'vendor' => 'Apple',
                'model' => 'iOS',
                'isMobile' => true,
                'identityMatches' => '\biPhone.*(Mobile|OS)|\biPod|\biPad',
                'versionMatches' => array('\bOS\b [VER]', 'iPhone OS/[VER]', 'iOS [VER];'),
            ),
        ),

        /**
         * Mac family.
         */
        'Mac' => array(
            'OSX' => array(
                'vendor' => 'Apple',
                'isMobile' => false,
                'identityMatches' => 'Mac OS X',
                'versionMatches' => array('Mac OS X [VER]'),
            ),
        ),
    );
}