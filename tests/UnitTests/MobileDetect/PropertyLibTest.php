<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class PropertyLibTest extends \PHPUnit_Framework_TestCase
{
    protected static $validMatchTypes = array('regex', 'strpos', 'stripos');

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
     * @return array
     */
    public function phoneAndTabledDevicesProvider()
    {
        $this->markTestSkipped('must be revisited.');

        $data = array();
        $phones = PropertyLib::getPhoneDevices();

        foreach ($phones as $type => $spec) {
            $data[] = array($type, $spec);
        }

        $tablets = PropertyLib::getTabletDevices();

        foreach ($tablets as $type => $spec) {
            $data[] = array($type, $spec);
        }

        return $data;
    }

    /**
     * @dataProvider phoneAndTabledDevicesProvider
     */
    public function testPhoneAndTabledDevicesAreValidFormat($device, $spec)
    {
        $this->markTestSkipped('must be revisited.');

        $this->assertInternalType('string', $device, 'The key should be a string');
        $this->assertArrayHasKey('vendor', $spec);
        $this->assertArrayHasKey('match', $spec);
        $this->assertArrayHasKey('modelMatch', $spec);

        if (array_key_exists('type', $spec)) {
            if (!in_array($spec['type'], self::$validMatchTypes)) {
                $this->fail(
                    sprintf('Not a valid "match" type: %s in %s', $spec['type'], $device)
                );
            }
        }

        $modelMatch = $spec['modelMatch'];
        if (!is_array($modelMatch) && $modelMatch != '') {
            $this->fail(
                sprintf('Not a valid "modelMatch": %s in %s', $spec['modelMatch'], $device)
            );
        }

        // validate regex, if that's the type
        if ((array_key_exists('type', $spec) && $spec['type'] == 'regex') ||
            !array_key_exists('type', $spec)
        ) {
            //try to regex match to validate the regex
            $this->assertPattern($spec['match'], $device);
        }
    }
    /*
    public function osBrowserProvider()
    {
        $data = array();

        $osgroup = PropertyLib::getOperatingSystems();
        foreach ($osgroup as $group => $os) {
            foreach ($os as $name => $spec) {
                $data[] = array($name, $spec);
            }
        }

        $browsers = PropertyLib::getBrowsers();
        foreach ($browsers as $group => $browser) {
            foreach ($browser as $name => $spec) {
                $data[] = array($name, $spec);
            }
        }

        return $data;
    }
    */
    /**
     * @dataProvider osBrowserProvider
     */
    /*
    public function testOsAndBrowserIsValidFormat($name, $spec)
    {
        $this->markTestSkipped('must be revisited.');

        $this->assertInternalType('array', $spec);
        $this->assertArrayHasKey('isMobile', $spec);
        $this->assertInternalType('boolean', $spec['isMobile']);
        $this->assertArrayHasKey('match', $spec);
        $this->assertArrayHasKey('versionMatch', $spec);
        $this->assertPattern($spec['match'], $name);

        if (is_array($spec['versionMatch'])) {
            foreach ($spec['versionMatch'] as $regex) {
                $this->assertPattern($regex, $name);
            }
        }
    }
    */
    /*
    public function propertiesProvider()
    {
        $props = PropertyLib::getProperties();
        $data = array();
        foreach ($props as $name => $matches) {
            $data[] = array($name, $matches);
        }
        return $data;
    }
    */
    /**
     * @dataProvider propertiesProvider
     */
    /*
    public function testProperties($name, $spec)
    {
        $this->markTestSkipped('must be revisited.');

        if (!is_array($spec)) {
            $spec = array($spec);
        }

        foreach ($spec as $match) {
            $this->assertPattern($match, $name);
        }
    }
    */
}