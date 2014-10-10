<?php

namespace DeviceLibTest;

use DeviceLib\Detector;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
    protected static $ualist = array();

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        if (!self::$ualist) {
            $file = TEST_ROOT_PATH . getenv('fixture_path') . getenv('ua_list_fixture');
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

    public function testValidHeadersAssigned()
    {
        //legit headers
        $headers = array(
            'HTTP_USER_AGENT' => $ua = 'Whatever',
            'HTTP_HOST' => $host = 'whatever.com',
            'HTTP_UA_CPU' => $cpu = 'ARM blah'
        );

        $detect = new Detector($headers);

        $this->assertSame($ua, $detect->getHeader('User-Agent'));
        $this->assertSame($host, $detect->getHeader('Host'));
        $this->assertSame($cpu, $detect->getHeader('UA-CPU'));
    }

    public function testInvalidHeaders()
    {
        $headers = array(
            'HTTP_GARBAGE' => true,
            'whatever' => true,
            'HTTP_USER_AGENTS' => true
        );

        $detect = new Detector($headers);

        $this->assertAttributeSame(array(), 'headers', $detect);
    }

    /**
     * @covers \DeviceLib\Detector::__construct, \DeviceLib\Detector::getUserAgent
     */
    public function testMultipleUserAgentsAppended()
    {
        $headers = array(
            'User-Agent' => 1,
            'X-OperaMini-Phone-UA' => 2,
            'X-DEVICE-User-Agent' => 3,
            'X-Original-USER-Agent' => 4,
            'Host' => 'kfjshdkfshldfkjshd',
            'X-Skyfire-Phone' => 5,
            'x-bold-Phone-UA' => 6,
            'Device-Stock-UA' => 7,
            'X-UCBROWSER-Device-UA' => 8
        );

        $detect = new Detector($headers);

        $this->assertSame('1 2 3 4 5 6 7 8', $detect->getUserAgent());
    }

    /**
     * @covers \DeviceLib\Detector::modelMatch
     */
    public function testModelMatch()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $modelMatches = array('hello[VER]', 'whatever{[MODEL]}');
        $against = 'thisishello1.2.3.4andwhatever{Spicy}more';

        //test matches for full array
        $ret = $m->invoke($detect, $modelMatches, $against);
        $this->assertSame(
            array(
                'version' => '1.2.3.4',
                'model' => 'Spicy'
            ),
            $ret
        );

        //test invalid params
        $ret = $m->invoke($detect, 'hi', 'whatever');
        $this->assertFalse($ret);
    }

    /**
     * @expectedException \DeviceLib\Exception\InvalidArgumentException
     * @expectedExceptionMessage Unknown match type: apples
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesInvalidType()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $m->invoke($detect, 'apples', '', '');
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesRegexActuallyMatches()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'regex','^st[u]+ff$', 'stuuuuuff'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesRegexDoesNotMatch()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'regex', '^stuff[s]?$', 'horse stuff'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesStrposDoesMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'strpos', 'u', 'stuff'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesStrposDoesNotMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'strpos', 'F', 'stuff'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesStrposDoesMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'stripos', 'u', 'STUFF'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testMatchesStrposDoesNotMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'stripos', 'q', 'STuff'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testPrepareRegex()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame('/^yo$/i', $m->invoke($detect, '^yo$'));
    }

    /**
     * @covers \DeviceLib\Detector::matches
     */
    public function testPrepareRegexWithPatternSubstitution()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame(
            '/^yo(?<version>[0-9\._-]+)and(?<model>[a-zA-Z0-9]+)!$/i',
            $m->invoke($detect, '^yo[VER]and[MODEL]!$')
        );
    }

    public function testDetectPhoneDeviceMissing()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);

        $detect->setUserAgent('hello');

        $this->assertFalse($m->invoke($detect));
    }

    /**
     * @ dataProvider userAgentData
     *
    public function testUserAgents($userAgent, $isMobile, $isTablet, $version, $model, $vendor)
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);

        $detect->setUserAgent($userAgent);
        $detectVal = $m->invoke($detect);

        if ($isMobile === true) {
            $this->assertInternalType('array', $detectVal, 'should have been an array!');
        } else {
            $this->assertFalse($detectVal, 'should have been false since test data isMobile !== true');
        }
    }*/

    public function testUserAgentMatches()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);

        $detect->setUserAgent("Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25");
        $detectVal = $m->invoke($detect);

        $this->assertInternalType('array', $detectVal);
        $this->assertArrayHasKey('model_match', $detectVal);
        $this->assertArrayHasKey('model', $detectVal);
        $this->assertArrayHasKey('vendor', $detectVal);

        $this->assertSame($detectVal['model_match']['version'], '6.1.3');
        $this->assertSame($detectVal['vendor'], 'Apple');
        $this->assertSame($detectVal['model'], 'iPhone');
    }

    public function testUserAgentNoMatches()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);

        $detect->setUserAgent("HORSE_OS");
        $detectVal = $m->invoke($detect);

        $this->assertFalse($detectVal);
    }

    public function osDataProvider()
    {
        return [
            [
                "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",
                '6.1.3',
                'iOS',
                'iOS',
                true
            ],
            [
                "Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)",
                '7.5',
                'Windows',
                'Windows Phone',
                true
            ],
            [
                "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)",
                '6.2',
                'Windows',
                'Windows Classic',
                false
            ],
            [
                "Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+",
                '10.0.0.1337',
                'BlackBerry',
                'BlackBerry',
                true
            ],
            [
                "Mozilla/4.0 (PDA; PalmOS/sony/model prmr/Revision:1.1.54 (en)) NetFront/3.0",
                false,
                'PalmOS',
                'PalmOS',
                true
            ]
        ];
    }

    /**
     * @dataProvider osDataProvider
     */
    public function testOperatingSystemMatches($ua, $version, $family, $os, $isMobile)
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectOperatingSystem');
        $m->setAccessible(true);

        $detect->setUserAgent($ua);
        $detectVal = $m->invoke($detect);

        $expected = array();

        if ($version) {
            $expected['version_match'] = array(
                'version' => $version
            );
        } else {
            $expected['version_match'] = $version;
        }

        $expected += array(
            'family' => $family,
            'is_mobile' => $isMobile,
            'os' => $os
        );

        $this->assertSame($expected, $detectVal);
    }

    public function browserDataProvider()
    {
        return [
            [
                "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",
                '8536.25',
                'Safari',
                'Safari Mobile',
                true
            ],
            [
                "Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)",
                '9.0',
                'IE',
                'IE Mobile',
                true
            ],
            [
                "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)",
                '10.0',
                'IE',
                'IE Desktop',
                false
            ],
            [
                "Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+",
                '537.1',
                'Safari',
                'Safari Mobile',
                true
            ],
            [
                "Mozilla/4.0 (PDA; PalmOS/sony/model prmr/Revision:1.1.54 (en)) NetFront/3.0",
                false,
                'GenericBrowser',
                'Generic Mobile Browser',
                true
            ]
        ];
    }

    /**
     * @dataProvider browserDataProvider
     */
    public function testBrowserMatches($ua, $version, $family, $browser, $isMobile)
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectBrowser');
        $m->setAccessible(true);

        $detect->setUserAgent($ua);
        $detectVal = $m->invoke($detect);

        $expected = array();

        if ($version) {
            $expected['version_match'] = array(
                'version' => $version
            );
        } else {
            $expected['version_match'] = $version;
        }

        $expected += array(
            'family' => $family,
            'is_mobile' => $isMobile,
            'browser' => $browser
        );

        $this->assertSame($expected, $detectVal);
    }
}
