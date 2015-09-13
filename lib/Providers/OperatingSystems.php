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
                'versionMatches' => array('Android [VER]'),
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
        )

    );

    public function getFamily($familyName)
    {
        return $this->data[$familyName];
    }
}