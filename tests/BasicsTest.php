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
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
class BasicTest extends PHPUnit_Framework_TestCase {

	protected function setUp(){

		$this->detect = new Mobile_Detect;

	}

	public function testClassExists(){

		$this->assertTrue(class_exists('Mobile_Detect'));

	}

	public function testBasicMethods(){

		$this->assertNotEmpty( $this->detect->getScriptVersion() );

		$this->detect->setHttpHeaders(array(
				'SERVER_SOFTWARE'       => 'Apache/2.2.15 (Linux) Whatever/4.0 PHP/5.2.13',
				'REQUEST_METHOD'        => 'POST',
				'HTTP_HOST'             => 'home.ghita.org',
				'HTTP_X_REAL_IP'        => '1.2.3.4',
				'HTTP_X_FORWARDED_FOR'  => '1.2.3.5',
				'HTTP_CONNECTION'       => 'close',
				'HTTP_USER_AGENT'       => 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25',
				'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
				'HTTP_ACCEPT_LANGUAGE'  => 'en-us,en;q=0.5',
				'HTTP_ACCEPT_ENCODING'  => 'gzip, deflate',
				'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
				'HTTP_REFERER'          => 'http://mobiledetect.net',
				'HTTP_PRAGMA'           => 'no-cache',
				'HTTP_CACHE_CONTROL'    => 'no-cache',
				'REMOTE_ADDR'           => '11.22.33.44',
				'REQUEST_TIME'          => '01-10-2012 07:57'
			));
		$this->assertCount( 16, $this->detect->getHttpHeaders() );
		$this->assertTrue( $this->detect->checkHttpHeadersForMobile() );

		$this->detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25');
		$this->assertNotEmpty( $this->detect->getUserAgent() );

		$this->assertTrue( $this->detect->isMobile() );
		$this->assertFalse( $this->detect->isTablet() );

		$this->assertTrue( $this->detect->isIphone() );
		$this->assertTrue( $this->detect->isiphone() );
		$this->assertTrue( $this->detect->isiOS() );
		$this->assertTrue( $this->detect->isios() );
		$this->assertTrue( $this->detect->is('iphone') );
		$this->assertTrue( $this->detect->is('ios') );

	}

}