<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class MatchingTheModelTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Matching an array of matches that contain MODEL keyword stops at the first matched regex.
     */
    public function testMatchingAnArrayOfMatchesThatContainMODELKeywordStopsAtTheFirstMatchedRegex()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $inputModelMatches = array('Nexus [MODEL]', '[MODEL] Nexus');
        $inputAgainst = 'Nexus 7_0 some stuff 999 Nexus';
        $outputMatches = array();
        $ret = $m->invoke($detect, $inputModelMatches, $inputAgainst, $outputMatches);

        $this->assertArrayHasKey('model', $ret);
        $this->assertSame('7', $ret['model']);
    }

    /**
     * Matching an array of matches that contain VER keyword stops at the first matched regex.
     */
    public function testMatchingAnArrayOfMatchesThatContainVERKeywordStopsAtTheFirstMatchedRegex()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $inputModelMatches = array('Nexus [VER]', '[VER] Nexus');
        $inputAgainst = 'Nexus 7_0 some stuff 999 Nexus';
        $outputMatches = array();
        $ret = $m->invoke($detect, $inputModelMatches, $inputAgainst, $outputMatches);

        $this->assertArrayHasKey('version', $ret);
        $this->assertSame('7.0', $ret['version']);
    }

    /**
     * Matching phone that contain model and version return the model and version keys with expected values.
     */
    public function testMatchingPhoneThatContainModelAndVersionReturnTheModelAndVersionKeysWithExpectedValues()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $inputModelMatches = array(
            '(?<model>iPhone).*CPU[a-z ]+(?<version>[0-9\._-]+)',
            '(?<model>iPod).*CPU[a-z ]+(?<version>[0-9\._-]+)'
        );
        $inputAgainst = 'Mozilla/5.0 (iPod; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A403 Safari/8536.25';
        $outputMatches = array();
        $ret = $m->invoke($detect, $inputModelMatches, $inputAgainst, $outputMatches);

        $this->assertArrayHasKey('model', $ret);
        $this->assertArrayHasKey('version', $ret);

        $this->assertSame('iPod', $ret['model']);
        $this->assertSame('6.0', $ret['version']);
    }

    /**
     * Matching a non existent set of matches return false.
     */
    public function testMatchingANonExistentSetOfMatchesReturnFalse()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('modelMatch');
        $m->setAccessible(true);

        $inputModelMatches = array(
            'Test1',
            'Test2'
        );
        $inputAgainst = 'Mozilla/5.0';
        $outputMatches = array();
        $ret = $m->invoke($detect, $inputModelMatches, $inputAgainst, $outputMatches);

        $this->assertFalse($ret);
        $this->assertEmpty($outputMatches);
    }



}