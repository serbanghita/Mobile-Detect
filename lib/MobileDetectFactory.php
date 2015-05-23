<?php
namespace MobileDetect;

use MobileDetect\Device\Device;
use MobileDetect\Properties\RecognizedHeadersProperties;
use MobileDetect\Properties\UaHeadersProperties;

use MobileDetect\Data\Browsers;
use MobileDetect\Data\OperatingSystems;
use MobileDetect\Data\Phones;
use MobileDetect\Data\Tablets;

use MobileDetect\Device\DeviceType;

use MobileDetect\Exception\InvalidDeviceSpecificationException;


class MobileDetectFactory
{
    public function createUaHeadersProperties()
    {
        return new UaHeadersProperties();
    }

    public function createRecognizedHeadersProperties()
    {
        return new RecognizedHeadersProperties();
    }

    public function createBrowsersData()
    {
        return new Browsers();
    }

    public function createOperatingSystemsData()
    {
        return new OperatingSystems();
    }

    public function createPhonesData()
    {
        return new Phones();
    }

    public function createTabletsData()
    {
        return new Tablets();
    }

    public function createContext()
    {
        return new MobileDetectContext();
    }

    /**
     * @param array $props An array of properties to create this device from.
     *
     * @return Device The device instance.
     *
     * @throws InvalidDeviceSpecificationException When insufficient properties are present to
     *                                                       identify this device.
     */
    public function createDeviceFromContext(array $props = array())
    {
        // ensure that all the required keys are present
        foreach (Device::$required as $key) {
            if (!array_key_exists($key, $props)) {
                throw new InvalidDeviceSpecificationException(sprintf('The %s property is required.', $key));
            }
        }

        // check that a valid type was passed
        if ($props['type'] != DeviceType::DESKTOP
            && $props['type'] != DeviceType::MOBILE
            && $props['type'] != DeviceType::TABLET
            && $props['type'] != DeviceType::BOT
        ) {
            throw new InvalidDeviceSpecificationException(sprintf("Unrecognized type: '%s'", $props['type']));
        }

        // create a new instance
        return new Device(
            $props['userAgent'],
            $props['type'],
            $props['model'],
            $props['modelVersion'],
            $props['operatingSystem'],
            $props['operatingSystemVersion'],
            $props['browser'],
            $props['browserVersion'],
            $props['vendor']
        );
    }
}