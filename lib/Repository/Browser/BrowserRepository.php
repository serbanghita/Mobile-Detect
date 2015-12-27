<?php
namespace MobileDetect\Repository\Browser;

class BrowserRepository
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
                'identityMatches' => [
                    'default' => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari|Android.*Safari',
                    'isMobile' => 'Safari/[0-9.]+'
                ],
                // @note: Safari 7534.48.3 is actually Version 5.1.
                // On BlackBerry the Version is overwritten by the OS.
                'versionMatches' => array('Safari/[VER]', 'Version/[VER]'),
                'versionHelper' => 'getSafariVersion'

            ),
            'Safari Desktop' => array(
                'vendor' => 'Apple',
                'model' => 'Safari Desktop',
                'isMobile' => false,
                'identityMatches' => 'Safari/[0-9.]+',
                'versionMatches' => array('Version/[VER]', 'Safari/[VER]'),
                'versionHelper' => 'getSafariVersion'
            ),
        ),

    );

    public function getSafariVersion($versionMatch)
    {
        $versions = $this->getSafariVersions();
        if (isset($versions[$versionMatch])) {
            return $versions[$versionMatch];
        } else {
            return null;
        }
    }

    // Updated from https://en.wikipedia.org/wiki/Safari_version_history
    public function getSafariVersions()
    {
          return array(
              // On Mac OS.
              '0.8' => array('version' => '48', 'codename' => ''),
              '73' => array('version' => '0.9', 'codename' => ''),
              // v. 1.0
              '85' => array('version' => '1.0', 'codename' => ''),
              '85.8.5' => array('version' => '1.0.3', 'codename' => ''),
              '100' => array('version' => '1.1', 'codename' => ''),
              '125' => array('version' => '1.2', 'codename' => ''),
              '312' => array('version' => '1.3', 'codename' => ''),
              '312.3' => array('version' => '1.3.1', 'codename' => ''),
              '312.5' => array('version' => '1.3.2', 'codename' => ''),
              '312.6' => array('version' => '1.3.2', 'codename' => ''),
              '412' => array('version' => '2.0', 'codename' => ''),
              '416.11' => array('version' => '2.0.2', 'codename' => ''),
              '419.3' => array('version' => '2.0.4', 'codename' => ''),
              '522.11' => array('version' => '3.0', 'codename' => ''),
              '522.12' => array('version' => '3.0.2', 'codename' => ''),
              '522.12.1' => array('version' => '3.0.3', 'codename' => ''),
              '523.10' => array('version' => '3.0.4', 'codename' => ''),
              '525.13' => array('version' => '3.1', 'codename' => ''),
              '525.17' => array('version' => '3.1.1', 'codename' => ''),
              '525.20' => array('version' => '3.1.1', 'codename' => ''),
              '525.21' => array('version' => '3.1.2', 'codename' => ''),
              '525.26' => array('version' => '3.2', 'codename' => ''),
              '525.27' => array('version' => '3.2.1', 'codename' => ''),
              '525.28' => array('version' => '3.2.3', 'codename' => ''),
              '526.11.2' => array('version' => '4.0 Beta', 'codename' => ''),
              '528.16' => array('version' => array('4.0', '4.0 Beta'), 'codename' => ''),
              '528.17' => array('version' => array('4.0', '4.0 Beta'), 'codename' => ''),
              '530.17' => array('version' => array('4.0', '4.0.1'), 'codename' => ''),
              '530.18' => array('version' => '4.0.1', 'codename' => ''),
              '530.19' => array('version' => '4.0.2', 'codename' => ''),
              '531.9' => array('version' => '4.0.3', 'codename' => ''),
              '531.21.10' => array('version' => '4.0.4', 'codename' => ''),
              '531.22.7' => array('version' => '4.0.5', 'codename' => ''),
              '533.16' => array('version' => array('4.1', '5.0'), 'codename' => ''),
              '533.17.8' => array('version' => array('4.1.1', '5.0.1'), 'codename' => ''),
              '533.17.9' => array('version' => '5.0.2', 'codename' => ''),
              '533.18.5' => array('version' => array('4.1.2', '5.0.2'), 'codename' => ''),
              '533.19.4' => array('version' => array('4.1.3', '5.0.3'), 'codename' => ''),
              '533.20.27' => array('version' => '5.0.4', 'codename' => ''),
              '533.21.1' => array('version' => '5.0.5', 'codename' => ''),
              '533.22.3' => array('version' => '5.0.6', 'codename' => ''),

              // From https://bugs.webkit.org/show_bug.cgi?id=44230
              '534.6+' => array('version' => '5.0.1', 'codename' => ''),
              // From https://bugs.webkit.org/show_bug.cgi?id=45632
              '534.8' => array('version' => '5.0.2', 'codename' => ''),
              '534.8+' => array('version' => '5.0.2', 'codename' => ''),
              // From https://bugs.webkit.org/show_bug.cgi?id=48312
              '534.11' => array('version' => '5.0.2', 'codename' => ''),
              '534.11+' => array('version' => '5.0.2', 'codename' => ''),
              '534.48.3' => array('version' => '5.1', 'codename' => ''),
              '534.51.22' => array('version' => '5.1.1', 'codename' => ''),
              '534.52.7' => array('version' => '5.1.2', 'codename' => ''),
              '534.53.10' => array('version' => '5.1.3', 'codename' => ''),
              '534.54.16' => array('version' => '5.1.4', 'codename' => ''),
              '534.55.3' => array('version' => '5.1.5', 'codename' => ''),
              '534.56.5' => array('version' => '5.1.6', 'codename' => ''),
              '534.57.2' => array('version' => '5.1.7', 'codename' => ''),
              '534.58.2' => array('version' => '5.1.8', 'codename' => ''),
              '534.59.8' => array('version' => '5.1.9', 'codename' => ''),
              '534.59.10' => array('version' => '5.1.10', 'codename' => ''),
              '536.2' => array('version' => '5.1.2', 'codename' => ''),
              '536.2+' => array('version' => '5.1.2', 'codename' => ''),
              '536.25' => array('version' => '6.0', 'codename' => ''),
              '536.26' => array('version' => '6.0.1', 'codename' => ''),
              '536.26.17' => array('version' => '6.0.2', 'codename' => ''),
              '536.28.10' => array('version' => '6.0.3', 'codename' => ''),
              '536.29.13' => array('version' => '6.0.4', 'codename' => ''),
              '536.30.1' => array('version' => '6.0.5', 'codename' => ''),
              // From https://gist.github.com/rniwa/2721861
              '537.1+' => array('version' => '5.1.5', 'codename' => ''),
              '537.10' => array('version' => '5.1', 'codename' => ''),
              '537.10+' => array('version' => '5.1', 'codename' => ''),
              '537.43.58' => array('version' => '6.1', 'codename' => ''),
              '537.51.1' => array('version' => '', 'codename' => ''),
              '537.73.11' => array('version' => array('6.1.1', '7.0.1'), 'codename' => ''),
              // @todo fill gaps here from 6.1.2 to 6.2.7
              '537.85.17' => array('version' => array('6.2.8', '7.1.8'), 'codename' => ''),
              '537.71' => array('version' => '7.0', 'codename' => ''),
              // @todo fill gaps here for 7.0.2
              '537.75.14' => array('version' => '7.0.3', 'codename' => ''),
              '537.76.4' => array('version' => '7.0.4', 'codename' => ''),
              '537.77.4' => array('version' => '7.0.5', 'codename' => ''),
              '537.78.2' => array('version' => '7.0.6', 'codename' => ''),
              // @todo fill gaps here for 7.1 to 7.1.7
              '538.35.8' => array('version' => '8.0', 'codename' => ''),
              // @todo fill gaps here for 8.0.1 to 8.0.5
              '600.6.3' => array('version' => '8.0.6', 'codename' => ''),
              '600.7.12' => array('version' => '8.0.7', 'codename' => ''),
              // @todo fill gap here for 8.0.8

              // On Windows
              '522.11.3' => array('version' => '3.0', 'codename' => ''),
              '522.12.2' => array('version' => '3.0.1', 'codename' => ''),
              '522.13.1' => array('version' => '3.0.2', 'codename' => ''),
              '522.15.5' => array('version' => '3.0.3', 'codename' => ''),
              '523.12.9' => array('version' => '3.0.4', 'codename' => ''),
              '523.13' => array('version' => '3.0.4', 'codename' => ''),
              '523.15' => array('version' => '3.0.4', 'codename' => ''),
              '525.26.13' => array('version' => '3.2', 'codename' => ''),
              '525.27.1' => array('version' => '3.2.1', 'codename' => ''),
              '525.28.1' => array('version' => '3.2.2', 'codename' => ''),
              '525.29.1' => array('version' => '3.2.3', 'codename' => ''),
              '526.12.2' => array('version' => '4.0', 'codename' => ''),
              '528.1.1' => array('version' => '4.0', 'codename' => ''),
              '530.19.1' => array('version' => '4.0.2', 'codename' => ''),
              '531.9.1' => array('version' => '4.0.3', 'codename' => ''),
              '534.30' => array('version' => '5.1', 'codename' => ''),
              '534.50' => array('version' => '5.1', 'codename' => ''),

              // According to http://www.somegeekintn.com/blog/stuff/iosvers/
              '600.1.4' => array('version' => '600.1.4', 'codename' => 'Safari Mobile for iOS 8.x'),
              '9537.53' => array('version' => '9537.53', 'codename' => 'Safari Mobile for iOS 7.x'),
              '8536.25' => array('version' => '8536.25', 'codename' => 'Safari Mobile for iOS 6.x'),
              // Found this with iOS 6_1_3
              '7534.48.3' => array('version' => '7534.48.3', 'codename' => 'Safari Mobile for iOS 5.x'),
              // According to http://www.useragentstring.com/Safari5.0.2_id_18120.php
              '6533.18.5' => array('version' => '6533.18.5', 'codename' => 'Safari Mobile 5.0.2'),
              '6531.22.7' => array('version' => '6531.22.7', 'codename' => 'Safari Mobile'),
              '531.21.10' => array('version' => '531.21.10', 'codename' => 'Safari Mobile for iOS 3.2'),
              '528.16' => array('version' => '528.16', 'codename' => 'Safari Mobile'),
              '525.18.1' => array('version' => '525.18.1', 'codename' => 'Safari Mobile'),
              '525.20' => array('version' => '525.20', 'codename' => 'Safari Mobile')
          );
    }
    
    
    public function getFamily($familyName)
    {
        return $this->data[$familyName];
    }
}