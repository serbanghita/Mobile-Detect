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

    protected function assertPattern($pattern, $name)
    {
        $detect = new MobileDetect();

        // prepare method so that we can access it
        $class = new \ReflectionClass(get_class($detect));
        $method = $class->getMethod('prepareRegex');
        $method->setAccessible(true);
        $pattern = $method->invokeArgs($detect, array($pattern));

        $res = @preg_match($pattern, 'garbagestringdoesnotmatter');
        if ($res === false) {
            $this->fail(
                sprintf('Not a valid regex: %s in %s [REGEX FAIL]', $pattern, $name)
            );
        }
        //this is for assertion counts
        $this->assertInternalType('integer', $res);
    }

    /**
     * regex error handler used with preg throws an exception
     * @expectedException \MobileDetect\Exception\RegexCompileException
     */
    public function testRegexErrorHandlerUsedWithPregThrowsAnException()
    {
        $detect = new MobileDetect();
        $detect->regexErrorHandler(111, 'Whatever preg_match error', 'stuff.txt', 11, array());
    }

    /**
     * regex error handler used with a regular php error returns false
     */
    public function testRegexErrorHandlerUsedWithARegularPhpErrorReturnsFalse()
    {
        $detect = new MobileDetect();
        $ret = $detect->regexErrorHandler(111, 'Whatever php error', 'stuff.txt', 11, array());

        $this->assertFalse($ret);
    }
}