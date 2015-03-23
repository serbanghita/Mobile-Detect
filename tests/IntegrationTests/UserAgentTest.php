<?php

namespace MobileDetectTest;

use MobileDetect\MobileDetect;

class UserAgentTest extends \PHPUnit_Framework_TestCase
{
    protected static $ualist = array();

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        // Get all User-Agents grouped by vendor.
        if (!self::$ualist) {
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

            self::$ualist = $list;
            unset($list);
        }
    }

    public function userAgentData()
    {
        if (!self::$ualist) {
            self::setUpBeforeClass();
        }

        return self::$ualist;
    }

    /**
     * @dataProvider userAgentData
     */
    public function testAgents($ua, $isMobile, $isTablet, $version, $model, $vendor)
    {
        $detector = new MobileDetect($ua);
        $device = $detector->detect();

        if (is_bool($isMobile)) {
            $this->assertSame($isMobile, $device->isMobile(), 'The isMobile() assertion is not correct.');
        }

        if (is_bool($isTablet)) {
            $this->assertSame($isTablet, $device->isTablet(), 'The isTablet() assertion is not correct.');
        }

        // so that phpunit doesn't complain on incomplete tests
        $this->assertSame($ua, $device->getUserAgent());
    }
}
