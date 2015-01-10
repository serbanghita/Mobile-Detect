<?php

namespace DeviceLibTest;

use DeviceLib\Detector;

class UserAgentTest extends \PHPUnit_Framework_TestCase
{
    protected static $ualist = array();

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        if (!self::$ualist) {
            $file = TEST_ROOT_PATH.getenv('fixture_path').getenv('ua_list_fixture');
            if (!is_readable($file)) {
                throw new \RuntimeException('Missing the fixture path definitions from phpunit.xml');
            }
            $json = json_decode(file_get_contents($file), JSON_OBJECT_AS_ARRAY);
            $json = $json['user_agents'];

            //make a list that is usable by functions (THE ORDER OF THE KEYS MATTERS!)
            foreach ($json as $userAgent) {
                $tmp = array();
                $tmp[] = isset($userAgent['user_agent']) ? $userAgent['user_agent'] : null;
                $tmp[] = isset($userAgent['mobile']) ? $userAgent['mobile'] : null;
                $tmp[] = isset($userAgent['tablet']) ? $userAgent['tablet'] : null;
                $tmp[] = isset($userAgent['version']) ? $userAgent['version'] : null;
                $tmp[] = isset($userAgent['model']) ? $userAgent['model'] : null;
                $tmp[] = isset($userAgent['vendor']) ? $userAgent['vendor'] : null;

                self::$ualist[] = $tmp;
            }
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
        $detector = new Detector($ua);
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
