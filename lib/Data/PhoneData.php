<?php
namespace MobileDetect\Data;

class PhoneData extends AbstractData
{
    /**
     * List of mobile devices (phones).
     *
     * @var array
     */
    protected $data = array(
        /**
         *
         */
        'iPhone' => array(
            'vendor' => 'Apple',
            'match' => '\biPhone\b|\biPod\b',
            'modelMatch' => array('iPhone.*CPU[a-z ]+[VER]', 'iPod.*CPU[a-z ]+[VER]'),
        ),
    );
}