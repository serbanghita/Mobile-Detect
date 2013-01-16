<?php
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