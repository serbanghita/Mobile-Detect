<?php
namespace MobileDetect\Data;

class PhonesData extends AbstractData
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
            'identityMatches' => '\b(iPhone|iPod)\b',
            'modelMatches' => array(
                '(?<model>iPhone).*CPU[a-z ]+(?<version>[0-9\._-]+)',
                '(?<model>iPod).*CPU[a-z ]+(?<version>[0-9\._-]+)'
            ),
        ),
        'Nexus' => array(
            'vendor' => 'Google',
            'identityMatches' => 'Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile|Nexus 4|Nexus 5|Nexus 6',
            'modelMatches' => array(
                '(?<model>Nexus (?<version>[a-zA-Z0-9]+)) Build',
                '(?<model>[a-zA-Z0-9]+ Nexus)'
            ),
        ),
    );
}