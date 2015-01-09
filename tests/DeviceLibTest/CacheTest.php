<?php

namespace DeviceLibTest;

use DeviceLib\Detector;
use DeviceLib\Device;
use DeviceLib\Type;

class CacheTest extends \PHPUnit_Framework_TestCase
{
    public function testInjectedCacheGetterAndIsCalledWhenDetecting()
    {
        $detect = new Detector();
        $wasCalled = false;

        $getter = function($key) use (&$wasCalled) {
            $wasCalled = $key;
        };

        $detect->setCacheGetter($getter);
        $detect->setUserAgent($ua = 'does not matter');
        $detect->detect();

        $this->assertSame($ua, $wasCalled);
    }

    public function testInjectedCacheSetterAndIsCalledWhenDetecting()
    {
        $detect = new Detector();
        $wasCalled = false;
        $savedObj = null;

        $setter = function($key, $obj) use (&$wasCalled, &$savedObj) {
            $wasCalled = $key;
            $savedObj = $obj;
        };

        $detect->setCacheSetter($setter);
        $detect->setUserAgent($ua = 'does not matter');
        $detect->detect();

        $this->assertSame($ua, $wasCalled);
    }

    public function testCachedDeviceIsActuallyUsed()
    {
        $detect = new Detector();
        $device = new Device('', Type::DESKTOP, '', '', '', '', '', '', '');
        $setter = function($key, $obj) { /* does not matter here */ };
        $getter = function($key) use (&$device) {
            return $device;
        };
        $detect->setCacheSetter($setter);
        $detect->setCacheGetter($getter);

        $detectedDevice = $detect->detect();
        $this->assertSame($device, $detectedDevice);
    }

    public function testSimpleInMemoryCache()
    {
        $detect = new Detector();
        $cache = array();
        $setterCalled = 0;
        $getterCalled = 0;
        $setter = function($key, $obj) use (&$cache, &$setterCalled) {
            $setterCalled++;
            $cache[$key] = serialize($obj);
            return true;
        };
        $getter = function($key) use (&$cache, &$getterCalled) {
            $getterCalled++;
            return isset($cache[$key]) ? unserialize($cache[$key]) : null;
        };

        $detect->setUserAgent($ua = 'horse/1.1');
        $detect->setCacheSetter($setter);
        $detect->setCacheGetter($getter);

        $detectedDevice = $detect->detect();
        $detectedDevice2 = $detect->detect();

        $this->assertEquals($detectedDevice, $detectedDevice2);

        $this->assertSame(1, $setterCalled, 'Setter should have been called once.');
        $this->assertSame(2, $getterCalled, 'Getter should have been called twice.');
    }
}
