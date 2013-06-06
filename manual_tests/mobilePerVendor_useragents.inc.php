<?php
/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 * @author      Serban Ghita <serbanghita@gmail.com>
 *
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 *
 *		This file is daily updated and it is based on our future API.
 */

$mobilePerVendor_userAgents = array(


	'Acer' => array(
		'Mozilla/5.0 (Linux; U; Android 4.0.3; de-de; A200 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'   => array( 'isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Webkit' => '534.30', 'Safari' => '4.0', 'Build' => 'IML74K'), 'model' => 'A200' ),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A501 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.1.1; A701 Build/JRO03H) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19'   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.1.2; B1-A71 Build/JZO54K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19' => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)'                                 => array('isMobile' => true, 'isTablet' => false),
		),

	'ASUS' => array(
		'Mozilla/5.0 (Linux; U; Android 3.2.1; en-us; Transformer TF101 Build/HTK75) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'            => array( 'isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '3.2.1', 'Webkit' => '534.13', 'Safari' => '4.0'), 'model' => 'Transformer TF101' ),
		'Mozilla/5.0 (Linux; Android 4.1.1; Transformer Build/JRO03L) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.1.1; ASUS Transformer Pad TF300T Build/JRO03C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; fr-fr; Transformer Build/JZO54K; CyanogenMod-10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; asus_laptop Build/IMM76L) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                 => array('isMobile' => true, 'isTablet' => false),
	),

	'Alcatel' => array(
		'Mozilla/5.0 (Linux; U; Android 2.3.5; it-it; ALCATEL ONE TOUCH 918D Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'      => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '2.3.5', 'Webkit' => '533.1', 'Safari' => '4.0', 'Build' => 'GRJ90'), 'model' => 'ONE TOUCH 918D' ),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; ALCATEL ONE TOUCH 991 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'       => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '2.3.6', 'Webkit' => '533.1', 'Safari' => '4.0', 'Build' => 'GRJ90'), 'model' => 'ONE TOUCH 991' ),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; ALCATEL ONE TOUCH 993D Build/ICECREAM) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '4.0.4', 'Webkit' => '534.30', 'Safari' => '4.0', 'Build' => 'ICECREAM'), 'model' => 'ONE TOUCH 993D' ),
		),

	'Amazon' => array(
		'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Webkit' => '528.5+', 'Kindle' => '3.0', 'Safari' => '4.0'), 'model' => 'Kindle' ),
		),

	'Apple' => array(
		'iTunes/9.1.1'                                                                                                                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16'                                          => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '3_0', 'Webkit' => '528.18', 'Safari' => '4.0'), 'model' => 'iPhone' ),
		'Mozilla/5.0 (iPhone; CPU iPhone OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/7534.48.3'                                               => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '5_1_1', 'Webkit' => '534.46', 'Mobile' => '9B206', 'Safari' => '5.1'), 'model' => 'iPhone' ),
		'Mozilla/5.0 (iPod; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A403 Safari/8536.25'                                                    => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '6_0', 'Webkit' => '536.26', 'Mobile' => '10A403', 'Safari' => '6.0'), 'model' => 'iPod'),
		'Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X; en-us) AppleWebKit/534.46.0 (KHTML, like Gecko) CriOS/21.0.1180.80 Mobile/9B206 Safari/7534.48.3 (6FF046A0-1BC4-4E7D-8A9D-6BF17622A123)' => array('isMobile' => true, 'isTablet' => true, 'version' => array('iOS' => '5_1_1', 'Webkit' => '534.46.0', 'Chrome' => '21.0.1180.80', 'Mobile' => '9B206'), 'model' => 'iPad' ),
		'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A403 Safari/8536.25'                                                           => array('isMobile' => true, 'isTablet' => true, 'version' => array('iOS' => '6_0', 'Webkit' => '536.26', 'Safari' => '6.0', 'Mobile' => '10A403'), 'model' => 'iPad' ),
		'Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5'                                          => array('isMobile' => true, 'isTablet' => true, 'version' => array('iOS' => '4_2_1', 'Webkit' => '533.17.9', 'Safari' => '5.0.2', 'Mobile' => '8C148'), 'model' => 'iPad' ),
		'Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.10'                                          => array('isMobile' => true, 'isTablet' => true, 'version' => array('iOS' => '3_2', 'Webkit' => '531.21.10', 'Safari' => '4.0.4', 'Mobile' => '7B334b'), 'model' => 'iPad' ),
		'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X; da-dk) AppleWebKit/534.46.0 (KHTML, like Gecko) CriOS/21.0.1180.82 Mobile/10A523 Safari/7534.48.3'                              => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '6_0_1', 'Webkit' => '534.46.0', 'Chrome' => '21.0.1180.82', 'Mobile' => '10A523'), 'model' => 'iPhone' ),
		'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25'                                                => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '6_0_1', 'Webkit' => '536.26', 'Safari' => '6.0', 'Mobile' => '10A523'), 'model' => 'iPhone' ),
		'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1 like Mac OS X; ru-ru) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/23.0.1271.100 Mobile/10B142 Safari/8536.25'                                   => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '6_1', 'Webkit' => '536.26', 'Chrome' => '23.0.1271.100', 'Mobile' => '10B142'), 'model' => 'iPhone' ),
		'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25'                                                => array('isMobile' => true, 'isTablet' => false, 'version' => array('iOS' => '6_1_3', 'Webkit' => '536.26', 'Safari' => '6.0', 'Mobile' => '10B329'), 'model' => 'iPhone' )
	),

	'Archos' => array(

		'Mozilla/5.0 (Linux; Android 4.0.4; ARCHOS 80G9 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19' => array(),

	),

	'BlackBerry' => array(
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9300; en) AppleWebKit/534.8+ (KHTML, like Gecko) Version/6.0.0.546 Mobile Safari/534.8+'                          => array('isMobile' => true, 'isTablet' => false, 'version' => array('Webkit' => '534.8+', 'BlackBerry' => '6.0.0.546'), 'model' => 'BlackBerry 9300' ),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9360; en-US) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.0.0.400 Mobile Safari/534.11+'                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9700; he) AppleWebKit/534.8+ (KHTML, like Gecko) Version/6.0.0.723 Mobile Safari/534.8+'                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9700; en-US) AppleWebKit/534.8  (KHTML, like Gecko) Version/6.0.0.448 Mobile Safari/534.8'                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9790; en-GB) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.1.0.714 Mobile Safari/534.11+'                     => array('isMobile' => true, 'isTablet' => false, 'version' => array('Webkit' => '534.11+', 'BlackBerry' => '7.1.0.714'), 'model' => 'BlackBerry 9790' ),
		'Opera/9.80 (BlackBerry; Opera Mini/7.0.29990/28.2504; U; en) Presto/2.8.119 Version/11.10'                                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9981; en-GB) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.1.0.342 Mobile Safari/534.11+'                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en-GB) AppleWebKit/534.8+ (KHTML, like Gecko) Version/6.0.0.546 Mobile Safari/534.8+'                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9780; es) AppleWebKit/534.8  (KHTML, like Gecko) Version/6.0.0.480 Mobile Safari/534.8'                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9810; en-US) AppleWebKit/534.11  (KHTML, like Gecko) Version/7.0.0.583 Mobile Safari/534.11'                      => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9900; en-US) AppleWebKit/534.11  (KHTML, like Gecko) Version/7.1.0.523 Mobile Safari/534.11'                      => array('isMobile' => true, 'isTablet' => false),
		'BlackBerry8520/5.0.0.592 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/136'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'BlackBerry8520/5.0.0.1067 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/603'                                                                          => array('isMobile' => true, 'isTablet' => false),
		'BlackBerry8520/5.0.0.1036 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/611'                                                                          => array( 'isMobile' => true, 'isTablet' => false, 'version' => array('BlackBerry' => '5.0.0.1036', 'VendorID' => '611'), 'model' => 'BlackBerry8520' ),
		'Mozilla/5.0 (BlackBerry; U; BlackBerry 9220; en) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.1.0.337 Mobile Safari/534.11+'                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (PlayBook; U; RIM Tablet OS 2.1.0; en-US) AppleWebKit/536.2+ (KHTML, like Gecko) Version/7.2.1.0 Safari/536.2+'                              => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+'                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BB10; Touch) AppleWebKit/537.10+ (KHTML, like Gecko) Version/10.0.9.2372 Mobile Safari/537.10+'                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (BB10; Touch) /537.10+ (KHTML, like Gecko) Version/10.0.9.2372 Mobile Safari/537.10+'                                                        => array( 'isMobile' => true, 'isTablet' => false, 'version' => array('BlackBerry' => '10.0.9.2372') ),
		'Mozilla/5.0 (Linux; U; Android 3.2.1; en-us; Transformer TF101 Build/HTK75) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'            => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '3.2.1', 'Webkit' => '534.13', 'Safari' => '4.0'), 'model' => 'Transformer TF101' ),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; de-de; A200 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                        => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Webkit' => '534.30', 'Safari' => '4.0'), 'model' => 'A200' ),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                        => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Webkit' => '534.30', 'Safari' => '4.0'), 'model' => 'A500' ),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A501 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                        => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Webkit' => '534.30', 'Safari' => '4.0'), 'model' => 'A501' ),
		'Mozilla/5.0 (Linux; Android 4.1.1; Transformer Build/JRO03L) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'                  => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.1', 'Webkit' => '535.19', 'Chrome' => '18.0.1025.166'), 'model' => 'Transformer' ),
		'Mozilla/5.0 (Linux; Android 4.1.1; ASUS Transformer Pad TF300T Build/JRO03C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'  => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.1', 'Webkit' => '535.19', 'Chrome' => '18.0.1025.166'), 'model' => 'Transformer Pad TF300T' ),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; fr-fr; Transformer Build/JZO54K; CyanogenMod-10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.2', 'Webkit' => '534.30', 'Safari' => '4.0', 'Build' => 'JZO54K'), 'model' => 'Transformer' ),
		'Mozilla/5.0 (Linux; Android 4.1.2; B1-A71 Build/JZO54K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19'                      => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.2', 'Webkit' => '535.19', 'Chrome' => '18.0.1025.166'), 'model' => 'B1-A71' ),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)'                                                      => array('isMobile' => true, 'isTablet' => false, 'version' => array('Windows Phone OS' => '7.5', 'Trident' => '5.0', 'IE' => '9.0'), 'model' => 'Allegro' ),
		),

	'Broncho' => array(

		'Mozilla/5.0 (Linux; U; Android 2.2; es-es; Broncho N701 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'	=> array('isMobile' => true, 'isTablet' => true),

		),

	// @ref: http://www.bqreaders.com/gb/tablets-prices-sale.html
	'bq' => array(
		'Mozilla/5.0 (Linux; U; Android 4.0.4; es-es; bq Livingstone 2 Build/1.1.7 20121018-10:33) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; es-es; bq Edison Build/1.1.10-1015 20121230-18:00) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'  => array('isMobile' => true, 'isTablet' => true),
		),

	'Casio' => array(
			'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; C771 Build/C771M120) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'				=> array('isMobile' => true, 'isTablet' => false),
			),

	// @ref: http://www.cobyusa.com/?p=pcat&pcat_id=3001
	'Coby' => array(
			'Mozilla/5.0 (Linux; U; Android 2.2; en-us; MID7010 Build/FRF85B) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'					=> array('isMobile' => true, 'isTablet' => true),
		),

	'Cube' => array(
			'Mozilla/5.0 (Linux; U; Android 4.0.3; ru-ru; CUBE U9GT 2 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'				=> array('isMobile' => true, 'isTablet' => true),
	),

	'Danew' => array(

		'Mozilla/5.0 (Linux; U; Android 4.0.3; es-es; Dslide 700 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array( 'isMobile' => true, 'isTablet' => true, 'version' => array( 'Android' => '4.0.3', 'Build' => 'IML74K', 'Webkit' => '534.30', 'Safari' => '4.0' ), 'model' => 'Dslide 700' )

		),

	'Dell' => array(
			'Mozilla/5.0 (Linux; U; Android 1.6; en-gb; Dell Streak Build/Donut AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/ 525.20.1'               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.7; hd-us; Dell Venue Build/GWK74; CyanogenMod-7.2.0) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; DELL; Venue Pro)'                                                          => array('isMobile' => true, 'isTablet' => false),
	),

	'Fly'	=> array(
			'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; FLY IQ256 Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'			=> array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; Fly IQ440; Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'			=> array('isMobile' => true, 'isTablet' => false),
		),

	// @ref: http://www.galapad.net/product.html
	'Galapad' => array(

		'Mozilla/5.0 (Linux; U; Android 4.1.1; zh-tw; G1 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.1', 'Webkit' => '534.30', 'Safari' => '4.0', 'Build' => 'JRO03C') ),

		),

	'Google' => array(
		'Mozilla/5.0 (Linux; Android 4.2.2; Nexus 4 Build/JDQ39) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.40 Mobile Safari/537.31 OPR/14.0.1074.54070'    => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '4.2.2', 'Build' => 'JDQ39', 'Webkit' => '537.31', 'Opera' => '14.0.1074.54070') ),
		'Mozilla/5.0 (Linux; Android 4.2.2; Nexus 4 Build/JDQ39) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.58 Mobile Safari/537.31'                        => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '4.2.2', 'Chrome' => '26.0.1410.58')),
		'Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19'                            => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.2; Nexus 7 Build/JOP40C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'                               => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.1.2; Nexus 7 Build/JZ054K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'                             => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.2', 'Chrome' => '18.0.1025.166') ),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; cs-cz; Nexus S Build/JZO54K; CyanogenMod-10.0.0) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => false),
		),

	'HP' => array(
		'Mozilla/5.0 (hp-tablet; Linux; hpwOS/3.0.5; U; en-GB) AppleWebKit/534.6 (KHTML, like Gecko) wOSBrowser/234.83 Safari/534.6 TouchPad/1.0'    => array('isMobile' => true, 'isTablet' => true),
		),

	'HTC' => array(
			'HTC_Touch_HD_T8282 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)'                                                                              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 1.5; en-us; ADR6200 Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1'                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.1; xx-xx; Desire_A8181 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; HTC Desire 1.19.161.5 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.1-update1; en-gb; HTC Desire Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; HTC Desire 1.19.161.5 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2; fr-fr; HTC Desire Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                      => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2; en-dk; Desire_A8181 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2; xx-xx; 001HT Build/FRF91) AppleWebKit/525.10+ (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2'                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2; xx-xx; HTCA8180/1.0 Android/2.2 release/06.23.2010 Browser/WAP 2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2.2; de-at; HTC Desire Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.2.2; en-sk; Desire_A8181 Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3; xx-xx; HTC/DesireS/1.07.163.1 Build/GRH78C) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.4; en-us; ADR6300 Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                       => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; en-gb; HTC/DesireS/2.10.161.3 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; ru-ru; HTC_DesireS_S510e Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; Inspire 4G Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; de-de; HTC Explorer A310e Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; en-gb; HTC_ChaCha_A810e Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; nl-nl; HTC_DesireHD_A9191 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; ru-ru; HTC Desire S Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'					=> array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.3; en-au; HTC Desire Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; de-de; HTC_DesireHD Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.5; ru-ua; HTC_WildfireS_A510e Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'           => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; HTC Vision Build/GRI40; ILWT-CM7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'          => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0; xx-xx; HTC_GOF_U/1.05.161.1 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; hu-hu; HTC Sensation Z710e Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; pl-pl; EVO3D_X515m Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; ru-ru; HTC_One_S Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; ru-ru; HTC_One_V Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; zh-cn; HTC_A320e Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; zh-tw; HTC Desire V Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.0.3; PG86100 Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                     => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; en-nl; SensationXE_Beats_Z715e Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; ADR6425LVW 4G Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.0.3; HTC One V Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; cs-ee; Sensation_Z710e Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'			=> array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; HTC Evo 4G Build/MIUI) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.4; en-my; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                  => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.4; it-it; IncredibleS_S710e Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'          => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.4; fr-fr; HTC_Desire_S Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.1.1; HTC One X Build/JRO03C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.1.1; HTC Butterfly Build/JRO03C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.1.1; EVO Build/JRO03C) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.169 Mobile Safari/537.22'							=> array('isMobile' => true, 'isTablet' => false),

			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; TITAN X310e)'                                                         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e)'                                                         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T8788)'                                                               => array('isMobile' => true, 'isTablet' => false),

			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC 7 Mozart T8698; QSD8x50)'                                              => array('isMobile' => true, 'isTablet' => false, 'version' => array('IE' => '9.0', 'Windows Phone OS' => '7.5', 'Trident' => '5.0'), 'model' => '7 Mozart T8698' ),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 HTC MOZART)'                                                        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Mondrian T8788)'                                                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Mozart T8698)'                                                      => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Mozart)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Mozart; Orange)'                                                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Pro T7576)'                                                         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Pro)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Schubert T9292)'                                                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Surround)'                                                          => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Trophy T8686)'                                                      => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Trophy)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Eternity)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Gold)'                                                                => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; HD2 LEO)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; HD2)'                                                                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; HD7 T9292)'                                                           => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; HD7)'                                                                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; iPad 3)'                                                              => array('isMobile' => true, 'isTablet' => true),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; LEO)'                                                                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Mazaa)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Mondrian)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Mozart T8698)'                                                        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Mozart)'                                                              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; mwp6985)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; PC40100)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; PC40200)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; PD67100)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; PI39100)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; PI86100)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar 4G)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e)'															=> array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e; 1.08.164.02)'                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e; 2.05.164.01)'                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e; 2.05.168.02)'                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar; Orange)'                                                       => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Schuber)'                                                             => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Schubert T9292)'                                                      => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Schubert)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Spark)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Surround)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T7575)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T8697)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T8788)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T9295)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; T9296)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; TITAN X310e)'                                                         => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Titan)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Torphy T8686)'                                                        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; X310e)'                                                               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC_blocked; T8788)'                                                       => array('isMobile' => true, 'isTablet' => false, 'version' => array('IE' => '9.0', 'Windows Phone OS' => '7.5', 'Trident' => '5.0'), 'model' => 'T8788' ),

			),

	'Huwaei' => array(
			'Mozilla/5.0 (Linux; U; Android 2.1; en-us; Ideos S7 Build/ERE27) AppleWebKit/525.10+ (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2'      => array('isMobile' => true, 'isTablet' => true),
			'Mozilla/5.0 (Linux; U; Android 2.3.6; lt-lt; U8660 Build/HuaweiU8660) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'        => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.7; ru-ru; HUAWEI-U8850 Build/HuaweiU8850) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 3.2; pl-pl; MediaPad Build/HuaweiMediaPad) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'         => array('isMobile' => true, 'isTablet' => true),
			'Mozilla/5.0 (Linux; U; Android 3.2; nl-nl; HUAWEI MediaPad Build/HuaweiMediaPad) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'  => array('isMobile' => true, 'isTablet' => true),
			),

	'Kobo' => array(
			'Mozilla/5.0 (Linux; U; Android 2.0; en-us;) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 (Kobo Touch)' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '2.0', 'Webkit' => '533.1', 'Safari' => '4.0') ),
		),

	'LG' => array(
			'Mozilla/5.0 (Linux; U; Android 2.2.2; pt-br; LG-P350f Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 MMS/LG-Android-MMS-V1.0/1.2' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; LG-P500 Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 MMS/LG-Android-MMS-V1.0/1.2'   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; LS670 Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                 => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.4; ru-ru; LG-E510 Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 MMS/LG-Android-MMS-V1.0/1.2'	=> array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 2.3.4; en-us; VS910 4G Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; LG-P700 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                           => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; LG-F160S Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                           => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; LG-E610v/V10f Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                      => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (Linux; Android 4.1.2; LG-F180K Build/JZO54K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                            => array('isMobile' => true, 'isTablet' => false),

			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG E-900)'                                                                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-C900)'                                                                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-C900k)'                                                                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-E900)'                                                                    => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-E900; Orange)'                                                            => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-E900h)'                                                                   => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; LG; LG-Optimus 7)'                                                               => array('isMobile' => true, 'isTablet' => false),
			// @ref: http://ja.wikipedia.org/wiki/L-06C
			'Mozilla/5.0 (Linux; U; Android 3.0.1; ja-jp; L-06C Build/HRI66) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                    => array('isMobile' => true, 'isTablet' => true),
			'Mozilla/5.0 (Linux; U; Android 3.0; en-us; LG-V900 Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                    => array('isMobile' => true, 'isTablet' => true),
			),

	'Microsoft' => array(

		// Surface tablet
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; .NET4.0E; .NET4.0C; Tablet PC 2.0)' => array('isMobile' => true, 'isTablet' => true, 'version' => array('IE' => '10.0', 'Windows NT' => '6.2', 'Trident' => '6.0') ),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0)'                                           => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)'                                    => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; ARMBJS)'                            => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)'                     => array('isMobile' => false, 'isTablet' => false),

		),

	'Motorola' => array(
		'Mozilla/5.0 (Linux; U; Android 2.2.2; zh-cn; ME722 Build/MLS2GC_2.6.0) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.4; en-us; DROIDX Build/4.5.1_57_DX8-51) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; MB855 Build/4.5.1A-1_SUN-254_13) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.5; es-us; MB526 Build/4.5.2-51_DFL-50) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                    => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-ca; MB860 Build/4.5.2A-51_OLL-17.8) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; MOT-XT535 Build/V1.540) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                         => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.7; ko-kr; A853 Build/SHOLS_U2_05.26.3; CyanogenMod-7.1.2) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 3.0; en-us; Xoom Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                      => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 3.1; en-us; Xoom Build/HMJ25) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                      => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; DROID RAZR 4G Build/6.7.2-180_DHD-16_M4-31) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; Xoom Build/IMM76L) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; pt-br; XT687 Build/V2.27D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                           => array('isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '4.0.4', 'Webkit' => '534.30', 'Safari' => '4.0'), 'model' => 'XT687' ),
		),

	// @ref: https://www.nabitablet.com/
	'Nabi'	=> array(
		'Mozilla/5.0 (Linux; U; Android 2.2.1; en-us; NABI-A Build/MASTER) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => true),
		),

	'NEC'	=> array(
		// @ref: http://www.n-keitai.com/n-08d/?from=mediasnet
		// @ref: http://devlog.dcm-gate.com/2012/03/medias-tab-n-06duseragnet.html
		// @ref: http://keitaiall.jp/N-08D.html aka MEDIAS TAB
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ja-jp; N-08D Build/A5001911) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android AAA; BBB; N-06D Build/CCC) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'     => array('isMobile' => true, 'isTablet' => true),

		),

	'Nook' => array(

		'Mozilla/5.0 (Linux; U; Android 2.2.1; en-us; NOOK BNRV200 Build/ERD79 1.4.3) Apple WebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array( 'isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '2.2.1', 'Webkit' => '533.1', 'Safari' => '4.0') ),

		),

	'Nokia' => array(
		'Nokia6303iclassic/5.0 (06.61) Profile/MIDP-2.1 Configuration/CLDC-1.1 Mozilla/5.0 AppleWebKit/420+ (KHTML, like Gecko) Safari/420+'																=> array('isMobile' => true, 'isTablet' => false),
		'nokian73-1/UC Browser7.8.0.95/69/400 UNTRUSTED/1.0'                                                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Nokia2760/2.0 (06.82) Profile/MIDP-2.1 Configuration/CLDC-1.1'                                                                                                                                     => array('isMobile' => true, 'isTablet' => false),
		'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0'                                                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'NokiaN70-1/5.0737.3.0.1 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1/UC Browser7.8.0.95/27/352'                                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (S60V3; U; ru; NokiaN73) AppleWebKit/530.13 (KHTML, like Gecko) UCBrowser/8.6.0.199/28/444/UCWEB Mobile'                                                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (S60V3; U; ru; NokiaC5-00.2)/UC Browser8.5.0.183/28/444/UCWEB Mobile'                                                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (S60V3; U; ru; NokiaC5-00.2) AppleWebKit/530.13 (KHTML, like Gecko) UCBrowser/8.7.0.218/28/352/UCWEB Mobile'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Series40; NokiaC3-00/08.63; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/2.2.0.0.33'                                                                         => array('isMobile' => true, 'isTablet' => false),
		'Opera/9.80 (Series 60; Opera Mini/7.0.31380/28.2725; U; es) Presto/2.8.119 Version/11.10'                                                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaC7-00/025.007; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.37 Mobile Safari/533.4 3gpp-gba'       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaX7-00/022.014; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.37 Mobile Safari/533.4 3gpp-gba'       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 NokiaE6-00/111.140.0058; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/535.1 (KHTML, like Gecko) NokiaBrowser/8.3.1.4 Mobile Safari/535.1 3gpp-gba'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 NokiaC6-01/111.040.1511; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/535.1 (KHTML, like Gecko) NokiaBrowser/8.3.1.4 Mobile Safari/535.1'            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 NokiaC6-01; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.4.2.6 Mobile Safari/533.4 3gpp-gba'                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 Nokia700/111.030.0609; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.4.2.6 Mobile Safari/533.4 3gpp-gba'     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 Nokia700/111.020.0308; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.4.1.14 Mobile Safari/533.4 3gpp-gba'    => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 NokiaN8-00/111.040.1511; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/535.1 (KHTML, like Gecko) NokiaBrowser/8.3.1.4 Mobile Safari/535.1 3gpp-gba'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Symbian/3; Series60/5.3 Nokia701/111.030.0609; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.4.2.6 Mobile Safari/533.4 3gpp-gba'     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 Nokia6120c/3.83; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 Nokia6120ci/7.02; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 Nokia6120c/7.10; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE66-1/510.21.009; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE71-1/110.07.127; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaN95-3/20.2.011 Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE51-1/200.34.36; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE63-1/500.21.009; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaN82/10.0.046; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaE52-1/052.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.6.2'                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaE52-1/@version@; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.26 Mobile Safari/533.4 3gpp-gba' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaC5-00/031.022; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.3.1'						=> array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaE52-1/@version@; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.26 Mobile Safari/533.4 3gpp-gba'	=> array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaC5-00.2/081.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.32 Mobile Safari/533.4 3gpp-gba' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; U; Series60/3.2 NokiaN79-1/32.001; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; U; Series60/3.2 Nokia6220c-1/06.101; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413'                                         => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaC5-00.2/071.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.26 Mobile Safari/533.4 3gpp-gba' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaE72-1/081.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.32 Mobile Safari/533.4 3gpp-gba'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.3; Series60/3.2 NokiaC5-00/061.005; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.6.2 3gpp-gba'                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaX6-00/40.0.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.33 Mobile Safari/533.4 3gpp-gb'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 Nokia5800d-1/60.0.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.33 Mobile Safari/533.4 3gpp-gba'  => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaC5-03/12.0.023; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.6.9 3gpp-gba'                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 Nokia5228/40.1.003; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.7.4 3gpp-gba'                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 Nokia5230/51.0.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.33 Mobile Safari/533.4 3gpp-gba'   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 Nokia5530c-2/32.0.007; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 BrowserNG/7.2.6.9 3gpp-gba'              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaN97-1/21.0.045; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) BrowserNG/7.1.4'                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaN97-4/30.0.004; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.1.28 3gpp-gba'                       => array('isMobile' => true, 'isTablet' => false, 'version' => array('Symbian' => '9.4', 'Webkit' => '533.4', 'NokiaBrowser' => '7.3.1.28'), 'model' => 'NokiaN97-4' ),

		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; 7 Mozart T8698)'                                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; 710)'                                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; 800)'                                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; 800C)'                                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; 800C; Orange)'                                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; 900)'                                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; HD7 T9292)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; LG E-900)'                                                                                              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 610)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 710)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 710; Orange)'                                                                                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 710; T-Mobile)'                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 710; Vodafone)'                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800) UP.Link/5.1.2.6'                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800; Orange)'                                                                                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800; SFR)'                                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800; T-Mobile)'                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800; vodafone)'                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; Lumia 800c)'                                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 900)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; Lumia 920)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 920)'                                                                                  => array('isMobile' => true, 'isTablet' => false, 'version' => array('IE' => '10.0', 'Windows Phone OS' => '8.0', 'Trident' => '6.0'), 'model' => 'Lumia 920' ),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; lumia800)'                                                                                              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Nokia 610)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Nokia 710)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Nokia 800)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Nokia 800C)'                                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Nokia 900)'                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; Nokia)'                                                                                                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; SGH-i917)'                                                                                              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Nokia; TITAN X310e)'                                                                                           => array('isMobile' => true, 'isTablet' => false, 'version' => array('Windows Phone OS' => '7.5', 'Trident' => '5.0'), 'model' => 'TITAN X310e' ),
		),


	// @todo: Research http://www.pantech.com/
	'Pantech' => array(
		'PANTECH-C790/JAUS08312009 Browser/Obigo/Q05A Profile/MIDP-2.0 Configuration/CLDC-1.1'                                                         => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.2.1; ko-kr; SKY IM-A600S Build/FRG83) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; ADR8995 4G Build/GRI40) AppleWebKit/533.1 (KHTML like Gecko) Version/4.0 Mobile Safari/533.1'    => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 3.2.1; en-us; PantechP4100 Build/HTK75) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'		=> array('isMobile' => true, 'isTablet' => true),
		),

	'Philips' => array(
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; W732 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30' => array('isMobile' => true, 'isTablet' => false),

		),

	'Prestigio' => array(
		'Mozilla/5.0 (Linux; U; Android 4.0.4; sk-sk; PMP7100D3G Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.4', 'Build' => 'IMM76D', 'Webkit' => '534.30', 'Safari' => '4.0'), 'model' => 'PMP7100D3G' ),
		),

	'RockChip' => array(
		'Mozilla/5.0 (Linux; U; Android 2.2.1; hu-hu; RK2818, Build/MASTER) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android Android 2.1-RK2818-1.0.0; zh-cn; MD701 Build/ECLAIR) AppleWebKit/530.17 (KHTML like Gecko) Version/4.0 Mobile Safari/530.17' => array('isMobile' => true, 'isTablet' => true),
		),

	// @ref: http://www.qmobile.com.pk/complete_range.php#
	'QMobile' => array(
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; A2 Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
		),

	'Samsung' => array(
		'SAMSUNG-SGH-D900i/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Browser/6.2.3.3.c.1.101 (GUI) MMP/2.0'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'SAMSUNG-GT-S5233T/S5233TXEJE3 SHP/VPP/R5 Jasmine/0.8 Qtv5.3 SMM-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1'                                                                                                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5380D/S5380FXXKL3; U; Bada/2.0; ru-ru) AppleWebKit/534.20 (KHTML, like Gecko) Dolfin/3.0 Mobile HVGA SMM-MMS/1.2.0 OPN-B'                                                            => array('isMobile' => true, 'isTablet' => false),
		'SAMSUNG-GT-C3312/1.0 NetFront/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1'                                                                                                                                             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 1.5; de-de; Galaxy Build/CUPCAKE) AppleWebKit/528.5 (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'SAMSUNG-GT-S3650/S3650XEII3 SHP/VPP/R5 Jasmine/1.0 Nextreaming SMM-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1'                                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'JUC (Linux; U; 2.3.6; zh-cn; GT-S5360; 240*320) UCWEB7.9.0.94/140/352'                                                                                                                                                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5250/S5250XEKJ3; U; Bada/1.0; ru-ru) AppleWebKit/533.1 (KHTML, like Gecko) Dolfin/2.0 Mobile WQVGA SMM-MMS/1.2.0 NexPlayer/3.0 profile/MIDP-2.1 configuration/CLDC-1.1 OPN-B'        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0; SAMSUNG; SGH-i917)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S8530/S8530XXJKA; U; Bada/1.2; cs-cz) AppleWebKit/533.1 (KHTML, like Gecko) Dolfin/2.2 Mobile WVGA SMM-MMS/1.2.0 OPN-B'                                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 1.6; ru-ru; Galaxy Build/Donut) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1'                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I5500 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'                                                                      => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.2; en-us; GALAXY_Tab Build/MASTER) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                             => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 2.2; ja-jp; SC-01C Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		// @about FROYO: http://gizmodo.com/5543853/what-is-froyo
		'Mozilla/5.0 (Linux; U; Android 2.2; fr-fr; GT-I9000 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.2.1; zh-cn; SCH-i909 Build/FROYO) UC AppleWebKit/534.31 (KHTML, like Gecko) Mobile Safari/534.31'                                                                                     => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; ja-jp; SC-01C Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                          => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; en-gb; GT-P1000 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; el-gr; GT-I9001 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; en-ca; SGH-I896 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; GT-S5660 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; GT-S6102 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; GT-S6102 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; pt-br; GT-S5367 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; fr-fr; GT-S5839i Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-S7500 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-S5830 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; es-us; GT-B5510L Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; pl-pl; GT-I9001-ORANGE/I9001BVKPC Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                      => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; GT-I8150 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; nl-nl; GT-I9070 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-S5360 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; es-us; GT-S6102B Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; GT-S5830i Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; GT-I8160 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.7; ru-ru; GT-S5830 Build/GRWK74; LeWa_ROM_Cooper_12.09.21) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.6; ru-ru; GT-N7000 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 3.0.1; en-us; GT-P7100 Build/HRI83) AppleWebkit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                                                                   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 3.2; he-il; GT-P7300 Build/HTJ85B) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                                                                    => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 3.2; en-gb; GT-P6200 Build/HTJ85B) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13'                                                                                    => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; GT-I9100 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; GT-I9100G Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; GT-P5100 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android-4.0.3; en-us; Galaxy Nexus Build/IML74K) AppleWebKit/535.7 (KHTML, like Gecko) CrMo/16.0.912.75 Mobile Safari/535.7'                                                                    => array( 'isMobile' => true, 'isTablet' => false, 'version' => array('Chrome' => '16.0.912.75') ),
		'Mozilla/5.0 (Linux; Android 4.0.3; SGH-T989 Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                            => array('isMobile' => true, 'isTablet' => false, 'version' => array('Chrome' => '18.0.1025.166') ),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; GT-P5100 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.0.4; GT-I9300 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.0.4; SPH-D710 Build/IMM76I) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; zh-cn; GT-I9300 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; GT-I9300-ORANGE/I9300BVBLG2 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; th-th; GT-I9300T Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; GT-I9100 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us ; GT-I9100 Build/IMM76D) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1/UCBrowser/8.4.1.204/145/355'                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; GT-N7000 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; th-th; GT-P6800 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.0.4; SAMSUNG-SGH-I747 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                    => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; es-es; GT-P5110 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.0.4; GT-P5110 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19'                                                                                   => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; zh-cn; SAMSUNG-GT-S7568_TD/1.0 Android/4.0.4 Release/07.15.2012 Browser/AppleWebKit534.30 Build/IMM76D) ApplelWebkit/534.30 (KHTML,like Gecko) Version/4.0 Mobile Safari/534.30' => array( 'isMobile' => true, 'isTablet' => false, 'version' => array('Android' => '4.0.4') ),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; GT-P3100 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; tr-tr; GT-P3105 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-ca; GT-N8010 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; GT-S7562 Build/IMM76I) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.1.1; en-us; GT-N7100 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.1.2; GT-N7100 Build/JZO54K) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.123 Mobile Safari/537.22 OPR/14.0.1025.52315'                                                        => array( 'isMobile' => true, 'isTablet' => false, 'version' => array( 'Build' => 'JZO54K', 'Webkit' => '537.22', 'Opera' => '14.0.1025.52315' ) ),
		'Mozilla/5.0 (Linux; U; Android 4.1.1; zh-hk; GT-N7105 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.1.1; ru-ru; GT-N8000 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                  => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; Android 4.1.1; SGH-i747M Build/JRO03L) AppleWebKit/535.19(KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; it-it; Galaxy Nexus Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; SGH-I777 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                           => array('isMobile' => true, 'isTablet' => false),



		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; CETUS)'                                                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; Focus I917 By TC)'                                                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; Focus i917)'                                                                                                              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; FOCUS S)'                                                                                                                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; GT-I8350)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; GT-i8700)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; GT-S7530)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; Hljchm\'s Wp)'                                                                                                            => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; I917)'                                                                                                                    => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; OMNIA 7)'                                                                                                                 => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; OMNIA7 By MWP_HS)'                                                                                                        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; OMNIA7)'                                                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; OMNIA7; Orange)'                                                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SGH-i677)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SGH-i917)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SGH-i917.)'                                                                                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SGH-i917R)'                                                                                                               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SGH-i937)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG; SMG-917R)'                                                                                                                => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG_blocked_blocked_blocked; OMNIA7; Orange)'                                                                                  => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SAMSUNG_blocked_blocked_blocked_blocked; OMNIA7; Orange)'                                                                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; SUMSUNG; OMNIA 7)'                                                                                                                 => array('isMobile' => true, 'isTablet' => false),

		),

	'simvalley' => array(

		'Mozilla/5.0 (Linux; U; Android 2.3.4; de-de; SP-80 Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),

		),

	'Sony' => array(
		'SonyEricssonK800i/R1AA Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1'                                                                                   => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.1-update1; es-ar; SonyEricssonE15a Build/2.0.1.A.0.47) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'       => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.1-update1; pt-br; SonyEricssonU20a Build/2.1.1.A.0.6) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'        => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.3; en-au; SonyEricssonX10i Build/3.0.1.G.0.75) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.4; ru-ru; SonyEricssonST18i Build/4.0.2.A.0.62) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.4; hr-hr; SonyEricssonST15i Build/4.0.2.A.0.62) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.4; sk-sk; SonyEricssonLT15i Build/4.0.2.A.0.62) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.7; th-th; SonyEricssonST27i Build/6.0.B.3.184) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 2.3.7; de-de; SonyEricssonST25i Build/6.0.B.3.184) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'               => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; pt-br; Xperia Tablet S Build/TID0092) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                          => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.0.3', 'Build' => 'TID0092', 'Webkit' => '534.30', 'Safari' => '4.0') ),
		'Mozilla/5.0 (Linux; Android 4.0.3; LT18i Build/4.1.A.0.562) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.0.3; Sony Tablet S Build/TISU0R0110) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19'                         => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; es-es; Sony Tablet S Build/TISU0143) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                           => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; SonyEricssonLT18i Build/4.1.B.0.587) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; fr-ch; SonyEricssonSK17i Build/4.1.B.0.587) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; SonyEricssonLT26i Build/6.1.A.2.45) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'              => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.0.4; LT22i Build/6.1.B.0.544) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; vi-vn; SonyEricssonLT22i Build/6.1.B.0.544) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'             => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.0.4; ST23i Build/11.0.A.5.5) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                           => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; Android 4.0.4; ST23i Build/11.0.A.2.10) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                          => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/5.0 (Linux; U; Android 4.1.2; ja-jp; SonySO-03E Build/10.1.E.0.265) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                          => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.1.2', 'Build' => '10.1.E.0.265', 'Webkit' => '534.30', 'Safari' => '4.0') ),
		'Mozilla/5.0 (Linux; Android 4.2.2; SGP321 Build/10.3.1.A.0.33) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.58 Safari/537.31'								=> array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '4.2.2', 'Build' => '10.3.1.A.0.33', 'Webkit' => '537.31', 'Chrome' => '26.0.1410.58') ),
		'SonyEricssonU5i/R2CA; Mozilla/5.0 (SymbianOS/9.4; U; Series60/5.0 Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 Safari/525' => array('isMobile' => true, 'isTablet' => false),
		'SonyEricssonU5i/R2AA; Mozilla/5.0 (SymbianOS/9.4; U; Series60/5.0 Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) Version/3.0 Safari/525' => array('isMobile' => true, 'isTablet' => false),
		'Mozilla/4.0 (PDA; PalmOS/sony/model prmr/Revision:1.1.54 (en)) NetFront/3.0'                                                                                           => array('isMobile' => true, 'isTablet' => false),
		),

	'Telstra' => array(
		'Mozilla/5.0 (Linux; U; Android 2.3.7; en-au; T-Hub2 Build/TVA301TELBG3) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => true),
		),

	// @info: http://www.texet.ru/tablet/
	'texet' => array(

		'Mozilla/5.0 (Linux; U; Android 2.3.4; ru-ru; TM-7021 Build/GB.m1ref.20120116) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '2.3.4', 'Webkit' => '533.1', 'Safari' => '4.0'), 'model' => 'TM-7021' ),

		),

	'Toshiba' => array(
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; TOSHIBA; TSUNAGI)' => array('isMobile' => true, 'isTablet' => false),
		// @ref: http://www.toshiba.co.uk/discontinued-products/folio-100/
		'Mozilla/5.0 (Linux; U; Android 2.2; it-it; TOSHIBA_FOLIO_AND_A Build/TOSHIBA_FOLIO_AND_A) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => true, 'version' => array('Android' => '2.2', 'Webkit' => '533.1', 'Safari' => '4.0') ),
		),

	'Versus' => array(
		'Mozilla/5.0 (Linux; Android 4.0.4; VS-TOUCHPAD 9 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19'                                                                                                                 => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; Versus Touchpad 9.7 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'                                                                                                                 => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; CnM-TOUCHPAD7 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30 BMID/E67A45B1AB'                                                                                                       => array('isMobile' => true, 'isTablet' => true),
		'Mozilla/5.0 (Linux; U; Android 4.1.1; en-gb; CnM TouchPad 7DC Build/JRO03H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30 TwonkyBeamBrowser/3.3.5-95 (Android 4.1.1; rockchip CnM TouchPad 7DC Build/meizhi_V2.80.wifi8723.20121225.b11c800)' => array('isMobile' => true, 'isTablet' => true),
		'OneBrowser/3.5/Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; TOUCHPAD 7 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'                                                                                                    => array('isMobile' => true, 'isTablet' => true),

		),

	'ZTE' => array(
			'Mozilla/5.0 (Linux; U; Android 2.3.5; pt-pt; Blade Build/tejosunhsine) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1' => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; ZTE; N880e_Dawoer_Fulllock; China Telecom)'               => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; ZTE; V965W)'                                              => array('isMobile' => true, 'isTablet' => false),
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; ZTE; Windows Phone - Internet 7; SFR)'                    => array('isMobile' => true, 'isTablet' => false),
		),

	'Zync' => array(
			'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us ; Z909 Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1/UCBrowser/8.4.1.204/145/444' => array('isMobile' => true, 'isTablet' => true),
		),

	'Other' => array(
		'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.20 Safari/537.36  OPR/15.0.1147.18 (Edition Next)'                                             => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36'                                                                                     => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Windows NT 5.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36'                                                                              => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Windows NT 5.2; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0'                                                                                                                  => array('isMobile' => false, 'isTablet' => false),
		'Opera/9.80 (Windows NT 5.2; WOW64) Presto/2.12.388 Version/12.14'                                                                                                                          => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0'                                                                                                                  => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (X11; FreeBSD amd64; rv:14.0) Gecko/20100101 Firefox/14.0.1'                                                                                                                   => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; .NET4.0E; .NET4.0C; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Tablet PC 2.0; MASMJS)' => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0; MANMJS)'                                                                                                           => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; MASMJS)'                                                                                                      => array('isMobile' => false, 'isTablet' => false),
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0; Touch; MASMJS)'                                                                                                    => array('isMobile' => false, 'isTablet' => false),
		'Opera/9.80 (Windows NT 6.2; WOW64; MRA 8.0 (build 5784)) Presto/2.12.388 Version/12.11'                                                                                                    => array('isMobile' => false, 'isTablet' => false),
		),


	'Generic' => array(
		'Opera/9.80 (Series 60; Opera Mini/6.5.29260/29.3417; U; ru) Presto/2.8.119 Version/11.10' => array('isMobile' => true, 'isTablet' => false),
		'Opera/9.80 (Android; Opera Mini/6.5.27452/29.3417; U; ru) Presto/2.8.119 Version/11.10'  => array('isMobile' => true, 'isTablet' => false),
		// New Opera
		'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.60 Safari/537.17 OPR/14.0.1025.52315' => array('isMobile' => false, 'isTablet' => false),
		// Unknown yet
		'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_2 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8H7 Safari/6533.18.5',
		'Mozilla/5.0 (Linux; U; Android 4.1.2; fr-fr; GT-I9070 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
		'Opera/9.80 (Android 2.3.7; Linux; Opera Mobi/46154) Presto/2.11.355 Version/12.10',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; it-it; DATAM819HD_C Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; SGPT12 Build/TID0142) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; cm_tenderloin Build/IMM76L; CyanogenMod-9) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',

		'Mozilla/5.0 (Linux; U; Android 4.1.1; fr-fr; A210 Build/JRO03H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30', // Acer Iconia Tab
		'Mozilla/5.0 (iPad; CPU OS 6_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B141 Safari/8536.25',
		'Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-I8150 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
		'Mozilla/5.0 (iPad; CPU OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Mercury/7.2 Mobile/10A523 Safari/8536.25', // Mercurio Browser
		'Opera/9.80 (Android 2.3.7; Linux; Opera Tablet/46154) Presto/2.11.355 Version/12.10',
		'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; sdk Build/MASTER) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30', // sdk
		'Mozilla/5.0 (Linux; U; Android 4.2; en-us; sdk Build/JB_MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', // sdk
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; GT-P7510 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Opera/9.80 (X11; Linux zbov) Presto/2.11.355 Version/12.10',
		'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; TOUCHPAD 7 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', // 7" Verso Android tablet
		'Mozilla/5.0 (iPhone; U; CPU OS 4_2_1 like Mac OS X) AppleWebKit/532.9 (KHTML, like Gecko) Version/5.0.3 Mobile/8B5097d Safari/6531.22.7',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; SGPT12 Build/TID0142) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30', // sony xperia tablet s unforts
		'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7498.US',
		'Mozilla/5.0 (Linux; U; Android 2.0.6_b1; ru-ru Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17', // PocketBook IQ701 (tablet)
		'Mozilla/5.0 (Linux; Android 4.0.4; z1000 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19', // It is a tablet with calling
		'Mozilla/5.0 (Linux; Android 4.0.3; cm_tenderloin Build/GWK74) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19', // HP touch pad running android cyanogenmod
		'Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; Android for Techvision TV1T808 Board Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1', // My device is tablet but its detected as phone
		'BlackBerry8520/5.0.0.592 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/136',
		'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17', // its a lenovo tablet 2 with windows 8 pro
		'Mozilla/5.0 (Linux; U; Android 4.0.4; es-es; IdeaTab_A1107 Build/MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Mozilla/5.0 (Linux; U; Android 3.1; ru-ru; LG-V900 Build/HMJ37) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13',
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; HTC; Windows Phone 8S by HTC)',
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)', // MS Surface RT tablet actually!
		'Mozilla/5.0 (PLAYSTATION 3 4.11) AppleWebKit/531.22.8 (KHTML, like Gecko)',
		'Mozilla/5.0 (Linux; U; Android 3.2; ru-ru; V9S_V1.4) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13', // Wrong detection - 7-inch tablet was detected as a phone. Android 3.2.1, native browser
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)', // Nope, its a Microsoft Surface tablet	 running Windows RT (8) with MSIE 10
		'Mozilla/5.0 (Linux; U; Android 2.2; es-es; Broncho N701 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1', // Tablet!
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)', // its a Microsoft surface rt (tablet)
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch; WebView/1.0)',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; Next7P12 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', // Nextbook 7SE Tablet
		'Opera/9.80 (X11; Linux zbov) Presto/2.11.355 Version/12.10', // allview alldro speed tablet, android ics, opera mobile
		'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0; Touch)', // Its a surface in portrait
		'Mozilla/5.0 (Linux; U; Android 2.3.6; es-es; SAMSUNG GT-S5830/S5830BUKT2 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
		'Mozilla/5.0 (Linux; U; Android 3.2.1; en-gb;HTC_Flyer_P512 Build/HTK75C) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13',
		// Am ramas la pozitia: 207


		// Android on Windows :) www.socketeq.com
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; full Android on Microsoft Windows, pad, pc, n*books Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',


		// TV
		'Opera/9.80 (Linux mips; U; InettvBrowser/2.2 (00014A;SonyDTV115;0002;0100) KDL40EX720; CC/BEL; en) Presto/2.7.61 Version/11.00',



		'Mozilla/5.0 (Android; Mobile; rv:18.0) Gecko/18.0 Firefox/18.0',
		// Maxthon
		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.12 (KHTML, like Gecko) Maxthon/3.0 Chrome/18.0.966.0 Safari/535.12',
		'Opera/9.80 (Windows NT 5.1; U; Edition Yx; ru) Presto/2.10.289 Version/12.02',
		'Mozilla/5.0 (Linux; U; Android 4.2; en-us; sdk Build/JB_MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
		'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; Windows Phone 6.5.3.5)',
		'PalmCentro/v0001 Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D061; Blazer/4.5) 16;320x320',
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)',
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Microsoft; XDeviceEmulator)',
		// @todo: research N880E
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; MAL; N880E; China Telecom)',
		'Opera/9.80 (Series 60; Opera Mini/7.0.29482/28.2859; U; ru) Presto/2.8.119 Version/11.10',
		'Opera/9.80 (S60; SymbOS; Opera Mobi/SYB-1202242143; U; en-GB) Presto/2.10.254 Version/12.00',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-au; 97D Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Opera/9.80 (Android; Opera Mini/7.0.29952/28.2647; U; ru) Presto/2.8.119 Version/11.10',
		'Opera/9.80 (Android; Opera Mini/6.1.25375/28.2555; U; en) Presto/2.8.119 Version/11.10',
		'Opera/9.80 (Mac OS X; Opera Tablet/35779; U; en) Presto/2.10.254 Version/12.00',
		'Mozilla/5.0 (Android; Tablet; rv:10.0.4) Gecko/10.0.4 Firefox/10.0.4 Fennec/10.0.4',
		'Mozilla/5.0 (Android; Tablet; rv:18.0) Gecko/18.0 Firefox/18.0',
		'Opera/9.80 (Linux armv7l; Maemo; Opera Mobi/14; U; en) Presto/2.9.201 Version/11.50',
		'Opera/9.80 (Android 2.2.1; Linux; Opera Mobi/ADR-1207201819; U; en) Presto/2.10.254 Version/12.00',
		'Mozilla/5.0 (Linux; U; Android 4.1.1; en-us; sdk Build/JRO03E) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
		),

	'Bot' => array(
		'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
		'grub-client-1.5.3; (grub-client-1.5.3; Crawl your own stuff with http://grub.org)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
		'Googlebot-Image/1.0' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
		'Python-urllib/2.5' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/),
		'facebookexternalhit/1.0 (+http://www.facebook.com/externalhit_uatext.php)' => array('isMobile' => false, 'isTablet' => false, /*'isBot' => true*/)
		),

);
