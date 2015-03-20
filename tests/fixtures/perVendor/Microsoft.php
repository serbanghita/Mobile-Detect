<?php
return array(
    'Microsoft' => array(		
		// Surface tablet
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; .NET4.0E; .NET4.0C; Tablet PC 2.0)'                => array('isMobile' => true, 'isTablet' => true, 'version' => array('IE' => '10.0', 'Windows NT' => '6.2', 'Trident' => '6.0') ),
		// Ambiguos.
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0)'                                                          => array('isMobile' => true, 'isTablet' => false),
		// Ambiguos.
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
        ),
);
