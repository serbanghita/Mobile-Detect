<?php
namespace MobileDetectTests\FunctionalTests;

use MobileDetect\Device\DeviceType;
use MobileDetect\MobileDetect;

class DetectingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * An User-agent of a phone that contains browser and operating system model and version information are returned in the props array.
     */
    public function testAnUserAgentOfAPhoneThatContainsBrowserAndOperatingSystemModelAndVersionInformationAreReturnedInThePropsArray()
    {
        $inputUserAgent = 'Mozilla/5.0 (Linux; Android 4.2.2; en-gb; SAMSUNG GT-I9205 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19';
        $mobileDetect = new MobileDetect($inputUserAgent);
        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertArrayHasKey('type', $props);
        $this->assertArrayHasKey('model', $props);
        $this->assertArrayHasKey('modelVersion', $props);
        $this->assertArrayHasKey('browser', $props);
        $this->assertArrayHasKey('browserVersion', $props);
        $this->assertArrayHasKey('operatingSystem', $props);
        $this->assertArrayHasKey('operatingSystemVersion', $props);

        $this->assertSame(DeviceType::MOBILE, $props['type']);
        $this->assertSame('Chrome Mobile', $props['browser']);
        $this->assertSame('18.0.1025.308', $props['browserVersion']);
        $this->assertSame('Android', $props['operatingSystem']);
        $this->assertSame('4.2.2', $props['operatingSystemVersion']);

        $this->assertTrue($device->isMobile());
    }

    /**
     * An User-agent of a phone that contains model and browser and operating system model and version information are returned in the props array.
     */
    public function testAnUserAgentOfAPhoneThatContainsModelAndBrowserAndOperatingSystemModelAndVersionInformationAreReturnedInThePropsArray()
    {
        $inputUserAgent = 'Mozilla/5.0 (iPad; CPU OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) CriOS/42.0.2311.47 Mobile/12F69 Safari/600.1.4';
        $mobileDetect = new MobileDetect($inputUserAgent);
        $device = $mobileDetect->detect();
        $props = $device->toArray();

        $this->assertArrayHasKey('type', $props);
        $this->assertArrayHasKey('model', $props);
        $this->assertArrayHasKey('modelVersion', $props);
        $this->assertArrayHasKey('browser', $props);
        $this->assertArrayHasKey('browserVersion', $props);
        $this->assertArrayHasKey('operatingSystem', $props);
        $this->assertArrayHasKey('operatingSystemVersion', $props);

        $this->assertSame(DeviceType::TABLET, $props['type']);
        $this->assertSame('iPad', $props['model']);
        $this->assertSame('Chrome Mobile', $props['browser']);
        $this->assertSame('42.0.2311.47', $props['browserVersion']);
        $this->assertSame('iOS', $props['operatingSystem']);
        $this->assertSame('8.3', $props['operatingSystemVersion']);

        $this->assertTrue($device->isMobile());
        $this->assertTrue($device->isTablet());
    }
}