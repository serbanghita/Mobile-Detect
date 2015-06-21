<?php
namespace MobileDetect\Properties;

use MobileDetect\AbstractStack;

class MobileHeadersProperties extends AbstractStack
{
    /**
     * HTTP headers that trigger the 'isMobile' detection
     * to be true.
     *
     * @var array
     */
    protected $data = array(

        'Accept' => array('matches' => array(
            // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
            'application/x-obml2d',
            // BlackBerry devices.
            'application/vnd.rim.html',
            'text/vnd.wap.wml',
            'application/vnd.wap.xhtml+xml',
        )),
        'X-WAP-Profile' => null,
        'X-WAP-ClientId' => null,
        'WAP-Connection' => null,
        'Profile' => null,
        // Reported by Opera on Nokia devices (eg. C3).
        'X-OperaMini-PHONE-UA' => null,
        'X-Nokia-IPAddress' => null,
        'X-Nokia-Gateway-ID' => null,
        'X-Orange-ID' => null,
        'X-Vodafone-3GPDPCONTEXT' => null,
        'X-HUAWEI-USERID' => null,
        // Reported by Windows Smartphones.
        'UA-OS' => null,
        // Reported by Verizon, Vodafone proxy system.
        'X-Mobile-Gateway' => null,
        // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e.
        'X-ATT-DeviceId' => null,
        // Seen this on a HTC.
        'UA-CPU' => array('matches' => array('ARM')),
    );
}