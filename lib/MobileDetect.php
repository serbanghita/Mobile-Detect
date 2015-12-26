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
use Psr\Http\Message\MessageInterface as HttpMessageInterface;
use MobileDetect\Providers\UserAgentHeaders;
use MobileDetect\Providers\HttpHeaders;
use MobileDetect\Providers\Browsers;
use MobileDetect\Providers\OperatingSystems;
use MobileDetect\Providers\Phones;
use MobileDetect\Providers\Tablets;
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
    protected $phonesProvider;
    protected $tabletsProvider;
    protected $browsersProvider;
    protected $operatingSystemsProvider;

    protected static $knownMatchTypes = array(
        'regex', //regular expression
        'strpos', //simple case-sensitive string within string check
        'stripos', //simple case-insensitive string within string check
    );

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
     * @param Phones|null $phonesProvider
     * @param Tablets|null $tabletsProvider
     * @param Browsers|null $browsersProvider
     * @param OperatingSystems|null $operatingSystemsProvider
     * @param UserAgentHeaders $userAgentHeaders
     * @param HttpHeaders $recognizedHttpHeaders
     */
    public function __construct(
        $headers = null,
        Phones $phonesProvider = null,
        Tablets $tabletsProvider = null,
        Browsers $browsersProvider = null,
        OperatingSystems $operatingSystemsProvider = null,
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


        if (!$phonesProvider) {
            $phonesProvider = new Phones;
        }
        
        if (!$tabletsProvider) {
            $tabletsProvider = new Tablets;
        }
        
        if (!$browsersProvider) {
            $browsersProvider = new Browsers;
        }
        
        if (!$operatingSystemsProvider) {
            $operatingSystemsProvider = new OperatingSystems;
        }



        $this->phonesProvider = $phonesProvider;
        $this->tabletsProvider = $tabletsProvider;
        $this->browsersProvider = $browsersProvider;
        $this->operatingSystemsProvider = $operatingSystemsProvider;

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

    public static function getKnownMatches()
    {
        return self::$knownMatchTypes;
    }

    /**
     * @param $version string The string to convert to a standard version.
     * @param bool $asArray
     * @return array|string A string or an array if $asArray is passed as true.
     */
    protected function prepareVersion($version, $asArray = false)
    {
        $version = str_replace('_', '.', $version);
        // @todo Need to remove extra characters from resulting
        // versions like '2.1-' or '2.1.'
        if ($asArray) {
            return explode('.', $version);
        } else {
            return $version;
        }
    }

    /**
     * Converts the quasi-regex into a full regex, replacing various common placeholders such
     * as [VER] or [MODEL].
     *
     * @param $regex string|array
     *
     * @return string
     */
    protected function prepareRegex($regex)
    {
        // Regex can be an array, because we have some really long
        // expressions (eg. Samsung) and other programming languages
        // cannot cope with the length. See #352
        if (is_array($regex)) {
            $regex = implode('', $regex);
        }

        $regex = sprintf('/%s/i', addcslashes($regex, '/'));
        $regex = str_replace('[VER]', '(?<version>[0-9\._-]+)', $regex);
        $regex = str_replace('[MODEL]', '(?<model>[a-zA-Z0-9]+)', $regex);

        return $regex;
    }

    /**
     * Given a type of match, this method will check if a valid match is found.
     *
     * @param  string                             $type    The type {{@see $this->knownMatchTypes}}.
     * @param  string                             $test    The test subject.
     * @param  string                             $against The pattern (for regex) or substring (for str[i]pos).
     * @return bool                               True if matched successfully.
     * @throws Exception\InvalidArgumentException If $against isn't a string or $type is invalid.
     */
    protected function identityMatch($type, $test, $against)
    {
        if (!in_array($type, $this->getKnownMatches())) {
            throw new Exception\InvalidArgumentException(
                sprintf('Unknown match type: %s', $type)
            );
        }

        // Always take a string.
        if (!is_string($against)) {
            throw new Exception\InvalidArgumentException(
                sprintf('Invalid %s pattern of type "%s" passed for "%s"', $type, gettype($against), $test)
            );
        }

        if ($type == 'regex') {
            if ($this->regexMatch($this->prepareRegex($test), $against)) {
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
     * Attempts to match the model and extracts
     * the version and model if available.
     *
     * @param $tests array Various tests.
     * @param $against string The test.
     *
     * @return array|bool False if no match, hash of match data otherwise.
     */
    protected function modelAndVersionMatch($tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return false;
        }

        $this->setRegexErrorHandler();

        $matchReturn = array();

        foreach ($tests as $test) {
            $regex = $this->prepareRegex($test);

            if ($this->regexMatch($regex, $against, $matches)) {
                // If the match contained a version, save it.
                if (isset($matches['version'])) {
                    $matchReturn['version'] = $this->prepareVersion($matches['version']);
                }

                // If the match contained a model, save it.
                if (isset($matches['model'])) {
                    $matchReturn['model'] = $matches['model'];
                }

                $this->restoreRegexErrorHandler();
                return $matchReturn;
            }
        }

        $this->restoreRegexErrorHandler();
        return false;
    }

    /**
     * @param $tests
     * @param $against
     * @return null
     */
    protected function modelMatch($tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return null;
        }

        $this->setRegexErrorHandler();

        foreach ($tests as $test) {
            $regex = $this->prepareRegex($test);

            if ($this->regexMatch($regex, $against, $matches)) {
                // If the match contained a model, save it.
                if (isset($matches['model'])) {
                    $this->restoreRegexErrorHandler();
                    return $matches['model'];
                }
            }
        }

        $this->restoreRegexErrorHandler();
        return null;
    }

    protected function versionMatch($tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return null;
        }

        $this->setRegexErrorHandler();

        foreach ($tests as $test) {
            $regex = $this->prepareRegex($test);

            if ($this->regexMatch($regex, $against, $matches)) {
                // If the match contained a version, save it.
                if (isset($matches['version'])) {
                    $this->restoreRegexErrorHandler();
                    return $this->prepareVersion($matches['version']);
                }
            }
        }

        $this->restoreRegexErrorHandler();
        return null;
    }

    protected function matchEntity($entity, $tests, $against)
    {
        if ($entity == 'version') {
            return $this->versionMatch($tests, $against);
        }

        if ($entity == 'model') {
            return $this->modelMatch($tests, $against);
        }
    }

    // @todo: Reduce scope of $deviceInfoFromDb
    protected function detectDeviceModel(array $deviceInfoFromDb)
    {
        if (!isset($deviceInfoFromDb['modelMatches'])) {
            return null;
        }

        return $this->matchEntity('model', $deviceInfoFromDb['modelMatches'], $this->getUserAgent());
    }

    // @todo: temporary duplicated code
    protected function detectDeviceModelVersion(array $deviceInfoFromDb)
    {
        if (!isset($deviceInfoFromDb['modelMatches'])) {
            return null;
        }

        return $this->matchEntity('version', $deviceInfoFromDb['modelMatches'], $this->getUserAgent());
    }

    protected function detectBrowserModel(array $browserInfoFromDb)
    {
        return (isset($browserInfoFromDb['model']) ? $browserInfoFromDb['model'] : null);
    }

    protected function detectBrowserVersion(array $browserInfoFromDb)
    {
        $browserVersionRaw = $this->matchEntity('version', $browserInfoFromDb['versionMatches'], $this->getUserAgent());
        if ($browserInfoFromDb['versionHelper']) {
            $funcName = $browserInfoFromDb['versionHelper'];
            if ($browserVersionDataFound = $this->browsersProvider->$funcName($browserVersionRaw)) {
                return $browserVersionDataFound['version'];
            }
        }
        return $browserVersionRaw;
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
        
        $prop = [
            'userAgent' => null,
            'deviceType' => null,
            'deviceModel' => null,
            'deviceModelVersion' => null,
            'operatingSystemModel' => null,
            'operatingSystemVersion' => null,
            'browserModel' => null,
            'browserVersion' => null,
            'vendor' => null
        ];

        // Search phone OR tablet database.
        // Get the device type.
        $prop['deviceType'] = DeviceType::DESKTOP;

        if ($phoneResult = $this->searchPhonesProvider()) {
            $prop['deviceType'] = DeviceType::MOBILE;
            $prop['deviceResult'] = $phoneResult;
        }

        if ($tabletResult = $this->searchTabletsProvider()) {
            $prop['deviceType'] = DeviceType::TABLET;
            $prop['deviceResult'] = $tabletResult;
        }

        // If we know the device,
        // get model and version of the physical device (if possible).
        $deviceResult = isset($prop['deviceResult']) ? $prop['deviceResult'] : null;
        if (!is_null($deviceResult)) {
            if (isset($deviceResult['model'])) {
                // Device model is already known from the DB.
                $prop['deviceModel'] = $deviceResult['model'];
            } else {
                $prop['deviceModel'] = $this->detectDeviceModel($deviceResult);
                $prop['deviceModelVersion'] = $this->detectDeviceModelVersion($deviceResult);
            }
        }

        // Get model and version of the browser (if possible).
        $browserResult = $this->searchBrowsersProvider();
        $prop['browserResult'] = $browserResult;

        if ($browserResult) {
            $prop['browserModel'] = $this->detectBrowserModel($browserResult);
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
        if (null === $deviceResult &&
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

        $prop['vendor'] = !is_null($deviceResult) ? $deviceResult['vendor'] : null;
        $prop['userAgent'] = $this->getUserAgent();

        // Add to cache.
        $device = $deviceClass::create($prop);
        $this->setCache($prop['userAgent'], $device);
        
        return $device;
    }

    private function searchForItemInDb(array $itemData)
    {
        // Check matching type, and assume regex if not present.
        if (!isset($itemData['matchType'])) {
            $itemData['matchType'] = 'regex';
        }

        if (!isset($itemData['vendor'])) {
            throw new Exception\InvalidDeviceSpecificationException(
                sprintf('Invalid spec for item. Missing %s key.', 'vendor')
            );
        }

        if (!isset($itemData['identityMatches'])) {
            throw new Exception\InvalidDeviceSpecificationException(
                sprintf('Invalid spec for item. Missing %s key.', 'identityMatches')
            );
        } elseif ($itemData['identityMatches'] === false) {
            // This is often case with vendors of phones that we
            // do not want to specifically detect, but we keep the record
            // for vendor matches purposes. (eg. Acer)
            return false;
        }

        if ($this->identityMatch($itemData['matchType'], $itemData['identityMatches'], $this->getUserAgent())) {
            // Found the matching item.
            return $itemData;
        }

        return false;
    }

    protected function searchPhonesProvider()
    {
        foreach ($this->phonesProvider->getAll() as $vendorKey => $itemData) {
            $result = $this->searchForItemInDb($itemData);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    protected function searchTabletsProvider()
    {
        foreach ($this->tabletsProvider->getAll() as $vendorKey => $itemData) {
            $result = $this->searchForItemInDb($itemData);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    protected function searchBrowsersProvider()
    {
        foreach ($this->browsersProvider->getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $result = $this->searchForItemInDb($itemData);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
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
     * @param $regex
     * @param $against
     * @param null $matches
     * @return int
     */
    private function regexMatch($regex, $against, &$matches = null)
    {
        return preg_match($regex, $against, $matches);
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