<?php
namespace MobileDetect\Service;

use MobileDetect\Matcher\BrowserMatcher;
use MobileDetect\Repository\Browser\Browser;
use MobileDetect\Repository\Browser\BrowserRepository;

class DetectBrowserService extends AbstractService
{
    public function detect()
    {
        $result = $this->getResult();
        
        // Get model and version of the browser (if possible).
        $browserRepo = new BrowserRepository(new \stdClass());
        $browser = $browserRepo->search();

        if ($browser instanceof Browser) {
            $context->setBrowserModel($browser->getModel());
            $context->setBrowserVersion(BrowserMatcher::matchVersion($browser, $context));
            return true;
        }
        
        return false;
    }
}