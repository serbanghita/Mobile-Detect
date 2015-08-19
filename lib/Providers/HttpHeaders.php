<?php
namespace MobileDetect\Providers;

class HttpHeaders
{
    /**
     * A list of possible HTTP Request headers.
     *
     * @var array
     */
    protected $data = array(
        'accept', // HTTP_ACCEPT
        'accept-charset',
        'accept-encoding', // HTTP_ACCEPT_ENCODING
        'accept-language', // HTTP_ACCEPT_LANGUAGE
        'accept-datetime',
        'authorization',
        'cache-control', // HTTP_CACHE_CONTROL
        'connection', // HTTP_CONNECTION
        'cookie', // HTTP_COOKIE
        'content-length',
        'content-md5',
        'content-type',
        'date',
        'expect',
        'from',
        'host', // HTTP_HOST
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
        'referer', // HTTP_REFERER
        // @todo No REMOTE_ADDR ?
        'te',
        'upgrade',
        'user-agent', // HTTP_USER_AGENT
        'via',
        'warning',
        //not so standard, but since they don't start with 'x', they need to be present
        'device-stock-ua',
        'wap-connection',
        'profile',
        'ua-os',
        'ua-cpu', // HTTP_UA_CPU
    );
    
    public function getAll()
    {
        return $this->data;
    }
}