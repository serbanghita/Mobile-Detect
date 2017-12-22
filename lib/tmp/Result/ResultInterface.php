<?php
namespace MobileDetect\Result;

use MobileDetect\Repository\Browser\BrowserInterface;
use MobileDetect\Repository\Device\DeviceInterface;
use MobileDetect\Repository\OperatingSystem\OperatingSystemInterface;

interface ResultInterface
{
    public function setHeaders(array $headers);
    public function getHeaders();
    public function setUserAgent($userAgent);
    public function getUserAgent();
    
    public function isMobile();
    public function isTablet();
    
    public function setDevice(DeviceInterface $device);
    public function getDevice();
    
    public function setBrowser(BrowserInterface $browser);
    public function getBrowser();
    
    public function setOperatingSystem(OperatingSystemInterface $os);
    public function getOperatingSystem();
}