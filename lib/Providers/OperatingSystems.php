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
                'versionHistory' => array(

                )
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
                // Updated from https://en.wikipedia.org/wiki/IOS_version_history
                'versionHistory' => array(
                    '7A341' => '3.0',
                    '7A400' => '3.1',
                    '7C144' => '3.1.1',
                    '7C145' => '3.1.1', 
                    '7C146' => '3.1.1', 
                    '7D11' => '3.1.2',
                    '7E18' => '3.1.3',
                    '7B367' => '3.2',
                    '7B405' => '3.2.1',
                    '7B500' => '3.2.2',
                    '8A293' => '4.0',
                    '8A306' => '4.0.1',
                    '8A400' => '4.0.2',
                    '8B117' => '4.1',
                    '8C148' => '4.2.1',
                    '8C148a' => '4.2.1',
                    '8E128' => '4.2.5',
                    '8E200' => '4.2.6',
                    '8E303' => '4.2.7',
                    '8E401' => '4.2.8',
                    '8E501' => '4.2.9',
                    '8E600' => '4.2.10',
                    '8F190' => '4.3',
                    '8F191' => '4.3',
                    '8G4' => '4.3.1',
                    '8H7' => '4.3.2',
                    '8H8' => '4.3.2',
                    '8J2' => '4.3.3',
                    '8J3' => '4.3.3',
                    '8K2' => '4.3.4',
                    '8L1' => '4.3.5',
                    '9A334' => '5.0',
                    '9A405' => '5.0.1',
                    '9A406' => '5.0.1',
                    '9B176' => '5.1',
                    '9B179' => '5.1',
                    '9B206' => '5.1.1',
                    '9B208' => '5.1.1',
                    '10A403' => '6.0',
                    '10A405' => '6.0',
                    '10A406' => '6.0',
                    '10A523' => '6.0.1',
                    '10A525' => '6.0.1',
                    '10A551' => '6.0.2',
                    '10B141' => '6.1',
                    '10B142' => '6.1',
                    '10B143' => '6.1',
                    '10B144' => '6.1',
                    '10B145' => '6.1.1',
                    '10B146' => '6.1.2',
                    '10B147' => '6.1.2',
                    '10B329' => '6.1.3',
                    '10B350' => '6.1.4',
                    '10B400' => '6.1.5',
                    '10B500' => '6.1.6',
                    '11A465' => '7.0',
                    '11A466' => '7.0',
                    '11A470a' => '7.0.1',
                    '11A501' => '7.0.2',
                    '11B511' => '7.0.3',
                    '11B554a' => '7.0.4',
                    '11B601' => '7.0.5',
                    '11B651' => '7.0.6',
                    '11D167' => '7.1',
                    '11D169' => '7.1',
                    '11D201' => '7.1.1',
                    '11D257' => '7.1.2',
                    '12A365' => '8.0',
                    '12A366' => '8.0',
                    '12A402' => '8.0.1',
                    '12A405' => '8.0.2',
                    '12B410' => '8.1',
                    '12B411' => '8.1',
                    '12B435' => '8.1.1',
                    '12B436' => '8.1.1',
                    '12B440' => '8.1.2',
                    '12D508' => '8.2',
                    '12F69' => '8.3',
                    '13T5365h' => '9.1'
                )
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
                'identityMatches' => '',
                'versionMatches' => array('RIM Tablet OS [VER]')
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

    public function getFamily($familyName)
    {
        return $this->data[$familyName];
    }
}