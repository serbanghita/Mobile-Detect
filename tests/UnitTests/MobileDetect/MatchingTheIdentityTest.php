<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class MatchingTheIdentityTest extends \PHPUnit_Framework_TestCase
{

    public function matchesAgainstUserAgents()
    {
        return array(
            array(
                'strpos',
                'Android',
                'Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; GT-S7562 Build/IMM76I) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                true
            ),
            array(
                'strpos',
                'iOS',
                'Mozilla/5.0 (iPhone; CPU iPhone OS 7_1_1 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Mobile/11D201 [FBAN/FBIOS;FBAV/12.1.0.24.20;FBBV/3214247;FBDV/iPhone6,1;FBMD/iPhone;FBSN/iPhone OS;FBSV/7.1.1;FBSS/2; FBCR/AT&T;FBID/phone;FBLC/en_US;FBOP/5]',
                false
            ),
            array(
              'stripos',
              'iOS',
              'VendorAppName/1.7.0 (iPhone; iOS 8.1.2; Scale/3.00)',
              true
            ),
            array(
                'regex',
                '\biPhone\b|\biPod\b',
                'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) CriOS/38.0.2125.59 Mobile/12A405 Safari/600.1.4',
                true
            ),
            array(
                'regex',
                '\biOS\b',
                'Mozilla/5.0 (Linux; U; Android 4.0.4; CriOS/38.0.2125.59)',
                false
            )
        );
    }


    /**
     * Matching User-Agents via simple strings works as expected when using a custom provider.
     * @dataProvider matchesAgainstUserAgents
     */
    public function testMatchingUserAgentsViaSimpleStringsWorksAsExpectedWhenUsingACustomProvider($type, $test, $against, $result)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertEquals($result, $m->invoke($detect, $type, $test, $against));
    }

    public function regexesWithVersionsAgainstUserAgents()
    {
        return array(
            array(
                'regex',
                'CriOS/[VER]',
                'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) CriOS/38.0.2125.59 Mobile/12A405 Safari/600.1.4',
                true
            )
        );
    }

    /**
     * Matching User-Agents via strings with custom versions and models works as expected when using a custom provider.
     * @dataProvider regexesWithVersionsAgainstUserAgents
     */
    public function testMatchingUserAgentsViaStringsWithCustomVersionsAndModelsWorksAsExpectedWhenUsingACustomProvider($type, $test, $against, $result)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertEquals($result, $m->invoke($detect, $type, $test, $against));
    }


    /**
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     * @expectedExceptionMessage Unknown match type: apples
     */
    public function testMatchesInvalidType()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $m->invoke($detect, 'apples', '', '');
    }

    /**
     * matching against an invalid pattern type throws an exception
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     * @expectedExceptionMessage Invalid regex pattern of type "array" passed for "whatever"
     */
    public function testMatchingAgainstAnInvalidPatternTypeThrowsAnException()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $m->invoke($detect, 'regex', 'whatever', array('regex1', 'regex2'));
    }


    public function testMatchesRegexActuallyMatches()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'regex', '^st[u]+ff$', 'stuuuuuff'));
    }

    public function testMatchesRegexDoesNotMatch()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'regex', '^stuff[s]?$', 'horse stuff'));
    }

    public function testMatchesStrposDoesMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'strpos', 'u', 'stuff'));
    }

    public function testMatchesStrposDoesNotMatchSensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'strpos', 'F', 'stuff'));
    }

    public function testMatchesStrposDoesMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertTrue($m->invoke($detect, 'stripos', 'u', 'STUFF'));
    }

    public function testMatchesStrposDoesNotMatchInsensitiveString()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('identityMatch');
        $m->setAccessible(true);

        $this->assertFalse($m->invoke($detect, 'stripos', 'q', 'STuff'));
    }
}