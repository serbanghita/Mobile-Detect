<?php

namespace MobileDetect;
use MobileDetect\Data\PropertyLib;

/**
 * Class Device
 *
 * Defines properties for a particular device.
 */
class Device implements DeviceInterface
{
    /**
     * A list of required keys for the factory method.
     *
     * @var array
     */
    protected static $required = array(
        'type', 'user_agent', 'model', 'model_version', 'os', 'os_version', 'browser', 'browser_version', 'vendor',
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
     * The vendor name for this device.
     *
     * @var string
     */
    protected $vendor;

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
            if (!array_key_exists($key, $props)) {
                throw new Exception\InvalidDeviceSpecificationException("The '$key' property is required.");
            }
        }

        // check that a valid type was passed
        if ($props['type'] != Type::DESKTOP
            && $props['type'] != Type::MOBILE
            && $props['type'] != Type::TABLET
            && $props['type'] != Type::BOT
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
            $props['browser_version'],
            $props['vendor']
        );
    }

    public function __construct($userAgent, $type, $model, $modelVer, $os, $osVer, $browser, $browserVer, $vendor)
    {
        $this->userAgent                = $userAgent;
        $this->type                     = $type;
        $this->model                    = $model;
        $this->modelVersion             = $modelVer;
        $this->operatingSystem          = $os;
        $this->operatingSystemVersion   = $osVer;
        $this->browser                  = $browser;
        $this->browserVersion           = $browserVer;
        $this->vendor                   = $vendor;
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
        return $this->type == Type::MOBILE || $this->type == Type::TABLET;
    }

    public function isDesktop()
    {
        return $this->type == Type::DESKTOP;
    }

    public function isTablet()
    {
        return $this->type == Type::TABLET;
    }

    public function isBot()
    {
        return $this->type == Type::BOT;
    }

    public function toArray()
    {
        return array(
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

    /**
     * Retrieve a version for a specific property.
     *
     * @param $key string The version key, such as WebKey.
     *
     * @return string|null A string if the version if found, null otherwise.
     */
    public function getVersion($key)
    {
        $version = null;
        $cmp = strtolower($key);

        foreach (PropertyLib::getProperties() as $name => $patterns) {
            if ($cmp == strtolower($name)) {
                if (!is_array($patterns)) {
                    $patterns = array($patterns);
                }

                foreach ($patterns as $pattern) {
                    $pattern = MobileDetect::prepareRegex($pattern);
                    if (preg_match($pattern, $this->userAgent, $matches)) {
                        if (isset($matches['version'])) {
                            $version = $matches['version'];
                        }
                    }
                }

                return $version;
            }
        }

        return null;
    }
}
