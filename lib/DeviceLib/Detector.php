<?php

namespace DeviceLib;

use DeviceLib\Data\PropertyLib;

class Detector {

    /**
     * For static invocations of this class, this holds a singleton for those methods.
     *
     * @var Detector
     */
    protected static $instance;

    /**
     * An instance of a device when using the static methods.
     *
     * @var DeviceInterface
     */
    protected static $device;

    protected static $knownMatchTypes = array(
        'regex', //regular expression
        'strpos', //simple case-sensitive string within string check
        'stripos', //simple case-insensitive string within string check
    );

    /**
     * A list of possible HTTP Request headers.
     *
     * @var array
     */
    protected static $requestHeaders = array(
        'accept',
        'accept-charset',
        'accept-encoding',
        'accept-language',
        'accept-datetime',
        'authorization',
        'cache-control',
        'connection',
        'cookie',
        'content-length',
        'content-md5',
        'content-type',
        'date',
        'expect',
        'from',
        'host',
        'permanent',
        'if-match',
        'if-modified-since',
        'if-none-match',
        'if-range',
        'if-unmodified-since',
        'max-forwards',
        'origin',
        'pragma',
        'proxy-authorization',
        'range',
        'referer',
        'te',
        'upgrade',
        'user-agent',
        'via',
        'warning',
        //not so standard, but since they don't start with 'x', they need to be present
        'device-stock-ua',
        'wap-connection',
        'profile',
        'ua-os',
        'ua-cpu'
    );

    /**
     * An associative array of headers in standard format. So the keys will be "User-Agent", and "Accepts" versus
     * the all caps PHP format.
     *
     * @var array
     */
    protected $headers = array();

    /**
     * Generates or gets a singleton for use with the simple API.
     *
     * @return Detector A single instance for using with the simple static API.
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * @param $headers \Iterator|array|string When it's a string, it's assumed to be User-Agent.
     */
    public function __construct($headers = null)
    {
        if (is_string($headers)) {
            $headers = array('User-Agent' => $headers);
        }

        //when no headers are provided, get them from _SERVER super global
        if ($headers === null) {
            $headers = $_SERVER;
        }

        if ($headers instanceof \Iterator) {
            $headers = iterator_to_array($headers, true);
        }

        //load up the headers
        foreach ($headers as $key => $value) {
            try {
                $standardKey = $this->standardizeHeader($key);
                $this->headers[$standardKey] = $value;
            } catch (Exception\InvalidArgumentException $e) {
                //ignore this key and move on
                continue;
            }
        }

        //when no param is passed, it is detected based on all available headers
        $this->setUserAgent();
    }

    /**
     * Retrieves a header.
     *
     * @param $key string The header.
     * @return string|null If the header is available, it's returned. Null otherwise.
     */
    public function getHeader($key)
    {
        //normalized since access might be with a variety of cases
        $key = strtolower($key);
        return isset($this->headers[$key]) ? $this->headers[$key] : null;
    }

    /**
     * Set an HTTP header.
     *
     * @param $key
     * @param $value
     * @return Detector Fluent interface.
     * @throws Exception\InvalidArgumentException When the $key isn't a valid HTTP request header name.
     */
    public function setHeader($key, $value)
    {
        $key = $this->standardizeHeader($key);
        $this->headers[$key] = trim($value);
        return $this;
    }

    /**
     * Retrieves the user agent header.
     *
     * @return null|string The value or null if it doesn't exist.
     */
    public function getUserAgent()
    {
        return $this->getHeader('User-Agent');
    }

    /**
     * @param $headerName string
     * @param $force bool Forces the header set even if it's not standard or doesn't start with "X-"
     * @return string The header, normalized, so HTTP_USER_AGENT becomes user-agent
     * @throws Exception\InvalidArgumentException When the $headerName isn't a valid HTTP request header name.
     */
    protected function standardizeHeader($headerName, $force = false)
    {
        if (strpos($headerName, 'HTTP_') === 0) {
            $headerName = substr($headerName, 5);
            $headerBits = explode('_', $headerName);

            $headerName = implode('-', $headerBits);
        }

        //all lower case to make it easier to find later
        $headerName = strtolower($headerName);

        //check for non-extension headers that are not standard
        if (!$force && $headerName[0] != 'x' && !in_array($headerName, static::$requestHeaders)) {
            throw new Exception\InvalidArgumentException("The request header $headerName isn't a recognized HTTP header name");
        }

        return $headerName;
    }

    /**
     * Set the User-Agent to be used.
     *
     * @param string $userAgent The user agent string to set.
     *
     * @return Detector Fluent interface.
     */
    public function setUserAgent($userAgent = null)
    {
        if ($userAgent) {
            $this->headers['user-agent'] = trim($userAgent);
            return $this;
        }

        $ua = array();
        foreach (PropertyLib::getUaHttpHeaders() as $altHeader) {
            if ($header = $this->getHeader($altHeader)) {
                $ua[] = $header;
            }
        }

        if (count($ua)) {
            $this->headers['user-agent'] = implode(' ', $ua);
        }

        return $this->getHeader('User-Agent');
    }

    /**
     * Check if the current device is mobile.
     *
     * @return bool
     */
    public static function isMobile()
    {
        if (!static::$device) {
            static::$device = static::getInstance()->detect();
        }

        return static::$device->isMobile();
    }

    /**
     * Check if the current device is a tablet.
     *
     * @return bool
     */
    public static function isTablet()
    {
        if (!static::$device) {
            static::$device = static::getInstance()->detect();
        }

        return static::$device->isTablet();
    }

    /**
     * This method allows for static calling of methods that get proxied to the device methods. For example,
     * when calling Detected::getOperatingSystem() it will be proxied to static::$device->getOperatingSystem().
     * Since reflection is used in combination with call_user_func_array(), this method is relatively expensive
     * and should not be used if the developer cares about performance. This is merely a convenience method
     * for beginners using this detection library.
     *
     * @param string $method The method name being invoked.
     * @param array $args Arguments for the called method.
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public static function __callStatic($method, array $args = array())
    {
        //this method must exist as an instance method on self::$device
        if (!static::$device) {
            static::$device = static::getInstance()->detect();
        }

        $refl = new \ReflectionObject(static::$device);
        foreach ($refl->getMethods(\ReflectionMethod::IS_PUBLIC) as $deviceMethod) {
            /** @var \ReflectionMethod $deviceMethod */
            if ($method == $deviceMethod->getName()) {
                return call_user_func_array(array(static::$device, $method), $args);
            }
        }

        //no methods found, so throw
        throw new \BadMethodCallException();
    }

    // static getters for properties
    public static function getBrowser(){}

    protected function prepareRegex($regex)
    {
        //add boundaries
        $regex = sprintf('/%s/i', $regex);

        $regex = str_replace('[VER]', '(?<version>[0-9\._-]+)', $regex);
        $regex = str_replace('[MODEL]', '(?<model>[a-zA-Z0-9]+)', $regex);

        return $regex;
    }

    /**
     * Given a type of match, this method will check if a valid match is found.
     *
     * @param string $type The type {{@see static::$knownMatchTypes}}.
     * @param string $test The test subject.
     * @param string $against The pattern (for regex) or substring (for str[i]pos).
     * @return bool True if matched successfully.
     * @throws Exception\InvalidArgumentException If $against isn't a string or $type is invalid.
     */
    protected function matches($type, $test, $against)
    {
        if (!in_array($type, static::$knownMatchTypes)) {
            throw new Exception\InvalidArgumentException(
                sprintf('Unknown match type: %s', $type)
            );
        }

        //always take an array
        if (!is_string($against)) {
            throw new Exception\InvalidArgumentException('Invalid type passed: ' . gettype($against));
        }

        if ($type == 'regex') {
            if (preg_match($this->prepareRegex($test), $against)) {
                return true;
            }
        } elseif ($type == 'strpos') {
            if (false !== strpos($against, $test)) {
                return true;
            }
        } elseif ($type == 'stripos') {
            if (false !== stripos($against, $test)) {
                return true;
            }
        }

        return false;
    }

    protected function versionPrepare($version, $asArray = false)
    {
        $version = str_replace('_', '.', $version);

        if ($asArray) {
            return explode('.', $version);
        } else {
            return $version;
        }
    }

    protected function modelMatch($modelMatch, $against)
    {
        //model match must be an array
        if (!is_array($modelMatch) || !count($modelMatch)) {
            return false;
        }

        $matchReturn = array();

        foreach ($modelMatch as $test) {
            $regex = $this->prepareRegex($test);

            if (preg_match($regex, $against, $matches)) {
                if (isset($matches['version'])) {
                    $matchReturn['model_version'] = $this->versionPrepare($matches['version']);
                }

                if (isset($matches['model'])) {
                    $matchReturn['model'] = $matches['model'];
                }
            }
        }

        return $matchReturn;
    }

    protected function detectDevice($devices)
    {
        foreach ($devices as $vendorKey => $vendor) {
            //check type, and assume regex if not present
            if (!isset($vendor['type'])) {
                $vendor['type'] = 'regex';
            }

            if (!isset($vendor['match'])) {
                throw new Exception\InvalidDeviceSpecificationException(
                    sprintf('Invalid spec for %s. Missing %s key.', $vendorKey, 'match')
                );
            }

            if (!isset($vendor['vendor'])) {
                throw new Exception\InvalidDeviceSpecificationException(
                    sprintf('Invalid spec for %s. Missing %s key.', $vendorKey, 'vendor')
                );
            }

            if ($this->matches($vendor['type'], $vendor['match'], $this->getUserAgent())) {
                $match = array();

                if (isset($vendor['modelMatch'])) {
                    $match['model_match'] = $this->modelMatch($vendor['modelMatch'], $this->getUserAgent());
                }

                $match['model'] = $vendorKey;
                $match['vendor'] = $vendor['vendor'];
                return $match;
            }
        }

        return false;
    }

    protected function detectPhoneDevice()
    {
        return $this->detectDevice(Data\PropertyLib::getPhoneDevices());
    }

    protected function detectTabletDevice()
    {
        return $this->detectDevice(Data\PropertyLib::getTabletDevices());
    }



    /**
     * Creates a device with all the necessary context to determine all the given
     * properties of a device, including OS, browser, and any other context-based properties.
     *
     * @param string $class (optional) The class to use. It can be anything that's derived from DeviceInterface.
     *
     * {@see DeviceInterface}
     *
     * @return DeviceInterface
     *
     * @throws Exception\InvalidArgumentException When an invalid class is used.
     */
    public function detect($class = null)
    {
        if ($class && !is_subclass_of($class, __NAMESPACE__ . '\DeviceInterface')) {
            throw new Exception\InvalidArgumentException(
                sprintf('Invalid class specified: %s. Must', is_object($class) ? get_class($class) : $class)
            );
        } else {
            //default class
            $class = 'Device';
        }

        $props = array();

        // @todo do the detection here
        $model = $this->detectPhoneDevice();
        $type = Type::MOBILE;

        if (!$model) {
            $model = $this->detectTabletDevice();
            $type = Type::TABLET;
        }

        if (!$model) {
            $type = Type::DESKTOP;
        }

        //#1 detect: phone OR tablet OR ...?
        //#2 detect: browser?
        //#3 detect: OS

        /*
         * This would happen after the detection
         *
         * $device = $class::create(array(
         *      'user_agent' => $this->getUserAgent(),
         *      ...
         *      ...
         * ));
         *
         * return $device;
         */

        //@todo this is just for PHPStorm not to complain during dev
        return $class::create($props);
    }
}
