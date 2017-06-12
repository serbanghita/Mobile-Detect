<?php
return array(
    'Amazon' => array(
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFTT Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.4 Mobile Safari/535.19 Silk-Accelerated =true' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)'                  => array('isMobile' => true, 'isTablet' => true, 'version' => array('Webkit' => '528.5+', 'Kindle' => '3.0', 'Safari' => '4.0'), 'model' => 'Kindle' ),
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFOTE Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                    => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Build' => 'IML74K', 'Webkit' => '534.30', 'Safari' => '4.0') ),
        'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; WFJWAE Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                   => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-us; KFTT Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.21 Safari/535.19 Silk-Accelerated=true' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-us; KFTHWI Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.21 Safari/535.19 Silk-Accelerated=true' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-us; KFJWI Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.21 Safari/535.19 Silk-Accelerated=true' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-us; KFSOWI Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.21 Safari/535.19 Silk-Accelerated=true' => array('isMobile' => true, 'isTablet' => true),
        // T720-WIFI is a tablet.
        'Mozilla/5.0 (Linux; U; Android 2.1; xx-xx; T720-WIFI Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; Android 5.1; KFARWI Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Silk/47.1.79 like Chrome/47.0.2526.80 Mobile Safari/537.36' => array('isMobile' => true, 'isTablet' => true),


        // Tablet.
        'Mozilla/5.0 (Linux; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/44.1.54 like Chrome/44.0.2403.63 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),

        // Desktop
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Silk/44.1.54 like Chrome/44.0.2403.63 Safari/537.36' => array('isMobile' => false, 'isTablet' => false),

        // Mobile
        // The new Amazon specs are confusing.
        // The problem is that KFTHWI is Kindle Fire HDX 7. So it's a tablet.
        // 'Mozilla/5.0 (Linux; U; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/44.1.54 like Chrome/44.0.2403.63 Mobile Safari/537.36' => array('isMobile' => true, 'isTablet' => false),

        // 29 mar 2017
        'Mozilla/5.0 (Linux; Android 5.1.1; KFASWI Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Silk/48.2.2 like Chrome/48.0.2564.95 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; Android 5.1.1; KFFOWI Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Silk/46.1.66 like Chrome/46.0.2490.80 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; U; en-us; KFAPWI Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.13 Safari/535.19 Silk-Accelerated=true'  => array('isMobile' => true, 'isTablet' => true),
        'Mozilla/5.0 (Linux; Android 5.1.1; KFGIWI Build/LVY48F) AppleWebKit/537.36 (KHTML, like Gecko) Silk/56.2.4 like Chrome/56.0.2924.87 Safari/537.36' => array('isMobile' => true, 'isTablet' => true),
        // Amazon Fire Phone
        'Mozilla/5.0 (Linux; U; Android 4.4.4; en-us; SD4930UR Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.60 like Chrome/37.0.2026.117 Mobile Safari/537.36' => array('isMobile' => true, 'isTablet' => false),

        ),
);
