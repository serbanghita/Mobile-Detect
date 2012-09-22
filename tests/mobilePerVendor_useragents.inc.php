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
 *              Victor Stanciu <vic.stanciu@gmail.com> (until v.1.0)
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://mobiledetect.net
 */

$mobilePerVendor_userAgents = array(

	'HTC' => array(
					'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
					'Mozilla/5.0 (Linux; U; Android 4.0.3; zh-tw; HTC Desire V Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
					'Mozilla/5.0 (Linux; U; Android 2.2.2; de-at; HTC Desire Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; HTC Desire 1.19.161.5 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
					'Mozilla/5.0 (Linux; U; Android 2.3.5; nl-nl; HTC_DesireHD_A9191 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.3.3; en-au; HTC Desire Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.3.5; de-de; HTC_DesireHD Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.2.2; en-sk; Desire_A8181 Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.1-update1; en-gb; HTC Desire Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
					'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; HTC Desire 1.19.161.5 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
					'Mozilla/5.0 (Linux; U; Android 2.2; en-dk; Desire_A8181 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 1.5; en-us; ADR6200 Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1',
					'Mozilla/5.0 (Linux; U; Android 2.3; xx-xx; HTC/DesireS/1.07.163.1 Build/GRH78C) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 2.1; xx-xx; Desire_A8181 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
					'Mozilla/5.0 (Linux; U; Android 4.0; xx-xx; HTC_GOF_U/1.05.161.1 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
					'Mozilla/5.0 (Linux; U; Android 2.2; xx-xx; 001HT Build/FRF91) AppleWebKit/525.10+ (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2',
					'Mozilla/5.0 (Linux; U; Android 2.2; xx-xx; HTCA8180/1.0 Android/2.2 release/06.23.2010 Browser/WAP 2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					'Mozilla/5.0 (Linux; U; Android 4.0.3; zh-cn; HTC_A320e Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
					'Mozilla/5.0 (Linux; Android 4.0.3; PG86100 Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
					'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; HTC Vision Build/GRI40; ILWT-CM7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
					),
					
	'LG' => array(
			'Mozilla/5.0 (Linux; U; Android 2.3.4; en-us; VS910 4G Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
			),
			
	'ACER' => array(
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A501 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; A501 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
		),
		
	'Apple' => array(
		'Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X; en-us) AppleWebKit/534.46.0 (KHTML, like Gecko) CriOS/21.0.1180.80 Mobile/9B206 Safari/7534.48.3 (6FF046A0-1BC4-4E7D-8A9D-6BF17622A123)',
		)

);