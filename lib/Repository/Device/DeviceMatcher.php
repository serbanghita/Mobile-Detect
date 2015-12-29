<?php
namespace MobileDetect\Repository\Device;

use MobileDetect\Context;
use MobileDetect\Matcher\Matcher;

class DeviceMatcher
{
    public static function matchItem(DeviceInterface $item, Context $context)
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

        if (Matcher::match($item->getMatchIdentity(), $context->getUserAgent(), $item->getMatchType())) {
            // Found the matching item.
            return $item;
        }

        return false;
    }
}