<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;
use Mockery;

class ConstructorTests extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * When no factory object is passed it creates a new factory instance.
     */
    /*
    public function testWhenNoFactoryObjectIsPassedItCreatesANewFactoryInstance()
    {
        $md = new MobileDetect();
        $this->assertInstanceOf('MobileDetect\\MobileDetectFactory', $md->getFactory());
    }
    */

    /**
     * When factory object is created it also creates all the needed properties classes.
     */
    public function testWhenFactoryObjectIsCreatedItAlsoCreatesAllTheNeededPropertiesClasses()
    {
        $md = new MobileDetect();
        $this->assertAttributeInstanceOf('MobileDetect\\Providers\\UserAgentHeaders', 'userAgentHeaders', $md);
        $this->assertAttributeInstanceOf('MobileDetect\\Providers\\HttpHeaders', 'recognizedHttpHeaders', $md);
    }

    /**
     * When headers are passed like string they are treated like a User-Agent.
     */
    public function testWhenHeadersArePassedLikeStringTheyAreTreatedLikeAUserAgent()
    {
        $inputUserAgent = 'My custom user-agent passed like a string via constructor.';
        $md = new MobileDetect($inputUserAgent);
        $this->assertEquals($inputUserAgent, $md->getHeader('user-agent'));
    }

    /**
     * When no headers are passed then the headers are taken from the global SERVER variable.
     */
    public function testWhenNoHeadersArePassedThenTheHeadersAreTakenFromTheGlobalSERVERVariable()
    {
        $inputUserAgent = $_SERVER['HTTP_USER_AGENT'] = 'My custom user agent.';
        $md = new MobileDetect();
        $this->assertEquals($inputUserAgent, $md->getHeader('user-agent'));
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
        $md = new MobileDetect($inputHeaders);
        $this->assertEquals('Some user-agent.', $md->getHeader('user-agent'));
        $this->assertEquals('Some content-type.', $md->getHeader('content-type'));
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

        $md = new MobileDetect($headers);
        $this->assertAttributeSame(array(), 'headers', $md);
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

        $detect = new MobileDetect($headers);

        $this->assertSame($ua, $detect->getHeader('User-Agent'));
        $this->assertSame($host, $detect->getHeader('Host'));
        $this->assertSame($cpu, $detect->getHeader('UA-CPU'));
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
        $detect = new MobileDetect($inputHeaders);
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
        ), $detect->getHeaders());
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
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     */
    public function testSettingAnUnknownHeaderReturnsNull()
    {
        $detect = new MobileDetect();
        $detect->setHeader('Blah-Blah', 'stuff');
    }

    public function testSettingKnownHeaderIsProperlySet()
    {
        $detect = new MobileDetect();
        $detect->setHeader('Warning', '199 Miscellaneous warning');
        $this->assertEquals($detect->getHeader('WaRNinG'), '199 Miscellaneous warning');
    }
    
    public function testThatAPsr7HttpMessageIsAValidType()
    {
        $httpMessage = Mockery::mock('\\Psr\\Http\\Message\\MessageInterface');
        $httpMessage->shouldReceive('getHeaders')->andReturn(array('user-agent' => 'hello'));
        $md = new MobileDetect($httpMessage);
        $this->assertSame('hello', $md->getUserAgent());
    }

    /**
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     * @expectedExceptionMessage Unexpected headers argument type=object
     */
    public function testThatAnUnknownHeaderTypeFails()
    {
        $headers = new \stdClass();
        new MobileDetect($headers);
    }
}