<?php
/**
 * Mobile Detect Library
 * =====================
 *
 * Motto: "Every business should have a mobile detection script to detect mobile readers"
 *
 * Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
 * It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.
 *
 *              Current authors (2.x - 3.x)
 * @author      Serban Ghita <serbanghita@gmail.com>
 * @author      Nick Ilyin <nick.ilyin@gmail.com>
 *
 *              Original author (1.0)
 * @author      Victor Stanciu <vic.stanciu@gmail.com>
 *
 * @license     Code and contributions have 'MIT License'
 *              More details: https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 *
 * @link        Homepage:     http://mobiledetect.net
 *              GitHub Repo:  https://github.com/serbanghita/Mobile-Detect
 *              Google Code:  http://code.google.com/p/php-mobile-detect/
 *              README:       https://github.com/serbanghita/Mobile-Detect/blob/master/README.md
 *              Examples:     https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
 *
 * @version     3.0.0-alpha
 */
namespace MobileDetect;

use MobileDetect\Device\DeviceInterface;
use MobileDetect\Exception\InvalidArgumentException;
use MobileDetect\Repository\Browser\Browser;
use MobileDetect\Repository\Browser\BrowserRepository;
use MobileDetect\Repository\Device\DeviceMatcher;
use MobileDetect\Repository\Device\PhoneRepository;
use MobileDetect\Repository\Tablet\TabletRepository;
use Psr\Http\Message\MessageInterface as HttpMessageInterface;
use MobileDetect\Repository\UserAgentHeaders;
use MobileDetect\Repository\HttpHeaders;
use MobileDetect\Device\DeviceType;

class MobileDetect
{
    const VERSION = '3.0.0-alpha';
    
    /**
     * An associative array of headers in standard format.
     * So the keys will be "User-Agent", and "Accepts" versus
     * the all caps PHP format.
     *
     * @var array
     */
    protected $headers = array();

    // Database.
    protected $userAgentHeaders;
    protected $recognizedHttpHeaders;

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
     * @param $headers \Iterator|array|HttpMessageInterface|string When it's a string, it's assumed to be User-Agent.
     * @param UserAgentHeaders $userAgentHeaders
     * @param HttpHeaders $recognizedHttpHeaders
     */
    public function __construct(
        $headers = null,
        UserAgentHeaders $userAgentHeaders = null,
        HttpHeaders $recognizedHttpHeaders = null
    ) {

        if (!$userAgentHeaders) {
            $userAgentHeaders = new UserAgentHeaders;
        }

        if (!$recognizedHttpHeaders) {
            $recognizedHttpHeaders = new HttpHeaders;
        }

        $this->userAgentHeaders = $userAgentHeaders;
        $this->recognizedHttpHeaders = $recognizedHttpHeaders;

        //parse the various types of headers we could receive
        if ($headers instanceof HttpMessageInterface) {
            $headers = $headers->getHeaders();
        } elseif ($headers instanceof \Iterator) {
            $headers = iterator_to_array($headers, true);
        } elseif (is_string($headers)) {
            $headers = array('User-Agent' => $headers);
        } elseif ($headers === null) {
            $headers = static::getHttpHeadersFromEnv();
        } elseif (!is_array($headers)) {
            throw new InvalidArgumentException(sprintf('Unexpected headers argument type=%s', gettype($headers)));
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

        // When no param is passed, it is detected
        // based on all available headers.
        $this->setUserAgent();
    }

    /**
     * Makes a best attempt at extracting headers, starting with Apache then trying $_SERVER super global.
     *
     * @return array
     */
    public static function getHttpHeadersFromEnv()
    {
        if (function_exists('getallheaders')) {
            return getallheaders();
        } elseif (function_exists('apache_request_headers')) {
            return apache_request_headers();
        } elseif (isset($_SERVER)) {
            return $_SERVER;
        }

        return array();
    }

    /**
     * Set the User-Agent to be used.
     * @param string $userAgent The user agent string to set.
     * @return MobileDetect Fluent interface.
     */
    public function setUserAgent($userAgent = null)
    {
        if ($userAgent) {
            $this->headers['user-agent'] = trim($userAgent);

            return $this;
        }

        $ua = array();

        foreach ($this->userAgentHeaders->getAll() as $altHeader) {
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

    public function getHeaders()
    {
        return $this->headers;
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
        if (!$force && $headerName[0] != 'x' && !in_array($headerName, $this->recognizedHttpHeaders->getAll())) {
            throw new Exception\InvalidArgumentException(
                sprintf("The request header %s isn't a recognized HTTP header name", $headerName)
            );
        }

        return $headerName;
    }

    /**
     * Retrieves the user agent header.
     * @return null|string The value or null if it doesn't exist.
     */
    public function getUserAgent()
    {
        return $this->getHeader('User-Agent');
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


    protected function detectOperatingSystemModel(array $operatingSystemInfoFromDb)
    {
        return (isset($operatingSystemInfoFromDb['model']) ? $operatingSystemInfoFromDb['model'] : null);
    }

    protected function detectOperatingSystemVersion(array $operatingSystemInfoFromDb)
    {
        return $this->matchEntity('version', $operatingSystemInfoFromDb['versionMatches'], $this->getUserAgent());
    }

    /**
     * Creates a device with all the necessary context to determine all the given
     * properties of a device, including OS, browser, and any other context-based properties.
     *
     * @param DeviceInterface $deviceClass (optional)
     *        The class to use. It can be anything that's derived from DeviceInterface.
     *
     * {@see DeviceInterface}
     *
     * @return DeviceInterface
     *
     * @throws Exception\InvalidArgumentException When an invalid class is used.
     */
    public function detect($deviceClass = null)
    {
        if ($deviceClass) {
            if (!is_subclass_of($deviceClass, __NAMESPACE__ . '\Device\DeviceInterface')) {
                $type = gettype($deviceClass);
                if ($type == 'object') {
                    $type = get_class($deviceClass);
                } elseif ($type == 'string') {
                    $type = $deviceClass;
                } else {
                    $type = sprintf('Invalid type %s', $type);
                }
                throw new Exception\InvalidArgumentException(sprintf('Invalid class specified: %s.', $type));
            }
        } else {
            // default implementation
            $deviceClass = __NAMESPACE__ . '\Device\Device';
        }

        // Cache check.
        if (($cached = $this->getFromCache($this->getUserAgent()))) {
            //make sure it's also of type that's requested
            if (is_subclass_of($cached, $deviceClass) || (is_object($cached) && $cached instanceof DeviceInterface)) {
                return $cached;
            }
        }

        $device = null;
        $context = new Context();
        $context->setUserAgent($this->getUserAgent());

        // @todo Unify DeviceRepository
        
        // Search phone database.
        // Save the device type in Context.
        $phone = PhoneRepository::search($context);
        if ($phone) {
            $context->setDeviceType(DeviceType::MOBILE);
            $device = $phone;
        }

        // Search tablet database. Override device info if found.
        // Save the device type in Context.
        $tablet = TabletRepository::search($context);
        if ($tablet) {
            $context->setDeviceType(DeviceType::TABLET);
            $device = $tablet;
        }

        // If we know the device,
        // get model and version of the physical device (if possible).
        if (!is_null($device)) {
            if (!is_null($device->getModel())) {
                // Device model is already known from the DB.
                $context->setDeviceModel($device->getModel());
            } else {
                // Attempt to detect model and model version.
                $deviceModelAndVersion = DeviceMatcher::matchItem($device, $context);
                // @todo HERE
            }
        }

        // Get model and version of the browser (if possible).
        $browser = BrowserRepository::search($context);

        if ($browser instanceof Browser) {
            $context->setBrowserModel($browser->getModel());
            $context->setBrowserVersion($browser->getVersion());
            $prop['browserVersion'] = $this->detectBrowserVersion($browserResult);
        }

        // Get model and version of the operating system (if possible).
        $operatingSystemResult = $this->searchOperatingSystemsProvider();
        $prop['operatingSystemResult'] = $operatingSystemResult;

        if ($operatingSystemResult) {
            $prop['operatingSystemModel'] = $this->detectOperatingSystemModel($operatingSystemResult);
            $prop['operatingSystemVersion'] = $this->detectOperatingSystemVersion($operatingSystemResult);
        }

        // Fallback if no device was found (phone or tablet)
        // and try to set the device type if the found browser
        // or operating system are mobile.
        if (null === $device &&
            (
                (
                    $browserResult &&
                    isset($browserResult['isMobile']) && $browserResult['isMobile']
                )
                    ||
                (
                    $operatingSystemResult &&
                    isset($operatingSystemResult['isMobile']) && $operatingSystemResult['isMobile']
                )
            )
        ) {
            $prop['deviceType'] = DeviceType::MOBILE;
        }

        $prop['vendor'] = !is_null($device) ? $device['vendor'] : null;
        $prop['userAgent'] = $this->getUserAgent();

        // Add to cache.
        $device = $deviceClass::create($prop);
        $this->setCache($prop['userAgent'], $device);
        
        return $device;
    }

    private function searchForItemInDb(array $itemData)
    {

    }

    protected function searchOperatingSystemsProvider()
    {
        foreach ($this->operatingSystemsProvider->getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $result = $this->searchForItemInDb($itemData);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
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
        if (strpos($msg, 'preg_') !== false) {
            // we only want to deal with preg match errors
            throw new Exception\RegexCompileException($msg, $code, $file, $line, $context);

        }

        return false;
    }

    private function setRegexErrorHandler()
    {
        // graceful handling of pcre errors
        set_error_handler(array($this, 'regexErrorHandler'));
    }

    private function restoreRegexErrorHandler()
    {
        // restore previous
        restore_error_handler();
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

        return null;
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