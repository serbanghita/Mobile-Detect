<?php
namespace MobileDetect\Repository\OperatingSystem;

use MobileDetect\Context;
use MobileDetect\Matcher\Matcher;

class OperatingSystemMatcher
{
    /**
     * @param OperatingSystem $item
     * @param Context $context
     * @return FALSE|OperatingSystem
     * @throws \Exception
     */
    public static function matchItem(OperatingSystem $item, Context $context)
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

        foreach ($item->getMatchIdentity() as $matchIdentity) {
            // Check for context. If the context differs from the current one,
            // skip the matching regex and go to the next one.
            if (is_array($matchIdentity['context']) && !empty($matchIdentity['context'])) {
                foreach ($matchIdentity['context'] as $contextCondition) {
                    if ($context->{$contextCondition[0]}() != $contextCondition[1]) {
                        continue 2;
                    }
                }
            }
            if (Matcher::match($matchIdentity['match'], $context->getUserAgent(), $matchIdentity['matchType'])) {
                // Found the matching item.
                return $item;
            }
        }

        return false;
    }

    public static function matchVersion(OperatingSystem $os, Context $context)
    {
        $matchVersion = $os->getMatchVersion();
        $version = Matcher::matchVersion($matchVersion, $context->getUserAgent());

        if (isset($matchVersion['matchProcessor']) && !is_null($version)) {
            $funcName = $matchVersion['matchProcessor'];
            if ($browserVersionDataFound = OperatingSystemRepository::$funcName($version)) {
                return $browserVersionDataFound['version'];
            }
        }
        return $version;
    }
}