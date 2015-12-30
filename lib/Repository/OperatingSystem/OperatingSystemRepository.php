<?php
namespace MobileDetect\Repository\OperatingSystem;

use MobileDetect\Context;

class OperatingSystemRepository
{
    protected $data;
    protected $context;

    public function __construct($data, Context $context)
    {
        $this->data = $data;
    }

    public function getFamily($familyName)
    {
        return isset($this->data[$familyName]) ? $this->data[$familyName] : null;
    }

    public function getAll()
    {
        return $this->data;
    }
    
    public function getAndroidVersions()
    {
        return [];
    }
    
    public function getAndroidVersion($version)
    {
        $versions = $this->getAndroidVersions();
        return (isset($versions[$version])) ? $versions[$version] : null;
    }

    public function getiOsVersions()
    {
        return [];
    }
    
    public function getiOsVersion($version)
    {
        $versions = $this->getiOsVersions();
        return (isset($versions[$version])) ? $versions[$version] : null;
    }

    public function getiOsSDKVersions()
    {
        return [];
    }

    public function getiOsSDKVersion($version)
    {
        $versions = $this->getiOsSDKVersions();
        return (isset($versions[$version])) ? $versions[$version] : null;
    }

    public function search()
    {
        $os = new OperatingSystem();

        foreach ($this->getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $os->reload($itemData);
                $result = OperatingSystemMatcher::matchItem($os, $this->context);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
    }
}