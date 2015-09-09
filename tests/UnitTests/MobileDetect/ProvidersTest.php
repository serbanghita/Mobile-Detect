<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;
use MobileDetect\Providers;

class ProvidersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function phoneAndTabledDevicesProvider()
    {
        $this->markTestSkipped('must be revisited.');

        $data = array();
        $phones = new Providers\Phones();

        foreach ($phones as $type => $spec) {
            $data[] = array($type, $spec);
        }

        $tablets = new Providers\Tablets();

        foreach ($tablets as $type => $spec) {
            $data[] = array($type, $spec);
        }

        return $data;
    }

    /**
     * Phone and Tablets devices have a valid format.
     * @dataProvider phoneAndTabledDevicesProvider
     */
    public function testPhoneAndTabletsDevicesHaveAValidFormat($device, $spec)
    {
        $this->assertInternalType('string', $device, 'The key should be a string');
        $this->assertArrayHasKey('vendor', $spec);
        $this->assertArrayHasKey('identityMatches', $spec);
        $this->assertArrayHasKey('modelMatches', $spec);

        if (array_key_exists('type', $spec)) {
            if (!in_array($spec['type'], MobileDetect::getKnownMatches())) {
                $this->fail(
                    sprintf('Not a valid "match" type: %s in %s', $spec['type'], $device)
                );
            }
        }

        $modelMatch = $spec['modelMatches'];
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