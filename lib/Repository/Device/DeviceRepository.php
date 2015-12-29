<?php
namespace MobileDetect\Repository\Device;

use MobileDetect\Context;

class DeviceRepository
{
    protected $data;
    protected $context;

    public function __construct($data, Context $context)
    {
        $this->data = $data;
    }

    public function getFromVendor($vendorName)
    {
        return isset($this->data->{$vendorName}) ? $this->data->{$vendorName} : null;
    }

    public function getAll()
    {
        return $this->data;
    }

    public function search()
    {
        $device = new Device();

        foreach ($this->getAll() as $vendorKey => $itemData) {
            $device->reload($itemData);
            $result = DeviceMatcher::matchItem($device, $this->context);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }
}