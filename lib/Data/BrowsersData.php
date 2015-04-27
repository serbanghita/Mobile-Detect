<?php
namespace MobileDetect\Data;

class BrowsersData extends AbstractData
{
    /**
     * List of browsers.
     *
     * The order inside a browser family is _important_.
     *
     * Eg. When checking for isChrome() we will first check for 'mobile'
     * and at last the 'desktop' version.
     * This way we don't need to keep accurate two regexes.
     * The last 'desktop' regex is a fallback.
     * At the last step we already know what happened before.
     *
     * @var array
     */
    protected $data = array(
        /**
         * Google Chrome browser family
         *
         * @docs https://developers.google.com/chrome/mobile/docs/user-agent
         */
        'Chrome'         => array(
            'Chrome Mobile' => array(
                'isMobile'     => true,
                'match'        => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
                'versionMatch' => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'),
            ),
            'Chrome Desktop' => array(
                'isMobile'     => false,
                'match'        => '\bChrome\b/[.0-9]*',
                'versionMatch' => array('Chrome/[VER]'),
            ),
        ),

        /**
         * Mozilla Firefox browser family
         *
         * @docs https://developer.mozilla.org/en-US/docs/User_Agent_Strings_Reference
         */
        'Firefox'        => array(
            'Firefox Mobile' => array(
                'isMobile'     => true,
                'match'        => '(Mobile|Tablet).*Firefox|Firefox.*Mobile|firefox.*maemo',
                'versionMatch' => array('Firefox/[VER]', 'rv:[VER]'),
            ),
            'Fennec' => array(
                'isMobile'     => true,
                'match'        => '\bfennec\b',
                'versionMatch' => array('Fennec/[VER]'),
            ),
            'Firefox Desktop' => array(
                'isMobile'     => false,
                'match'        => 'Firefox/[0-9.]+',
                'versionMatch' => array('rv:[VER]', 'Firefox/[VER]'),
            ),
        ),
        /**
         * Microsoft Internet Explorer family
         *
         * @docs http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
         */
        'IE'             => array(
            'IE Mobile' => array(
                'isMobile'     => true,
                'match'        => 'IEMobile|MSIEMobile',
                'versionMatch' => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident.*rv.[VER]'),
            ),
            'IE Desktop' => array(
                'isMobile'     => false,
                'match'        => 'MSIE [0-9.]+;|Trident.*rv.[0-9.]+',
                'versionMatch' => array('MSIE [VER];', 'Trident.*rv.[VER]'),
            ),
        ),

        /**
         * Opera family
         */
        'Opera'          => array(
            'Opera Mini' => array(
                'isMobile'     => true,
                'match'        => 'Opera.*Mini',
                'versionMatch' => array('Opera Mini/[VER]'),
            ),
            'Opera Mobi' => array(
                'isMobile'     => true,
                'match'        => 'Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+',
                'versionMatch' => array('Opera Mobi/[VER]', ' OPR/[VER]', 'Version/[VER]'),
            ),
            'Opera Coast' => array(
                'isMobile'     => true,
                'match'        => 'Coast/[0-9.]+',
                'versionMatch' => array('Coast/[VER]'),
            ),
            'Opera Desktop' => array(
                'isMobile'     => false,
                'match'        => '\bOpera\b| OPR/',
                'versionMatch' => array('Opera/[VER]', ' OPR/[VER]', 'Version/[VER]' ),
            ),
        ),

        /**
         * Apple Safari family
         *
         * @docs http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/OptimizingforSafarioniPhone/OptimizingforSafarioniPhone.html#//apple_ref/doc/uid/TP40006517-SW3
         * @note Safari 7534.48.3 is actually Version 5.1.
         * @note On BlackBerry the Version is overwriten by the OS.
         */
        'Safari'         => array(
            'Safari Mobile' => array(
                'isMobile'     => true,
                'match'        => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari',
                'versionMatch' => array('Version/[VER]', 'Safari/[VER]'),
            ),
            'Safari Desktop' => array(
                'isMobile'     => false,
                'match'        => 'Safari/[0-9.]+',
                'versionMatch' => array('Version/[VER]', 'Safari/[VER]'),
            ),
        ),

    );
}