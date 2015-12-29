<?php
namespace MobileDetectTests\UnitTests;

use MobileDetect\MobileDetect;
use MobileDetect\Device\DeviceType;

class DetectingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * If the User-Agent is found in the phones DB then device type is MOBILE.
     */
    public function testIfTheUserAgentIsFoundInThePhonesDBThenDeviceTypeIsMOBILE()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
                        ->setConstructorArgs(array(
                            'An user agent string'
                        ))
                        ->setMethods(array(
                            'searchPhonesProvider',
                            'searchBrowsersProvider',
                            'searchOperatingSystemsProvider'
                        ))
                        ->getMock();

        $mobileDetect->expects($this->any())
                        ->method('searchPhonesProvider')
                        ->willReturn(array(
                            'vendor' => 'a',
                            'matchIdentity' => 'b',
                            'matchModelAndVersion' => array('c','d')
        ));
        $mobileDetect->expects($this->any())
                        ->method('searchBrowsersProvider')
                        ->willReturn(false);
        $mobileDetect->expects($this->any())
                        ->method('searchOperatingSystemsProvider')
                        ->willReturn(false);

        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertInstanceOf('\MobileDetect\Device\Device', $device);
        $this->assertTrue($device->isMobile());
        $this->assertSame($props['type'], DeviceType::MOBILE);

    }

    /**
     * If the User-Agent is found in the tablets DB then deviceType is TABLET.
     */
    public function testIfTheUserAgentIsFoundInTheTabletsDBThenDeviceTypeIsTABLET()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
            ->setConstructorArgs(array(
                'An user agent string'
            ))
            ->setMethods(array(
                'searchTabletsProvider',
                'searchBrowsersProvider',
                'searchOperatingSystemsProvider'
            ))
            ->getMock();

        $mobileDetect->expects($this->any())
            ->method('searchTabletsProvider')
            ->willReturn(array(
                'vendor' => 'a',
                'matchIdentity' => 'b',
                'matchModelAndVersion' => array('c','d')
            ));
        $mobileDetect->expects($this->any())
            ->method('searchBrowsersProvider')
            ->willReturn(false);
        $mobileDetect->expects($this->any())
            ->method('searchOperatingSystemsProvider')
            ->willReturn(false);

        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertInstanceOf('\MobileDetect\Device\Device', $device);
        $this->assertTrue($device->isTablet());
        $this->assertSame($props['type'], DeviceType::TABLET);
    }

    /**
     * If the User-Agent is not found in the phones and tablets DB but it matches only the mobile browser then device type is MOBILE.
     */
    public function testIfTheUserAgentIsNotFoundInThePhonesAndTabletsDBButItMatchesOnlyTheMobileBrowserThenDeviceTypeIsMOBILE()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
            ->setConstructorArgs(array(
                'An user agent string'
            ))
            ->setMethods(array(
                'searchPhonesProvider',
                'searchTabletsProvider',
                'searchBrowsersProvider',
                'searchOperatingSystemsProvider'
            ))
            ->getMock();

        $mobileDetect->expects($this->any())
            ->method('searchPhonesProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchTabletsProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchBrowsersProvider')
            ->willReturn(array(
                'vendor' => 'a',
                'isMobile' => true,
                'matchIdentity' => 'b',
                'versionMatches' => array('c', 'd'),
            ));

        $mobileDetect->expects($this->any())
            ->method('searchOperatingSystemsProvider')
            ->willReturn(false);

        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertInstanceOf('\MobileDetect\Device\Device', $device);
        $this->assertArrayHasKey('type', $props);
        $this->assertSame($props['type'], DeviceType::MOBILE);
        $this->assertTrue($device->isMobile());
    }

    /**
     * If the User-Agent is not found in the phones and tablets DB but it matches only the mobile operating system then device type is MOBILE.
     */
    public function testIfTheUserAgentIsNotFoundInThePhonesAndTabletsDBButItMatchesOnlyTheMobileOperatingSystemThenDeviceTypeIsMOBILE()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
            ->setConstructorArgs(array(
                'An user agent string'
            ))
            ->setMethods(array(
                'searchPhonesProvider',
                'searchTabletsProvider',
                'searchBrowsersProvider',
                'searchOperatingSystemsProvider'
            ))
            ->getMock();

        $mobileDetect->expects($this->any())
            ->method('searchPhonesProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchTabletsProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchBrowsersProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchOperatingSystemsProvider')
            ->willReturn(array(
                'vendor' => 'a',
                'isMobile' => true,
                'matchIdentity' => 'b',
                'versionMatches' => array('c', 'd'),
            ));

        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertInstanceOf('\MobileDetect\Device\Device', $device);
        $this->assertArrayHasKey('type', $props);
        $this->assertSame($props['type'], DeviceType::MOBILE);
        $this->assertTrue($device->isMobile());
    }

    /**
     * If the User-Agent is not found in the phones and tablets database or mobile browsers or mobile operating systems then device type is DESKTOP.
     */
    public function testIfTheUserAgentIsNotFoundInThePhonesAndTabletsDatabaseOrMobileBrowsersOrMobileOperatingSystemsThenDeviceTypeIsDESKTOP()
    {
        /**
         * @var $mobileDetect \MobileDetect\MobileDetect|\PHPUnit_Framework_MockObject_MockObject
         */
        $mobileDetect = $this->getMockBuilder('\MobileDetect\MobileDetect')
            ->setConstructorArgs(array(
                'An user agent string'
            ))
            ->setMethods(array(
                'searchPhonesProvider',
                'searchTabletsProvider',
                'searchBrowsersProvider',
                'searchOperatingSystemsProvider'
            ))
            ->getMock();

        $mobileDetect->expects($this->any())
            ->method('searchPhonesProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchTabletsProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchBrowsersProvider')
            ->willReturn(false);

        $mobileDetect->expects($this->any())
            ->method('searchOperatingSystemsProvider')
            ->willReturn(false);

        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertInstanceOf('\MobileDetect\Device\Device', $device);
        $this->assertArrayHasKey('type', $props);
        $this->assertSame($props['type'], DeviceType::DESKTOP);
        $this->assertFalse($device->isMobile());
        $this->assertTrue($device->isDesktop());
    }
}