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

		$this->detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25');
		
		$this->assertTrue( $this->detect->isMobile() );
		$this->assertFalse( $this->detect->isTablet() );
		$this->assertTrue( $this->detect->isIphone() );
		$this->assertTrue( $this->detect->isiOS() );
		$this->assertTrue( $this->detect->is('iphone') );
		$this->assertTrue( $this->detect->is('ios') );

	}

}