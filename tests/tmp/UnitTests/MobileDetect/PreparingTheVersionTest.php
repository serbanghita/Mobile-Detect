<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class PreparingTheVersion extends \PHPUnit_Framework_TestCase
{
    public function versionStringsProvider()
    {
        return array(
            array('7.1.1', '7.1.1'),
            array('6_1_3', '6.1.3')
        );
    }

    /**
     * Preparing the version returns the expected string format result.
     * @dataProvider versionStringsProvider
     */
    public function testPreparingTheVersionReturnsTheExpectedStringFormatResult($input, $expected)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareVersion');
        $m->setAccessible(true);

        $this->assertEquals($expected, $m->invoke($detect, $input));

    }

    public function versionAsArrayProvider()
    {
        return array(
            array('7.1.1', array(7, 1, 1)),
            array('6_1_3', array(6, 1, 3))
        );
    }

    /**
     * Preparing the version returns the expected array format result.
     * @dataProvider versionAsArrayProvider
     */
    public function testPreparingTheVersionReturnsTheExpectedArrayFormatResult($input, $expected)
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareVersion');
        $m->setAccessible(true);

        $this->assertEquals($expected, $m->invoke($detect, $input, true));

    }

    /**
     * preparing a version in semver format as an array returns an array with three elements
     */
    public function testPreparingAVersionInSemverFormatAsAnArrayReturnsAnArrayWithThreeElements()
    {
        $r = new \ReflectionObject($detect = new MobileDetect());
        $m = $r->getMethod('prepareVersion');
        $m->setAccessible(true);

        $ret = $m->invoke($detect, '2.1.10', true);

        $this->assertSame($ret, array('2','1','10'));
    }

}