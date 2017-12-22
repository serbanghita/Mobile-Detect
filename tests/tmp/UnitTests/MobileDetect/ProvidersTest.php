<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;
use MobileDetect\Repository;

class ProvidersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function phoneAndTabledDevicesProvider()
    {
        $data = array();
        $phones = new Repository\PhoneRepository();

        foreach ($phones->getAll() as $type => $spec) {
            $data[] = array($type, $spec);
        }

        $tablets = new Repository\Tablets();

        foreach ($tablets->getAll() as $type => $spec) {
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
        $this->assertArrayHasKey('matchIdentity', $spec);
        $this->assertArrayHasKey('matchModelAndVersion', $spec);

        if (array_key_exists('type', $spec)) {
            if (!in_array($spec['type'], MobileDetect::getKnownMatches())) {
                $this->fail(
                    sprintf('Not a valid "match" type: %s in %s', $spec['type'], $device)
                );
            }
        }

        $modelMatch = $spec['matchModelAndVersion'];
        if (!is_array($modelMatch) && $modelMatch != '') {
            $this->fail(
                sprintf('Not a valid "modelMatch": %s in %s', $spec['modelMatch'], $device)
            );
        }
    }

    public function osBrowserProvider()
    {
        $data = array();

        $osGroup = new Repository\OperatingSystems();
        foreach ($osGroup->getAll() as $group => $os) {
            foreach ($os as $name => $spec) {
                $data[] = array($name, $spec);
            }
        }

        $browsers = new Repository\Browsers();
        foreach ($browsers as $group => $browser) {
            foreach ($browser as $name => $spec) {
                $data[] = array($name, $spec);
            }
        }

        return $data;
    }

    /**
     * OS and Browsers have a valid format.
     * @dataProvider osBrowserProvider
     */
    public function testOsAndBrowserIsValidFormat($name, $spec)
    {
        $this->assertInternalType('array', $spec);
        $this->assertArrayHasKey('isMobile', $spec);
        $this->assertInternalType('boolean', $spec['isMobile']);
        $this->assertArrayHasKey('matchIdentity', $spec);
        $this->assertArrayHasKey('versionMatches', $spec);
    }
}