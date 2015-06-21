<?php
namespace MobileDetect\Device;
use MobileDetect\MobileDetectContext;

/**
 * Class Device
 *
 * Defines properties for a particular device.
 */
class Device implements DeviceInterface
{
    /**
     * One of the TYPE_* constants.
     *
     * @var int
     */
    protected $type;

    /**
     * The 'User-Agent' header as a string.
     *
     * @var string
     */
    protected $userAgent;

    /**
     * The model of this device, such as Samsung, Chromebook, iPhone, or ...
     *
     * @var string
     */
    protected $model;

    /**
     * Version of the particular model, such as 5S for the iPhone 5S.
     *
     * @var string
     */
    protected $modelVersion;

    /**
     * The operating system, such as 'Windows' or 'iOS'.
     *
     * @var string
     */
    protected $operatingSystem;

    /**
     * The OS version.
     *
     * @var string
     */
    protected $operatingSystemVersion;

    /**
     * The browser. If this is a bot, then this value is populated with the bot identifier, such as
     * "facebookexternalhit" for Facebook crawling or "GoogleBot" for the Google.
     *
     * @var string
     */
    protected $browser;

    /**
     * The version of the browser (or bot crawler).
     *
     * @var string
     */
    protected $browserVersion;

    /**
     * The vendor name for this device.
     *
     * @var string
     */
    protected $vendor;

    public function __construct(MobileDetectContext $context)
    {
        $this->userAgent = $context->get('userAgent');
        $this->type = $context->get('deviceType');
        $this->model = $context->get('deviceModel');
        $this->modelVersion = $context->get('deviceModelVersion');
        $this->operatingSystem = $context->get('operatingSystemModel');
        $this->operatingSystemVersion = $context->get('operatingSystemVersion');
        $this->browser = $context->get('browserModel');
        $this->browserVersion = $context->get('browserVersion');
        $this->vendor = $context->get('vendor');
    }

    /**
     * Retrieves the type of device.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getModelVersion()
    {
        return $this->modelVersion;
    }

    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    public function getOperatingSystemVersion()
    {
        return $this->operatingSystemVersion;
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function isMobile()
    {
        return $this->type == DeviceType::MOBILE || $this->type == DeviceType::TABLET;
    }

    public function isDesktop()
    {
        return $this->type == DeviceType::DESKTOP;
    }

    public function isTablet()
    {
        return $this->type == DeviceType::TABLET;
    }

    public function isBot()
    {
        return $this->type == DeviceType::BOT;
    }

    public function toArray()
    {
        return array(
            'type'                      => $this->getType(),
            'isMobile'                  => $this->isMobile(),
            'isTablet'                  => $this->isTablet(),
            'isDesktop'                 => $this->isDesktop(),
            'isBot'                     => $this->isBot(),
            'browser'                   => $this->getBrowser(),
            'browserVersion'            => $this->getBrowserVersion(),
            'model'                     => $this->getModel(),
            'modelVersion'              => $this->getModelVersion(),
            'operatingSystem'           => $this->getOperatingSystem(),
            'operatingSystemVersion'    => $this->getOperatingSystemVersion(),
            'userAgent'                 => $this->getUserAgent(),
            'vendor'                    => $this->getVendor(),
        );
    }
}