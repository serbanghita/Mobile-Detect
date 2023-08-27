<?php

namespace DetectionTests;

use Detection\MobileDetect;
use PHPUnit\Framework\TestCase;

final class MobileDetectVersionTest extends TestCase
{
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
        $detect = new MobileDetect();
        $detect->setHttpHeaders(['HTTP_USER_AGENT' => $userAgent]);
        $prop = $detect->version($property);

        $this->assertSame($stringVersion, $prop);

        $prop = $detect->version($property, 'float');
        $this->assertSame($floatVersion, $prop);

        //assert that garbage data is always === false
        $prop = $detect->version('garbage input is always garbage');
        $this->assertFalse($prop);
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
        $md = new MobileDetect();
        $actual = $md->prepareVersionNo($raw);
        $this->assertSame($expected, $actual, "We expected " . var_export($raw, true) . " to convert to "
            . var_export($expected, true) . ', but got ' . var_export($actual, true) . ' instead');
    }
}
