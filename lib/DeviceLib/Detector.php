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
        //not so standard, but oh well
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
     * Generates or gets a singleton for use with teh simple API.
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

    // boolean detection methods
    public static function isMobile()
    {
        $device = static::getInstance()->detect();
        return $device->isMobile();
    }

    public static function isTablet(){}
    // OR
    public static function __callStatic($method, $args){}

    // static getters for properties
    public static function getBrowser(){}

    // Better, more advanced API
    /**
     * Creates a device with all the necessary context to determine all the given
     * properties of a device, including OS, browser, and any other context-based properties.
     *
     * {@see Device}
     *
     * @return Device
     */
    public function detect(){}
}
