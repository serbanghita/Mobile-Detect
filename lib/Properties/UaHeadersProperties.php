<?php
namespace MobileDetect\Properties;

use MobileDetect\AbstractStack;

class UaHeadersProperties extends AbstractStack
{
    /**
     * All possible HTTP headers that represent the
     * User-Agent string.
     *
     * Instead of looking just for HTTP_USER_AGENT
     * we will check multiple variants to extract as
     * much data as possible.
     *
     * @var array
     */
    protected $data = array(
        // The default User-Agent string.
        'User-Agent',
        // Header can occur on devices using Opera Mini.
        'X-OperaMini-Phone-UA',
        // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
        'X-Device-User-Agent',
        'X-Original-User-Agent',
        'X-Skyfire-Phone',
        'X-Bold-Phone-UA',
        'Device-Stock-UA',
        'X-UcBrowser-Device-UA',
    );
}