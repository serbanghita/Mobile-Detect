<?php
namespace MobileDetect\Providers;

class OperatingSystems extends AbstractProvider
{
    /**
     * List of mobile Operating Systems.
     *
     * @var array
     */
    protected $data = array(
        /**
         * Android OS family.
         *
         */
        'Android' => array(
            'Android' => array(
                'vendor' => 'Google',
                'model' => 'Android',
                'isMobile' => true,
                'identityMatches' => 'Android',
                'matchType' => 'strpos',
                'versionMatches' => array('Android[ -][VER]'),
                'versionHelper' => 'getAndroidVersions'
            ),
        ),
        /**
         * Apple's iOS family.
         *
         */
        'iOS' => array(
            'iOS' => array(
                'vendor' => 'Apple',
                'model' => 'iOS',
                'isMobile' => true,
                'identityMatches' => '\biPhone.*(Mobile|OS)|\biPod|\biPad',
                'versionMatches' => array('\bOS\b [VER]', 'iPhone OS/[VER]', 'iOS [VER];'),
                'versionHelper' => 'getiOsVersions'
            ),
        ),

        /**
         * Mac family.
         */
        'Mac' => array(
            'OSX' => array(
                'vendor' => 'Apple',
                'isMobile' => false,
                'identityMatches' => 'Mac OS X',
                'versionMatches' => array('Mac OS X [VER]'),
            ),
        ),

        /**
         * Windows OS family.
         *
         * @docs http://en.wikipedia.org/wiki/Windows_Mobile
         *       http://en.wikipedia.org/wiki/Windows_Phone
         *       http://wifeng.cn/?r=blog&a=view&id=106
         *       http://nicksnettravels.builttoroam.com/post/2011/01/10/Bogus-Windows-Phone-7-User-Agent-String.aspx
         */
        // @docs http://en.wikipedia.org/wiki/Windows_Mobile
        'Windows' => array(
            'Windows Mobile' => array(
                'vendor' => 'Microsoft',
                'model' => 'Windows Mobile',
                'isMobile' => true,
                'identityMatches' => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
                'versionMatches' => array('Windows CE/[VER]'),
            ),
            // @docs http://windowsteamblog.com/windows_phone/b/wpdev/archive/2011/08/29/introducing-the-ie9-on-windows-phone-mango-user-agent-string.aspx
            // @docs http://en.wikipedia.org/wiki/Windows_NT#Releases
            'Windows Phone' => array(
                'vendor' => 'Microsoft',
                'model' => 'Windows Phone',
                'isMobile' => true,
                'identityMatches' => 'Windows Phone 8.1|Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7|Windows NT 6.[23]; ARM;',
                'versionMatches' => array('Windows Phone OS [VER]', 'Windows Phone [VER]', 'Windows NT [VER]'),
            ),
            // @docs http://social.msdn.microsoft.com/Forums/en-US/windowsdeveloperpreviewgeneral/thread/6be392da-4d2f-41b4-8354-8dcee20c85cd
            'Windows Classic' => array(
                'vendor' => 'Microsoft',
                'model' => 'Windows',
                'isMobile' => false,
                'identityMatches' => 'Windows|Win64',
                'versionMatches' => array('Windows NT [VER]'),
            ),
        ),
        
        // @docs https://supportforums.blackberry.com/t5/tkb/articleprintpage/tkb-id/browser_dev@tkb/article-id/69
        'BlackBerry' => array(
            // @docs https://en.wikipedia.org/wiki/BlackBerry_Tablet_OS
            'BlackBerry Tablet' => array(
                'vendor' => 'BlackBerry',
                'model' => 'BlackBerry Tablet',
                'isMobile' => true,
                'identityMatches' => 'PlayBook|RIM Tablet',
                'versionMatches' => array('Tablet OS [VER]')
            ),
            'BlackBerry' => array(
                'vendor' => 'BlackBerry',
                'model' => 'BlackBerry',
                'isMobile' => true,
                'identityMatches' => 'blackberry|\bBB10\b|rim tablet os',
                'versionMatches' => array('Version/[VER]', 'BlackBerry[VER]', 'BlackBerry [VER];')
            )
        ),

        'Bada' => array(
            /**
             * Bada was developed only for mobile devices.
             * @docs https://en.wikipedia.org/wiki/Bada
             */
            'Bada' => array(
                'vendor' => 'Bada',
                'model' => 'Bada',
                'isMobile' => true,
                'identityMatches' => '\bBada\b',
                'versionMatches' => array('Bada/[VER]')
            )
        ),
        
        /**
         * JAVA OS family.
         *
         * @docs https://en.wikipedia.org/wiki/Java_Platform,_Micro_Edition
         * @docs https://en.wikipedia.org/wiki/Mobile_Information_Device_Profile
         */
        'Java' => array(
            'Java Mobile' => array(
                'vendor' => 'Oracle',
                'model' => 'Java Mobile',
                'isMobile' => true,
                // '|Java/' produces bug #135
                'identityMatches' => 'J2ME/|\bMIDP\b|\bCLDC\b',
                'versionMatches' => array('MIDP-[VER]', 'MMP/[VER]', 'J2ME/[VER]')
            )
        )
    );

    public function getAndroidVersions()
    {
        return array(
            'LVY48F' => array('version' => '5.1.1_r18', 'codename' => 'Lollipop'),
            'LYZ28K' => array('version' => '5.1.1_r17', 'codename' => 'Lollipop'),
            'LMY48P' => array('version' => '5.1.1_r16', 'codename' => 'Lollipop'),
            'LMY48N' => array('version' => '5.1.1_r15', 'codename' => 'Lollipop'),
            'LMY48M' => array('version' => '5.1.1_r14', 'codename' => 'Lollipop'),
            'LVY48E' => array('version' => '5.1.1_r13', 'codename' => 'Lollipop'),
            'LYZ28J' => array('version' => '5.1.1_r12', 'codename' => 'Lollipop'),
            'LMY48J' => array('version' => '5.1.1_r10', 'codename' => 'Lollipop'),
            'LMY48I' => array('version' => '5.1.1_r9', 'codename' => 'Lollipop'),
            'LVY48C' => array('version' => '5.1.1_r8', 'codename' => 'Lollipop'),
            'LMY48G' => array('version' => '5.1.1_r6', 'codename' => 'Lollipop'),
            'LYZ28E' => array('version' => '5.1.1_r5', 'codename' => 'Lollipop'),
            'LMY47Z' => array('version' => '5.1.1_r4', 'codename' => 'Lollipop'),
            'LMY48B' => array('version' => '5.1.1_r3', 'codename' => 'Lollipop'),
            'LMY47X' => array('version' => '5.1.1_r2', 'codename' => 'Lollipop'),
            'LMY47V' => array('version' => '5.1.1_r1', 'codename' => 'Lollipop'),
            'LMY47O' => array('version' => '5.1.0_r5', 'codename' => 'Lollipop'),
            'LMY47M' => array('version' => '5.1.0_r4', 'codename' => 'Lollipop'),
            'LMY47I' => array('version' => '5.1.0_r3', 'codename' => 'Lollipop'),
            'LMY47E' => array('version' => '5.1.0_r2', 'codename' => 'Lollipop'),
            'LMY47D' => array('version' => '5.1.0_r1', 'codename' => 'Lollipop'),
            'LRX22L' => array('version' => '5.0.2_r3', 'codename' => 'Lollipop'),
            'LRX22G' => array('version' => '5.0.2_r1', 'codename' => 'Lollipop'),
            'LRX22C' => array('version' => '5.0.1_r1', 'codename' => 'Lollipop'),
            'LRX21V' => array('version' => '5.0.0_r7.0.1', 'codename' => 'Lollipop'),
            'LRX21T' => array('version' => '5.0.0_r6.0.1', 'codename' => 'Lollipop'),
            'LRX21R' => array('version' => '5.0.0_r5.1.0.1', 'codename' => 'Lollipop'),
            'LRX21Q' => array('version' => '5.0.0_r5.0.1', 'codename' => 'Lollipop'),
            'LRX21P' => array('version' => '5.0.0_r4.0.1', 'codename' => 'Lollipop'),
            'LRX21O' => array('version' => '5.0.0_r3.0.1', 'codename' => 'Lollipop'),
            'LRX21M' => array('version' => '5.0.0_r2.0.1', 'codename' => 'Lollipop'),
            'LRX21L' => array('version' => '5.0.0_r1.0.1', 'codename' => 'Lollipop'),
            'KTU84Q' => array('version' => '4.4.4_r2', 'codename' => 'KitKat'),
            'KTU84P' => array('version' => '4.4.4_r1', 'codename' => 'KitKat'),
            'KTU84M' => array('version' => '4.4.3_r1.1', 'codename' => 'KitKat'),
            'KTU84L' => array('version' => '4.4.3_r1', 'codename' => 'KitKat'),
            'KVT49L' => array('version' => '4.4.2_r2', 'codename' => 'KitKat'),
            'KOT49H' => array('version' => '4.4.2_r1', 'codename' => 'KitKat'),
            'KOT49E' => array('version' => '4.4.1_r1', 'codename' => 'KitKat'),
            'KRT16S' => array('version' => '4.4_r1.2', 'codename' => 'KitKat'),
            'KRT16M' => array('version' => '4.4_r1', 'codename' => 'KitKat'),
            'JLS36I' => array('version' => '4.3.1_r1', 'codename' => 'Jelly Bean'),
            'JLS36C' => array('version' => '4.3_r3', 'codename' => 'Jelly Bean'),
            'JSS15R' => array('version' => '4.3_r2.3', 'codename' => 'Jelly Bean'),
            'JSS15Q' => array('version' => '4.3_r2.2', 'codename' => 'Jelly Bean'),
            'JSS15J' => array('version' => '4.3_r2.1', 'codename' => 'Jelly Bean'),
            'JSR78D' => array('version' => '4.3_r2', 'codename' => 'Jelly Bean'),
            'JWR66Y' => array('version' => '4.3_r1.1', 'codename' => 'Jelly Bean'),
            'JWR66V' => array('version' => '4.3_r1', 'codename' => 'Jelly Bean'),
            'JWR66N' => array('version' => '4.3_r0.9.1', 'codename' => 'Jelly Bean'),
            'JWR66L' => array('version' => '4.3_r0.9', 'codename' => 'Jelly Bean'),
            'JDQ39E' => array('version' => '4.2.2_r1.2', 'codename' => 'Jelly Bean'),
            'JDQ39B' => array('version' => '4.2.2_r1.1', 'codename' => 'Jelly Bean'),
            'JDQ39' => array('version' => '4.2.2_r1', 'codename' => 'Jelly Bean'),
            'JOP40G' => array('version' => '4.2.1_r1.2', 'codename' => 'Jelly Bean'),
            'JOP40F' => array('version' => '4.2.1_r1.1', 'codename' => 'Jelly Bean'),
            'JOP40D' => array('version' => '4.2.1_r1', 'codename' => 'Jelly Bean'),
            'JOP40C' => array('version' => '4.2_r1', 'codename' => 'Jelly Bean'),
            'JZO54M' => array('version' => '4.1.2_r2.1', 'codename' => 'Jelly Bean'),
            'JZO54L' => array('version' => '4.1.2_r2', 'codename' => 'Jelly Bean'),
            'JZO54K' => array('version' => '4.1.2_r1', 'codename' => 'Jelly Bean'),
            'JRO03S' => array('version' => '4.1.1_r6.1', 'codename' => 'Jelly Bean'),
            'JRO03R' => array('version' => '4.1.1_r6', 'codename' => 'Jelly Bean'),
            'JRO03O' => array('version' => '4.1.1_r5', 'codename' => 'Jelly Bean'),
            'JRO03L' => array('version' => '4.1.1_r4', 'codename' => 'Jelly Bean'),
            'JRO03H' => array('version' => '4.1.1_r3', 'codename' => 'Jelly Bean'),
            'JRO03E' => array('version' => '4.1.1_r2', 'codename' => 'Jelly Bean'),
            'JRO03D' => array('version' => '4.1.1_r1.1', 'codename' => 'Jelly Bean'),
            'JRO03C' => array('version' => '4.1.1_r1', 'codename' => 'Jelly Bean'),
            'IMM76L' => array('version' => '4.0.4_r2.1', 'codename' => 'Ice Cream Sandwich'),
            'IMM76K' => array('version' => '4.0.4_r2', 'codename' => 'Ice Cream Sandwich'),
            'IMM76I' => array('version' => '4.0.4_r1.2', 'codename' => 'Ice Cream Sandwich'),
            'IMM76D' => array('version' => '4.0.4_r1.1', 'codename' => 'Ice Cream Sandwich'),
            'IMM76' => array('version' => '4.0.4_r1', 'codename' => 'Ice Cream Sandwich'),
            'IML77' => array('version' => '4.0.3_r1.1', 'codename' => 'Ice Cream Sandwich'),
            'IML74K' => array('version' => '4.0.3_r1', 'codename' => 'Ice Cream Sandwich'),
            'ICL53F' => array('version' => '4.0.2_r1', 'codename' => 'Ice Cream Sandwich'),
            'ITL41F' => array('version' => '4.0.1_r1.2', 'codename' => 'Ice Cream Sandwich'),
            'ITL41D' => array('version' => '4.0.1_r1.1', 'codename' => 'Ice Cream Sandwich'),
            'GWK74' => array('version' => '2.3.7_r1', 'codename' =>  'Gingerbread'),
            'GRK39F' => array('version' => '2.3.6_r1', 'codename' =>  'Gingerbread'),
            'GRK39C' => array('version' => '2.3.6_r0.9', 'codename' =>  'Gingerbread'),
            'GRJ90' => array('version' => '2.3.5_r1', 'codename' =>  'Gingerbread'),
            'GRJ22' => array('version' => '2.3.4_r1', 'codename' =>  'Gingerbread'),
            'GRJ06D' => array('version' => '2.3.4_r0.9', 'codename' =>  'Gingerbread'),
            'GRI54' => array('version' => '2.3.3_r1.1', 'codename' =>  'Gingerbread'),
            'GRI40' => array('version' => '2.3.3_r1', 'codename' =>  'Gingerbread'),
            'GRH78C' => array('version' => '2.3.2_r1', 'codename' =>  'Gingerbread'),
            'GRH78' => array('version' => '2.3.1_r1', 'codename' =>  'Gingerbread'),
            'GRH55' => array('version' => '2.3_r1', 'codename' =>  'Gingerbread'),
            'FRK76C' => array('version' => '2.2.3_r2' , 'codename' => 'Froyo'),
            'FRK76' => array('version' => '2.2.3_r1' , 'codename' => 'Froyo'),
            'FRG83G' => array('version' => '2.2.2_r1' , 'codename' => 'Froyo'),
            'FRG83D' => array('version' => '2.2.1_r2' , 'codename' => 'Froyo'),
            'FRG83' => array('version' => '2.2.1_r1' , 'codename' => 'Froyo'),
            'FRG22D' => array('version' => '2.2_r1.3' , 'codename' => 'Froyo'),
            'FRG01B' => array('version' => '2.2_r1.2' , 'codename' => 'Froyo'),
            'FRF91' => array('version' => '2.2_r1.1' , 'codename' => 'Froyo'),
            'FRF85B' => array('version' => '2.2_r1' , 'codename' => 'Froyo'),
            'EPF21B' => array('version' => '2.1_r2.1p2', 'codename' => 'Eclair'),
            'ESE81' => array('version' => '2.1_r2.1s', 'codename' => 'Eclair'),
            'EPE54B' => array('version' => '2.1_r2.1p', 'codename' => 'Eclair'),
            'ERE27' => array('version' => '2.1_r2', 'codename' => 'Eclair'),
            'ERD79' => array('version' => '2.1_r1', 'codename' => 'Eclair'),
            'ESD56' => array('version' => '2.0.1_r1', 'codename' => 'Eclair'),
            'ESD20' => array('version' => '2.0_r1', 'codename' => 'Eclair'),
            'DMD64' => array('version' => '1.6_r1.5', 'codename' => 'Donut'),
            'DRD20' => array('version' => '1.6_r1.4', 'codename' => ''),
            'DRD08' => array('version' => '1.6_r1.3', 'codename' => ''),
            'DRC92' => array('version' => '1.6_r1.2', 'codename' => ''),
        );
    }

    public function getiOsVersions()
    {
        // Updated from https://en.wikipedia.org/wiki/IOS_version_history
        return array(
            '7A341' => array('version' => '3.0', 'codename' => ''),
            '7A400' => array('version' => '3.1', 'codename' => ''),
            '7C144' => array('version' => '3.1.1', 'codename' => ''),
            '7C145' => array('version' => '3.1.1', 'codename' => ''),
            '7C146' => array('version' => '3.1.1', 'codename' => ''),
            '7D11' => array('version' => '3.1.2', 'codename' => ''),
            '7E18' => array('version' => '3.1.3', 'codename' => ''),
            '7B367' => array('version' => '3.2', 'codename' => ''),
            '7B405' => array('version' => '3.2.1', 'codename' => ''),
            '7B500' => array('version' => '3.2.2', 'codename' => ''),
            '8A293' => array('version' => '4.0', 'codename' => ''),
            '8A306' => array('version' => '4.0.1', 'codename' => ''),
            '8A400' => array('version' => '4.0.2', 'codename' => ''),
            '8B117' => array('version' => '4.1', 'codename' => ''),
            '8C148' => array('version' => '4.2.1', 'codename' => ''),
            '8C148a' => array('version' => '4.2.1', 'codename' => ''),
            '8E128' => array('version' => '4.2.5', 'codename' => ''),
            '8E200' => array('version' => '4.2.6', 'codename' => ''),
            '8E303' => array('version' => '4.2.7', 'codename' => ''),
            '8E401' => array('version' => '4.2.8', 'codename' => ''),
            '8E501' => array('version' => '4.2.9', 'codename' => ''),
            '8E600' => array('version' => '4.2.10', 'codename' => ''),
            '8F190' => array('version' => '4.3', 'codename' => ''),
            '8F191' => array('version' => '4.3', 'codename' => ''),
            '8G4' => array('version' => '4.3.1', 'codename' => ''),
            '8H7' => array('version' => '4.3.2', 'codename' => ''),
            '8H8' => array('version' => '4.3.2', 'codename' => ''),
            '8J2' => array('version' => '4.3.3', 'codename' => ''),
            '8J3' => array('version' => '4.3.3', 'codename' => ''),
            '8K2' => array('version' => '4.3.4', 'codename' => ''),
            '8L1' => array('version' => '4.3.5', 'codename' => ''),
            '9A334' => array('version' => '5.0', 'codename' => ''),
            '9A405' => array('version' => '5.0.1', 'codename' => ''),
            '9A406' => array('version' => '5.0.1', 'codename' => ''),
            '9B176' => array('version' => '5.1', 'codename' => ''),
            '9B179' => array('version' => '5.1', 'codename' => ''),
            '9B206' => array('version' => '5.1.1', 'codename' => ''),
            '9B208' => array('version' => '5.1.1', 'codename' => ''),
            '10A403' => array('version' => '6.0', 'codename' => ''),
            '10A405' => array('version' => '6.0', 'codename' => ''),
            '10A406' => array('version' => '6.0', 'codename' => ''),
            '10A523' => array('version' => '6.0.1', 'codename' => ''),
            '10A525' => array('version' => '6.0.1', 'codename' => ''),
            '10A551' => array('version' => '6.0.2', 'codename' => ''),
            '10B141' => array('version' => '6.1', 'codename' => ''),
            '10B142' => array('version' => '6.1', 'codename' => ''),
            '10B143' => array('version' => '6.1', 'codename' => ''),
            '10B144' => array('version' => '6.1', 'codename' => ''),
            '10B145' => array('version' => '6.1.1', 'codename' => ''),
            '10B146' => array('version' => '6.1.2', 'codename' => ''),
            '10B147' => array('version' => '6.1.2', 'codename' => ''),
            '10B329' => array('version' => '6.1.3', 'codename' => ''),
            '10B350' => array('version' => '6.1.4', 'codename' => ''),
            '10B400' => array('version' => '6.1.5', 'codename' => ''),
            '10B500' => array('version' => '6.1.6', 'codename' => ''),
            '11A465' => array('version' => '7.0', 'codename' => ''),
            '11A466' => array('version' => '7.0', 'codename' => ''),
            '11A470a' => array('version' => '7.0.1', 'codename' => ''),
            '11A501' => array('version' => '7.0.2', 'codename' => ''),
            '11B511' => array('version' => '7.0.3', 'codename' => ''),
            '11B554a' => array('version' => '7.0.4', 'codename' => ''),
            '11B601' => array('version' => '7.0.5', 'codename' => ''),
            '11B651' => array('version' => '7.0.6', 'codename' => ''),
            '11D167' => array('version' => '7.1', 'codename' => ''),
            '11D169' => array('version' => '7.1', 'codename' => ''),
            '11D201' => array('version' => '7.1.1', 'codename' => ''),
            '11D257' => array('version' => '7.1.2', 'codename' => ''),
            '12A365' => array('version' => '8.0', 'codename' => ''),
            '12A366' => array('version' => '8.0', 'codename' => ''),
            '12A402' => array('version' => '8.0.1', 'codename' => ''),
            '12A405' => array('version' => '8.0.2', 'codename' => ''),
            '12B410' => array('version' => '8.1', 'codename' => ''),
            '12B411' => array('version' => '8.1', 'codename' => ''),
            '12B435' => array('version' => '8.1.1', 'codename' => ''),
            '12B436' => array('version' => '8.1.1', 'codename' => ''),
            '12B440' => array('version' => '8.1.2', 'codename' => ''),
            '12D508' => array('version' => '8.2', 'codename' => ''),
            '12F69' => array('version' => '8.3', 'codename' => ''),
            '13T5365h' => array('version' => '9.1', 'codename' => ''),
        );
    }

    public function getFamily($familyName)
    {
        return $this->data[$familyName];
    }
}