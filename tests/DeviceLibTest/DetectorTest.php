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
}
