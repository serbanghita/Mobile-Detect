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
         * Opera family
         */
        'Opera' => array(
            'Opera Mini' => array(
                'vendor' => 'Opera',
                'model' => 'Opera Mini',
                'isMobile' => true,
                'identityMatches' => 'Opera.*Mini',
                'versionMatches' => array('Opera Mini/[VER]'),
            ),
            'Opera Mobi' => array(
                'vendor' => 'Opera',
                'model' => 'Opera Mobi',
                'isMobile' => true,
                'identityMatches' => 'Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+',
                'versionMatches' => array('Opera Mobi/[VER]', ' OPR/[VER]', 'Version/[VER]'),
            ),
            'Opera Coast' => array(
                'vendor' => 'Opera',
                'model' => 'Opera Coast',
                'isMobile' => true,
                'identityMatches' => 'Coast/[0-9.]+',
                'versionMatches' => array('Coast/[VER]'),
            ),
            'Opera Desktop' => array(
                'vendor' => 'Opera',
                'model' => 'Opera Desktop',
                'isMobile' => false,
                'identityMatches' => '\bOpera\b| OPR/',
                'versionMatches' => array('Opera/[VER]', ' OPR/[VER]', 'Version/[VER]' ),
            ),
        ),
        /**
         * Google Chrome browser family
         *
         * @docs https://developers.google.com/chrome/mobile/docs/user-agent
         */
        'Chrome' => array(
            'Chrome Mobile' => array(
                'vendor' => 'Google',
                'model' => 'Chrome Mobile',
                'isMobile' => true,
                'identityMatches' => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
                'versionMatches' => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'),
            ),
            'Chrome Desktop' => array(
                'vendor' => 'Google',
                'model' => 'Chrome Desktop',
                'isMobile' => false,
                'identityMatches' => '\bChrome\b/[.0-9]*',
                'versionMatches' => array('Chrome/[VER]'),
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
                'vendor' => 'Apple',
                'model' => 'Safari Mobile',
                'isMobile' => true,
                'identityMatches' => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari',
                'versionMatches' => array('Version/[VER]', 'Safari/[VER]'),
            ),
            'Safari Desktop' => array(
                'vendor' => 'Apple',
                'model' => 'Safari Desktop',
                'isMobile' => false,
                'identityMatches' => 'Safari/[0-9.]+',
                'versionMatches' => array('Version/[VER]', 'Safari/[VER]'),
            ),
        ),

        /**
         * NetFront browsers family.
         * @todo Should I split this into NetFront and NetFrontLife? Maybe it's overkill.
         */
        'NetFront' => array(
            'NetFront' => array(
                'vendor' => 'NetFront',
                'model' => 'NetFront',
                'isMobile' => true,
                'identityMatches' => 'NetFront/[.0-9]+|NetFrontLifeBrowser',
                'versionMatches' => array('NetFront/[VER]', 'NetFrontLifeBrowser/[VER]', 'Version/[VER]'),
            )
        )

    );
}