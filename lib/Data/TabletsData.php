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
        'Nexus' => array(
            'vendor' => 'Google',
            'identityMatches' => 'Android.*Nexus[\s]+(7|9|10)|^.*Android.*Nexus(?:(?!Mobile).)*$',
            'modelMatches' => array(
                // Same as PhonesData::$data['Nexus']['modelMatches']
                'Google (?<model>[a-zA-Z]+ (?<version>[a-zA-Z0-9]+))',
                '(?<model>Nexus (?<version>[a-zA-Z0-9]+)) Build',
                '(?<model>[a-zA-Z0-9]+ Nexus)'
            )
        )
    );
}