<?php
namespace MobileDetect\Repository\Browser;

use MobileDetect\Matcher\Matcher;
use MobileDetect\Result\Result;

class BrowserRepository
{
    protected $data;
    protected $context;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function getSafariVersions()
    {
          return [];
    }
    
    public function getFamily($familyName)
    {
        return isset($this->data[$familyName]) ? $this->data[$familyName] : null;
    }

    public function getSafariVersion($version)
    {
        $versions = $this->getSafariVersions();
        return (isset($versions[$version])) ? $versions[$version] : null;
    }

    public function getAll()
    {
        return $this->data;
    }

    public function matchByUserAgent($userAgent, Result $result)
    {
        $browser = new Browser();

        foreach ($this->getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $browser->reload($itemData);
                $result = $this->matchItem($browser, $userAgent, $result);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
    }

    /**
     * @param Browser $item
     * @param $userAgent
     * @param Result $result
     * @return FALSE|Browser
     * @throws \Exception
     */
    protected function matchItem(Browser $item, $userAgent, Result $result)
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
                    if ($result->{$contextCondition[0]}() != $contextCondition[1]) {
                        continue 2;
                    }
                }
            }
            if (Matcher::match($matchIdentity['match'], $userAgent, $matchIdentity['matchType'])) {
                // Found the matching item.
                return $item;
            }
        }

        return false;
    }

    protected function matchVersion(Browser $browser, $userAgent)
    {
        $matchVersion = $browser->getMatchVersion();
        $version = Matcher::matchVersion($matchVersion, $userAgent);

        if (isset($matchVersion['matchProcessor']) && !is_null($version)) {
            $funcName = $matchVersion['matchProcessor'];
            if ($browserVersionDataFound = BrowserRepository::$funcName($version)) {
                return $browserVersionDataFound['version'];
            }
        }
        return $version;
    }
}