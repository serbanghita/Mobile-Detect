<?php
namespace MobileDetect\Data;

class TabletsData extends AbstractData
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
        'iPad' => array(
            'vendor' => 'Apple',
            'model' => 'iPad',
            'identityMatches' => 'iPad|iPad.*Mobile',
            'modelMatches' => array('iPad.*CPU[a-z ]+(?<version>[0-9\._-]+)'),
        ),
    );
}