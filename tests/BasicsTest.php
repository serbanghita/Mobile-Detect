<?php
class BasicTest extends PHPUnit_Framework_TestCase {

	public function testClassExists(){

		$this->assertTrue(class_exists('Mobile_Detect'));

	}

}