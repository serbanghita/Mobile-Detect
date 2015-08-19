<?php
namespace MobileDetect\Device;
use MobileDetect\Exception\InvalidDeviceSpecificationException;

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
    public static $requiredFields = array(
        'deviceType',
        'userAgent'
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
    
    public function __construct(
        $userAgent,
        $deviceType, $deviceModel, $deviceModelVersion,
        $operatingSystemModel, $operatingSystemVersion,
        $browserModel, $browserVersion,
        $vendor
    )
    {
        $this->userAgent = $userAgent;
        $this->type = $deviceType;
        $this->model = $deviceModel;
        $this->modelVersion = $deviceModelVersion;
        $this->operatingSystem = $operatingSystemModel;
        $this->operatingSystemVersion = $operatingSystemVersion;
        $this->browser = $browserModel;
        $this->browserVersion = $browserVersion;
        $this->vendor = $vendor;
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

    /**
     * @param array $prop   An array of properties to create this device from.
     * @return Device The device instance.
     * @throws InvalidDeviceSpecificationException When insufficient properties are present to
     *                                                       identify this device.
     */
    public static function create(array $prop)
    {
        // ensure that all the required keys are present
        foreach (self::$requiredFields as $key) {
            if (!isset($prop[$key])) {
                throw new InvalidDeviceSpecificationException(sprintf('The %s property is required.', $key));
            }
        }

        // check that a valid type was passed
        if ($prop['deviceType'] != DeviceType::DESKTOP
            && $prop['deviceType'] != DeviceType::MOBILE
            && $prop['deviceType'] != DeviceType::TABLET
            && $prop['deviceType'] != DeviceType::BOT
        ) {
            throw new InvalidDeviceSpecificationException(
                sprintf("Unrecognized type: '%s'", $prop['deviceType'])
            );
        }

        // create a new instance
        return new static(
            $prop['userAgent'],
            $prop['deviceType'], $prop['deviceModel'], $prop['deviceModelVersion'],
            $prop['operatingSystemModel'], $prop['operatingSystemVersion'],
            $prop['browserModel'], $prop['browserVersion'],
            $prop['vendor']
        );
    }
}