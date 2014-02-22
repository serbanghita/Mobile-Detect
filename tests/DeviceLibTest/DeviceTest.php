<?php

namespace DeviceLibTest;

use DeviceLib\Device;

class DeviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \DeviceLib\Exception\InvalidDeviceSpecificationException
     * @expectedExceptionMessage The 'type' property is required.
     */
    public function testEmptyFactory()
    {
        Device::create();
    }

    public function testFactorySetCorrectly()
    {
        $device = Device::create(array(
            'type' => $type = Device::TYPE_DESKTOP,
            'user_agent' => $ua = 'Blah',
            'model' => $model = 'Samsung Galaxy',
            'model_version' => $modelVer = 'S4',
            'os' => $os = 'Android',
            'os_version' => $osVer = '3.5',
            'browser' => $browser = 'Chrome',
            'browser_version' => $browserVer = '31.5.1245'
        ));

        // make sure everything was set correctly
        $this->assertSame($type, $device->getType());
        $this->assertSame($ua, $device->getUserAgent());
        $this->assertSame($model, $device->getModel());
        $this->assertSame($modelVer, $device->getModelVersion());
        $this->assertSame($os, $device->getOperatingSystem());
        $this->assertSame($osVer, $device->getOperatingSystemVersion());
        $this->assertSame($browser, $device->getBrowser());
        $this->assertSame($browserVer, $device->getBrowserVersion());

        //check the bool methods
        $this->assertTrue($device->isDesktop());
        $this->assertFalse($device->isMobile());
        $this->assertFalse($device->isTablet());
        $this->assertFalse($device->isBot());

        //check the toArray method
        $expectedArr = array(
            'isMobile' => $device->isMobile(),
            'isTablet' => $device->isTablet(),
            'isDesktop' => $device->isDesktop(),
            'isBot' => $device->isBot(),
            'browser' => $device->getBrowser(),
            'browserVersion' => $device->getBrowserVersion(),
            'model' => $device->getModel(),
            'modelVersion' => $device->getModelVersion(),
            'operatingSystem' => $device->getOperatingSystem(),
            'operatingSystemVersion' => $device->getOperatingSystemVersion(),
            'userAgent' => $device->getUserAgent()
        );
        $actualArr = $device->toArray();
        $this->assertSame($expectedArr, $actualArr);
    }
}
