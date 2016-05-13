<?php
return array(
    'Microsoft' => array(
        // Surface tablet
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; .NET4.0E; .NET4.0C; Tablet PC 2.0)'                => array('isMobile' => true, 'isTablet' => true, 'version' => array('IE' => '10.0', 'Windows NT' => '6.2', 'Trident' => '6.0') ),
        // Ambiguous.
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0)'                                                          => array('isMobile' => true, 'isTablet' => false),
        // Ambiguous.
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)'                                                   => array('isMobile' => true, 'isTablet' => false),
        // http://www.whatismybrowser.com/developers/unknown-user-agent-fragments
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; ARMBJS)'                                           => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)'                                    => array('isMobile' => false, 'isTablet' => false),

        // Thanks to Jonathan Donzallaz!
        // Firefox (nightly) in metro mode on Dell XPS 12
        'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:25.0) Gecko/20130626 Firefox/25.0'                                                       => array('isMobile' => false, 'isTablet' => false),
        // Firefox in desktop mode on Dell XPS 12
        'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0'                                                       => array('isMobile' => false, 'isTablet' => false),
        // IE10 in metro mode on Dell XPS 12
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; MDDCJS)'                                           => array('isMobile' => false, 'isTablet' => false),
        // IE10 in desktop mode on Dell XPS 12
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0; MDDCJS)'                                                => array('isMobile' => false, 'isTablet' => false),
        // Opera on Dell XPS 12
        'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.52 Safari/537.36 OPR/15.0.1147.130' => array('isMobile' => false, 'isTablet' => false),
        // Chrome on Dell XPS 12
        'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36'                  => array('isMobile' => false, 'isTablet' => false),
        // Google search app from Windows Store
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MDDCJS; WebView/1.0)'                       => array('isMobile' => false, 'isTablet' => false),

        // Nokia Lumia Tests.
        // There are important because of Windows Continuum.
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; Microsoft; Lumia 640 XL LTE)' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 520)' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 620)' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 822)' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 430 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 435) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 532) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537 BMID/E679DAAB6F' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 640 LTE) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 1520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537 UCBrowser/4.2.1.541 Mobile' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 620) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 625) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 635) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 635; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 735) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 820; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 830) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 925) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 930) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 6.2; ARM; Trident/7.0; Touch; rv:11.0; WPDesktop; Lumia 635) like Gecko' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 550) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 640 Dual SIM) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950 XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 625) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 635) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 830) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/14.14295' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 930) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/14.14295' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530 Dual SIM) like Gecko' => array('isMobile' => true, 'isTablet' => false),

        'Mozilla/5.0 (Windows NT 10.0; ARM; Lumia 950 XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 10.0; ARM; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 10.0; ARM; Lumia 930) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        'Mozilla/5.0 (Windows NT 10.0; ARM; Lumia 730 Dual SIM) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586' => array('isMobile' => true, 'isTablet' => false),
        ),
);
