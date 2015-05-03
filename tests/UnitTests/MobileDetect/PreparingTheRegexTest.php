<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class PreparingTheRegex extends \PHPUnit_Framework_TestCase
{
    public function testPrepareRegex()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame('/^yo$/i', $m->invoke($detect, '^yo$'));
    }

    public function testPrepareRegexWithPatternSubstitution()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareRegex');
        $m->setAccessible(true);

        $this->assertSame(
            '/^yo(?<version>[0-9\._-]+)and(?<model>[a-zA-Z0-9]+)!$/i',
            $m->invoke($detect, '^yo[VER]and[MODEL]!$')
        );
    }
}