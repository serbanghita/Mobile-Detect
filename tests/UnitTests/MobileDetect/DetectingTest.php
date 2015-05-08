<?php
namespace MobileDetectTests\UnitTests;

use MobileDetect\Device\DeviceType;

class DetectingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * If the User-Agent is found in the phone DB deviceType is MOBILE.
     */
    public function testIfTheUserAgentIsFoundInThePhoneDBDeviceTypeIsMOBILE()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
                        ->setConstructorArgs(array(
                            'An user agent string'
                        ))
                        ->setMethods(array(
                            'searchForPhoneInDb',
                            'searchForBrowserInDb',
                            'searchForOperatingSystemInDb'
                        ))
                        ->getMock();

        $mobileDetect->expects($this->any())
                        ->method('searchForPhoneInDb')
                        ->willReturn(array(
                            'vendor' => 'a',
                            'identityMatches' => 'b',
                            'modelMatches' => array('c','d')
        ));
        $mobileDetect->expects($this->any())
                        ->method('searchForBrowserInDb')
                        ->willReturn(false);
        $mobileDetect->expects($this->any())
                        ->method('searchForOperatingSystemInDb')
                        ->willReturn(false);

        $props = $mobileDetect->detect();

        $this->assertArrayHasKey('type', $props);
        $this->assertSame($props['type'], DeviceType::MOBILE);
    }

}