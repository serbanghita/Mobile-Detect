<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class SetUserAgentTests extends \PHPUnit_Framework_TestCase
{

    /**
     * Setting an User-agent with right and left whitespaces will be trimmed
     */
    public function testSettingAnUserAgentWithRightAndLeftWhitespacesWillBeTrimmed()
    {
        $md = new MobileDetect();
        $md->setUserAgent(' A user-agent with trailing spaces  ');
        $this->assertEquals('A user-agent with trailing spaces', $md->getHeader('user-agent'));
    }

    /**
     * Setting an User-agent through multiple recognized http headers returns a concatenated User-agent
     */
    public function testSettingAnUserAgentThroughMultipleRecognizedHttpHeadersReturnsAConcatenatedUserAgent()
    {
        $inputHeaders = array(
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

        $md = new MobileDetect($inputHeaders);
        $this->assertSame('1 2 3 4 5 6 7 8', $md->getUserAgent());
    }
}