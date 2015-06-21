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
     * @param MobileDetectContext $context An array of properties to create this device from.
     *
     * @return Device The device instance.
     *
     * @throws InvalidDeviceSpecificationException When insufficient properties are present to
     *                                                       identify this device.
     */
    public function createDeviceFromContext(MobileDetectContext $context)
    {
        // ensure that all the required keys are present
        foreach ($context::$required as $key) {
            if (null === $context->get($key)) {
                throw new InvalidDeviceSpecificationException(sprintf('The %s property is required.', $key));
            }
        }

        // check that a valid type was passed
        if ($context->get('deviceType') != DeviceType::DESKTOP
            && $context->get('deviceType') != DeviceType::MOBILE
            && $context->get('deviceType') != DeviceType::TABLET
            && $context->get('deviceType') != DeviceType::BOT
        ) {
            throw new InvalidDeviceSpecificationException(
                sprintf("Unrecognized type: '%s'", $context->get('deviceType'))
            );
        }

        // create a new instance
        return new Device($context);
    }
}