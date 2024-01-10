<?php

namespace DetectionTests;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;
use PHPUnit\Framework\TestCase;

/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
final class MobileDetectGeneralTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('\Detection\MobileDetect'));
    }

    public function testBadMethodCall()
    {
        $this->expectException(\BadMethodCallException::class);
        $md = new MobileDetect();
        $md->badmethodthatdoesntexistatall();
    }

    /**
     * @throws MobileDetectException
     */
    public function testNoUserAgentSetAndAutoInitOfHttpHeadersIsFalse()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No valid user-agent has been set.');

        $detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->isMobile();
    }

    /**
     * @throws MobileDetectException
     */
    public function testNoUserAgentSet()
    {
        $detect = new MobileDetect();
        $this->assertFalse($detect->isMobile());
    }

    /**
     * @throws MobileDetectException
     */
    public function testEmptyStringAsAUserAgent()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('');
        $this->assertFalse($detect->isMobile());
    }

    /**
     * @throws MobileDetectException
     */
    public function testAutoInitPicksUpKnownHttpHeaders()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 Mobile/10A523';

        $detect = new MobileDetect();
        $this->assertTrue($detect->isMobile());
        $this->assertTrue($detect->isiOS());
        $this->assertTrue($detect->isiPhone());
    }

    /**
     * @throws MobileDetectException
     */
    public function testValidHeadersThatDoNotContainHttpUserAgentHeaderButNoUserAgentIsManuallySet()
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders([
            'HTTP_CONNECTION'       => 'close',
            'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
        ]);
        $this->assertFalse($detect->isMobile());
    }

    public function testValidHeadersThatDoNotContainHttpUserAgentHeaderButNoUserAgentIsManuallySetAndAutoInitOfHttpHeadersIsFalse()
    {
        $this->expectException(MobileDetectException::class);
        $this->expectExceptionMessage('No valid user-agent has been set.');

        $detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->setHttpHeaders([
            'HTTP_CONNECTION'       => 'close',
            'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
        ]);
        $detect->isMobile();
    }

    /**
     * @throws MobileDetectException
     */
    public function testValidHeadersThatContainHttpUserAgentHeaderButNoUserAgentIsManuallySet()
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders([
            'HTTP_CONNECTION'       => 'close',
            'HTTP_USER_AGENT'       => 'iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26',
            'HTTP_ACCEPT'           => 'text/vnd.wap.wml, application/json, text/javascript, */*; q=0.01',
        ]);

        $this->assertEquals('iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26', $detect->getUserAgent());
        $this->assertTrue($detect->isMobile());
    }

    public function testScriptVersion()
    {
        $detect = new MobileDetect();
        $this->assertNotEmpty($version = $detect->getVersion());
        $formatCheck = (bool)preg_match('/^[0-9]+\.[0-9]+\.[0-9]+(-[a-zA-Z0-9])?$/', $version);
        $this->assertTrue($formatCheck, "Fails the semantic version test. The version " . var_export($version, true)
            . ' does not match X.Y.Z pattern');
    }

    /**
     * @throws MobileDetectException
     */
    public function testBasicMethods()
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders([
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
            ]);

        $this->assertCount(16, $detect->getHttpHeaders());
        $this->assertTrue($detect->checkHttpHeadersForMobile());

        $detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25');
        $this->assertNotEmpty($detect->getUserAgent());

        $this->assertTrue($detect->isMobile());
        $this->assertFalse($detect->isTablet());

        $this->assertTrue($detect->isIphone());
        $this->assertTrue($detect->isiphone());
        $this->assertTrue($detect->isiOS());
        $this->assertTrue($detect->isios());
        $this->assertTrue($detect->is('iphone'));
        $this->assertTrue($detect->is('ios'));
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
    public function testHeaders(array $headers)
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders($headers);

        foreach ($headers as $header => $value) {
            if (!str_starts_with($header, 'HTTP_')) {
                //make sure it wasn't set
                $this->assertNull($detect->getHttpHeader($value));
            } else {
                //make sure it's equal
                $this->assertEquals($value, $detect->getHttpHeader($header));
            }
        }

        //verify some headers work with the translated getter
        $this->assertEquals($headers['HTTP_USER_AGENT'], $detect->getHttpHeader('User-Agent'));
    }

    /**
     * @dataProvider headersProvider
     * @param $headers
     */
    public function testInvalidHeader($headers)
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders($headers);
        $this->assertNull($detect->getHttpHeader('garbage_is_Garbage'));
    }

    public function testEmptyHeaders()
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders([]);
        $this->assertCount(0, $detect->getHttpHeaders());
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
            [[], '']
        ];
    }

    /**
     * @dataProvider userAgentProvider
     * @param $headers
     * @param $expectedUserAgent
     */
    public function testGetUserAgent($headers, $expectedUserAgent)
    {
        $detect = new MobileDetect();
        $detect->setHttpHeaders($headers);
        $this->assertSame($expectedUserAgent, $detect->getUserAgent());
    }

    /**
     * Headers should be reset when you use setHttpHeaders.
     * @issue #144
     */
    public function testSetHttpHeaders()
    {
        $header1 = ['HTTP_PINK_PONY' => 'I secretly love ponies >_>'];
        $detect = new MobileDetect();
        $detect->setHttpHeaders($header1);
        $this->assertSame($detect->getHttpHeaders(), $header1);

        $header2 = array('HTTP_FIRE_BREATHING_DRAGON' => 'yeah!');
        $detect->setHttpHeaders($header2);
        $this->assertSame($detect->getHttpHeaders(), $header2);
    }

    /**
     * Read response from cloudfront, if the cloudfront headers are detected
     * @throws MobileDetectException
     */
    public function testSetCfHeaders()
    {
        // Test mobile detected
        $header1 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'false',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'true',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'false'
        ];
        $detect = new MobileDetect();
        $detect->setHttpHeaders($header1);
        $this->assertSame($detect->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($detect->isTablet(), false);
        $this->assertSame($detect->isMobile(), true);

        // Test neither mobile nor tablet (desktop)
        $header2 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'true',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'false',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'false'
        ];
        $detect->setHttpHeaders($header2);
        $this->assertSame($detect->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($detect->isTablet(), false);
        $this->assertSame($detect->isMobile(), false);

        // Test tablet detected
        $header3 = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'false',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'false',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'true'
        ];
        $detect->setHttpHeaders($header3);
        $this->assertSame($detect->getUserAgent(), 'Amazon CloudFront');
        $this->assertSame($detect->isTablet(), true);
        $this->assertSame($detect->isMobile(), false);
    }

    public function testSetUserAgent()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('hello world');
        $this->assertSame('hello world', $detect->getUserAgent());
    }

    public function testSetLongUserAgent()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(str_repeat("a", 501));
        $this->assertEquals(500, strlen($detect->getUserAgent()));
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
        $detect = new MobileDetect();
        $detect->setHttpHeaders($headers);
        $this->assertTrue($detect->checkHttpHeadersForMobile());
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
        $detect = new MobileDetect();
        $detect->setHttpHeaders($headers);
        $this->assertFalse($detect->checkHttpHeadersForMobile());
    }

    public function testRules()
    {
        $md = new MobileDetect();
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
        $md = new MobileDetect();
        $count = array_sum([
            count(MobileDetect::getPhoneDevices()),
            count(MobileDetect::getTabletDevices()),
            count(MobileDetect::getOperatingSystems()),
            count(MobileDetect::getBrowsers()),
        ]);
        $rules = $md->getRules();
        $this->assertCount($count, $rules);
    }
}
