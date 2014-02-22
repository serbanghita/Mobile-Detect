<?php

namespace DeviceLib;

/**
 * Class Device
 *
 * Defines properties for a particular device.
 */
class Device
{
    const TYPE_MOBILE           = 0;
    const TYPE_DESKTOP          = 1;
    const TYPE_TABLET           = 2;
    const TYPE_BOT              = 3;

    /**
     * A list of required keys for the factory method.
     *
     * @var array
     */
    protected static $required = array(
        'type', 'user_agent', 'model', 'model_version', 'os', 'os_version', 'browser', 'browser_version'
    );

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
     * @param array $props An array of properties to create this device from.
     *
     * @return Device The device instance.
     *
     * @throws Exception\InvalidDeviceSpecificationException When insufficient properties are present to
     *                                                       identify this device.
     */
    public static function create(array $props = array())
    {
        // ensure that all the required keys are present
        foreach (static::$required as $key) {
            if (!isset($props[$key])) {
                throw new Exception\InvalidDeviceSpecificationException("The '$key' property is required.");
            }
        }

        // check that a valid type was passed
        if ($props['type'] != static::TYPE_DESKTOP
            && $props['type'] != static::TYPE_MOBILE
            && $props['type'] != static::TYPE_TABLET
            && $props['type'] != static::TYPE_BOT
        ) {
            throw new Exception\InvalidDeviceSpecificationException("Unrecognized type: '{$props['type']}'");
        }

        // create a new instance
        return new static(
            $props['user_agent'],
            $props['type'],
            $props['model'],
            $props['model_version'],
            $props['os'],
            $props['os_version'],
            $props['browser'],
            $props['browser_version']
        );
    }

    public function __construct($userAgent, $type, $model, $modelVer, $os, $osVer, $browser, $browserVer)
    {
        $this->userAgent                = $userAgent;
        $this->type                     = $type;
        $this->model                    = $model;
        $this->modelVersion             = $modelVer;
        $this->operatingSystem          = $os;
        $this->operatingSystemVersion   = $osVer;
        $this->browser                  = $browser;
        $this->browserVersion           = $browserVer;
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
        return $this->browser;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function isMobile()
    {
        return $this->type == static::TYPE_MOBILE;
    }

    public function isDesktop()
    {
        return $this->type == static::TYPE_DESKTOP;
    }

    public function isTablet()
    {
        return $this->type == static::TYPE_TABLET;
    }

    public function isBot()
    {
        return $this->type == static::TYPE_BOT;
    }
}
