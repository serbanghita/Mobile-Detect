<?php
namespace MobileDetect;

use MobileDetect\MobileDetectFactory;

use MobileDetect\Properties\UaHeadersProperties;
use MobileDetect\Properties\RecognizedHeadersProperties;
use MobileDetect\Properties\MobileHeadersProperties;

use MobileDetect\Data\BrowsersData;
use MobileDetect\Data\OperatingSystemsData;
use MobileDetect\Data\PhonesData;
use MobileDetect\Data\TabletsData;

use MobileDetect\Device\DeviceType;

class MobileDetect
{
    /**
     * An associative array of headers in standard format.
     * So the keys will be "User-Agent", and "Accepts" versus
     * the all caps PHP format.
     *
     * @var array
     */
    protected $headers = array();
    protected $factory;
    protected $uaHeadersProperties;
    protected $recognizedHeadersProperties;

    // Database.
    protected $browsersData;
    protected $operatingSystemsData;
    protected $phonesData;
    protected $tabletsData;

    protected $knownMatchTypes = array(
        'regex', //regular expression
        'strpos', //simple case-sensitive string within string check
        'stripos', //simple case-insensitive string within string check
    );

    /**
     * @param $headers \Iterator|array|string When it's a string, it's assumed to be User-Agent.
     * @param MobileDetectFactory $factory
     */
    public function __construct($headers = null, MobileDetectFactory $factory = null)
    {
        // Create the factory class instance if none is passed.
        if ($factory === null) {
            $this->factory = new MobileDetectFactory();
        }

        $this->uaHeadersProperties = $this->factory->createUaHeadersProperties();
        $this->recognizedHeadersProperties = $this->factory->createRecognizedHeadersProperties();

        $this->browsersData = $this->factory->createBrowsersData();
        $this->operatingSystemsData = $this->factory->createOperatingSystemsData();
        $this->phonesData = $this->factory->createPhonesData();
        $this->tabletsData = $this->factory->createTabletsData();

        if (is_string($headers)) {
            $headers = array('User-Agent' => $headers);
        }

        // When no headers are provided,
        // get them from _SERVER super global.
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

        // When no param is passed, it is detected
        // based on all available headers.
        $this->setUserAgent();
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

        foreach ($this->uaHeadersProperties->getAll() as $altHeader) {
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
        if (!$force && $headerName[0] != 'x' && !in_array($headerName, $this->recognizedHeadersProperties->getAll())) {
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

    public function getFactory()
    {
        return $this->factory;
    }

    protected function getKnownMatches()
    {
        return $this->knownMatchTypes;
    }

    /**
     * @param $version string The string to convert to a standard version.
     * @param bool $asArray
     * @return array|string A string or an array if $asArray is passed as true.
     */
    protected function prepareVersion($version, $asArray = false)
    {
        $version = str_replace('_', '.', $version);

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
     * @param $regex string
     *
     * @return string
     */
    protected function prepareRegex($regex)
    {
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

        //always take an array
        if (!is_string($against)) {
            throw new Exception\InvalidArgumentException('Invalid type passed: '.gettype($against));
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
    protected function modelMatch($tests, $against)
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

    public function detect()
    {
        $props = array();

        // Search the entire database.
        // Assign properties when found.

        // Search phone OR tablet database.
        // Tag the device type.
        $deviceType = DeviceType::DESKTOP;
        if ($deviceResult = $this->searchForPhoneInDb()) {
            $deviceType = DeviceType::MOBILE;
        } elseif ($deviceResult = $this->searchForTabletInDb()) {
            $deviceType = DeviceType::TABLET;
        }

        // Get model and version of the physical device (if possible).
        if ($deviceResult && isset($deviceResult['modelMatches'])) {
            $deviceModelResult = $this->modelMatch($deviceResult['modelMatches'], $this->getUserAgent());
        }

        // Search browser.
        // Get model and version of the browser matched.
        $browserResults = $this->searchForBrowserInDb();
        if ($browserResults && isset($browserResults['versionMatches'])) {
            $browserVersionResult = $this->modelMatch($browserResults['versionMatches'], $this->getUserAgent());
        }

        // Search operating system.
        // Get model and version of the operating system.
        $osResults = $this->searchForOperatingSystemInDb();
        if ($osResults && isset($osResults['versionMatches'])) {
            $osVersionResults = $this->modelMatch($osResults['versionMatches'], $this->getUserAgent());
        }

        // Fallback.
        // Tag the device type if searching phones OR tablets didn't match anything.
        if (!$deviceResult && ($browserResults || $osResults)) {
            $deviceType = DeviceType::MOBILE;
        } else if (!$deviceResult && !$browserResults && !$osResults) {
            $deviceType = DeviceType::DESKTOP;
        }

        $props['type'] = $deviceType;
        $props['model'] = isset($deviceModelResult) ? $deviceModelResult['model'] : null;
        $props['modelVersion'] = isset($deviceModelResult) ? $deviceModelResult['version'] : null;
        $props['browser'] = null;
        $props['browserVersion'] = null;
        $props['os'] = null;
        $props['osVersion'] = null;

        return $props;
    }

    private function searchForItemInDb(array $itemsData)
    {
        foreach ($itemsData as $vendorKey => $item) {
            // Check matching type, and assume regex if not present.
            if (!isset($item['matchType'])) {
                $item['matchType'] = 'regex';
            }

            if (!isset($item['vendor'])) {
                throw new Exception\InvalidDeviceSpecificationException(
                    sprintf('Invalid spec for %s. Missing %s key.', $vendorKey, 'vendor')
                );
            }

            if (!isset($item['identityMatches'])) {
                throw new Exception\InvalidDeviceSpecificationException(
                    sprintf('Invalid spec for %s. Missing %s key.', $vendorKey, 'match')
                );
            }

            if ($this->identityMatch($item['type'], $item['identityMatches'], $this->getUserAgent())) {
                // Found the matching item.
                return $item;
            }
        }

        return false;
    }

    protected function searchForPhoneInDb()
    {
        return $this->searchForItemInDb($this->phonesData->getAll());
    }

    protected function searchForTabletInDb()
    {
        return $this->searchForItemInDb($this->tabletsData->getAll());
    }

    protected function searchForBrowserInDb()
    {
        foreach ($this->browsersData->getAll() as $browserFamilyName => $browserFamilyData) {
            $result = $this->searchForItemInDb($browserFamilyData);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    protected function searchForOperatingSystemInDb()
    {
        return $this->searchForItemInDb($this->operatingSystemsData->getAll());
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
    private function regexErrorHandler($code, $msg, $file, $line, $context)
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
}