<?php
namespace MobileDetect;

use MobileDetect\Data\BrowsersData;
use MobileDetect\Data\OperatingSystemsData;
use MobileDetect\Data\PhonesData;
use MobileDetect\Data\TabletsData;
use MobileDetect\Properties\RecognizedHeadersProperties;
use MobileDetect\Properties\UaHeadersProperties;

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
        return new BrowsersData();
    }

    public function createOperatingSystemsData()
    {
        return new OperatingSystemsData();
    }

    public function createPhonesData()
    {
        return new PhonesData();
    }

    public function createTabletsData()
    {
        return new TabletsData();
    }
}