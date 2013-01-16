<?php
class BasicTest extends PHPUnit_Framework_TestCase {

	public function testClassExists(){

		$detect = new Mobile_Detect;
		$this->assertTrue(class_exists('Mobile_Detect'));

	}

}