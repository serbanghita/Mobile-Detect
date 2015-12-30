<?php
namespace MobileDetect\Repository\Device;

use MobileDetect\Matcher\Matcher;

class DeviceRepository
{
    protected $data;
    protected $context;

    public function __construct($data)
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

    /**
     * @param $userAgent
     * @return bool|DeviceInterface
     * @throws \Exception
     */
    public function matchByUserAgent($userAgent)
    {
        $device = new Device();

        foreach ($this->getAll() as $vendorKey => $itemData) {
            $device->reload($itemData);
            $result = $this->matchItem($device, $userAgent);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    /**
     * @param DeviceInterface $item
     * @param $userAgent
     * @return bool|DeviceInterface
     * @throws \Exception
     */
    protected function matchItem(DeviceInterface $item, $userAgent)
    {
        if (is_null($item->getVendor())) {
            throw new \Exception(
                sprintf('Invalid spec for item. Missing %s key.', 'vendor')
            );
        }

        if (is_null($item->getMatchIdentity())) {
            throw new \Exception(
                sprintf('Invalid spec for item. Missing %s key.', 'matchIdentity')
            );
        } elseif ($item->getMatchIdentity() === false) {
            // This is often case with vendors of phones that we
            // do not want to specifically detect, but we keep the record
            // for vendor matches purposes. (eg. Acer)
            return false;
        }

        if (Matcher::match($item->getMatchIdentity(), $userAgent, $item->getMatchType())) {
            // Found the matching item.
            return $item;
        }

        return false;
    }
}