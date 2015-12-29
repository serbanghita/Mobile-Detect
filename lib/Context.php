<?php
namespace MobileDetect;

use MobileDetect\Device\DeviceType;
use MobileDetect\Repository\Device\DeviceInterface;

class Context
{
    protected $userAgent = null;
    protected $device = null;
    protected $deviceType = DeviceType::DESKTOP;
    protected $deviceModel = null;
    protected $deviceModelVersion = null;
    protected $operatingSystemModel = null;
    protected $operatingSystemVersion = null;
    protected $browserModel = null;
    protected $browserVersion = null;
    protected $vendor = null;

    public function isMobile()
    {
        return DeviceType::MOBILE || DeviceType::TABLET;
    }

    /**
     * @return null
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param DeviceInterface $device
     * @return Context
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return null
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param null $userAgent
     * @return Context
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return null
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /**
     * @param null $deviceType
     * @return Context
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
        return $this;
    }

    /**
     * @return null
     */
    public function getDeviceModel()
    {
        return $this->deviceModel;
    }

    /**
     * @param null $deviceModel
     * @return Context
     */
    public function setDeviceModel($deviceModel)
    {
        $this->deviceModel = $deviceModel;
        return $this;
    }

    /**
     * @return null
     */
    public function getDeviceModelVersion()
    {
        return $this->deviceModelVersion;
    }

    /**
     * @param null $deviceModelVersion
     * @return Context
     */
    public function setDeviceModelVersion($deviceModelVersion)
    {
        $this->deviceModelVersion = $deviceModelVersion;
        return $this;
    }

    /**
     * @return null
     */
    public function getOperatingSystemModel()
    {
        return $this->operatingSystemModel;
    }

    /**
     * @param null $operatingSystemModel
     * @return Context
     */
    public function setOperatingSystemModel($operatingSystemModel)
    {
        $this->operatingSystemModel = $operatingSystemModel;
        return $this;
    }

    /**
     * @return null
     */
    public function getOperatingSystemVersion()
    {
        return $this->operatingSystemVersion;
    }

    /**
     * @param null $operatingSystemVersion
     * @return Context
     */
    public function setOperatingSystemVersion($operatingSystemVersion)
    {
        $this->operatingSystemVersion = $operatingSystemVersion;
        return $this;
    }

    /**
     * @return null
     */
    public function getBrowserModel()
    {
        return $this->browserModel;
    }

    /**
     * @param null $browserModel
     * @return Context
     */
    public function setBrowserModel($browserModel)
    {
        $this->browserModel = $browserModel;
        return $this;
    }

    /**
     * @return null
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * @param null $browserVersion
     * @return Context
     */
    public function setBrowserVersion($browserVersion)
    {
        $this->browserVersion = $browserVersion;
        return $this;
    }

    /**
     * @return null
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param null $vendor
     * @return Context
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }


}