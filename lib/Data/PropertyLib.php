<?php

namespace MobileDetect\Data;

class PropertyLib
{
    /*
     * @todo We need to automate the creation of this class from the 2.x branch.
     */

    /**
     * All possible HTTP headers that represent the
     * User-Agent string.
     *
     * Instead of looking just for HTTP_USER_AGENT
     * we will check multiple variants to extract as
     * much data as possible.
     *
     * @var array
     */
    protected static $uaHttpHeaders = array(
        // The default User-Agent string.
        'User-Agent',
        // Header can occur on devices using Opera Mini.
        'X-OperaMini-Phone-UA',
        // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
        'X-Device-User-Agent',
        'X-Original-User-Agent',
        'X-Skyfire-Phone',
        'X-Bold-Phone-UA',
        'Device-Stock-UA',
        'X-UcBrowser-Device-UA',
    );

    /**
     * HTTP headers that trigger the 'isMobile' detection
     * to be true.
     *
     * @var array
     */
    protected static $mobileHeaders = array(

        'Accept'                  => array('matches' => array(
            // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
            'application/x-obml2d',
            // BlackBerry devices.
            'application/vnd.rim.html',
            'text/vnd.wap.wml',
            'application/vnd.wap.xhtml+xml',
        )),
        'X-WAP-Profile'           => null,
        'X-WAP-ClientId'          => null,
        'WAP-Connection'          => null,
        'Profile'                 => null,
        // Reported by Opera on Nokia devices (eg. C3).
        'X-OperaMini-PHONE-UA'    => null,
        'X-Nokia-IPAddress'       => null,
        'X-Nokia-Gateway-ID'      => null,
        'X-Orange-ID'             => null,
        'X-Vodafone-3GPDPCONTEXT' => null,
        'X-HUAWEI-USERID'         => null,
        // Reported by Windows Smartphones.
        'UA-OS'                   => null,
        // Reported by Verizon, Vodafone proxy system.
        'X-Mobile-Gateway'        => null,
        // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e.
        'X-ATT-DeviceId'          => null,
        // Seen this on a HTC.
        'UA-CPU'                  => array('matches' => array('ARM')),
    );

    /**
     * List of mobile devices (phones).
     *
     * @var array
     */
    protected static $phoneDevices = array(
        /**
         *
         */
        'iPhone'        => array(
            'vendor'     => 'Apple',
            'match'      => '\biPhone\b|\biPod\b',
            'modelMatch' => array('iPhone.*CPU[a-z ]+[VER]', 'iPod.*CPU[a-z ]+[VER]'),
        ),


    );

    /**
     * List of tablet devices.
     *
     * @todo: Check for mobile friendly emails topic.
     * @var array
     */
    protected static $tabletDevices = array(
        /**
         * iPad tablets family.
         */
        'iPad'              => array(
            'vendor'     => 'Apple',
            'match'      => 'iPad|iPad.*Mobile',
            'modelMatch' => array('iPad.*CPU[a-z ]+[VER]'),
        ),


    );

    /**
     * List of mobile Operating Systems.
     *
     * @var array
     */
    protected static $operatingSystems = array(


        /**
         * Apple's iOS family.
         *
         */
        'iOS'               => array(
            'iOS' => array(
                'isMobile'     => true,
                'match'        => '\biPhone.*(Mobile|OS)|\biPod|\biPad',
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
    protected static $browsers = array(
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

    /**
     * Utilities.
     *
     * @var array
     */
    protected static $utilities = array(
        // Experimental. When a mobile device wants to switch to 'Desktop Mode'.
        // @ref: http://scottcate.com/technology/windows-phone-8-ie10-desktop-or-mobile/
        // @ref: https://github.com/serbanghita/Mobile-Detect/issues/57#issuecomment-15024011
        'DesktopMode' => 'WPDesktop',
        'TV'          => 'SonyDTV|HbbTV', // experimental
        'WebKit'      => '(webkit)[ /]([\w.]+)',
        'Bot'         => 'Googlebot|DoCoMo|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit',
        'MobileBot'   => 'Googlebot-Mobile|DoCoMo|YahooSeeker/M1A1-R2D2',
        'Console'     => '\b(Nintendo|Nintendo WiiU|PLAYSTATION|Xbox)\b',
        'Watch'       => 'SM-V700',
    );

    /**
     * The individual segments that could exist in a User-Agent string. VER refers to the regular
     * expression defined in the constant self::VER.
     *
     * @var array
     */
    protected static $properties = array(

        // Build
        'Mobile'        => 'Mobile/[VER]',
        'Build'         => 'Build/[VER]',
        'Version'       => 'Version/[VER]',
        'VendorID'      => 'VendorID/[VER]',

        // Devices
        'iPad'          => 'iPad.*CPU[a-z ]+[VER]',
        'iPhone'        => 'iPhone.*CPU[a-z ]+[VER]',
        'iPod'          => 'iPod.*CPU[a-z ]+[VER]',
        //'BlackBerry'    => array('BlackBerry[VER]', 'BlackBerry [VER];'),
        'Kindle'        => 'Kindle/[VER]',

        // Browser
        'Chrome'        => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'),
        'Coast'         => array('Coast/[VER]'),
        'Dolfin'        => 'Dolfin/[VER]',
        // @reference: https://developer.mozilla.org/en-US/docs/User_Agent_Strings_Reference
        'Firefox'       => 'Firefox/[VER]',
        'Fennec'        => 'Fennec/[VER]',
        // @reference: http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
        'IE'      => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];'),
        // http://en.wikipedia.org/wiki/NetFront
        'NetFront'      => 'NetFront/[VER]',
        'NokiaBrowser'  => 'NokiaBrowser/[VER]',
        'Opera'         => array(' OPR/[VER]', 'Opera Mini/[VER]', 'Version/[VER]'),
        'Opera Mini'    => 'Opera Mini/[VER]',
        'Opera Mobi'    => 'Version/[VER]',
        'UC Browser'    => 'UC Browser[VER]',
        'MQQBrowser'    => 'MQQBrowser/[VER]',
        'MicroMessenger' => 'MicroMessenger/[VER]',
        'baiduboxapp'   => 'baiduboxapp/[VER]',
        'baidubrowser'  => 'baidubrowser/[VER]',
        'Iron'          => 'Iron/[VER]',
        // @note: Safari 7534.48.3 is actually Version 5.1.
        // @note: On BlackBerry the Version is overwriten by the OS.
        'Safari'        => array('Version/[VER]', 'Safari/[VER]'),
        'Skyfire'       => 'Skyfire/[VER]',
        'Tizen'         => 'Tizen/[VER]',
        'Webkit'        => array('webkit[ /][VER]', 'AppleWebKit/[VER]'),

        // Engine
        'Gecko'         => 'Gecko/[VER]',
        'Trident'       => 'Trident/[VER]',
        'Presto'        => 'Presto/[VER]',

        // OS
        'iOS'              => ' \bOS\b [VER] ',
        'Android'          => 'Android [VER]',
        'BlackBerry'       => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]', 'Version/[VER]'),
        'BREW'             => 'BREW [VER]',
        'Java'             => 'Java/[VER]',
        // @reference: http://windowsteamblog.com/windows_phone/b/wpdev/archive/2011/08/29/introducing-the-ie9-on-windows-phone-mango-user-agent-string.aspx
        // @reference: http://en.wikipedia.org/wiki/Windows_NT#Releases
        'Windows Phone OS' => array( 'Windows Phone OS [VER]', 'Windows Phone [VER]'),
        'Windows Phone'    => 'Windows Phone [VER]',
        'Windows CE'       => 'Windows CE/[VER]',
        // http://social.msdn.microsoft.com/Forums/en-US/windowsdeveloperpreviewgeneral/thread/6be392da-4d2f-41b4-8354-8dcee20c85cd
        'Windows NT'       => 'Windows NT [VER]',
        'Symbian'          => array('SymbianOS/[VER]', 'Symbian/[VER]'),
        'webOS'            => array('webOS/[VER]', 'hpwOS/[VER];'),
    );

    public static function getBrowsers()
    {
        return static::$browsers;
    }

    /**
     * Get all possible HTTP headers that
     * can contain the User-Agent string.
     *
     * @return array List of HTTP headers.
     */
    public static function getUaHttpHeaders()
    {
        return self::$uaHttpHeaders;
    }

    public static function getMobileHeaders()
    {
        return static::$mobileHeaders;
    }

    public static function getOperatingSystems()
    {
        return static::$operatingSystems;
    }

    public static function getPhoneDevices()
    {
        return static::$phoneDevices;
    }

    public static function getTabletDevices()
    {
        return static::$tabletDevices;
    }

    public static function getUtilities()
    {
        return static::$utilities;
    }

    public static function getProperties()
    {
        return static::$properties;
    }
}
