<?php
namespace MobileDetect;

use MobileDetect\MobileDetectFactory;

use MobileDetect\Properties\UaHeadersProperties;
use MobileDetect\Properties\RecognizedHeadersProperties;
use MobileDetect\Properties\MobileHeadersProperties;

use MobileDetect\Data\Browsers;
use MobileDetect\Data\OperatingSystems;
use MobileDetect\Data\Phones;
use MobileDetect\Data\Tablets;

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

    /**
     * Current context in which we are performing
     * the detection of elements.
     * @var MobileDetectContext
     */
    protected $context;

    protected $knownMatchTypes = array(
        'regex', //regular expression
        'strpos', //simple case-sensitive string within string check
        'stripos', //simple case-insensitive string within string check
    );

    /**
     * @param $headers \Iterator|array|string When it's a string, it's assumed to be User-Agent.
     * @param MobileDetectFactory $factory
     */
    public function __construct(
        $headers = null,
        MobileDetectFactory $factory = null
    ) {
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
                sprintf('Invalid %s pattern passed %s for %s', $type, gettype($against), $test)
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

    protected function modelMatch($tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return false;
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
        return false;
    }

    protected function versionMatch($tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return false;
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
        return false;
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
        return ($browserInfoFromDb && isset($browserInfoFromDb['model']) ? $browserInfoFromDb['model'] : null);
    }

    protected function detectBrowserVersion(array $browserInfoFromDb)
    {
        return $this->matchEntity('version', $browserInfoFromDb['versionMatches'], $this->getUserAgent());
    }

    protected function detectOperatingSystemModel(array $operatingSystemInfoFromDb)
    {
        return ($operatingSystemInfoFromDb && isset($operatingSystemInfoFromDb['model']) ? $operatingSystemInfoFromDb['model'] : null);
    }

    protected function detectOperatingSystemVersion(array $operatingSystemInfoFromDb)
    {
        return $this->matchEntity('version', $operatingSystemInfoFromDb['versionMatches'], $this->getUserAgent());
    }

    public function detect()
    {
        $this->context = $this->factory->createContext();

        // Search phone OR tablet database.
        // Get the device type.
        $this->context->set('deviceType', DeviceType::DESKTOP);

        if ($phoneResult = $this->searchForPhoneInDb()) {
            $this->context->set('deviceType', DeviceType::MOBILE);
            $this->context->set('deviceResult', $phoneResult);
        }

        if ($tabletResult = $this->searchForTabletInDb()) {
            $this->context->set('deviceType', DeviceType::TABLET);
            $this->context->set('deviceResult', $tabletResult);
        }

        // If we know the device,
        // get model and version of the physical device (if possible).
        $deviceResult = $this->context->get('deviceResult');
        if (!is_null($deviceResult)) {
            if (isset($deviceResult['model'])) {
                // Device model is already known from the DB.
                $this->context->set('deviceModel', $deviceResult['model']);
            } else {
                $this->context->set('deviceModel', $this->detectDeviceModel($deviceResult));
                $this->context->set('deviceModelVersion', $this->detectDeviceModelVersion($deviceResult));
            }
        }

        // Get model and version of the browser (if possible).
        $browserResult = $this->searchForBrowserInDb();
        $this->context->set('browserResult', $browserResult);

        if ($browserResult) {
            $this->context->set('browserModel', $this->detectBrowserModel($browserResult));
            $this->context->set('browserVersion', $this->detectBrowserVersion($browserResult));
        }

        // Get model and version of the operating system (if possible).
        $operatingSystemResult = $this->searchForOperatingSystemInDb();
        $this->context->set('operatingSystemResult', $operatingSystemResult);

        if ($operatingSystemResult) {
            $this->context->set('operatingSystemModel', $this->detectOperatingSystemModel($operatingSystemResult));
            $this->context->set('operatingSystemVersion', $this->detectOperatingSystemVersion($operatingSystemResult));
        }

        // Fallback if no device was found (phone or tablet)
        // and try to set the device type if the found browser
        // or operating system are mobile.
        if (null === $this->context->get('deviceResult') &&
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
            $this->context->set('deviceType', DeviceType::MOBILE);
        }

        $this->context->set('vendor', $this->context->get('deviceResult')['vendor']);
        $this->context->set('userAgent', $this->getUserAgent());

        return $this->factory->createDeviceFromContext($this->context);
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

    protected function searchForPhoneInDb()
    {
        foreach ($this->phonesData->getAll() as $vendorKey => $itemData) {
            $result = $this->searchForItemInDb($itemData);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    protected function searchForTabletInDb()
    {
        foreach ($this->tabletsData->getAll() as $vendorKey => $itemData) {
            $result = $this->searchForItemInDb($itemData);
            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    protected function searchForBrowserInDb()
    {
        foreach ($this->browsersData->getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $result = $this->searchForItemInDb($itemData);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
    }

    protected function searchForOperatingSystemInDb()
    {
        foreach ($this->operatingSystemsData->getAll() as $familyName => $items) {
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