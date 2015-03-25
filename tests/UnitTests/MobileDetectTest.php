<?php

namespace MobileDetectTest\UnitTests;

use MobileDetect\MobileDetect;

class MobileDetectTest extends \PHPUnit_Framework_TestCase
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

    public function testValidHeadersAssigned()
    {
        //legit headers
        $headers = array(
            'HTTP_USER_AGENT' => $ua = 'Whatever',
            'HTTP_HOST' => $host = 'whatever.com',
            'HTTP_UA_CPU' => $cpu = 'ARM blah',
        );

        $detect = new MobileDetect($headers);

        $this->assertSame($ua, $detect->getHeader('User-Agent'));
        $this->assertSame($host, $detect->getHeader('Host'));
        $this->assertSame($cpu, $detect->getHeader('UA-CPU'));
    }

    public function testInvalidHeaders()
    {
        $headers = array(
            'HTTP_GARBAGE' => true,
            'whatever' => true,
            'HTTP_USER_AGENTS' => true,
        );

        $detect = new MobileDetect($headers);

        $this->assertAttributeSame(array(), 'headers', $detect);
    }


    /**
     * constructor converts the headers from an iterator object
     */
    public function testConstructorConvertsTheHeadersFromAnIteratorObject()
    {
        $iterator = new \ArrayIterator(
            array(
                'User-Agent' => 1,
                'Content-type' => 2
            )
        );
        $detect = new MobileDetect($iterator);
        $this->assertEquals(1, $detect->getUserAgent());
        $this->assertEquals(2, $detect->getHeader('Content-type'));
    }


    /**
     * @covers \MobileDetect\MobileDetect::__construct
     * @covers \MobileDetect\MobileDetect::getUserAgent
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
            'X-UCBROWSER-Device-UA' => 8,
        );

        $detect = new MobileDetect($headers);

        $this->assertSame('1 2 3 4 5 6 7 8', $detect->getUserAgent());
    }


    /**
     * set header sets and standardizes the name of the header
     */
    public function testSetHeaderSetsAndStandardizesTheNameOfTheHeader()
    {
        $detect = new MobileDetect();
        $detect->setHeader('Authorization', 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $detect->setHeader('Content-Type', 'application/x-www-form-urlencoded  ');
        $detect->setHeader('Warning', '199 Miscellaneous warning');

        $this->assertEquals($detect->getHeader('authorization'), 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $this->assertEquals($detect->getHeader('content-type'), 'application/x-www-form-urlencoded');
        $this->assertEquals($detect->getHeader('warning'), '199 Miscellaneous warning');
    }


    /**
     * setting an unknown header returns null
     */
    public function testSettingAnUnknownHeaderReturnsNull()
    {
        $detect = new MobileDetect();
        $detect->setHeader('Warning', '199 Miscellaneous warning');
        $this->assertEquals($detect->getHeader('warning'), '199 Miscellaneous warning');
    }


    /**
     * preparing a version in semver format as an array returns an array with three elements
     */
    public function testPreparingAVersionInSemverFormatAsAnArrayReturnsAnArrayWithThreeElements()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('versionPrepare');
        $m->setAccessible(true);

        $ret = $m->invoke($detect, '2.1.10', true);

        $this->assertSame($ret, array('2','1','10'));
    }


    /**
     * @covers \MobileDetect\MobileDetect::modelMatch
     */
    public function testModelMatch()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $modelMatches = array('hello[VER]', 'whatever{[MODEL]}');
        $against = 'thisishello1.2.3.4andwhatever{Spicy}more';

        //test matches for full array
        $ret = $m->invoke($detect, $modelMatches, $against);
        $this->assertSame(
            array(
                'version' => '1.2.3.4',
                'model' => 'Spicy',
            ),
            $ret
        );

        //test invalid params
        $ret = $m->invoke($detect, 'hi', 'whatever');
        $this->assertFalse($ret);
    }

    /**
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     * @expectedExceptionMessage Unknown match type: apples
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesInvalidType()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $m->invoke($detect, 'apples', '', '');
    }


    /**
     * matching against an invalid pattern type throws an exception
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     * @expectedExceptionMessage Invalid type passed: array
     */
    public function testMatchingAgainstAnInvalidPatternTypeThrowsAnException()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $m->invoke($detect, 'regex', 'whatever', array('regex1', 'regex2'));
    }


    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesRegexActuallyMatches()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'regex', '^st[u]+ff$', 'stuuuuuff'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesRegexDoesNotMatch()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'regex', '^stuff[s]?$', 'horse stuff'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesStrposDoesMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'strpos', 'u', 'stuff'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesStrposDoesNotMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'strpos', 'F', 'stuff'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesStrposDoesMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'stripos', 'u', 'STUFF'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testMatchesStrposDoesNotMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('matches');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'stripos', 'q', 'STuff'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testPrepareRegex()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame('/^yo$/i', $m->invoke($detect, '^yo$'));
    }

    /**
     * @covers \MobileDetect\MobileDetect::matches
     */
    public function testPrepareRegexWithPatternSubstitution()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame(
            '/^yo(?<version>[0-9\._-]+)and(?<model>[a-zA-Z0-9]+)!$/i',
            $m->invoke($detect, '^yo[VER]and[MODEL]!$')
        );
    }

    public function testDetectPhoneDeviceMissing()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
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
     $r = new \ReflectionObject($detect = new MobileDetect());
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
        $r = new \ReflectionObject($detect = new MobileDetect());
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
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);

        $detect->setUserAgent("HORSE_OS");
        $detectVal = $m->invoke($detect);

        $this->assertFalse($detectVal);
    }

    public function osDataProvider()
    {
        return array(
            array(
                "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",
                '6.1.3',
                'iOS',
                'iOS',
                true,
            ),
            array(
                "Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)",
                '7.5',
                'Windows',
                'Windows Phone',
                true,
            ),
            array(
                "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)",
                '6.2',
                'Windows',
                'Windows Classic',
                false,
            ),
            array(
                "Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+",
                '10.0.0.1337',
                'BlackBerry',
                'BlackBerry',
                true,
            ),
            array(
                "Mozilla/4.0 (PDA; PalmOS/sony/model prmr/Revision:1.1.54 (en)) NetFront/3.0",
                false,
                'PalmOS',
                'PalmOS',
                true,
            ),
        );
    }

    /**
     * @dataProvider osDataProvider
     */
    public function testOperatingSystemMatches($ua, $version, $family, $os, $isMobile)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('detectOperatingSystem');
        $m->setAccessible(true);

        $detect->setUserAgent($ua);
        $detectVal = $m->invoke($detect);

        $expected = array();

        if ($version) {
            $expected['version_match'] = array(
                'version' => $version,
            );
        } else {
            $expected['version_match'] = $version;
        }

        $expected += array(
            'family' => $family,
            'is_mobile' => $isMobile,
            'os' => $os,
        );

        $this->assertSame($expected, $detectVal);
    }

    public function browserDataProvider()
    {
        return array(
            array(
                "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",
                '8536.25',
                'Safari',
                'Safari Mobile',
                true,
            ),
            array(
                "Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Acer; Allegro)",
                '9.0',
                'IE',
                'IE Mobile',
                true,
            ),
            array(
                "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0; Touch; MASMJS)",
                '10.0',
                'IE',
                'IE Desktop',
                false,
            ),
            array(
                "Mozilla/5.0 (BB10; Touch) AppleWebKit/537.1+ (KHTML, like Gecko) Version/10.0.0.1337 Mobile Safari/537.1+",
                '537.1',
                'Safari',
                'Safari Mobile',
                true,
            ),
            array(
                "Mozilla/4.0 (PDA; PalmOS/sony/model prmr/Revision:1.1.54 (en)) NetFront/3.0",
                false,
                'GenericBrowser',
                'Generic Mobile Browser',
                true,
            ),
        );
    }

    /**
     * @dataProvider browserDataProvider
     */
    public function testBrowserMatches($ua, $version, $family, $browser, $isMobile)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('detectBrowser');
        $m->setAccessible(true);

        $detect->setUserAgent($ua);
        $detectVal = $m->invoke($detect);

        $expected = array();

        if ($version) {
            $expected['version_match'] = array(
                'version' => $version,
            );
        } else {
            $expected['version_match'] = $version;
        }

        $expected += array(
            'family' => $family,
            'is_mobile' => $isMobile,
            'browser' => $browser,
        );

        $this->assertSame($expected, $detectVal);
    }

    // @todo actually use the JSON file as a data source for this; perhaps move to a new test
    public function testDetect()
    {
        $detect = new MobileDetect();
        $ua = "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25";
        $detect->setUserAgent($ua);
        $device = $detect->detect();

        $this->assertInstanceOf('\MobileDetect\DeviceInterface', $device);
        $this->assertTrue($device->isMobile());
        $this->assertFalse($device->isTablet());
        $this->assertFalse($device->isDesktop());
        $this->assertFalse($device->isBot());
        $this->assertSame($ua, $device->getUserAgent());
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
