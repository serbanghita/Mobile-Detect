<?php
namespace MobileDetect\Http;

class RequestHeaders
{
    /**
     * A list of relevant HTTP Request headers.
     *
     * @var array
     */
    protected $data = array(
        "HTTP_FROM",
        "HTTP_REFERER",
        "HTTP_UPGRADE",
        "HTTP_USER_AGENT",
        "HTTP_VIA",
        "HTTP_WARNING",
        //not so standard, but since they don't start with 'x', they need to be present
        "HTTP_DEVICE_STOCK_UA",
        "HTTP_WAP_CONNECTION",
        "HTTP_PROFILE",
        "HTTP_UA_OS",
        "HTTP_UA_CPU",
    );

    public function getAll(): array {
        return $this->data;
    }
}