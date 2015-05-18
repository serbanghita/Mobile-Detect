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
        ),
        // http://www.acer.ro/ac/ro/RO/content/drivers
        // http://www.packardbell.co.uk/pb/en/GB/content/download (Packard Bell is part of Acer)
        // http://us.acer.com/ac/en/US/content/group/tablets
        // http://www.acer.de/ac/de/DE/content/models/tablets/
        // Can conflict with Micromax and Motorola phones codes.
        'Acer' => array(
            'vendor' => 'Acer',
            'identityMatches' => 'Android.*; \b(A100|A101|A110|A200|A210|A211|A500|A501|A510|A511|A700|A701|W500|W500P|W501|W501P|W510|W511|W700|G100|G100W|B1-A71|B1-710|B1-711|A1-810|A1-811|A1-830)\b|W3-810|\bA3-A10\b|\bA3-A11\b',
            // @todo modelMatches might be shared between phones and tablets.
            'modelMatches' => array(
                '; (?<model>[a-zA-Z0-9-]+) Build',
                '; Acer; (?<model>[a-zA-Z0-9-]+)'
            )
        ),

    );
}