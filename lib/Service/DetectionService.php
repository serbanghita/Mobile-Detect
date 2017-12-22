<?php
namespace MobileDetect\Service;

use MobileDetect\Http\Request;
use MobileDetect\Result\Context;

class DetectionService
{
    protected $request;
    protected $context;
    protected $hardwareService;
    protected $browserService;
    protected $osService;
    protected $device;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->context = new Context($request);
    }

    public function identifyDevice()
    {
        $this->hardwareService = new HardwareService($this->input);
        $this->browserService = new BrowserService($this->input, $this->context);
        $this->osService = new OsService($this->input, $this->context);

        $device = new Device();
        $device->setHardware(HardwareItem);
        $device->setBrowser(BrowserItem);
        $device->setOs(OsItem);

        return $device;
    }

}
