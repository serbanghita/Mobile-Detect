<?php

namespace MobileDetect;

use MobileDetect\Data\PropertyLib;

class MobileDetect
{
    /**
     * For static invocations of this class, this holds a singleton for those methods.
     *
     * @var MobileDetect
     */
    protected static $instance;

    /**
     * An instance of a device when using the static methods.
     *
     * @var DeviceInterface
     */
    protected static $device;

    /**
     * An optionally callable cache setter for attaching a caching implementation for caching the detection of a device.
     *
     * The expected signature:
     *      @param  $key        string      The key identifier (i.e. the User-Agent).
     *      @param  $obj        DeviceInterface the device being saved.
     *
     * @var \Closure
     */
    protected $cacheSet;

    /**
     * An optionally callable cache getter for attaching a caching implementation for caching the detection of a device.
     *
     * The expected signature:
     *     @param $key string The key identifier (i.e. the User-Agent).
     *     @return DeviceInterface|null
     *
     * @var \Closure
     */
    protected $cacheGet;

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
        'ua-cpu',
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
     * @return MobileDetect A single instance for using with the simple static API.
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function destroy()
    {
        static::$instance = null;
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
     * @return MobileDetect                       Fluent interface.
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
     * @return string                             The header, normalized, so HTTP_USER_AGENT becomes user-agent
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
     * @return MobileDetect Fluent interface.
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

        return $this;
    }

    /**
     * This method allows for static calling of methods that get proxied to the device methods. For example,
     * when calling Detected::getOperatingSystem() it will be proxied to static::$device->getOperatingSystem().
     * Since reflection is used in combination with call_user_func_array(), this method is relatively expensive
     * and should not be used if the developer cares about performance. This is merely a convenience method
     * for beginners using this detection library.
     *
     * @param string $method The method name being invoked.
     * @param array  $args   Arguments for the called method.
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

        if (method_exists(static::$device, $method)) {
            return call_user_func_array(array(static::$device, $method), $args);
        }

        //method not found, so yeah...
        throw new \BadMethodCallException(sprintf('No such method "%s" exists in Device class.', $method));
    }

    /**
     * Converts the quasi-regex into a full regex, replacing various common placeholders such
     * as [VER] or [MODEL].
     *
     * @param $regex string
     *
     * @return string
     */
    public static function prepareRegex($regex)
    {
        $regex = sprintf('/%s/i', addcslashes($regex, '/'));
        $regex = str_replace('[VER]', '(?<version>[0-9\._-]+)', $regex);
        $regex = str_replace('[MODEL]', '(?<model>[a-zA-Z0-9]+)', $regex);

        return $regex;
    }

    /**
     * Given a type of match, this method will check if a valid match is found.
     *
     * @param  string                             $type    The type {{@see static::$knownMatchTypes}}.
     * @param  string                             $test    The test subject.
     * @param  string                             $against The pattern (for regex) or substring (for str[i]pos).
     * @return bool                               True if matched successfully.
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
            throw new Exception\InvalidArgumentException('Invalid type passed: '.gettype($against));
        }

        if ($type == 'regex') {
            if (preg_match(static::prepareRegex($test), $against)) {
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

    /**
     * @param $version string The string to convert to a standard version.
     *
     * @param bool $asArray
     *
     * @return array|string A string or an array if $asArray is passed as true.
     */
    protected function versionPrepare($version, $asArray = false)
    {
        $version = str_replace('_', '.', $version);

        if ($asArray) {
            return explode('.', $version);
        } else {
            return $version;
        }
    }

    /**
     * An error handler that gets registered to watch only for regex errors and convert
     * to an exception.
     *
     * @param $code int
     * @param $msg string
     * @param $file string
     * @param $line int
     * @param $context array
     *
     * @return bool False to indicate this is not a regex error to be handled.
     *
     * @throws Exception\RegexCompileException When there is a regex error.
     */
    public function regexErrorHandler($code, $msg, $file, $line, $context)
    {
        if (strpos($msg, 'preg_') !== 0) {
            // we only want to deal with preg match errors
            return false;
        }

        throw new Exception\RegexCompileException($msg, $code, $file, $line, $context);
    }

    /**
     * Attempts to match the model.
     *
     * @param $modelMatch array Various tests.
     * @param $against string The test.
     *
     * @return array|bool False if no match, hash of match data otherwise.
     */
    protected function modelMatch($modelMatch, $against)
    {
        //model match must be an array
        if (!is_array($modelMatch) || !count($modelMatch)) {
            return false;
        }

        // graceful handling of pcre errors
        set_error_handler(array($this, 'regexErrorHandler'));

        $matchReturn = array();

        foreach ($modelMatch as $test) {
            $regex = static::prepareRegex($test);

            if (preg_match($regex, $against, $matches)) {
                if (isset($matches['version'])) {
                    $matchReturn['version'] = $this->versionPrepare($matches['version']);
                }

                if (isset($matches['model'])) {
                    $matchReturn['model'] = $matches['model'];
                }
            }
        }

        // restore previous
        restore_error_handler();

        return $matchReturn;
    }

    /**
     * Detect and retrieve a hash of data against an array of device specs..
     *
     * @param $devices array An array of device definitions.
     *
     * @return array|bool False if no match, hash of matched data otherwise.
     *
     * @throws Exception\InvalidDeviceSpecificationException If the device array is invalid.
     */
    protected function detectDevice(array $devices)
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

    /**
     * Attempts to detect whether or not this is a phone device.
     *
     * @see MobileDetect::detectDevice
     *
     * @return array|bool
     */
    protected function detectPhoneDevice()
    {
        return $this->detectDevice(Data\PropertyLib::getPhoneDevices());
    }

    /**
     * Attempts to detect whether or not this is a tablet device.
     *
     * @see MobileDetect::detectDevice
     *
     * @return array|bool
     */
    protected function detectTabletDevice()
    {
        return $this->detectDevice(Data\PropertyLib::getTabletDevices());
    }

    /**
     * Detect a device based on a grouped spec.
     *
     * @param $families array Array of groups of device specs, such as OS's and browsers.
     *
     * @return array
     */
    protected function detectFamily($families)
    {
        foreach ($families as $family => $group) {
            foreach ($group as $name => $item) {
                //check type, and assume regex if not present
                if (!isset($item['type'])) {
                    $item['type'] = 'regex';
                }

                if (!isset($item['match'])) {
                    throw new Exception\InvalidDeviceSpecificationException(
                        sprintf('Invalid spec for %s. Missing %s key.', $name, 'match')
                    );
                }

                if (!isset($item['isMobile'])) {
                    throw new Exception\InvalidDeviceSpecificationException(
                        sprintf('Invalid spec for %s. Missing %s key.', $name, 'isMobile')
                    );
                }

                if ($this->matches($item['type'], $item['match'], $this->getUserAgent())) {
                    $match = array();

                    if (isset($item['versionMatch'])) {
                        $match['version_match'] = $this->modelMatch($item['versionMatch'], $this->getUserAgent());
                    }

                    $match['family'] = $family;
                    $match['name'] = $name;
                    $match['is_mobile'] = $item['isMobile'];

                    return $match;
                }
            }
        }
    }

    /**
     * Detect the operating system.
     *
     * @return array|void A hash if matched.
     */
    protected function detectOperatingSystem()
    {
        $match = $this->detectFamily(Data\PropertyLib::getOperatingSystems());
        if (!$match) {
            return;
        }

        if (isset($match['name'])) {
            $match['os'] = $match['name'];
            unset($match['name']);
        }

        return $match;
    }

    /**
     * Detect the browser.
     *
     * @return array|void A hash if matched.
     */
    protected function detectBrowser()
    {
        $match = $this->detectFamily(Data\PropertyLib::getBrowsers());
        if (!$match) {
            return;
        }

        if (isset($match['name'])) {
            $match['browser'] = $match['name'];
            unset($match['name']);
        }

        return $match;
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
        if ($class) {
            if (!is_subclass_of($class, __NAMESPACE__.'\DeviceInterface')) {
                throw new Exception\InvalidArgumentException(
                    sprintf('Invalid class specified: %s. Must', is_object($class) ? get_class($class) : $class)
                );
            }
        } else {
            // default implementation
            $class = __NAMESPACE__.'\\Device';
        }

        if (($cached = $this->getFromCache($this->getUserAgent()))) {
            //make sure it's also of type that's requested
            if (is_subclass_of($cached, $class) || (is_object($cached) && $cached instanceof DeviceInterface)) {
                return $cached;
            }
        }

        $props = array();

        if ($model = $this->detectPhoneDevice()) {
            $props['type'] = Type::MOBILE;
        }
        if ($model = $this->detectTabletDevice()) {
            $props['type'] = Type::TABLET;
        }

        $os = $this->detectOperatingSystem();
        $props['os'] = $os['os'];
        $props['os_version'] = isset($os['version_match']['version']) ? $os['version_match']['version'] : null;

        //sometimes only the OS tells us that this device is mobile IF we haven't previously detected this
        if (!isset($props['type'])) {
            if ($os['is_mobile']) {
                $props['type'] = Type::MOBILE;
            }
        }

        $browser = $this->detectBrowser();
        $props['browser'] = $browser['browser'];
        $props['browser_version'] = isset($browser['version_match']['version']) ?
            $browser['version_match']['version'] : null;

        //again, set the type if not already detected by mobile, tablet, or os detection
        if (!isset($props['type'])) {
            if ($browser['is_mobile']) {
                $props['type'] = Type::MOBILE;
            }
        }

        if (!isset($props['type'])) {
            $props['type'] = Type::DESKTOP;
        }

        $props['model'] = $model['model'];
        $props['model_version'] = isset($model['model_match']['version']) ? $model['model_match']['version'] : null;
        $props['vendor'] = $model['vendor'];

        $props['user_agent'] = $this->getUserAgent();

        $device = $class::create($props);
        $this->setCache($props['user_agent'], $device);

        return $device;
    }

    /**
     * Set the cache setter lambda.
     *
     * @param \Closure $cb
     *
     * @return MobileDetect
     */
    public function setCacheSetter(\Closure $cb)
    {
        $this->cacheSet = $cb;

        return $this;
    }

    /**
     * Set the cache getter lambda.
     *
     * @param \Closure $cb
     *
     * @return $this
     */
    public function setCacheGetter(\Closure $cb)
    {
        $this->cacheGet = $cb;

        return $this;
    }

    /**
     * Try to get the device from cache if available.
     *
     * @param $key string The key.
     *
     * @return DeviceInterface|null
     */
    public function getFromCache($key)
    {
        if (is_callable($this->cacheGet)) {
            $cb = $this->cacheGet;

            return $cb($key);
        }

        return;
    }

    /**
     * Try to save the detected device in cache.
     *
     * @param $key string The key.
     * @param DeviceInterface $obj The device.
     *
     * @return bool false if not succeeded.
     */
    public function setCache($key, DeviceInterface $obj)
    {
        if (is_callable($this->cacheSet)) {
            $cb = $this->cacheSet;

            return $cb($key, $obj);
        }

        return false;
    }
}
