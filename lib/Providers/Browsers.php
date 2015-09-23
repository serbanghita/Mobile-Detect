<?php
namespace MobileDetect\Providers;

class Browsers extends AbstractProvider
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
         * Microsoft Internet Explorer family
         *
         * @docs http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
         */
        'IE' => array(
            'IE Mobile' => array(
                'vendor' => 'Microsoft',
                'model' => 'IE Mobile',
                'isMobile' => true,
                'identityMatches' => 'IEMobile|MSIEMobile|Trident/[0-9.]+; Touch; rv:[0-9.]+;',
                'versionMatches' => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident.*rv.[VER]'),
            ),
            'IE Desktop' => array(
                'vendor' => 'Microsoft',
                'model' => 'IE Desktop',
                'isMobile' => false,
                'identityMatches' => 'MSIE [0-9.]+;|Trident.*rv.[0-9.]+',
                'versionMatches' => array('MSIE [VER];', 'Trident.*rv.[VER]'),
            ),
        ),
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
         * NetFront browsers family.
         * @todo (Serban) Should we split this into NetFront and NetFrontLife? Mobile/Desktop
         * @docs http://en.wikipedia.org/wiki/NetFront
         */
        'NetFront' => array(
            'NetFront Mobile' => array(
                'vendor' => 'NetFront',
                'model' => 'NetFront Mobile',
                'isMobile' => true,
                'identityMatches' => 'NetFront/[.0-9]+|NetFrontLifeBrowser|NF-Browser',
                'versionMatches' => array('NetFront/[VER]', 'NetFrontLifeBrowser/[VER]', 'Version/[VER]'),
            )
        ),

        'Generic' => array(
            /**
             * Dolfin family has only mobile browsers.
             * @docs https://en.wikipedia.org/wiki/Dolphin_Browser
             */
            'Dolfin' => array(
                'vendor' => 'Dolfin',
                'model' => 'Dolfin',
                'isMobile' => true,
                'identityMatches' => '\bDolfin\b',
                'versionMatches' => array('Dolfin/[VER]')
            ),
            /**
             * @docs http://www.ucweb.com/
             */
            'UCBrowser' => array(
                'vendor' => 'UCWeb',
                'model' => 'UCBrowser',
                'isMobile' => true,
                'identityMatches' => 'UC.*Browser|UCWEB',
                'versionMatches' => array('UCWEB[VER]', 'UCBrowser/[VER]')
            ),
            'Silk' => array(
                'vendor' => 'Amazon',
                'model' => 'Silk',
                'isMobile' => true,
                'identityMatches' => '\bSilk\b',
                'versionMatches' => 'Silk\[VER]'
            ),
            'Generic Mobile' => array(
                'vendor' => 'Generic',
                'model' => 'Generic Mobile',
                'isMobile' => true,
                'identityMatches' => 'NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|UP.Browser|ObigoInternetBrowser',
                // @todo If this grows, then split into multiple generic browsers as they become important.
                'versionMatches' => array('Version/[VER]', 'Safari/[VER]', 'Browser/[VER]'),
            )
        ),

        /**
         * Apple Safari family
         *
         * @docs http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/OptimizingforSafarioniPhone/OptimizingforSafarioniPhone.html#//apple_ref/doc/uid/TP40006517-SW3
         * @note Safari 7534.48.3 is actually Version 5.1.
         * @note On BlackBerry the Version is overwritten by the OS.
         */
        'Safari'         => array(
            'Safari Mobile' => array(
                'vendor' => 'Apple',
                'model' => 'Safari Mobile',
                'isMobile' => true,
                'identityMatches' => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari|Android.*Safari',
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

    );
    
    
    public function getFamily($familyName)
    {
        return $this->data[$familyName];
    }
}