<?php
return array(
    'Console' => array(

		//Nintendo Wii:
		'Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.28 (KHTML, like Gecko) NX/3.0.3.12.14 NintendoBrowser/3.1.1.9577.EU'    => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Nintendo WiiU) AppleWebKit/534.52 (KHTML, like Gecko) NX/{Version No} NintendoBrowser/{Version No}.US' => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7567.US'                                                              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7498.US'                                                              => array('isMobile' => true, 'isTablet' => false),
		//Sony PlayStation:
		'Mozilla/5.0 (PLAYSTATION 3 4.21) AppleWebKit/531.22.8 (KHTML, like Gecko)'                                          => array('isMobile' => false, 'isTablet' => false),
		//Microsoft Xbox:
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; Xbox)'                                              => array('isMobile' => false, 'isTablet' => false),
		// WTF? Must investigate.
		//'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Xbox)'                        => array('isMobile' => false, 'isTablet' => false),

        ),

    'Other' => array(
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10) AppleWebKit/600.1.25 (KHTML, like Gecko) Version/8.0 Safari/600.1.25' => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36' => array('isMobile' => false, 'isTablet' => false),

        // @todo 3Q - http://3q-int.com/en/download/tablets7/
        'Mozilla/5.0 (Linux; U; Android 4.0.4; it-it; MT0729B Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.4; uk-us; RC9716B Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,

        // Sogou Explorer (Browser)
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36 SE 2.X MetaSr 1.0' => null,
        'Mozilla/4.0 (compatible; MSIE 9.0; Windows NT 6.1; SV1; SE 2.x)' => null,

        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Iron/37.0.2000.0 Chrome/37.0.2000.0 Safari/537.36' => array('version' => array('Iron' => '37.0.2000.0')),
        // Liebao Browser
        'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36 LBBROWSER',
        'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.102 Chrome/32.0.1700.102 Safari/537.36'                                                     => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0'                                                                                                                  => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 AlexaToolbar/psPCtGhf-2.2'                                                                                        => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:22.0) Gecko/20100101 Firefox/22.0'                                                                                                              => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (X11; Linux ppc; rv:17.0) Gecko/20130626 Firefox/17.0 Iceweasel/17.0.7'                                                                                                        => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (X11; Linux) AppleWebKit/535.22+ Midori/0.4'                                                                                                                                   => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-us) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.20+ Midori/0.4'                                                              => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.20 Safari/537.36  OPR/15.0.1147.18 (Edition Next)'                                             => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36'                                                                                     => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 5.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36'                                                                              => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 5.2; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0'                                                                                                                  => array('isMobile' => false, 'isTablet' => false),
        'Opera/9.80 (Windows NT 5.2; WOW64) Presto/2.12.388 Version/12.14'                                                                                                                          => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0'                                                                                                                  => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (X11; FreeBSD amd64; rv:14.0) Gecko/20100101 Firefox/14.0.1'                                                                                                                   => array('isMobile' => false, 'isTablet' => false),
        // @todo Inspect https://gist.githubusercontent.com/pongacm/b7775bebf2b26c09e1f8/raw/0aff83747959386663f3a5c68d7f7150764a8e2d/Varnish%20-%20Tablet%20PC%20(TAB)
        // https://github.com/varnish/varnish-devicedetect/issues/19
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; .NET4.0E; .NET4.0C; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Tablet PC 2.0; MASMJS)' => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0; MANMJS)'                                                                                                           => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; MASMJS)'                                                                                                      => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0; Touch; MASMJS)'                                                                                                    => array('isMobile' => false, 'isTablet' => false),
        'Opera/9.80 (Windows NT 6.2; WOW64; MRA 8.0 (build 5784)) Presto/2.12.388 Version/12.11'                                                                                                    => array('isMobile' => false, 'isTablet' => false),
        // IE 10
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)'                                                                                                                   => array('isMobile' => false, 'isTablet' => false),
        // IE 11 @todo: Trident(.*)rv.(\d+)\.(\d+)
        'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv 11.0) like Gecko'                                                                                                                             => array('isMobile' => false, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko'                                                                                                               => array('isMobile' => false, 'isTablet' => false),

        // TV
        'Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ (KHTML, like Gecko) Safari/537.1+ HbbTV/1.1.1 ( ;LGE ;NetCast 4.0 ;03.20.30 ;1.0M ;)'                                               => array('isMobile' => false, 'isTablet' => false),
        'HbbTV/1.1.1 (;Panasonic;VIERA 2012;1.261;0071-3103 2000-0000;)'                                                                                                                            => array('isMobile' => false, 'isTablet' => false),
        'Opera/9.80 (Linux armv7l; HbbTV/1.1.1 (; Sony; KDL32W650A; PKG3.211EUA; 2013;); ) Presto/2.12.362 Version/12.11'                                                                           => array('isMobile' => false, 'isTablet' => false),
        ),

    'TV' => array(
        'Opera/9.80 (Linux mips ; U; HbbTV/1.1.1 (; Philips; ; ; ; ) CE-HTML/1.0 NETTV/3.2.1; en) Presto/2.6.33 Version/10.70' => null
        ),

    'Generic' => array(

        'Mozilla/5.0 (Linux; U; Jolla; Sailfish; Mobile; rv:20.0) Gecko/20.0 Firefox/20.0 Sailfish Browser/1.0 like Safari/535.19' => array('isMobile' => true, 'isTablet' => true),

        // Generic Firefox User-agents
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Gecko_user_agent_string_reference#Firefox_OS
        'Mozilla/5.0 (Mobile; rv:26.0) Gecko/26.0 Firefox/26.0' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Tablet; rv:26.0) Gecko/26.0 Firefox/26.0' => array('isMobile' => true, 'isTablet' => true),

        // Facebook WebView
        'Mozilla/5.0 (iPhone; CPU iPhone OS 7_1_1 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Mobile/11D201 [FBAN/FBIOS;FBAV/12.1.0.24.20;FBBV/3214247;FBDV/iPhone6,1;FBMD/iPhone;FBSN/iPhone OS;FBSV/7.1.1;FBSS/2; FBCR/AT&T;FBID/phone;FBLC/en_US;FBOP/5]' => null,

        // Outlook
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/7.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET4.0C; .NET4.0E; InfoPath.3; IM-2014-026; IM-2014-043; Microsoft Outlook 14.0.7113; ms-office; MSOffice 14)' => null,

        // Carrefour tablet
        'Mozilla/5.0 (Linux; Android 4.2.2; CT1020W Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),

        // @comment: Pipo m6pro tablet
        'Mozilla/5.0 (Linux; Android 4.2.2; M6pro Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.141 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),

        // https://github.com/varnish/varnish-devicedetect/issues/17
        // To be researched.
        'MobileSafari/9537.53 CFNetwork/672.1.13 Darwin/13.1.0' => array('isMobile' => true, 'isTablet' => false),
        'Appcelerator Titanium/3.2.2.GA (iPod touch/6.1.6; iPhone OS; en_US;)' => array('isMobile' => true, 'isTablet' => false),


        'Opera Coast/3.0.3.78307 CFNetwork/672.1.15 Darwin/14.0.0' => array('isMobile' => true, 'isTablet' => false),

        'Mozilla/5.0 (Linux; Android 4.0.3; ALUMIUM10 Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.99 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; Android 4.2.1; en-us; JY-G3 Build/JOP40D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Linux; U; Android 4.1.1; hu-hu; M758A Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => true),

        'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; EVOTAB Build/IMM76I) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => true),
        'Java/1.6.0_22' => array('isMobile' => false, 'isTablet' => false, 'version' => array('Java' => '1.6.0_22') ),
        'Opera/9.80 (Series 60; Opera Mini/6.5.29260/29.3417; U; ru) Presto/2.8.119 Version/11.10' => array('isMobile' => true, 'isTablet' => false),
        'Opera/9.80 (Android; Opera Mini/6.5.27452/29.3417; U; ru) Presto/2.8.119 Version/11.10'  => array('isMobile' => true, 'isTablet' => false),
        'Opera/9.80 (iPhone; Opera Mini/7.1.32694/27.1407; U; en) Presto/2.8.119 Version/11.10' => array('isMobile' => true, 'isTablet' => false),
        // New Opera
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.60 Safari/537.17 OPR/14.0.1025.52315' => array('isMobile' => false, 'isTablet' => false),
        // Unknown yet
        // Looks like Chromebook
        'Mozilla/5.0 (X11; CrOS armv7l 4920.83.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.103 Safari/537.36' => null,
        'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_2 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8H7 Safari/6533.18.5' => array('isMobile' => true, 'isTablet' => false),
        'Opera/9.80 (Android 2.3.7; Linux; Opera Mobi/46154) Presto/2.11.355 Version/12.10' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Linux; U; Android 4.0.3; it-it; DATAM819HD_C Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; SGPT12 Build/TID0142) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; cm_tenderloin Build/IMM76L; CyanogenMod-9) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,

        'Mozilla/5.0 (Linux; U; Android 4.1.1; fr-fr; A210 Build/JRO03H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null, // Acer Iconia Tab
        'Mozilla/5.0 (iPad; CPU OS 6_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B141 Safari/8536.25' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-I8150 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => null,
        'Mozilla/5.0 (iPad; CPU OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Mercury/7.2 Mobile/10A523 Safari/8536.25' => null, // Mercurio Browser
        'Opera/9.80 (Android 2.3.7; Linux; Opera Tablet/46154) Presto/2.11.355 Version/12.10' => null,
        'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; sdk Build/MASTER) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true), // sdk
        'Mozilla/5.0 (Linux; U; Android 4.2; en-us; sdk Build/JB_MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true), // sdk
        
        'Opera/9.80 (X11; Linux zbov) Presto/2.11.355 Version/12.10' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; TOUCHPAD 7 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => null, // 7" Verso Android tablet
        'Mozilla/5.0 (iPhone; U; CPU OS 4_2_1 like Mac OS X) AppleWebKit/532.9 (KHTML, like Gecko) Version/5.0.3 Mobile/8B5097d Safari/6531.22.7' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; SGPT12 Build/TID0142) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null, // sony xperia tablet s unforts
        'Mozilla/5.0 (Linux; U; Android 2.0.6_b1; ru-ru Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17' => null, // PocketBook IQ701 (tablet)
        'Mozilla/5.0 (Linux; Android 4.0.4; z1000 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19' => null, // It is a tablet with calling
        'Mozilla/5.0 (Linux; Android 4.0.3; cm_tenderloin Build/GWK74) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19' => null, // HP touch pad running android cyanogenmod
        'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; Android for Techvision TV1T808 Board Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => null, // My device is tablet but its detected as phone
        'BlackBerry8520/5.0.0.592 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/136' => null,
        'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17' => null, // its a lenovo tablet 2 with windows 8 pro
        'Mozilla/5.0 (Linux; U; Android 3.1; ru-ru; LG-V900 Build/HMJ37) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13' => null,
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; HTC; Windows Phone 8S by HTC)' => null,
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)' => null, // MS Surface RT tablet actually!
        'Mozilla/5.0 (PLAYSTATION 3 4.11) AppleWebKit/531.22.8 (KHTML, like Gecko)' => null,
        'Mozilla/5.0 (Linux; U; Android 3.2; ru-ru; V9S_V1.4) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13' => null, // Wrong detection - 7-inch tablet was detected as a phone. Android 3.2.1, native browser
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)' => null, // Nope, its a Microsoft Surface tablet  running Windows RT (8) with MSIE 10
        'Mozilla/5.0 (Linux; U; Android 2.2; es-es; Broncho N701 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => null, // Tablet!
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)' => null, // its a Microsoft surface rt (tablet)
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; WebView/1.0)' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; Next7P12 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => null, // Nextbook 7SE Tablet
        'Opera/9.80 (X11; Linux zbov) Presto/2.11.355 Version/12.10' => null, // allview alldro speed tablet, android ics, opera mobile
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)' => null, // Its a surface in portrait
        'Mozilla/5.0 (Linux; U; Android 2.3.6; es-es; SAMSUNG GT-S5830/S5830BUKT2 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => null,
        'Mozilla/5.0 (Linux; U; Android 3.2.1; en-gb;HTC_Flyer_P512 Build/HTK75C) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13' => null,
        // Am ramas la pozitia: 207

        // Android on Windows :) www.socketeq.com
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; full Android on Microsoft Windows, pad, pc, n*books Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,

        // TV
        'Opera/9.80 (Linux mips; U; InettvBrowser/2.2 (00014A;SonyDTV115;0002;0100) KDL40EX720; CC/BEL; en) Presto/2.7.61 Version/11.00' => null,

        'Mozilla/5.0 (Android; Mobile; rv:18.0) Gecko/18.0 Firefox/18.0' => array('isMobile' => true),
        // Maxthon
        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.12 (KHTML, like Gecko) Maxthon/3.0 Chrome/18.0.966.0 Safari/535.12' => null,
        'Opera/9.80 (Windows NT 5.1; U; Edition Yx; ru) Presto/2.10.289 Version/12.02' => null,
        'Mozilla/5.0 (Linux; U; Android 4.2; en-us; sdk Build/JB_MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => null,
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; Windows Phone 6.5.3.5)' => null,
        'PalmCentro/v0001 Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D061; Blazer/4.5) 16;320x320' => null,
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)' => null,
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Microsoft; XDeviceEmulator)' => null,
        // @todo: research N880E
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; MAL; N880E; China Telecom)' => null,
        'Opera/9.80 (Series 60; Opera Mini/7.0.29482/28.2859; U; ru) Presto/2.8.119 Version/11.10' => array('isMobile' => true),
        'Opera/9.80 (S60; SymbOS; Opera Mobi/SYB-1202242143; U; en-GB) Presto/2.10.254 Version/12.00' => null,
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-au; 97D Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => null,
        'Opera/9.80 (Android; Opera Mini/7.0.29952/28.2647; U; ru) Presto/2.8.119 Version/11.10' => array('isMobile' => true, 'isTablet' => false),
        'Opera/9.80 (Android; Opera Mini/6.1.25375/28.2555; U; en) Presto/2.8.119 Version/11.10' => array('isMobile' => true, 'isTablet' => false),
        'Opera/9.80 (Mac OS X; Opera Tablet/35779; U; en) Presto/2.10.254 Version/12.00' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Android; Tablet; rv:10.0.4) Gecko/10.0.4 Firefox/10.0.4 Fennec/10.0.4' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Android; Tablet; rv:18.0) Gecko/18.0 Firefox/18.0' => array('isMobile' => true, 'isTablet' => true),
        'Opera/9.80 (Linux armv7l; Maemo; Opera Mobi/14; U; en) Presto/2.9.201 Version/11.50' => array('isMobile' => true),
        'Opera/9.80 (Android 2.2.1; Linux; Opera Mobi/ADR-1207201819; U; en) Presto/2.10.254 Version/12.00' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Linux; U; Android 4.1.1; en-us; sdk Build/JRO03E) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true),
        'Mozilla/5.0 (Linux; U; Android 4.2.2; de-de; Endeavour 1010 Build/ONDA_MID) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true),     // Blaupunkt Endeavour 1010
        'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; Tablet-PC-4 Build/ICS.g08refem618.20121102) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true),
        // Tagi tablets
        'Mozilla/5.0 (Linux; U; Android 4.2.2; de-de; Tagi Tab S10 Build/8089) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array(
            'isMobile' => true, 'isTablet' => true,
        ),
        ),

    'Bot' => array(
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
        'grub-client-1.5.3; (grub-client-1.5.3; Crawl your own stuff with http://grub.org)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
        'Googlebot-Image/1.0' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
        'Python-urllib/2.5' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
        'facebookexternalhit/1.0 (+http://www.facebook.com/externalhit_uatext.php)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/)
        ),
);
