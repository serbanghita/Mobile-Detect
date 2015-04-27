<?php
namespace MobileDetect;

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
}