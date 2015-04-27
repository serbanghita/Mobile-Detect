<?php
namespace MobileDetect\Data;

class TabletData extends AbstractData
{
    /**
     * List of tablet devices.
     *
     * @todo: Check for mobile friendly emails topic.
     * @var array
     */
    protected $data = array(
        /**
         * iPad tablets family.
         */
        'iPad'              => array(
            'vendor'     => 'Apple',
            'match'      => 'iPad|iPad.*Mobile',
            'modelMatch' => array('iPad.*CPU[a-z ]+[VER]'),
        ),


    );
}