<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class StaticTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        MobileDetect::destroy();
    }

    /**
     * new instance is different from a static declared instance
     */
    public function testNewInstanceIsDifferentFromAStaticDeclaredInstance()
    {
        $newInstance = new MobileDetect(
            array('HTTP_USER_AGENT' => 'Mozilla/5.0 AppleWebKit/537.36')
        );
        $this->assertNotSame($newInstance, $newInstance::getInstance());
    }

    /**
     * new instance is an instance of mobile detect
     */
    public function testNewInstanceIsAnInstanceOfMobileDetect()
    {
        $newInstance = new MobileDetect(
            array('HTTP_USER_AGENT' => 'Mozilla/5.0 AppleWebKit/537.36')
        );
        $this->assertInstanceOf('MobileDetect\\MobileDetect', $newInstance);
    }

    public function testStaticMethodExistsOnDevice()
    {
        $_SERVER = array();
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25';
        $this->assertTrue(MobileDetect::isMobile());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage No such method "lollin" exists in Device class.
     */
    public function testStaticMethodNotExistsOnDevice()
    {
        $_SERVER = array();
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/1.0';
        MobileDetect::lollin();
    }
}