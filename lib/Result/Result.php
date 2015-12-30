<?php
namespace MobileDetect\Result;

use MobileDetect\Device\DeviceType;
use MobileDetect\Repository\Browser\BrowserInterface;
use MobileDetect\Repository\Device\DeviceInterface;
use MobileDetect\Repository\OperatingSystem\OperatingSystemInterface;

class Result implements ResultInterface
{
    protected $headers = [];
    protected $userAgent;
    
    /**
     * @var DeviceInterface
     */
    protected $device;
    /**
     * @var BrowserInterface
     */
    protected $browser;

    /**
     * @var OperatingSystemInterface
     */
    protected $operatingSystem;

    public function isMobile()
    {
        return $this->getDevice() instanceof DeviceInterface &&
        $this->getDevice()->getType() == DeviceType::MOBILE;
    }
    
    public function isTablet()
    {
        return $this->getDevice() instanceof DeviceInterface &&
        $this->getDevice()->getType() == DeviceType::TABLET;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Result
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param mixed $userAgent
     * @return Result
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param DeviceInterface $device
     * @return Result
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return BrowserInterface
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param BrowserInterface $browser
     * @return Result
     */
    public function setBrowser( BrowserInterface$browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * @return OperatingSystemInterface
     */
    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    /**
     * @param OperatingSystemInterface $operatingSystem
     * @return Result
     */
    public function setOperatingSystem(OperatingSystemInterface $operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }
    
    
}