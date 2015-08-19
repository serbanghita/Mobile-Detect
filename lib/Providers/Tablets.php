<?php
namespace MobileDetect\Providers;

class Tablets
{
    /**
     * List of tablet devices.
     *
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

        'Samsung' => array(
            'vendor' => 'Samsung',
            'identityMatches' => [
                'SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|GT-P1000|GT-P1003|GT-P1010|GT-P3105|GT-P6210|GT-P6800|GT-P6810|GT-P7100|GT-P7300|GT-P7310|GT-P7500|GT-P7510|SCH-I800|SCH-I815',
                '|SCH-I905|SGH-I957|SGH-I987|SGH-T849|SGH-T859|SGH-T869|SPH-P100|GT-P3100|GT-P3108|GT-P3110|GT-P5100|GT-P5110|GT-P6200|GT-P7320|GT-P7511|GT-N8000|GT-P8510|SGH-I497',
                '|SPH-P500|SGH-T779|SCH-I705|SCH-I915|GT-N8013|GT-P3113|GT-P5113|GT-P8110|GT-N8010|GT-N8005|GT-N8020|GT-P1013|GT-P6201|GT-P7501|GT-N5100|GT-N5105|GT-N5110|SHV-E140K',
                '|SHV-E140L|SHV-E140S|SHV-E150S|SHV-E230K|SHV-E230L|SHV-E230S|SHW-M180K|SHW-M180L|SHW-M180S|SHW-M180W|SHW-M300W|SHW-M305W|SHW-M380K|SHW-M380S|SHW-M380W|SHW-M430W',
                '|SHW-M480K|SHW-M480S|SHW-M480W|SHW-M485W|SHW-M486W|SHW-M500W|GT-I9228|SCH-P739|SCH-I925|GT-I9200|GT-I9205|GT-P5200|GT-P5210|GT-P5210X|SM-T311|SM-T310|SM-T310X|SM-T210',
                '|SM-T210R|SM-T211|SM-P600|SM-P601|SM-P605|SM-P900|SM-P901|SM-T217|SM-T217A|SM-T217S|SM-P6000|SM-T3100|SGH-I467|XE500|SM-T110|GT-P5220|GT-I9200X|GT-N5110X|GT-N5120|SM-P905',
                '|SM-T111|SM-T2105|SM-T315|SM-T320|SM-T320X|SM-T321|SM-T520|SM-T525|SM-T530NU|SM-T230NU|SM-T330NU|SM-T900|XE500T1C|SM-P605V|SM-P905V|SM-T337V|SM-T537V|SM-T707V|SM-T807V',
                '|SM-P600X|SM-P900X|SM-T210X|SM-T230|SM-T230X|SM-T325|GT-P7503|SM-T531|SM-T330|SM-T530|SM-T705C|SM-T535|SM-T331|SM-T800|SM-T700|SM-T537|SM-T807|SM-P907A|SM-T337A|SM-T537A',
                '|SM-T707A|SM-T807A|SM-T237P|SM-T807P|SM-P607T|SM-T217T|SM-T337T|SM-T807T' // SCH-P709|SCH-P729|SM-T2558 - Samsung Mega - treat them like a regular phone.
            ],
            // Same as phones.
            'modelMatches' => [
                'SAMSUNG (?<model>[a-zA-Z0-9-]+)',
                '; SAMSUNG; (?<model>[a-zA-Z0-9-]+)',
                '; (?<model>[a-zA-Z0-9-]+) Build',
                '; (?<model>[a-zA-Z0-9-]+)\) like Gecko',
                '; (?<model>[a-zA-Z0-9-]+)/[a-zA-Z0-9-.]+ Build'
            ]
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

    public function getDataFromVendor($vendorName)
    {
        return $this->data[$vendorName];
    }

    public function getAll()
    {
        return $this->data;
    }
}