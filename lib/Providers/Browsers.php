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
                // @note: Safari 7534.48.3 is actually Version 5.1.
                // On BlackBerry the Version is overwritten by the OS.
                'versionMatches' => array('Version/[VER]', 'Safari/[VER]'),
                // Updated from https://en.wikipedia.org/wiki/Safari_version_history
                'versionHistory' => array(
                    // On Max OS.
                    '0.8' => '48',
                    '73' => '0.9',
                    // v. 1.0
                    '85' => '1.0',
                    '85.8.5' => '1.0.3',
                    '100' => '1.1',
                    '125' => '1.2',
                    '312' => '1.3',
                    '312.3' => '1.3.1',
                    '312.5' => '1.3.2',
                    '312.6' => '1.3.2',
                    '412' => '2.0',
                    '416.11' => '2.0.2',
                    '419.3' => '2.0.4',
                    '522.11' => '3.0',
                    '522.12' => '3.0.2',
                    '522.12.1' => '3.0.3',
                    '523.10' => '3.0.4',
                    '525.13' => '3.1',
                    '525.17' => '3.1.1',
                    '525.20' => '3.1.1',
                    '525.21' => '3.1.2',
                    '525.26' => '3.2',
                    '525.27' => '3.2.1',
                    '525.28' => '3.2.3',
                    '526.11.2' => '4.0 Beta',
                    '528.16' => '4.0 Beta',
                    '528.17' => '4.0 Beta',
                    '530.17' => '4.0',
                    '530.18' => '4.0.1',
                    '530.19' => '4.0.2',
                    '531.9' => '4.0.3',
                    '531.21.10' => '4.0.4',
                    '531.22.7' => '4.0.5',
                    '533.16' => '4.1',
                    '533.17.8' => '4.1.1',
                    '533.18.5' => '4.1.2',
                    '533.19.4' => '4.1.3',
                    '533.16' => '5.0',
                    '533.17.8' => '5.0.1',
                    '533.18.5' => '5.0.2',
                    '533.19.4' => '5.0.3',
                    '533.20.27' => '5.0.4',
                    '533.21.1' => '5.0.5',
                    '533.22.3' => '5.0.6',

                    // From https://bugs.webkit.org/show_bug.cgi?id=44230
                    '534.6+' => '5.0.1',
                    // From https://bugs.webkit.org/show_bug.cgi?id=45632
                    '534.8' => '5.0.2',
                    '534.8+' => '5.0.2',
                    // From https://bugs.webkit.org/show_bug.cgi?id=48312
                    '534.11' => '5.0.2',
                    '534.11+' => '5.0.2',
                    '534.48.3' => '5.1',
                    '534.51.22' => '5.1.1',
                    '534.52.7' => '5.1.2',
                    '534.53.10' => '5.1.3',
                    '534.54.16' => '5.1.4',
                    '534.55.3' => '5.1.5',
                    '534.56.5' => '5.1.6',
                    '534.57.2' => '5.1.7',
                    '534.58.2' => '5.1.8',
                    '534.59.8' => '5.1.9',
                    '534.59.10' => '5.1.10',
                    '536.2+' => '5.1.2',
                    '536.25' => '6.0',
                    '536.26' => '6.0.1',
                    '536.26.17' => '6.0.2',
                    '536.28.10' => '6.0.3',
                    '536.29.13' => '6.0.4',
                    '536.30.1' => '6.0.5',
                    // From https://gist.github.com/rniwa/2721861
                    '537.1+' => '5.1.5',
                    '537.10+' => '5.1',
                    '537.43.58' => '6.1',
                    '537.73.11' => '6.1.1',
                    // @todo fill gaps here from 6.1.2 to 6.2.7
                    '537.85.17' => '6.2.8',
                    '537.71' => '7.0',
                    '537.73.11' => '7.0.1',
                    // @todo fill gaps here for 7.0.2
                    '537.75.14' => '7.0.3',
                    '537.76.4' => '7.0.4',
                    '537.77.4' => '7.0.5',
                    '537.78.2' => '7.0.6',
                    // @todo fill gaps here for 7.1 to 7.1.7
                    '537.85.17' => '7.1.8',
                    '538.35.8' => '8.0',
                    // @todo fill gaps here for 8.0.1 to 8.0.5
                    '600.6.3' => '8.0.6',
                    '600.7.12' => '8.0.7',
                    // @todo fill gap here for 8.0.8
                    
                    // On Windows
                    '522.11.3' => '3.0',
                    '522.12.2' => '3.0.1',
                    '522.13.1' => '3.0.2',
                    '522.15.5' => '3.0.3',
                    '523.12.9' => '3.0.4',
                    '523.13' => '3.0.4',
                    '523.15' => '3.0.4',
                    '525.13' => '3.1',
                    '525.17' => '3.1.1',
                    '525.21' => '3.1.2',
                    '525.26.13' => '3.2',
                    '525.27.1' => '3.2.1',
                    '525.28.1' => '3.2.2',
                    '525.29.1' => '3.2.3',
                    '526.12.2' => '4.0',
                    '528.1.1' => '4.0',
                    '528.16' => '4.0',
                    '528.17' => '4.0',
                    '530.17' => '4.0.1',
                    '530.19.1' => '4.0.2',
                    '531.9.1' => '4.0.3',
                    '531.21.10' => '4.0.4',
                    '531.22.7' => '4.0.5',
                    '533.16' => '5.0',
                    '533.17.8' => '5.0.1',
                    '533.18.5' => '5.0.2',
                    '533.19.4' => '5.0.3',
                    '533.20.27' => '5.0.4',
                    '533.21.1' => '5.0.5',
                    
                    '534.30' => '5.1',
                    '534.50' => '5.1',
                    '534.51.22' => '5.1.1',
                    '534.52.7' => '5.1.2',
                    '534.54.16' => '5.1.4',
                    '534.55.3' => '5.1.5',
                    '534.57.2' => '5.1.7'

                )
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