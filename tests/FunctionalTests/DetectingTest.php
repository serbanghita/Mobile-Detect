<?php
namespace MobileDetectTests\FunctionalTests;

use MobileDetect\MobileDetect;

class DetectingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * An User-agent of a phone that contains browser and operating system model and version information are returned in the props array
     * @group functional
     */
    public function testAnUserAgentOfAPhoneThatContainsBrowserAndOperatingSystemModelAndVersionInformationAreReturnedInThePropsArray()
    {
        $inputUserAgent = 'Mozilla/5.0 (Linux; Android 4.2.2; en-gb; SAMSUNG GT-I9205 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19';
        $md = new MobileDetect($inputUserAgent);
        $props = $md->detect();

        $this->assertArrayHasKey('type', $props);
        $this->assertArrayHasKey('model', $props);
        $this->assertArrayHasKey('modelVersion', $props);
        $this->assertArrayHasKey('browser', $props);
        $this->assertArrayHasKey('browserVersion', $props);
        $this->assertArrayHasKey('os', $props);
        $this->assertArrayHasKey('osVersion', $props);

        $this->assertEquals('Chrome Mobile', $props['browser']);
        $this->assertEquals('18.0.1025.308', $props['browserVersion']);
        $this->assertEquals('Android', $props['os']);
        $this->assertEquals('4.2.2', $props['osVersion']);
    }

}