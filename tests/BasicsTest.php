<?php

namespace DetectionTests;

use Detection\MobileDetect;
use Detection\MobileDetectInterface;
use PHPUnit\Framework\TestCase;

/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
final class BasicsTest extends TestCase
{
    protected MobileDetectInterface $detect;

    public function testClassExists()
    {
        $this->assertTrue(class_exists('\Detection\MobileDetect'));
    }

    public function setUp(): void
    {
        $this->detect = new MobileDetect;
    }

    public function testBasicMethods()
    {
        $this->assertNotEmpty($this->detect->getScriptVersion());

        $this->detect->setHttpHeaders(array(
                'SERVER_SOFTWARE'       => 'Apache/2.2.15 (Linux) Whatever/4.0 PHP/5.2.13',
                'REQUEST_METHOD'        => 'POST',
                'HTTP_HOST'             => 'home.ghita.org',
                'HTTP_X_REAL_IP'        => '1.2.3.4',
                'HTTP_X_FORWARDED_FOR'  => '1.2.3.5',
                'HTTP_CONNECTION'       => 'close',
                'HTTP_USER_AGENT'       => 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25',
                'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
                'HTTP_ACCEPT_LANGUAGE'  => 'en-us,en;q=0.5',
                'HTTP_ACCEPT_ENCODING'  => 'gzip, deflate',
                'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
                'HTTP_REFERER'          => 'http://mobiledetect.net',
                'HTTP_PRAGMA'           => 'no-cache',
                'HTTP_CACHE_CONTROL'    => 'no-cache',
                'REMOTE_ADDR'           => '11.22.33.44',
                'REQUEST_TIME'          => '01-10-2012 07:57'
            ));

        //12 because only 12 start with HTTP_
        $this->assertCount(12, $this->detect->getHttpHeaders());
        $this->assertTrue($this->detect->checkHttpHeadersForMobile());

        $this->detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25');
        $this->assertNotEmpty($this->detect->getUserAgent());

        $this->assertTrue($this->detect->isMobile());
        $this->assertFalse($this->detect->isTablet());

        $this->assertTrue($this->detect->isIphone());
        $this->assertTrue($this->detect->isiphone());
        $this->assertTrue($this->detect->isiOS());
        $this->assertTrue($this->detect->isios());
        $this->assertTrue($this->detect->is('iphone'));
        $this->assertTrue($this->detect->is('ios'));
    }

    public function headersProvider(): array
    {
        return [
            [[
                'SERVER_SOFTWARE'       => 'Apache/2.2.15 (Linux) Whatever/4.0 PHP/5.2.13',
                'REQUEST_METHOD'        => 'POST',
                'HTTP_HOST'             => 'home.ghita.org',
                'HTTP_X_REAL_IP'        => '1.2.3.4',
                'HTTP_X_FORWARDED_FOR'  => '1.2.3.5',
                'HTTP_CONNECTION'       => 'close',
                'HTTP_USER_AGENT'       => 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25',
                'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
                'HTTP_ACCEPT_LANGUAGE'  => 'en-us,en;q=0.5',
                'HTTP_ACCEPT_ENCODING'  => 'gzip, deflate',
                'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
                'HTTP_REFERER'          => 'http://mobiledetect.net',
                'HTTP_PRAGMA'           => 'no-cache',
                'HTTP_CACHE_CONTROL'    => 'no-cache',
                'REMOTE_ADDR'           => '11.22.33.44',
                'REQUEST_TIME'          => '01-10-2012 07:57'
            ]],
            [[
                'SERVER_SOFTWARE'       => 'Rogue software',
                'REQUEST_METHOD'        => 'GET',
                'REMOTE_ADDR'           => '8.8.8.8',
                'REQUEST_TIME'          => '07-10-2013 23:56',
                'HTTP_USER_AGENT'       => "garbage/1.0"
            ]],
            [[
                'SERVER_SOFTWARE'       => 'Apache/1.3.17 (Linux) PHP/5.5.2',
                'REQUEST_METHOD'        => 'HEAD',
                'HTTP_USER_AGENT'       => 'Mozilla/5.0 (Linux; U; Android 1.5; en-us; ADR6200 Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1',
                'REMOTE_ADDR'           => '1.250.250.0',
                'REQUEST_TIME'          => '06-12-2006 11:06'
            ]],
        ];
    }

    /**
     * @dataProvider headersProvider
     * @param array $headers
     */
    public function testConstructorInjection(array $headers)
    {
        $md = new MobileDetect($headers);

        foreach ($headers as $header => $value) {
            if (substr($header, 0, 5) !== 'HTTP_') {
                //make sure it wasn't set
                $this->assertNull($md->getHttpHeader($value));
            } else {
                //make sure it's equal
                $this->assertEquals($value, $md->getHttpHeader($header));
            }
        }

        //verify some headers work with the translated getter
        $this->assertNull($md->getHttpHeader('Remote-Addr'));
        $this->assertNull($md->getHttpHeader('Server-Software'));
        $this->assertEquals($headers['HTTP_USER_AGENT'], $md->getHttpHeader('User-Agent'));
    }

    /**
     * @dataProvider headersProvider
     * @param $headers
     */
    public function testInvalidHeader($headers)
    {
        $md = new MobileDetect($headers);
        $this->assertNull($md->getHttpHeader('garbage_is_Garbage'));
    }

    public function userAgentProvider(): array
    {
        return [
            [[
                'HTTP_USER_AGENT' => 'blah'
            ], 'blah'],
            [[
                'HTTP_USER_AGENT' => 'iphone',
                'HTTP_X_OPERAMINI_PHONE_UA' => 'some other stuff'
            ], 'iphone some other stuff'],
            [[
                'HTTP_X_DEVICE_USER_AGENT' => 'hello world'
            ], 'hello world'],
            [[], null]
        ];
    }

    /**
     * @dataProvider userAgentProvider
     * @param $headers
     * @param $expectedUserAgent
     */
    public function testGetUserAgent($headers, $expectedUserAgent)
    {
        $md = new MobileDetect($headers);
        $md->setUserAgent();
        $this->assertSame($expectedUserAgent, $md->getUserAgent());
    }

    /**
     * Headers should be reset when you use setHttpHeaders.
     * @issue #144
     */
    public function testSetHttpHeaders()
    {
        $header1 = ['HTTP_PINK_PONY' => 'I secretly love ponies >_>'];
        $md = new MobileDetect($header1);
        $this->assertSame($md->getHttpHeaders(), $header1);

        $header2 = array('HTTP_FIRE_BREATHING_DRAGON' => 'yeah!');
        $md->setHttpHeaders($header2);
        $this->assertSame($md->getHttpHeaders(), $header2);
    }

    /**
     * Read response from cloudfront, if the cloudfront headers are detected
     */
    public function testSetCfHeaders()
    {
        // Test mobile detected
        $header1 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'false',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'true',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'false'
        ];
        $md = new MobileDetect($header1);
        $this->assertSame($md->getCfHeaders(), $header1);
        $this->assertSame($md->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($md->isTablet(), false);
        $this->assertSame($md->isMobile(), true);

        // Test neither mobile nor tablet (desktop)
        $header2 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'true',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'false',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'false'
        ];
        $md->setHttpHeaders($header2);
        $this->assertSame($md->getCfHeaders(), $header2);
        $this->assertSame($md->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($md->isTablet(), false);
        $this->assertSame($md->isMobile(), false);

        // Test tablet detected
        $header3 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'false',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'false',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'true'
        ];
        $md->setCfHeaders($header3);
        $this->assertSame($md->getCfHeaders(), $header3);
        $this->assertSame($md->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($md->isTablet(), true);
        $this->assertSame($md->isMobile(), false);

        // Check if the headers are cleared
        $header4 = [];
        $md->setHttpHeaders($header4);
        $this->assertSame($md->getCfHeaders(), $header4);
    }

    public function testSetUserAgent()
    {
        $md = new MobileDetect([]);
        $md->setUserAgent('hello world');
        $this->assertSame('hello world', $md->getUserAgent());
    }

    public function testSetLongUserAgent()
    {
        $md = new MobileDetect;
        $md->setUserAgent(str_repeat("a", 501));
        $this->assertEquals(strlen($md->getUserAgent()), 500);
    }

    //special headers that give 'quick' indication that a device is mobile
    public function quickHeadersData(): array
    {
        return [
            [[
                'HTTP_ACCEPT' => 'application/json; q=0.2, application/x-obml2d; q=0.8, image/gif; q=0.99, */*'
            ]],
            [[
                'HTTP_ACCEPT' => 'text/*; q=0.1, application/vnd.rim.html'
            ]],
            [[
                'HTTP_ACCEPT' => 'text/vnd.wap.wml',
            ]],
            [[
                'HTTP_ACCEPT' => 'application/vnd.wap.xhtml+xml',
            ]],
            [[
                'HTTP_X_WAP_PROFILE' => 'hello',
            ]],
            [[
                'HTTP_X_WAP_CLIENTID' => ''
            ]],
            [[
                'HTTP_WAP_CONNECTION' => ''
            ]],
            [[
                'HTTP_PROFILE' => ''
            ]],
            [[
                'HTTP_X_OPERAMINI_PHONE_UA' => ''
            ]],
            [[
                'HTTP_X_NOKIA_GATEWAY_ID' => ''
            ]],
            [[
                'HTTP_X_ORANGE_ID' => ''
            ]],
            [[
                'HTTP_X_VODAFONE_3GPDPCONTEXT' => ''
            ]],
            [[
                'HTTP_X_HUAWEI_USERID' => ''
            ]],
            [[
                'HTTP_UA_OS' => ''
            ]],
            [[
                'HTTP_X_MOBILE_GATEWAY' => ''
            ]],
            [[
                'HTTP_X_ATT_DEVICEID' => ''
            ]],
            [[
                'HTTP_UA_CPU' => 'ARM'
            ]]
        ];
    }

    /**
     * @dataProvider quickHeadersData
     * @param $headers
     */
    public function testQuickHeaders($headers)
    {
        $md = new MobileDetect($headers);
        $this->assertTrue($md->checkHttpHeadersForMobile());
    }

    // Headers that are not mobile.
    public function quickNonMobileHeadersData(): array
    {

        return [
            [[
                'HTTP_UA_CPU' => 'AMD64'
            ]],
            [[
                'HTTP_UA_CPU' => 'X86'
            ]],
            [[
                'HTTP_ACCEPT' => 'text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01'
            ]],
            [[
                'HTTP_REQUEST_METHOD' => 'DELETE'
            ]],
            [[
                'HTTP_VIA' => '1.1 ws-proxy.stuff.co.il C0A800FA'
            ]],
        ];
    }

    /**
     * @dataProvider quickNonMobileHeadersData
     * @param $headers
     */
    public function testNonMobileQuickHeaders($headers)
    {
        $md = new MobileDetect($headers);
        $this->assertFalse($md->checkHttpHeadersForMobile());
    }

    public function testBadMethodCall()
    {
        $this->expectException(\BadMethodCallException::class);
        $md = new MobileDetect([]);
        $md->badmethodthatdoesntexistatall();
    }

    public function versionDataProvider(): array
    {
        return [
            [
                'Mozilla/5.0 (Linux; Android 4.0.4; ARCHOS 80G9 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
                'Android',
                '4.0.4',
                4.04
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.0.4; ARCHOS 80G9 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
                'Webkit',
                '535.19',
                535.19
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.0.4; ARCHOS 80G9 Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
                'Chrome',
                '18.0.1025.166',
                18.01025166
            ],
            [
                'Mozilla/5.0 (BlackBerry; U; BlackBerry 9700; en-US) AppleWebKit/534.8  (KHTML, like Gecko) Version/6.0.0.448 Mobile Safari/534.8',
                'BlackBerry',
                '6.0.0.448',
                6.00448
            ],
            [
                'Mozilla/5.0 (BlackBerry; U; BlackBerry 9700; en-US) AppleWebKit/534.8  (KHTML, like Gecko) Version/6.0.0.448 Mobile Safari/534.8',
                'Webkit',
                '534.8',
                534.8
            ],
            [
                'Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en-GB) AppleWebKit/534.8+ (KHTML, like Gecko) Version/6.0.0.546 Mobile Safari/534.8+',
                'BlackBerry',
                '6.0.0.546',
                6.00546
            ]
        ];
    }

    /**
     * @dataProvider versionDataProvider
     */
    public function testVersionExtraction($userAgent, $property, $stringVersion, $floatVersion)
    {
        $md = new MobileDetect(['HTTP_USER_AGENT' => $userAgent]);
        $prop = $md->version($property);

        $this->assertSame($stringVersion, $prop);

        $prop = $md->version($property, 'float');
        $this->assertSame($floatVersion, $prop);

        //assert that garbage data is always === false
        $prop = $md->version('garbage input is always garbage');
        $this->assertFalse($prop);
    }

    public function testRules()
    {
        $md = new MobileDetect;
        $count = array_sum([
            count(MobileDetect::getPhoneDevices()),
            count(MobileDetect::getTabletDevices()),
            count(MobileDetect::getOperatingSystems()),
            count(MobileDetect::getBrowsers())
        ]);
        $rules = $md->getRules();
        $this->assertCount($count, $rules);
    }

    public function testRulesExtended()
    {
        $md = new MobileDetect;
        $count = array_sum([
            count(MobileDetect::getPhoneDevices()),
            count(MobileDetect::getTabletDevices()),
            count(MobileDetect::getOperatingSystems()),
            count(MobileDetect::getBrowsers()),
        ]);
        $rules = $md->getRules();
        $this->assertCount($count, $rules);
    }

    public function testScriptVersion()
    {
        $v = MobileDetect::getScriptVersion();
        $formatCheck = (bool)preg_match('/^[0-9]+\.[0-9]+\.[0-9]+(-[a-zA-Z0-9])?$/', $v);

        $this->assertTrue($formatCheck, "Fails the semantic version test. The version " . var_export($v, true)
                . ' does not match X.Y.Z pattern');
    }

    public function crazyVersionNumbers(): array
    {
        return [
            ['2.5.6', 2.56],
            ['12142.2142.412521.24.152', 12142.214241252124152],
            ['6_3', 6.3],
            ['4_7  /7 7 12_9', 4.777129],
            ['49', 49.0],
            ['2.6.x', 2.6],
            ['45.6.1.x.12', 45.61]
        ];
    }

    /**
     * @dataProvider crazyVersionNumbers
     * @param $raw
     * @param $expected
     */
    public function testPrepareVersionNo($raw, $expected)
    {
        $md = new MobileDetect;
        $actual = $md->prepareVersionNo($raw);
        $this->assertSame($expected, $actual, "We expected " . var_export($raw, true) . " to convert to "
            . var_export($expected, true) . ', but got ' . var_export($actual, true) . ' instead');
    }
}
