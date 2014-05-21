<?php

namespace DeviceLibTest;

use DeviceLib\Detector;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
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
                'model_version' => '1.2.3.4',
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

    /*public function testDetectPhoneDevice()
    {
        $r = new \ReflectionObject($detect = new Detector());
        $m = $r->getMethod('detectPhoneDevice');
        $m->setAccessible(true);
    }*/
}
