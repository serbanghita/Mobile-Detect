<?php

namespace MobileDetectTest;

use MobileDetect\MobileDetect;

class UserAgentTest extends \PHPUnit_Framework_TestCase
{
    public function userAgentData()
    {
        // Setup.
        $includeBasePath = TEST_ROOT_PATH . getenv('fixture_path_perVendor');
        if (!is_dir($includeBasePath)) {
            throw new \RuntimeException('Missing the fixture path definitions from phpunit.xml');
        }
        $list = array();

        // Scan.
        $dir = new \DirectoryIterator($includeBasePath);
        foreach ($dir as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            $listNew = include $includeBasePath . '/' . $fileInfo->getFilename();
            if (is_array($listNew)) {
                $list = array_merge($list, $listNew);
            }
        }

        return $list;
    }

    /**
     * @dataProvider userAgentData
     *
     * @param $ua
     * @param $isMobile
     * @param $isTablet
     * @param $browser
     * @param $browserVersion
     * @param $operatingSystem
     * @param $operatingSystemVersion
     * @param $model
     * @param $modelVersion
     */
    public function testAgents($ua, $isMobile, $isTablet, $browser, $browserVersion, $operatingSystem, $operatingSystemVersion, $model, $modelVersion)
    {
        $detector = new MobileDetect($ua);
        $device = $detector->detect();


        if (is_bool($isMobile)) {
            $this->assertSame($isMobile, $device->isMobile(), 'The isMobile() assertion is not correct.');
        }

        if (is_bool($isTablet)) {
            $this->assertSame($isTablet, $device->isTablet(), 'The isTablet() assertion is not correct.');
        }

        if (isset($browser)) {
            $this->assertSame($browser, $device->getBrowser(), 'The getBrowser() assertion is not correct.');
        }

        if (isset($browserVersion)) {
            $this->assertSame($browserVersion, $device->getBrowserVersion(), 'The getBrowserVersion() assertion is not correct.');
        }

        if (isset($operatingSystem)) {
            $this->assertSame($operatingSystem, $device->getOperatingSystem(), 'The getOperatingSystem() assertion is not correct.');
        }

        if (isset($operatingSystemVersion)) {
            $this->assertSame($operatingSystemVersion, $device->getOperatingSystemVersion(), 'The getOperatingSystemVersion() assertion is not correct.');
        }

        if (isset($model)) {
            $this->assertSame($model, $device->getModel(), 'The getModel() assertion is not correct.');
        }

        if (isset($modelVersion)) {
            $this->assertSame($modelVersion, $device->getModelVersion(), 'The getModelVersion() assertion is not correct.');
        }

        $this->assertSame($ua, $detector->getUserAgent());
    }

}
