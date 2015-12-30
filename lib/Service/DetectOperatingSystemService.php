<?php
namespace MobileDetect\Service;

use MobileDetect\Context;
use MobileDetect\Repository\OperatingSystem\OperatingSystem;
use MobileDetect\Repository\OperatingSystem\OperatingSystemMatcher;
use MobileDetect\Repository\OperatingSystem\OperatingSystemRepository;

class DetectOperatingSystemService
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    protected function getContext()
    {
        return $this->context;
    }
    
    public function detect()
    {
        $context = $this->getContext();

        // Get model and version of the browser (if possible).
        $osRepo = new OperatingSystemRepository(new \stdClass(), $context);
        $os = $osRepo->search();

        if ($os instanceof OperatingSystem) {
            $context->setOperatingSystemModel($os->getModel());
            $context->setOperatingSystemVersion(OperatingSystemMatcher::matchVersion($os, $context));
            return true;
        }

        return false;
    }
}