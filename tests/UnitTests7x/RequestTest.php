<?php
namespace MobileDetectTests\UnitTests;

use MobileDetect\Http\Request;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{

    /**
     * When HTTP headers is a boolean then exception is thrown.
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unexpected headers argument type=boolean
     */
    public function testWhenHTTPHeadersIsABooleanThenExceptionIsThrown(): void
    {
        new Request(false);
    }

    /**
     * When HTTP headers is an object then exception is thrown.
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unexpected headers argument type=object
     */
    public function testThatAnUnknownHeaderTypeFails()
    {
        $headers = new \stdClass();
        new Request($headers);
    }

    /**
     * When headers are passed like string they are treated like a User-Agent.
     */
    public function testWhenHeadersArePassedLikeStringTheyAreTreatedLikeAUserAgent()
    {
        $inputUserAgent = 'My custom user-agent passed like a string via constructor.';
        $request = new Request($inputUserAgent);
        $this->assertEquals($inputUserAgent, $request->getHeader('user-agent'));
    }

    /**
     * When a header is not in the list of known headers then an exception is thrown
     * @expectedException \InvalidArgumentException
     */
    public function testWhenAHeaderIsNotInTheListOfKnownHeadersThenAnExceptionIsThrown()
    {
        $request = new Request();
        $request->setHeader("Blah-Blah", "stuff");
    }

    /**
     * When a header is explicitly set then it's name is also standardized.
     */
    public function testWhenAHeaderIsExplicitlySetThenItSNameIsAlsoStandardized()
    {
        $request = new Request();
        $request->setHeader("HTTP_WAP_CONNECTION", "Stack-Type=HTTP");
        $request->setHeader("HTTP_UA_CPU", "AMD64");

        $this->assertEquals($request->getHeader('authorization'), 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $this->assertEquals($request->getHeader('content-type'), 'application/x-www-form-urlencoded');
    }

    /**
     * When setting a known header then it is properly set.
     */
    public function testWhenSettingAKnownHeaderThenItIsProperlySet()
    {
        $request = new Request(['Warning' => '199 Miscellaneous warning']);
        $this->assertEquals($request->getHeader('WaRNinG'), '199 Miscellaneous warning');
    }

    /**
     * When setting an explicit user agent it has priority over the one set in headers
     */
    public function testWhenSettingAnExplicitUserAgentItHasPriorityOverTheOneSetInHeaders()
    {
        $request = new Request(["User-Agent" => "efg"]);
        $request->setUserAgent("abc");
        $this->assertSame("abc", $request->getUserAgent());
    }

    /**
     * When setting a null user agent the one from the headers is set.
     */
    public function testWhenSettingANullUserAgentTheOneFromTheHeadersIsSet()
    {
        $request = new Request(["User-Agent" => "efg"]);
        $request->setUserAgent(null);
        $this->assertSame("efg", $request->getUserAgent());
    }

    /**
     * PSR7 headers can be set.
     */
    public function testPSR7HeadersCanBeSet()
    {
        $httpMessage = \Mockery::mock('\\Psr\\Http\\Message\\MessageInterface');
        $httpMessage->shouldReceive('getHeaders')->andReturn(['user-agent' => 'hello']);
        $request = new Request($httpMessage);
        $this->assertSame("hello", $request->getUserAgent());
    }

    /**
     * When no headers are passed then the headers are taken from the global SERVER variable.
     */
    public function testWhenNoHeadersArePassedThenTheHeadersAreTakenFromTheGlobalSERVERVariable()
    {
        $inputUserAgent = $_SERVER['HTTP_USER_AGENT'] = 'My custom user agent.';
        $request = new Request();
        $this->assertEquals($inputUserAgent, $request->getHeader("user-agent"));
    }

    /**
     * When no user agent or headers are passed then user agent is taken from the global SERVER variable.
     */
    public function testWhenNoUserAgentOrHeadersArePassedThenUserAgentIsTakenFromTheGlobalSERVERVariable()
    {
        $inputUserAgent = $_SERVER['HTTP_USER_AGENT'] = 'My custom user agent.';
        $request = new Request();
        $this->assertEquals($inputUserAgent, $request->getUserAgent());
    }

    /**
     * When headers are passed as a Iterator instance they are converted to array.
     */
    public function testWhenHeadersArePassedAsAIteratorInstanceTheyAreConvertedToArray()
    {
        $inputHeaders = new \ArrayIterator(
            array(
                'User-Agent' => 'Some user-agent.',
                'Content-type' => 'Some content-type.'
            )
        );
        $request = new Request($inputHeaders);
        $this->assertEquals('Some user-agent.', $request->getHeader('user-agent'));
        $this->assertEquals('Some content-type.', $request->getHeader('content-type'));
    }

    /**
     * When headers are passed as a Iterator instance they are converted to array and User-Agent is set.
     */
    public function testWhenHeadersArePassedAsAIteratorInstanceTheyAreConvertedToArrayAndUserAgentIsSet()
    {
        $iterator = new \ArrayIterator(
            array(
                'User-Agent' => 'Some user-agent.',
                'Content-type' => 'Some content-type.'
            )
        );
        $request = new Request($iterator);
        $this->assertEquals("Some user-agent.", $request->getUserAgent());
    }

    /**
     * When all headers passed are invalid the headers remain an empty array
     */
    public function testWhenAllHeadersPassedAreInvalidTheHeadersRemainAnEmptyArray()
    {
        $headers = array(
            'HTTP_GARBAGE' => true,
            'whatever' => true,
            'HTTP_USER_AGENTS' => true,
        );

        $request = new Request($headers);
        $this->assertSame([], $request->getHeaders());
    }

    /**
     * When an array of valid headers is passed to the constructor they are set and found by getHeader method.
     */
    public function testWhenAnArrayOfValidHeadersIsPassedToTheConstructorTheyAreSetAndFoundByGetHeaderMethod()
    {
        //legit headers
        $headers = array(
            'HTTP_USER_AGENT' => $ua = 'Whatever',
            'HTTP_HOST' => $host = 'whatever.com',
            'HTTP_UA_CPU' => $cpu = 'ARM blah',
        );

        $request = new Request($headers);

        $this->assertSame($ua, $request->getHeader('User-Agent'));
        $this->assertSame($host, $request->getHeader('Host'));
        $this->assertSame($cpu, $request->getHeader('UA-CPU'));
    }

    /**
     * Setting an array of mixed valid and invalid headers doesn't throw any exception and getHeaders returns only the valid headers
     */
    public function testSettingAnArrayOfMixedValidAndInvalidHeadersDoesntThrowAnyExceptionAndGetHeadersReturnsOnlyTheValidHeaders()
    {
        $inputHeaders = array(
            'HTTP_ACCEPT_LANGUAGE' => 'en-GB',
            'HTTP_REFERER' => 'http://demo.mobiledetect.net/',
            'HTTP_ACCEPT' => 'text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01',
            'HTTP_UA_CPU' => 'ARM',
            'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e)',
            'HTTP_HOST' => 'demo.mobiledetect.net',
            'HTTP_CONNECTION' => 'close',
            'HTTP_CACHE_CONTROL' => 'no-cache',
            'HTTP_COOKIE' => 'PHPSESSID=527c39b00786535e95550d64c7652855',
            'REMOTE_ADDR' => '91.220.121.250',
            'REQUEST_TIME' => '27-09-2012 15:19'
        );
        $request = new Request($inputHeaders);
        $this->assertSame(array(
            'accept-language' => 'en-GB',
            'referer' => 'http://demo.mobiledetect.net/',
            'accept' => 'text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01',
            'ua-cpu' => 'ARM',
            'accept-encoding' => 'gzip, deflate',
            'user-agent' => 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar C110e)',
            'host' => 'demo.mobiledetect.net',
            'connection' => 'close',
            'cache-control' => 'no-cache',
            'cookie' => 'PHPSESSID=527c39b00786535e95550d64c7652855',
        ), $request->getHeaders());
    }

    /**
     * When multiple known User-Agent headers are passed then they are appended to User-Agent string.
     */
    public function testWhenMultipleKnownUserAgentHeadersArePassedThenTheyAreAppendedToUserAgentString()
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

        $request = new Request($headers);

        $this->assertSame('1 2 3 4 5 6 7 8', $request->getUserAgent());
    }

    public function testCloudFrontHeaders()
    {
        $headers = [
            'HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER' => 'false',
            'HTTP_CLOUDFRONT_IS_MOBILE_VIEWER'  => 'true',
            'HTTP_CLOUDFRONT_IS_TABLET_VIEWER'  => 'false'
        ];

        $request = new Request($headers);

        $this->assertEquals("false", $request->getHeader("cloudfront-is-desktop-viewer"));
        $this->assertEquals("true", $request->getHeader("cloudfront-is-mobile-viewer"));
        $this->assertEquals("false", $request->getHeader("cloudfront-is-tablet-viewer"));
    }

    public function tearDown()
    {
        \Mockery::close();
        parent::tearDown();
    }

}