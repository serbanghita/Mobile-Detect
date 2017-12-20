<?php
namespace MobileDetect\Http;

class Headers {

    public static $uaHeaders = [
        // UA variants.
        "user-agent",
        // Header occurs on devices using Opera Mini.
        "x-operamini-phone",
        'x-operamini-phone-ua',
        // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
        // Found on Nintendo 3DS.
        "x-device-user-agent",
        "x-original-user-agent",
        "x-skyfire-phone",
        "x-bold-phone-ua",
        "device-stock-ua",
        "x-ucbrowser-device-ua",
    ];

    /**
     * These headers combined can provide clues
     * to the device's profile.
     */
    public static $someHttpHeaders = [
        "from",
        "referer",
        "upgrade",
        "via",
        "warning",
        "wap-connection",
        "profile",
        "ua-os",
        "ua-cpu"
    ];

    public static $cfHeaders = [
        // CloudFront Headers
        "cloudfront-is-desktop-viewer",
        "cloudfront-is-mobile-viewer",
        "cloudfront-is-tablet-viewer"
    ];

    /**
     * HTTP headers that trigger the 'isMobile' detection
     * to be true.
     */
    public static $mobileHttpHeaders  = [

        'accept' => array('matches' => array(
            // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
            'application/x-obml2d',
            // BlackBerry devices.
            'application/vnd.rim.html',
            'text/vnd.wap.wml',
            'application/vnd.wap.xhtml+xml',
        )),
        'x-wap-profile' => null,
        'x-wap-clientid' => null,
        'wap-connection' => null,
        'profile' => null,
        // Reported by Opera on Nokia devices (eg. C3).
        'x-operamini-phone-ua' => null,
        'x-nokia-ipaddress' => null,
        'x-nokia-gateway-id' => null,
        'x-orange-id' => null,
        'x-vodafone-3gpdpcontext' => null,
        'x-huawei-userid' => null,
        // Reported by Windows Smartphones.
        'ua-os' => null,
        // Reported by Verizon, Vodafone proxy system.
        'x-mobile-gateway' => null,
        // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e.
        'x-att-deviceid' => null,
        // Seen this on a HTC.
        'ua-cpu' => array('matches' => array('ARM')),
    ];


}