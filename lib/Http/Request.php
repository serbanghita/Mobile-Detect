<?php
namespace MobileDetect\Http;
use Psr\Http\Message\MessageInterface as HttpMessageInterface;

class Request
{
    const MAX_UA_LENGTH = 500;
    public $userAgent;
    public $httpHeaders = [];
    public $cloudfrontHeaders = [];

    public function __construct($httpHeaders = null)
    {
        $this->setHttpHeaders($httpHeaders);
        $this->setCfHeaders();
        $this->setUserAgent();
    }

    /**
     * @param $httpHeaders \Iterator|array|HttpMessageInterface|string
     *                      When it's a string, it's assumed to be User-Agent.
     * @return Request
     * @throws \InvalidArgumentException
     */
    protected function setHttpHeaders($httpHeaders) {

        // Parse the various types of headers we could receive.
        if ($httpHeaders instanceof HttpMessageInterface) {
            $httpHeaders = $httpHeaders->getHeaders();
        } elseif ($httpHeaders instanceof \Iterator) {
            $httpHeaders = iterator_to_array($httpHeaders, true);
        } elseif (is_string($httpHeaders)) {
            $httpHeaders = ["HTTP_USER_AGENT" => $httpHeaders];
        } elseif ($httpHeaders === null) {
            $httpHeaders = static::getHttpHeadersFromEnv();
        } elseif (!is_array($httpHeaders)) {
            throw new \InvalidArgumentException(
                sprintf('Unexpected headers argument type=%s', gettype($httpHeaders))
            );
        }

//        $httpHeadersKnown = self::$knownHttpHeaders;
//        $httpHeaders = array_filter($httpHeaders, function($val) use ($httpHeadersKnown) {
//            return in_array($val, $httpHeadersKnown);
//        });

        // Prepare header names.
        foreach ($httpHeaders as $key => $value) {
            $standardKey = $this->prepareHeaderName($key);
            $this->httpHeaders[$standardKey] = $value;
        }

        return $this;
    }

    /**
     * Set CloudFront headers
     * http://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/header-caching.html#header-caching-web-device
     * @return Request
     */
    protected function setCfHeaders() {

        // clear existing headers
        $this->cloudfrontHeaders = [];

        // Only save CLOUDFRONT headers. In PHP land, that means only _SERVER vars that
        // start with cloudfront-.
        foreach ($this->httpHeaders as $key => $value) {
            if (substr($key, 0, 10) === "cloudfront") {
                $this->cloudfrontHeaders[$key] = $value;
            }
        }

        return $this;
    }

    /**
     * Retrieves the cloudfront headers.
     * @return array
     */
    public function getCfHeaders()
    {
        return $this->cloudfrontHeaders;
    }

    /**
     * Set the User-Agent to be used.
     * @param string $userAgent The user agent string to set.
     * @return string|null
     */
    public function setUserAgent($userAgent = null)
    {
        if (!empty($userAgent)) {
            return $this->userAgent = $this->prepareUserAgent($userAgent);
        } else {
            $this->userAgent = null;
            $userAgents = [];
            foreach (Headers::$uaHeaders as $altHeader) {
                if (
                    !empty($this->httpHeaders[$altHeader]) &&
                    !in_array($this->httpHeaders[$altHeader], $userAgents)
                ) {
                    $userAgents[] = $this->httpHeaders[$altHeader];
                }
            }
            if (count($userAgents) > 0) {
                $this->userAgent = implode(" ", $userAgents);
            }

            if (!empty($this->userAgent)) {
                return $this->userAgent = $this->prepareUserAgent($this->userAgent);
            }
        }

        if (count($this->getCfHeaders()) > 0) {
            return $this->userAgent = 'Amazon CloudFront';
        }

        return $this->userAgent = null;
    }


    /**
     * @param string $userAgent
     * @return string
     */
    protected static function prepareUserAgent($userAgent) {
        $userAgent = trim($userAgent);
        $userAgent = substr($userAgent, 0, self::MAX_UA_LENGTH);
        return $userAgent;
    }

    /**
     * @param $headerName string
     * @return string The header, normalized, so HTTP_USER_AGENT becomes user-agent
     * @throws \InvalidArgumentException When the $headerName isn't a valid HTTP request header name.
     */
    protected function prepareHeaderName($headerName)
    {
        if (strpos($headerName, 'HTTP_') === 0) {
            $headerName = substr($headerName, 5);
            $headerBits = explode('_', $headerName);
            $headerName = implode('-', $headerBits);
        }

        // All lower case to make it easier to find later.
        $headerName = strtolower($headerName);

        return $headerName;
    }

    /**
     * Makes a best attempt at extracting headers, starting with Apache then trying $_SERVER super global.
     *
     * @return array
     */
    public function getHttpHeadersFromEnv(): array
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
     * Set an HTTP header.
     *
     * @param $key
     * @param $value
     * @return Request Fluent interface.
     * @throws \InvalidArgumentException When the $key isn't a valid HTTP request header name.
     */
    public function setHeader($key, $value)
    {
        $key = $this->prepareHeaderName($key);
        $this->httpHeaders[$key] = trim($value);

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

        return isset($this->httpHeaders[$key]) ? $this->httpHeaders[$key] : null;
    }

    public function getHeaders()
    {
        return $this->httpHeaders;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }
}