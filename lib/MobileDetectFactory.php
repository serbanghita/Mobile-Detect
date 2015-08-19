<?php
namespace MobileDetect;

use MobileDetect\Properties\RecognizedHeadersProperties;
use MobileDetect\Properties\UaHeadersProperties;

use MobileDetect\Data\Browsers;
use MobileDetect\Data\OperatingSystems;
use MobileDetect\Data\Phones;
use MobileDetect\Data\Tablets;

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
}