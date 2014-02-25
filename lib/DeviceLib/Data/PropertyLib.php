<?php

namespace DeviceLib\Data;

class PropertyLib {

    /*
     * @todo We need to automate the creation of this class from the 2.x branch.
     */

    /**
     * All possible HTTP headers that represent the
     * User-Agent string.
     * 
     * Instead of looking just for HTTP_USER_AGENT 
     * we will check multiple variants to extract as 
     * much data as possible.
     *
     * @var array
     */
    protected static $uaHttpHeaders = array(
        // The default User-Agent string.
        'User-Agent',
        // Header can occur on devices using Opera Mini.
        'X-OperaMini-Phone-Ua',
        // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
        'X-Device-User-Agent',
        'X-Original-User-Agent',
        'X-Skyfire-Phone',
        'X-Bold-Phone-Ua',
        'Device-Stock-Ua',
        'X-UcBrowser-Device-Ua'
    );

    /**
     * HTTP headers that trigger the 'isMobile' detection
     * to be true.
     *
     * @var array
     */
    protected static $mobileHeaders = array(

        'Accept'                  => array('matches' => array(
            // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
            'application/x-obml2d',
            // BlackBerry devices.
            'application/vnd.rim.html',
            'text/vnd.wap.wml',
            'application/vnd.wap.xhtml+xml'
        )),
        'X-WAP-Profile'           => null,
        'X-WAP-ClientId'          => null,
        'WAP-Connection'          => null,
        'Profile'                 => null,
        // Reported by Opera on Nokia devices (eg. C3).
        'X-OperaMini-PHONE-UA'    => null,
        'X-Nokia-IPAddress'       => null,
        'X-Nokia-Gateway-ID'      => null,
        'X-Orange-ID'             => null,
        'X-Vodafone-3GPDPCONTEXT' => null,
        'X-HUAWEI-USERID'         => null,
        // Reported by Windows Smartphones.
        'UA-OS'                   => null,
        // Reported by Verizon, Vodafone proxy system.
        'X-Mobile-Gateway'        => null,
        // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e.
        'X-ATT-DeviceId'          => null,
        // Seen this on a HTC.
        'UA-CPU'                  => array('matches' => array('ARM')),
    );

    /**
     * List of mobile devices (phones).
     *
     * @var array
     */
    protected static $phoneDevices = array(
        /**
         *
         */
        'iPhone'        => array(
            'vendor'     => 'Apple',
            'match'      => '\biPhone.*Mobile|\biPod',
            'modelMatch' => array('iPhone.*CPU[a-z ]+[VER]', 'iPod.*CPU[a-z ]+[VER]'),
        ),

        /**
         *
         */
        'BlackBerry'    => array(
            'vendor'     => 'BlackBerry',
            'match'      => 'BlackBerry|\bBB10\b|rim[0-9]+',
            'modelMatch' => array('BlackBerry.[MODEL]'),
        ),

        /**
         *
         */
        'HTC'           => array(
            'vendor' => 'HTC',
            'match' => 'HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6400L|ADR6425|001HT|Inspire 4G|Android.*\bEVO\b|T-Mobile G1|Z520m|ThunderBolt',
            'modelMatch' => array('HTC.[MODEL]', 'HTC; [MODEL]', 'HTC/[MODEL]', ' [MODEL] Build'),
        ),

        /**
         *
         */
        'Nexus'         => array(
            'vendor'     => 'Google',
            'match'      => 'Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile',
            'modelMatch' => array('Nexus [MODEL] Build', '[MODEL] Nexus'),
        ),

        /**
         * @todo: Is 'Dell Streak' a tablet or a phone? ;)
         */
        'Dell'          => array(
            'vendor'     => 'Dell',
            'match'      => 'Dell.*Streak|Dell.*Aero|Dell.*Venue|DELL.*Venue Pro|Dell Flash|Dell Smoke|Dell Mini 3iX|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
            'modelMatch' => '',
        ),

        'Motorola'      => array(
            'vendor'     => 'Motorola',
            'match'      => 'Motorola|\bDroid\b.*Build|DROIDX|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|Motorola.*ELECTRIFY|Motorola.*i1|i867|i940|MB200|MB300|MB501|MB502|MB508|MB511|MB520|MB525|MB526|MB611|MB612|MB632|MB810|MB855|MB860|MB861|MB865|MB870|ME501|ME502|ME511|ME525|ME600|ME632|ME722|ME811|ME860|ME863|ME865|MT620|MT710|MT716|MT720|MT810|MT870|MT917|Motorola.*TITANIUM|WX435|WX445|XT300|XT301|XT311|XT316|XT317|XT319|XT320|XT390|XT502|XT530|XT531|XT532|XT535|XT603|XT610|XT611|XT615|XT681|XT701|XT702|XT711|XT720|XT800|XT806|XT860|XT862|XT875|XT882|XT883|XT894|XT901|XT907|XT909|XT910|XT912|XT928|XT926|XT915|XT919|XT925',
            'modelMatch' => '',
        ),

        'Samsung'       => array(
            'vendor'     => 'Samsung',
            'match'      => 'Samsung|SGH-I337|BGT-S5230|GT-B2100|GT-B2700|GT-B2710|GT-B3210|GT-B3310|GT-B3410|GT-B3730|GT-B3740|GT-B5510|GT-B5512|GT-B5722|GT-B6520|GT-B7300|GT-B7320|GT-B7330|GT-B7350|GT-B7510|GT-B7722|GT-B7800|GT-C3010|GT-C3011|GT-C3060|GT-C3200|GT-C3212|GT-C3212I|GT-C3262|GT-C3222|GT-C3300|GT-C3300K|GT-C3303|GT-C3303K|GT-C3310|GT-C3322|GT-C3330|GT-C3350|GT-C3500|GT-C3510|GT-C3530|GT-C3630|GT-C3780|GT-C5010|GT-C5212|GT-C6620|GT-C6625|GT-C6712|GT-E1050|GT-E1070|GT-E1075|GT-E1080|GT-E1081|GT-E1085|GT-E1087|GT-E1100|GT-E1107|GT-E1110|GT-E1120|GT-E1125|GT-E1130|GT-E1160|GT-E1170|GT-E1175|GT-E1180|GT-E1182|GT-E1200|GT-E1210|GT-E1225|GT-E1230|GT-E1390|GT-E2100|GT-E2120|GT-E2121|GT-E2152|GT-E2220|GT-E2222|GT-E2230|GT-E2232|GT-E2250|GT-E2370|GT-E2550|GT-E2652|GT-E3210|GT-E3213|GT-I5500|GT-I5503|GT-I5700|GT-I5800|GT-I5801|GT-I6410|GT-I6420|GT-I7110|GT-I7410|GT-I7500|GT-I8000|GT-I8150|GT-I8160|GT-I8190|GT-I8320|GT-I8330|GT-I8350|GT-I8530|GT-I8700|GT-I8703|GT-I8910|GT-I9000|GT-I9001|GT-I9003|GT-I9010|GT-I9020|GT-I9023|GT-I9070|GT-I9082|GT-I9100|GT-I9103|GT-I9220|GT-I9250|GT-I9300|GT-I9305|GT-I9500|GT-I9505|GT-M3510|GT-M5650|GT-M7500|GT-M7600|GT-M7603|GT-M8800|GT-M8910|GT-N7000|GT-S3110|GT-S3310|GT-S3350|GT-S3353|GT-S3370|GT-S3650|GT-S3653|GT-S3770|GT-S3850|GT-S5210|GT-S5220|GT-S5229|GT-S5230|GT-S5233|GT-S5250|GT-S5253|GT-S5260|GT-S5263|GT-S5270|GT-S5300|GT-S5330|GT-S5350|GT-S5360|GT-S5363|GT-S5369|GT-S5380|GT-S5380D|GT-S5560|GT-S5570|GT-S5600|GT-S5603|GT-S5610|GT-S5620|GT-S5660|GT-S5670|GT-S5690|GT-S5750|GT-S5780|GT-S5830|GT-S5839|GT-S6102|GT-S6500|GT-S7070|GT-S7200|GT-S7220|GT-S7230|GT-S7233|GT-S7250|GT-S7500|GT-S7530|GT-S7550|GT-S7562|GT-S7710|GT-S8000|GT-S8003|GT-S8500|GT-S8530|GT-S8600|SCH-A310|SCH-A530|SCH-A570|SCH-A610|SCH-A630|SCH-A650|SCH-A790|SCH-A795|SCH-A850|SCH-A870|SCH-A890|SCH-A930|SCH-A950|SCH-A970|SCH-A990|SCH-I100|SCH-I110|SCH-I400|SCH-I405|SCH-I500|SCH-I510|SCH-I515|SCH-I600|SCH-I730|SCH-I760|SCH-I770|SCH-I830|SCH-I910|SCH-I920|SCH-I959|SCH-LC11|SCH-N150|SCH-N300|SCH-R100|SCH-R300|SCH-R351|SCH-R400|SCH-R410|SCH-T300|SCH-U310|SCH-U320|SCH-U350|SCH-U360|SCH-U365|SCH-U370|SCH-U380|SCH-U410|SCH-U430|SCH-U450|SCH-U460|SCH-U470|SCH-U490|SCH-U540|SCH-U550|SCH-U620|SCH-U640|SCH-U650|SCH-U660|SCH-U700|SCH-U740|SCH-U750|SCH-U810|SCH-U820|SCH-U900|SCH-U940|SCH-U960|SCS-26UC|SGH-A107|SGH-A117|SGH-A127|SGH-A137|SGH-A157|SGH-A167|SGH-A177|SGH-A187|SGH-A197|SGH-A227|SGH-A237|SGH-A257|SGH-A437|SGH-A517|SGH-A597|SGH-A637|SGH-A657|SGH-A667|SGH-A687|SGH-A697|SGH-A707|SGH-A717|SGH-A727|SGH-A737|SGH-A747|SGH-A767|SGH-A777|SGH-A797|SGH-A817|SGH-A827|SGH-A837|SGH-A847|SGH-A867|SGH-A877|SGH-A887|SGH-A897|SGH-A927|SGH-B100|SGH-B130|SGH-B200|SGH-B220|SGH-C100|SGH-C110|SGH-C120|SGH-C130|SGH-C140|SGH-C160|SGH-C170|SGH-C180|SGH-C200|SGH-C207|SGH-C210|SGH-C225|SGH-C230|SGH-C417|SGH-C450|SGH-D307|SGH-D347|SGH-D357|SGH-D407|SGH-D415|SGH-D780|SGH-D807|SGH-D980|SGH-E105|SGH-E200|SGH-E315|SGH-E316|SGH-E317|SGH-E335|SGH-E590|SGH-E635|SGH-E715|SGH-E890|SGH-F300|SGH-F480|SGH-I200|SGH-I300|SGH-I320|SGH-I550|SGH-I577|SGH-I600|SGH-I607|SGH-I617|SGH-I627|SGH-I637|SGH-I677|SGH-I700|SGH-I717|SGH-I727|SGH-i747M|SGH-I777|SGH-I780|SGH-I827|SGH-I847|SGH-I857|SGH-I896|SGH-I897|SGH-I900|SGH-I907|SGH-I917|SGH-I927|SGH-I937|SGH-I997|SGH-J150|SGH-J200|SGH-L170|SGH-L700|SGH-M110|SGH-M150|SGH-M200|SGH-N105|SGH-N500|SGH-N600|SGH-N620|SGH-N625|SGH-N700|SGH-N710|SGH-P107|SGH-P207|SGH-P300|SGH-P310|SGH-P520|SGH-P735|SGH-P777|SGH-Q105|SGH-R210|SGH-R220|SGH-R225|SGH-S105|SGH-S307|SGH-T109|SGH-T119|SGH-T139|SGH-T209|SGH-T219|SGH-T229|SGH-T239|SGH-T249|SGH-T259|SGH-T309|SGH-T319|SGH-T329|SGH-T339|SGH-T349|SGH-T359|SGH-T369|SGH-T379|SGH-T409|SGH-T429|SGH-T439|SGH-T459|SGH-T469|SGH-T479|SGH-T499|SGH-T509|SGH-T519|SGH-T539|SGH-T559|SGH-T589|SGH-T609|SGH-T619|SGH-T629|SGH-T639|SGH-T659|SGH-T669|SGH-T679|SGH-T709|SGH-T719|SGH-T729|SGH-T739|SGH-T746|SGH-T749|SGH-T759|SGH-T769|SGH-T809|SGH-T819|SGH-T839|SGH-T919|SGH-T929|SGH-T939|SGH-T959|SGH-T989|SGH-U100|SGH-U200|SGH-U800|SGH-V205|SGH-V206|SGH-X100|SGH-X105|SGH-X120|SGH-X140|SGH-X426|SGH-X427|SGH-X475|SGH-X495|SGH-X497|SGH-X507|SGH-X600|SGH-X610|SGH-X620|SGH-X630|SGH-X700|SGH-X820|SGH-X890|SGH-Z130|SGH-Z150|SGH-Z170|SGH-ZX10|SGH-ZX20|SHW-M110|SPH-A120|SPH-A400|SPH-A420|SPH-A460|SPH-A500|SPH-A560|SPH-A600|SPH-A620|SPH-A660|SPH-A700|SPH-A740|SPH-A760|SPH-A790|SPH-A800|SPH-A820|SPH-A840|SPH-A880|SPH-A900|SPH-A940|SPH-A960|SPH-D600|SPH-D700|SPH-D710|SPH-D720|SPH-I300|SPH-I325|SPH-I330|SPH-I350|SPH-I500|SPH-I600|SPH-I700|SPH-L700|SPH-M100|SPH-M220|SPH-M240|SPH-M300|SPH-M305|SPH-M320|SPH-M330|SPH-M350|SPH-M360|SPH-M370|SPH-M380|SPH-M510|SPH-M540|SPH-M550|SPH-M560|SPH-M570|SPH-M580|SPH-M610|SPH-M620|SPH-M630|SPH-M800|SPH-M810|SPH-M850|SPH-M900|SPH-M910|SPH-M920|SPH-M930|SPH-N100|SPH-N200|SPH-N240|SPH-N300|SPH-N400|SPH-Z400|SWC-E100|SCH-i909|GT-N7100|GT-N7105|SCH-I535|SM-N900A|SGH-I317|SGH-T999L|GT-S5360B',
            'modelMatch' => '',
        ),

        'LG'            => array(
            'vendor'     => 'LG',
            'match'      => '\bLG\b;|LG[- ]?(C800|C900|E400|E610|E900|E-900|F160|F180K|F180L|F180S|730|855|L160|LS840|LS970|LU6200|MS690|MS695|MS770|MS840|MS870|MS910|P500|P700|P705|VM696|AS680|AS695|AX840|C729|E970|GS505|272|C395|E739BK|E960|L55C|L75C|LS696|LS860|P769BK|P350|P500|P509|P870|UN272|US730|VS840|VS950|LN272|LN510|LS670|LS855|LW690|MN270|MN510|P509|P769|P930|UN200|UN270|UN510|UN610|US670|US740|US760|UX265|UX840|VN271|VN530|VS660|VS700|VS740|VS750|VS910|VS920|VS930|VX9200|VX11000|AX840A|LW770|P506|P925|P999)',
            'modelMatch' => '',
        ),

        'Sony'          => array(
            'vendor'     => 'Sony',
            'match'      => 'SonyST|SonyLT|SonyEricsson|SonyEricssonLT15iv|LT18i|E10i|LT28h|LT26w|SonyEricssonMT27i',
            'modelMatch' => '',
        ),

        'Asus'          => array(
            'vendor'     => 'Asus',
            'match'      => 'Asus.*Galaxy|PadFone.*Mobile',
            'modelMatch' => '',
        ),

        /**
         * Added because the codes might conflict with Acer Tablets.
         * @docs http://www.micromaxinfo.com/mobiles/smartphones
         */
        'Micromax'      => array(
            'vendor'     => 'Micromax',
            'match'      => 'Micromax.*\b(A210|A92|A88|A72|A111|A110Q|A115|A116|A110|A90S|A26|A51|A35|A54|A25|A27|A89|A68|A65|A57|A90)\b',
            'modelMatch' => '',
        ),

        /**
         * // avantgo|blazer|elaine|hiptop|plucker|xiino ;
         * @todo complete the regex.
         */
        'Palm'          => array(
            'vendor'     => 'Palm',
            'match'      => 'PalmSource|Palm',
            'modelMatch' => '',
        ),

        /**
         * Just for fun ;)
         */
        'Vertu'         => array(
            'vendor'     => 'Vertu',
            'match'      => 'Vertu|Vertu.*Ltd|Vertu.*Ascent|Vertu.*Ayxta|Vertu.*Constellation(F|Quest)?|Vertu.*Monika|Vertu.*Signature',
            'modelMatch' => '',
        ),

        /**
         * Most of the VEGA devices are legacy. PANTECH seem to be newer devices based on Android.
         * @docs http://www.pantech.co.kr/en/prod/prodList.do?gbrand=VEGA (PANTECH)         *
         */
        'Pantech'       => array(
            'vendor'     => 'Pantech',
            'match'      => 'PANTECH|IM-A850S|IM-A840S|IM-A830L|IM-A830K|IM-A830S|IM-A820L|IM-A810K|IM-A810S|IM-A800S|IM-T100K|IM-A725L|IM-A780L|IM-A775C|IM-A770K|IM-A760S|IM-A750K|IM-A740S|IM-A730S|IM-A720L|IM-A710K|IM-A690L|IM-A690S|IM-A650S|IM-A630K|IM-A600S|VEGA PTL21|PT003|P8010|ADR910L|P6030|P6020|P9070|P4100|P9060|P5000|CDM8992|TXT8045|ADR8995|IS11PT|P2030|P6010|P8000|PT002|IS06|CDM8999|P9050|PT001|TXT8040|P2020|P9020|P2000|P7040|P7000|C790',
            'modelMatch' => '',
        ),

        /**
         * @docs http://www.fly-phone.com/devices/smartphones/ ; Included only smartphones.
         */
        'Fly'           => array(
            'vendor'     => 'Fly',
            'match'      => 'IQ230|IQ444|IQ450|IQ440|IQ442|IQ441|IQ245|IQ256|IQ236|IQ255|IQ235|IQ245|IQ275|IQ240|IQ285|IQ280|IQ270|IQ260|IQ250',
            'modelMatch' => '',
        ),

        /**
         * Added simvalley mobile just for fun. They have some interesting devices.
         * @docs http://www.simvalley.fr/telephonie---gps-_22_telephonie-mobile_telephones_.html
         */
        'SimValley'     => array(
            'vendor'     => 'SimValley',
            'match'      => '\b(SP-80|XT-930|SX-340|XT-930|SX-310|SP-360|SP60|SPT-800|SP-120|SPT-800|SP-140|SPX-5|SPX-8|SP-100|SPX-8|SPX-12)\b',
            'modelMatch' => '',
        ),

        /**
         * Tapatalk is a mobile app;
         * @docs http://support.tapatalk.com/threads/smf-2-0-2-os-and-browser-detection-plugin-and-tapatalk.15565/#post-79039
         */
        'GenericPhone'  => array(
            'vendor' => 'Generic Phone',
            'match' => 'Tapatalk|PDA;|SAGEM|\bmmp\b|pocket|\bpsp\b|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|\bwap\b|nokia|Series40|Series60|S60|SonyEricsson|N900|MAUI.*WAP.*Browser',
            'modelMatch' => false
        )
    );

    /**
     * List of tablet devices.
     *
     * @todo: Check for mobile friendly emails topic.
     * @var array
     */
    protected static $tabletDevices = array(
        /**
         * iPad tablets family.
         */
        'iPad'              => array(
            'vendor'     => 'Apple',
            'match'      => 'iPad|iPad.*Mobile',
            'modelMatch' => array('iPad.*CPU[a-z ]+[VER]'),
        ),

        /**
         * Nexus tablets family.
         */
        'NexusTablet'       => array(
            'vendor'     => 'Google',
            'match'      => '^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$',
            'modelMatch' => array('Nexus [MODEL] Build', '[MODEL] Nexus'),
        ),

        /**
         * Samsung tablets family.
         */
        'SamsungTablet'     => array(
            'vendor'     => 'Samsung',
            'match'      => 'SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|GT-P1000|GT-P1003|GT-P1010|GT-P3105|GT-P6210|GT-P6800|GT-P6810|GT-P7100|GT-P7300|GT-P7310|GT-P7500|GT-P7510|SCH-I800|SCH-I815|SCH-I905|SGH-I957|SGH-I987|SGH-T849|SGH-T859|SGH-T869|SPH-P100|GT-P3100|GT-P3108|GT-P3110|GT-P5100|GT-P5110|GT-P6200|GT-P7320|GT-P7511|GT-N8000|GT-P8510|SGH-I497|SPH-P500|SGH-T779|SCH-I705|SCH-I915|GT-N8013|GT-P3113|GT-P5113|GT-P8110|GT-N8010|GT-N8005|GT-N8020|GT-P1013|GT-P6201|GT-P7501|GT-N5100|GT-N5110|SHV-E140K|SHV-E140L|SHV-E140S|SHV-E150S|SHV-E230K|SHV-E230L|SHV-E230S|SHW-M180K|SHW-M180L|SHW-M180S|SHW-M180W|SHW-M300W|SHW-M305W|SHW-M380K|SHW-M380S|SHW-M380W|SHW-M430W|SHW-M480K|SHW-M480S|SHW-M480W|SHW-M485W|SHW-M486W|SHW-M500W|GT-I9228|SCH-P739|SCH-I925|GT-I9200|GT-I9205|GT-P5200|GT-P5210|SM-T311|SM-T310|SM-T210|SM-T210R|SM-T211|SM-P600|SM-P601|SM-P605|SM-P900|SM-T217|SM-T217A|SM-T217S|SM-P6000|SM-T3100|SGH-I467|XE500',
            'modelMatch' => '',
        ),

        /**
         * Kindle tablets family.
         *
         * @docs http://www.labnol.org/software/kindle-user-agent-string/20378/
         */
        'Kindle'            => array(
            'vendor'     => 'Amazon',
            'match'      => 'Kindle|Silk.*Accelerated|Android.*\b(KFOT|KFTT|KFJWI|KFJWA|KFOTE|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|WFJWAE)\b',
            'modelMatch' => array('Kindle/[VER]', 'Kindle.[MODEL]'),
        ),

        /**
         * Surface tablets family.
         *
         * Only the Surface tablets with Windows RT are considered mobile.
         * @docs http://msdn.microsoft.com/en-us/library/ie/hh920767(v=vs.85).aspx
         */
        'SurfaceTablet'     => array(
            'vendor' => 'Microsoft',
            'match' => 'Windows NT [0-9.]+; ARM;',
            'modelMatch' => '',
        ),

        /**
         * HP tablets family.
         * @docs http://shopping1.hp.com/is-bin/INTERSHOP.enfinity/WFS/WW-USSMBPublicStore-Site/en_US/-/USD/ViewStandardCatalog-Browse?CatalogCategoryID=JfIQ7EN5lqMAAAEyDcJUDwMT
         */
        'HPTablet'          => array(
            'vendor' => 'HP',
            'match' => 'HP Slate 7|HP ElitePad 900|hp-tablet|EliteBook.*Touch',
            'modelMatch' => '',
        ),

        /**
         * Asus tablets family.
         * (excluding Nexus)
         *
         * @note: watch out for PadFone, see #132
         */
        'AsusTablet'        => array(
            'vendor'     => 'Asus',
            'match'      => '^.*PadFone((?!Mobile).)*$|Transformer|TF101|TF101G|TF300T|TF300TG|TF300TL|TF700T|TF700KL|TF701T|TF810C|ME171|ME301T|ME302C|ME371MG|ME370T|ME372MG|ME172V|ME173X|ME400C|Slider SL101',
            'modelMatch' => '',
        ),

        'BlackBerryTablet'  => array(
            'vendor'     => 'BlackBerry',
            'match'      => 'PlayBook|RIM Tablet',
            'modelMatch' => '',
        ),

        'HTCtablet'         => array(
            'vendor'     => 'HTC',
            'match'      => 'HTC Flyer|HTC Jetstream|HTC-P715a|HTC EVO View 4G|PG41200',
            'modelMatch' => '',
        ),

        'MotorolaTablet'    => array(
            'vendor'     => 'Motorola',
            'match'      => 'xoom|sholest|MZ615|MZ605|MZ505|MZ601|MZ602|MZ603|MZ604|MZ606|MZ607|MZ608|MZ609|MZ615|MZ616|MZ617',
            'modelMatch' => '',
        ),

        'NookTablet'        => array(
            'vendor'     => 'Barnes and Nobles',
            'match'      => 'Android.*Nook|NookColor|nook browser|BNRV200|BNRV200A|BNTV250|BNTV250A|BNTV400|BNTV600|LogicPD Zoom2',
            'modelMatch' => '',
        ),

        /**
         * Acer tablets family.
         *
         * Can conflict with Micromax and Motorola phones codes.
         *
         * @docs http://www.acer.ro/ac/ro/RO/content/drivers
         *       http://www.packardbell.co.uk/pb/en/GB/content/download (Packard Bell is part of Acer)
         *       http://us.acer.com/ac/en/US/content/group/tablets
         */
        'AcerTablet'        => array(
            'vendor'     => 'Acer',
            'match'      => 'Android.*; \b(A100|A101|A110|A200|A210|A211|A500|A501|A510|A511|A700|A701|W500|W500P|W501|W501P|W510|W511|W700|G100|G100W|B1-A71|B1-710|B1-711|A1-810)\b|W3-810',
            'modelMatch' => '',
        ),

        /**
         * Toshiba tablets family.
         *
         * @docs http://eu.computers.toshiba-europe.com/innovation/family/Tablets/1098744/banner_id/tablet_footerlink/
         *       http://us.toshiba.com/tablets/tablet-finder
         *       http://www.toshiba.co.jp/regza/tablet/
         */
        'ToshibaTablet'     => array(
            'vendor'     => 'Toshiba',
            'match'      => 'Android.*(AT100|AT105|AT200|AT205|AT270|AT275|AT300|AT305|AT1S5|AT500|AT570|AT700|AT830)|TOSHIBA.*FOLIO',
            'modelMatch' => '',
        ),

        /**
         * LG tablets family.
         *
         * @docs http://www.nttdocomo.co.jp/english/service/developer/smart_phone/technical_info/spec/index.html
         */
        'LGTablet'          => array(
            'vendor'     => 'LG',
            'match'      => '\bL-06C|LG-V900|LG-V909\b',
            'modelMatch' => '',
        ),

        'FujitsuTablet'     => array(
            'vendor' => 'Fujitsu',
            'match' => 'Android.*\b(F-01D|F-05E|F-10D|M532|Q572)\b',
            'modelMatch' => '',
        ),

        /**
         * Prestigio tablets family.
         *
         * @docs http://www.prestigio.com/support
         */
        'PrestigioTablet'   => array(
            'vendor' => 'Prestigio',
            'match' => 'PMP3170B|PMP3270B|PMP3470B|PMP7170B|PMP3370B|PMP3570C|PMP5870C|PMP3670B|PMP5570C|PMP5770D|PMP3970B|PMP3870C|PMP5580C|PMP5880D|PMP5780D|PMP5588C|PMP7280C|PMP7280|PMP7880D|PMP5597D|PMP5597|PMP7100D|PER3464|PER3274|PER3574|PER3884|PER5274|PER5474|PMP5097CPRO|PMP5097|PMP7380D|PMP5297C|PMP5297C_QUAD',
            'modelMatch' => '',
        ),

        /**
         * Lenovo tablets family.
         *
         * @docs http://support.lenovo.com/en_GB/downloads/default.page?#
         */
        'LenovoTablet'      => array(
            'vendor'     => 'Lenovo',
            'match'      => 'IdeaTab|S2110|S6000|K3011|A3000|A1000|A2107|A2109|A1107|ThinkPad([ ]+)?Tablet',
            'modelMatch' => '',
        ),

        /**
         * Yarvik tablets family.
         *
         *
         */
        'YarvikTablet'      => array(
            'vendor'     => 'Yarvik',
            'match'      => 'Android.*(TAB210|TAB211|TAB224|TAB250|TAB260|TAB264|TAB310|TAB360|TAB364|TAB410|TAB411|TAB420|TAB424|TAB450|TAB460|TAB461|TAB464|TAB465|TAB467|TAB468)',
            'modelMatch' => '',
        ),

        'MedionTablet'      => array(
            'vendor'     => 'Medion',
            'match'      => 'Android.*\bOYO\b|LIFE.*(P9212|P9514|P9516|S9512)|LIFETAB',
            'modelMatch' => '',
        ),

        'ArnovaTablet'      => array(
            'vendor' => 'Arnova',
            'match' => 'AN10G2|AN7bG3|AN7fG3|AN8G3|AN8cG3|AN7G3|AN9G3|AN7dG3|AN7dG3ST|AN7dG3ChildPad|AN10bG3|AN10bG3DT',
            'modelMatch' => '',
        ),

        /**
         * IRU tablet
         * Could be a China rebranded tablet.
         *
         * @docs http://www.iru.ru/catalog/soho/planetable/
         * @todo recategorieze, reinvestigate
         */
        'IRUTablet'         => array(
            'vendor' => 'IRU',
            'match' => 'M702pro',
            'modelMatch' => '',
        ),

        'MegafonTablet'     => array(
            'vendor' => 'Megafon',
            'match' => 'MegaFon V9|\bZTE V9\b|Android.*\bMT7A\b',
            'modelMatch' => '',
        ),

        /**
         * E-boda tablets family.
         *
         * @docs http://www.e-boda.ro/tablete-pc.html
         */
        'EbodaTablet'       => array(
            'vendor'     => 'E-boda',
            'match'      => 'E-Boda (Supreme|Impresspeed|Izzycomm|Essential)',
            'modelMatch' => '',
        ),

        /**
         * AllView tablets family.
         *
         * @docs http://www.allview.ro/produse/droseries/lista-tablete-pc/
         */
        'AllViewTablet'           => array(
            'vendor'     => 'AllView',
            'match'      => 'Allview.*(Viva|Alldro|City|Speed|All TV|Frenzy|Quasar|Shine|TX1|AX1|AX2)',
            'modelMatch' => '',
        ),

        /**
         * Archos tablets family.
         *
         * @docs http://wiki.archosfans.com/index.php?title=Main_Page
         */
        'ArchosTablet'      => array(
            'vendor' => 'Archos',
            'match' => '\b(101G9|80G9|A101IT)\b|Qilive 97R',
            'modelMatch' => '',
        ),

        /**
         * Ainol tablets family.
         *
         * @docs http://www.ainol.com/plugin.php?identifier=ainol&module=product
         */
        'AinolTablet'       => array(
            'vendor' => 'Ainol',
            'match' => 'NOVO7|NOVO8|NOVO10|Novo7Aurora|Novo7Basic|NOVO7PALADIN|novo9-Spark',
            'modelMatch' => '',
        ),

        /**
         * Sony tablets family.
         *
         * @todo inspect http://esupport.sony.com/US/p/select-system.pl?DIRECTOR=DRIVER
         * @docs Readers http://www.atsuhiro-me.net/ebook/sony-reader/sony-reader-web-browser
         *       http://www.sony.jp/support/tablet/
         */
        'SonyTablet'        => array(
            'vendor' => 'Sony',
            'match' => 'Sony.*Tablet|Xperia Tablet|Sony Tablet S|SO-03E|SGPT12|SGPT13|SGPT114|SGPT121|SGPT122|SGPT123|SGPT111|SGPT112|SGPT113|SGPT131|SGPT132|SGPT133|SGPT211|SGPT212|SGPT213|SGP311|SGP312|SGP321|EBRD1101|EBRD1102|EBRD1201',
            'modelMatch' => '',
        ),

        /**
         * Cube tablets family.
         *
         * @docs http://www.cube-tablet.com/buy-products.html
         */
        'CubeTablet'        => array(
            'vendor'     => 'Cube',
            'match'      => 'Android.*(K8GT|U9GT|U10GT|U16GT|U17GT|U18GT|U19GT|U20GT|U23GT|U30GT)|CUBE U8GT',
            'modelMatch' => '',
        ),

        /**
         * Coby tablets family.
         *
         * @docs http://www.cobyusa.com/?p=pcat&pcat_id=3001
         */
        'CobyTablet'        => array(
            'vendor'     => 'Coby',
            'match'      => 'MID1042|MID1045|MID1125|MID1126|MID7012|MID7014|MID7015|MID7034|MID7035|MID7036|MID7042|MID7048|MID7127|MID8042|MID8048|MID8127|MID9042|MID9740|MID9742|MID7022|MID7010',
            'modelMatch' => '',
        ),

        /**
         * MID tablet family.
         *
         * @docs http://www.match.net.cn/products.asp
         */
        'MIDTablet'         => array(
            'vendor' => 'MID',
            'match' => 'M9701|M9000|M9100|M806|M1052|M806|T703|MID701|MID713|MID710|MID727|MID760|MID830|MID728|MID933|MID125|MID810|MID732|MID120|MID930|MID800|MID731|MID900|MID100|MID820|MID735|MID980|MID130|MID833|MID737|MID960|MID135|MID860|MID736|MID140|MID930|MID835|MID733',
            'modelMatch' => '',
        ),

        /**
         * SMiT tablet family.
         *
         * @docs http://pdadb.net/index.php?m=pdalist&list=SMiT (NoName Chinese Tablets)
         *       http://www.imp3.net/14/show.php?itemid=20454
         */
        'SMiTTablet'        => array(
            'vendor'     => 'SMiT',
            'match'      => 'Android.*(\bMID\b|MID-560|MTV-T1200|MTV-PND531|MTV-P1101|MTV-PND530)',
            'modelMatch' => '',
        ),

        /**
         * RockChip tablet family.
         *
         * @docs http://www.rock-chips.com/index.php?do=prod&pid=2
         */
        'RockChipTablet'    => array(
            'vendor'     => 'RockChip',
            'match'      => 'Android.*(RK2818|RK2808A|RK2918|RK3066)|RK2738|RK2808A',
            'modelMatch' => '',
        ),

        /**
         * Fly tablet family.
         *
         * @docs http://www.fly-phone.com/devices/tablets/
         *       http://www.fly-phone.com/service/
         */
        'FlyTablet'         => array(
            'vendor'     => 'Fly',
            'match'      => 'IQ310|Fly Vision',
            'modelMatch' => '',
        ),

        /**
         * bq tablet family.
         *
         * @docs http://www.bqreaders.com/gb/tablets-prices-sale.html
         */
        'bqTablet'          => array(
            'vendor'     => 'bq',
            'match'      => 'bq.*(Elcano|Curie|Edison|Maxwell|Kepler|Pascal|Tesla|Hypatia|Platon|Newton|Livingstone|Cervantes|Avant)|Maxwell.*Lite|Maxwell.*Plus',
            'modelMatch' => '',
        ),

        /**
         * Huawei tablet family.
         *
         * @docs http://www.huaweidevice.com/worldwide/productFamily.do?method=index&directoryId=5011&treeId=3290
         *       http://www.huaweidevice.com/worldwide/downloadCenter.do?method=index&directoryId=3372&treeId=0&tb=1&type=software (including legacy tablets)
         */
        'HuaweiTablet'      => array(
            'vendor'     => 'Huawei',
            'match'      => 'MediaPad|IDEOS S7|S7-201c|S7-202u|S7-101|S7-103|S7-104|S7-105|S7-106|S7-201|S7-Slim',
            'modelMatch' => '',
        ),

        /**
         * Nec tablet family.
         *
         * Nec or Medias Tab
         *
         */
        'NecTablet'         => array(
            'vendor' => 'Nec',
            'match' => '\bN-06D|\bN-08D',
            'modelMatch' => '',
        ),

        /**
         * Pantech tablet family.
         *
         * @docs http://www.pantechusa.com/phones/
         */
        'PantechTablet'     => array(
            'vendor'     => 'Pantech',
            'match'      => 'Pantech.*P4100',
            'modelMatch' => '',
        ),

        /**
         *  Broncho tablets family.
         *
         * @docs http://www.broncho.cn/ (hard to find)
         */
        'BronchoTablet'     => array(
            'vendor'     => 'Broncho',
            'match'      => 'Broncho.*(N701|N708|N802|a710)',
            'modelMatch' => '',
        ),

        /**
         * Versus tablets family.
         *
         * @docs http://versusuk.com/support.html
         */
        'VersusTablet'      => array(
            'vendor'     => 'Versus',
            'match'      => 'TOUCHPAD.*[78910]|\bTOUCHTAB\b',
            'modelMatch' => '',
        ),

        /**
         * Zync tablets family.
         *
         * @docs http://www.zync.in/index.php/our-products/tablet-phablets
         */
        'ZyncTablet'        => array(
            'vendor'     => 'Zync',
            'match'      => 'z1000|Z99 2G|z99|z930|z999|z990|z909|Z919|z900',
            'modelMatch' => '',
        ),

        /**
         * Positivo tablets family.
         *
         * @docs http://www.positivoinformatica.com.br/www/pessoal/tablet-ypy/
         */
        'PositivoTablet'    => array(
            'vendor' => '',
            'match' => 'TB07STA|TB10STA|TB07FTA|TB10FTA',
            'modelMatch' => '',
        ),

        /**
         * Nabi tablets family.
         *
         * @docs https://www.nabitablet.com/
         */
        'NabiTablet'        => array(
            'vendor'     => 'Nabi',
            'match'      => 'Android.*\bNabi',
            'modelMatch' => '',
        ),

        'KoboTablet'        => array(
            'vendor'     => 'Kobo',
            'match'      => 'Kobo Touch|\bK080\b|\bVox\b Build|\bArc\b Build',
            'modelMatch' => '',
        ),

        /**
         * Danew tablets family.
         *
         * French Tablets
         * @docs  http://www.danew.com/produits-tablette.php
         */
        'DanewTablet'       => array(
            'vendor'     => 'Danew',
            'match'      => 'DSlide.*\b(700|701R|702|703R|704|802|970|971|972|973|974|1010|1012)\b',
            'modelMatch' => '',
        ),

        /**
         * Texet tablet family.
         *
         * Texet Tablets and Readers
         * @docs  http://www.texet.ru/tablet/
         */
        'TexetTablet'       => array(
            'vendor'     => 'Texet',
            'match'      => 'NaviPad|TB-772A|TM-7045|TM-7055|TM-9750|TM-7016|TM-7024|TM-7026|TM-7041|TM-7043|TM-7047|TM-8041|TM-9741|TM-9747|TM-9748|TM-9751|TM-7022|TM-7021|TM-7020|TM-7011|TM-7010|TM-7023|TM-7025|TM-7037W|TM-7038W|TM-7027W|TM-9720|TM-9725|TM-9737W|TM-1020|TM-9738W|TM-9740|TM-9743W|TB-807A|TB-771A|TB-727A|TB-725A|TB-719A|TB-823A|TB-805A|TB-723A|TB-715A|TB-707A|TB-705A|TB-709A|TB-711A|TB-890HD|TB-880HD|TB-790HD|TB-780HD|TB-770HD|TB-721HD|TB-710HD|TB-434HD|TB-860HD|TB-840HD|TB-760HD|TB-750HD|TB-740HD|TB-730HD|TB-722HD|TB-720HD|TB-700HD|TB-500HD|TB-470HD|TB-431HD|TB-430HD|TB-506|TB-504|TB-446|TB-436|TB-416|TB-146SE|TB-126SE',
            'modelMatch' => '',
        ),

        /**
         * Playstation tablet family.
         *
         * @note Avoid detecting 'PLAYSTATION 3' as mobile.
         */
        'PlaystationTablet' => array(
            'vendor'     => 'Sony',
            'match'      => 'Playstation.*(Portable|Vita)',
            'modelMatch' => '',
        ),

        /**
         * Galapad tablet family.
         *
         * @docs http://www.galapad.net/product.html
         */
        'GalapadTablet'     => array(
            'vendor'     => 'Galapad',
            'match'      => 'Android.*\bG1\b',
            'modelMatch' => '',
        ),

        /**
         * Micromax tablet family.
         *
         * @docs http://www.micromaxinfo.com/tablet/funbook
         */
        'MicromaxTablet'    => array(
            'vendor'     => 'Micromax',
            'match'      => 'Funbook|Micromax.*\b(P250|P560|P360|P362|P600|P300|P350|P500|P275)\b',
            'modelMatch' => '',
        ),

        /**
         * Karbonn tablet family.
         *
         * http://www.karbonnmobiles.com/products_tablet.php
         */
        'KarbonnTablet'     => array(
            'vendor'     => 'Karbonn',
            'match'      => 'Android.*\b(A39|A37|A34|ST8|ST10|ST7|Smart Tab3|Smart Tab2)\b',
            'modelMatch' => '',
        ),

        /**
         * AllFine tablet family.
         *
         * @docs http://www.myallfine.com/Products.asp
         */
        'AllFineTablet'     => array(
            'vendor'     => 'AllFine',
            'match'      => 'Fine7 Genius|Fine7 Shine|Fine7 Air|Fine8 Style|Fine9 More|Fine10 Joy|Fine11 Wide',
            'modelMatch' => '',
        ),

        /**
         * PROSCAN tablet family.
         *
         * @docs http://www.proscanvideo.com/products-search.asp?itemClass=TABLET&itemnmbr=
         */
        'PROSCANTablet'     => array(
            'vendor'     => 'PROSCAN',
            'match'      => '\b(PEM63|PLT1023G|PLT1041|PLT1044|PLT1044G|PLT1091|PLT4311|PLT4311PL|PLT4315|PLT7030|PLT7033|PLT7033D|PLT7035|PLT7035D|PLT7044K|PLT7045K|PLT7045KB|PLT7071KG|PLT7072|PLT7223G|PLT7225G|PLT7777G|PLT7810K|PLT7849G|PLT7851G|PLT7852G|PLT8015|PLT8031|PLT8034|PLT8036|PLT8080K|PLT8082|PLT8088|PLT8223G|PLT8234G|PLT8235G|PLT8816K|PLT9011|PLT9045K|PLT9233G|PLT9735|PLT9760G|PLT9770G)\b',
            'modelMatch' => '',
        ),

        /**
         * YONES tablet family.
         *
         * @docs http://www.yonesnav.com/products/products.php
         */
        'YONESTablet' => array(
            'vendor'     => 'YONES',
            'match'      => 'BQ1078|BC1003|BC1077|RK9702|BC9730|BC9001|IT9001|BC7008|BC7010|BC708|BC728|BC7012|BC7030|BC7027|BC7026',
            'modelMatch' => '',
        ),

        /**
         * ChangJia tablet family.
         *
         * China manufacturer makes tablets for different small brands (eg. http://www.zeepad.net/index.html)
         * @docs http://www.cjshowroom.com/eproducts.aspx?classcode=004001001
         */
        'ChangJiaTablet'    => array(
            'vendor'     => 'ChangJia',
            'match'      => 'TPC7102|TPC7103|TPC7105|TPC7106|TPC7107|TPC7201|TPC7203|TPC7205|TPC7210|TPC7708|TPC7709|TPC7712|TPC7110|TPC8101|TPC8103|TPC8105|TPC8106|TPC8203|TPC8205|TPC8503|TPC9106|TPC9701|TPC97101|TPC97103|TPC97105|TPC97106|TPC97111|TPC97113|TPC97203|TPC97603|TPC97809|TPC97205|TPC10101|TPC10103|TPC10106|TPC10111|TPC10203|TPC10205|TPC10503',
            'modelMatch' => '',
        ),

        /**
         * GU tablet family.
         *
         * @docs http://www.gloryunion.cn/products.asp
         *       http://www.allwinnertech.com/en/apply/mobile.html
         *       http://www.ptcl.com.pk/pd_content.php?pd_id=284 (EVOTAB)
         *       Cute or Cool tablets, not sure yet.
         *  @todo must research to avoid collisions.
         */
        'GUTablet'          => array(
            'vendor'     => 'GU',
            'match'      => 'TX-A1301|TX-M9002|Q702',
            'modelMatch' => '',
        ), // A12R|D75A|D77|D79|R83|A95|A106C|R15|A75|A76|D71|D72|R71|R73|R77|D82|R85|D92|A97|D92|R91|A10F|A77F|W71F|A78F|W78F|W81F|A97F|W91F|W97F|R16G|C72|C73E|K72|K73|R96G

        /**
         * PointOfView tablet family.
         *
         * @docs http://www.pointofview-online.com/showroom.php?shop_mode=product_listing&category_id=118
         */
        'PointOfViewTablet' => array(
            'vendor'     => 'PointOfView',
            'match'      => 'TAB-P506|TAB-navi-7-3G-M|TAB-P517|TAB-P-527|TAB-P701|TAB-P703|TAB-P721|TAB-P731N|TAB-P741|TAB-P825|TAB-P905|TAB-P925|TAB-PR945|TAB-PL1015|TAB-P1025|TAB-PI1045|TAB-P1325|TAB-PROTAB[0-9]+|TAB-PROTAB25|TAB-PROTAB26|TAB-PROTAB27|TAB-PROTAB26XL|TAB-PROTAB2-IPS9|TAB-PROTAB30-IPS9|TAB-PROTAB25XXL|TAB-PROTAB26-IPS10|TAB-PROTAB30-IPS10',
            'modelMatch' => '',
        ),

        /**
         * Overmax tablet family.
         *
         * @docs http://www.overmax.pl/pl/katalog-produktow,p8/tablety,c14/
         * @todo add more tests.
         */
        'OvermaxTablet'     => array(
            'vendor'     => 'Overmax',
            'match'      => 'OV-(SteelCore|NewBase|Basecore|Baseone|Exellen|Quattor|EduTab|Solution|ACTION|BasicTab|TeddyTab|MagicTab|Stream|TB-08|TB-09)',
            'modelMatch' => '',
        ),

        /**
         * HCL tablet family
         *
         * @docs http://hclmetablet.com/India/index.php
         */
        'HCLTablet'         => array(
            'vendor'     => 'HCL',
            'match'      => 'HCL.*Tablet|Connect-3G-2.0|Connect-2G-2.0|ME Tablet U1|ME Tablet U2|ME Tablet G1|ME Tablet X1|ME Tablet Y2|ME Tablet Sync',
            'modelMatch' => '',
        ),

        /**
         * DPS tablet family.
         *
         * @docs http://www.edigital.hu/Tablet_es_e-book_olvaso/Tablet-c18385.html
         */
        'DPSTablet'         => array(
            'vendor' => 'DPS',
            'match' => 'DPS Dream 9|DPS Dual 7',
            'modelMatch' => '',
        ),

        /**
         * Visture tablet family.
         *
         * @docs http://www.visture.com/index.asp
         */
        'VistureTablet'     => array(
            'vendor'     => 'Visture',
            'match'      => 'V97 HD|i75 3G|Visture V4( HD)?|Visture V5( HD)?|Visture V10',
            'modelMatch' => '',
        ),

        /**
         * Cresta tablet family.
         *
         * @docs http://www.mijncresta.nl/tablet
         */
        'CrestaTablet'     => array(
            'vendor'     => 'Cresta',
            'match'      => 'CTP(-)?810|CTP(-)?818|CTP(-)?828|CTP(-)?838|CTP(-)?888|CTP(-)?978|CTP(-)?980|CTP(-)?987|CTP(-)?988|CTP(-)?989',
            'modelMatch' => '',
        ),

        /**
         * MediaTek tablet family.
         *
         * @link http://www.mediatek.com/_en/01_products/02_proSys.php?cata_sn=1&cata1_sn=1&cata2_sn=309
         */
        'MediatekTablet' => array(
            'vendor' => '',
            'match' => '\bMT8125|MT8389|MT8135|MT8377\b',
            'modelMatch' => '',
        ),

        /**
         * Concorde tablet family.
         */
        'ConcordeTablet' => array(
            'vendor' => 'Concorde',
            'match' => 'Concorde([ ]+)?Tab|ConCorde ReadMan',
            'modelMatch' => '',
        ),

        /**
         * GoClever Tablet family.
         *
         * @link http://www.goclever.com/uk/products,c1/tablet,c5/
         */
        'GoCleverTablet' => array(
            'vendor' => 'GoClever',
            'match' => 'GOCLEVER TAB|A7GOCLEVER|M1042|M7841|M742|R1042BK|R1041|TAB A975|TAB A7842|TAB A741|TAB A741L|TAB M723G|TAB M721|TAB A1021|TAB I921|TAB R721|TAB I720|TAB T76|TAB R70|TAB R76.2|TAB R106|TAB R83.2|TAB M813G|TAB I721|GCTA722|TAB I70|TAB I71|TAB S73|TAB R73|TAB R74|TAB R93|TAB R75|TAB R76.1|TAB A73|TAB A93|TAB A93.2|TAB T72|TAB R83|TAB R974|TAB R973|TAB A101|TAB A103|TAB A104|TAB A104.2|R105BK|M713G|A972BK|TAB A971|TAB R974.2|TAB R104|TAB R83.3|TAB A1042',
            'modelMatch' => '',
        ),

        /**
         * Modecom tablets family.
         *
         * @link http://www.modecom.eu/tablets/portal/
         */
        'ModecomTablet' => array(
            'vendor' => 'Modecom',
            'match' => 'FreeTAB 9000|FreeTAB 7.4|FreeTAB 7004|FreeTAB 7800|FreeTAB 2096|FreeTAB 7.5|FreeTAB 1014|FreeTAB 1001 |FreeTAB 8001|FreeTAB 9706|FreeTAB 9702|FreeTAB 7003|FreeTAB 7002|FreeTAB 1002|FreeTAB 7801|FreeTAB 1331|FreeTAB 1004|FreeTAB 8002|FreeTAB 8014|FreeTAB 9704|FreeTAB 1003',
            'modelMatch' => '',
        ),

        /**
         * Hudl tablet
         *
         * @link http://www.tesco.com/direct/hudl/
         */
        'Hudl'              => array(
            'vendor' => 'Hudl',
            'match' => 'Hudl HT7S3',
            'modelMatch' => '',
        ),

        /**
         * Telstra phone (like Cisco Phones)
         *
         * @link http://www.telstra.com.au/home-phone/thub-2/
         */
        'TelstraTablet'     => array(
            'vendor' => 'Telstra',
            'match' => 'T-Hub2',
            'modelMatch' => '',
        ),

        'GenericTablet'     => array(
            'vendor' => 'Generic Tablet',
            'match' => 'Android.*\b97D\b|Tablet(?!.*PC)|ViewPad7|BNTV250A|MID-WCDMA|LogicPD Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b|rk30sdk|\bEVOTAB\b|SmartTabII10|SmartTab10|M758A|ET904',
            'modelMatch' => false,
        ),
    );

    /**
     * List of mobile Operating Systems.
     *
     * @var array
     */
    protected static $operatingSystems = array(
        /**
         * Android OS family.
         *
         */
        'Android'         => array(
            'Android' => array(
                'isMobile'     => true,
                'match'        => 'Android',
                'versionMatch' => array('Android [VER]')
            )
        ),

        /**
         * Apple's iOS family.
         *
         */
        'iOS'               => array(
            'iOS' => array(
                'isMobile'     => true,
                'match'        => '\biPhone.*Mobile|\biPod|\biPad',
                'versionMatch' => array(' \bOS\b [VER] '),
            )
        ),

        /**
         * Windows OS family.
         *
         * @docs http://en.wikipedia.org/wiki/Windows_Mobile
         *       http://en.wikipedia.org/wiki/Windows_Phone
         *       http://wifeng.cn/?r=blog&a=view&id=106
         *       http://nicksnettravels.builttoroam.com/post/2011/01/10/Bogus-Windows-Phone-7-User-Agent-String.aspx
         */
        'Windows'           => array(
            'Windows Mobile' => array(
                'isMobile'     => true,
                'match'        => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
                'versionMatch' => array('Windows CE/[VER]'),
            ),
            // @docs http://windowsteamblog.com/windows_phone/b/wpdev/archive/2011/08/29/introducing-the-ie9-on-windows-phone-mango-user-agent-string.aspx
            // @docs http://en.wikipedia.org/wiki/Windows_NT#Releases
            'Windows Phone' => array(
                'isMobile'     => true,
                'match'        => 'Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7',
                'versionMatch' => array('Windows Phone OS [VER]', 'Windows Phone [VER]', 'Windows NT [VER]'),
            ),
            // @docs http://social.msdn.microsoft.com/Forums/en-US/windowsdeveloperpreviewgeneral/thread/6be392da-4d2f-41b4-8354-8dcee20c85cd
            'Windows Classic' => array(
                'isMobile'     => false,
                'match'        => 'Windows|Win64',
                'versionMatch' => array('Windows NT [VER]'),
            )
        ),

        'BlackBerry' => array(
            'BlackBerry' => array(
                'isMobile'     => true,
                'match'        => 'blackberry|\bBB10\b|rim tablet os',
                'versionMatch' => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]', 'Version/[VER]'),
            )
        ),

        'PalmOS' => array(
            'PalmOS' => array(
                'isMobile' => true,
                'match' => 'PalmOS|avantgo|blazer|elaine|hiptop|palm|plucker|xiino',
                'versionMatch' => false
            )
        ),

        'Symbian' => array(
            'Symbian' => array(
                'isMobile' => true,
                'match' => 'Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\bS60\b',
                'versionMatch' => array('SymbianOS/[VER]', 'Symbian/[VER]')
            )
        ),

        'JavaOS' => array(
            'JavaOS' => array(
                'isMobile' => true,
                'match' => 'J2ME/|\bMIDP\b|\bCLDC\b', // '|Java/' produces bug #135
                'versionMatch' => array('Java/[VER]')
            )
        ),

        'webOS' => array(
            'webOS' => array(
                'isMobile' => true,
                'match' => 'webOS|hpwOS',
                'versionMatch' => array('webOS/[VER]', 'hpwOS/[VER];'),
            )
        ),

        /**
         * MeeGo
         *
         * @docs http://en.wikipedia.org/wiki/MeeGo
         * @todo research MeeGo in UAs
         */
        'MeeGoOS' => array(
            'MeeGoOS' => array(
                'isMobile' => true,
                'match' => 'MeeGo',
                'versionMatch' => false
            )
        ),

        /**
         * Maemo
         *
         * @docs http://en.wikipedia.org/wiki/Maemo
         * @todo research Maemo in UAs
         */
        'MaemoOS' => array(
            'OS' => array(
                'isMobile'     => true,
                'match'        => '\bMaemo\b',
                'versionMatch' => false
            )
        ),

        'badaOS' => array(
            'badaOS' => array(
                'isMobile'     => true,
                'match'        => '\bBada\b',
                'versionMatch' => false
            )
        ),

        'BREWOS' => array(
            'BREWOS' => array(
                'isMobile'     => true,
                'match'        => '\bBREW\b',
                'versionMatch' => array('BREW [VER]')
            )
        ),
    );

    /**
     * List of browsers.
     *
     * The order inside a browser family is _important_.
     *
     * Eg. When checking for isChrome() we will first check for 'mobile'
     * and at last the 'desktop' version.
     * This way we don't need to keep accurate two regexes.
     * The last 'desktop' regex is a fallback.
     * At the last step we already know what happened before.
     *
     * @var array
     */
    protected static $browsers = array(
        /**
         * Google Chrome browser family
         *
         * @docs https://developers.google.com/chrome/mobile/docs/user-agent
         */
        'Chrome'         => array(
            'Chrome Mobile' => array(
                'isMobile'     => true,
                'match'        => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
                'versionMatch' => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]')
            ),
            'Chrome Desktop' => array(
                'isMobile'     => false,
                'match'        => '\bChrome\b/[.0-9]*',
                'versionMatch' => array('Chrome/[VER]')
            )
        ),

        /**
         * Mozilla Firefox browser family
         *
         * @docs https://developer.mozilla.org/en-US/docs/User_Agent_Strings_Reference
         */
        'Firefox'        => array(
            'Firefox Mobile' => array(
                'isMobile'     => true,
                'match'        => '(Mobile|Tablet).*Firefox|Firefox.*Mobile|firefox.*maemo',
                'versionMatch' => array('Firefox/[VER]', 'rv:[VER]'),
            ),
            'Fennec' => array(
                'isMobile'     => true,
                'match'        => '\bfennec\b',
                'versionMatch' => array('Fennec/[VER]'),
            ),
            'Firefox Desktop' => array(
                'isMobile'     => false,
                'match'        => 'Firefox/[0-9.]+',
                'versionMatch' => array('rv:[VER]', 'Firefox/[VER]'),
            )
        ),
        /**
         * Microsoft Internet Explorer family
         *
         * @docs http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
         */
        'IE'             => array(
            'IE Mobile' => array(
                'isMobile'     => true,
                'match'        => 'IEMobile|MSIEMobile',
                'versionMatch' => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident.*rv.[VER]'),
            ),
            'IE Desktop' => array(
                'isMobile'     => false,
                'match'        => 'MSIE [0-9.]+;|Trident.*rv.[0-9.]+',
                'versionMatch' => array('MSIE [VER];', 'Trident.*rv.[VER]'),
            )
        ),

        /**
         * Opera family
         */
        'Opera'          => array(
            'Opera Mini' => array(
                'isMobile'     => true,
                'match'        => 'Opera.*Mini',
                'versionMatch' => array('Opera Mini/[VER]'),
            ),
            'Opera Mobi' => array(
                'isMobile'     => true,
                'match'        => 'Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+',
                'versionMatch' => array('Opera Mobi/[VER]', ' OPR/[VER]', 'Version/[VER]'),
            ),
            'Opera Coast' => array(
                'isMobile'     => true,
                'match'        => 'Coast/[0-9.]+',
                'versionMatch' => array('Coast/[VER]'),
            ),
            'Opera Desktop' => array(
                'isMobile'     => false,
                'match'        => '\bOpera\b| OPR/',
                'versionMatch' => array('Opera/[VER]', ' OPR/[VER]', 'Version/[VER]' )
            ),
        ),

        /**
         * Apple Safari family
         *
         * @docs http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/OptimizingforSafarioniPhone/OptimizingforSafarioniPhone.html#//apple_ref/doc/uid/TP40006517-SW3
         * @note Safari 7534.48.3 is actually Version 5.1.
         * @note On BlackBerry the Version is overwriten by the OS.
         */
        'Safari'         => array(
            'Safari Mobile' => array(
                'isMobile'     => true,
                'match'        => 'Version.*Mobile.*Safari|Safari.*Mobile',
                'versionMatch' => array('Version/[VER]', 'Safari/[VER]'),
            ),
            'Safari Desktop' => array(
                'isMobile'     => false,
                'match'        => 'Safari/[0-9.]+',
                'versionMatch' => array('Version/[VER]', 'Safari/[VER]'),
            ),
        ),
        /**
         * UC Browser family
         *
         */
        'UCBrowser'      => array(
            'UCBrowser Mobile' => array(
                'isMobile'     => true,
                'match'        => 'UC.*Browser|\bUCWEB\b',
                'versionMatch' => array('UC Browser[VER]', 'UCBrowser/[VER]')
            )
        ),

        /**
         * Dolfin browser family.
         */
        'Dolfin'         => array(
            'Dolfin Mobile' => array(
                'isMobile'     => true,
                'match'        => '\bDolfin\b',
                'versionMatch' => array('Dolfin/[VER]')
            )
        ),


        /**
         * Skyfire browser family.
         */
        'Skyfire'        => array(
            'Skyfire Mobile' => array(
                'isMobile'     => true,
                'match'        => 'Skyfire',
                'versionMatch' => array('Skyfire/[VER]')
            )
        ),

        /**
         * Tizen browser family.
         */
        'Tizen'          => array(
            'Tizen Mobile' => array(
                'isMobile'     => true,
                'match'        => '\bTizen\b',
                'versionMatch' => array('Tizen/[VER]')
            )
        ),

        /**
         * Puffin browser family.
         *
         * @docs http://www.puffinbrowser.com/index.php
         * @note Puffin contains 'Chrome' identity.
         */
        'Puffin'         => array(
            'PuffinMobile' => array(
                'isMobile'     => true,
                'match'        => 'Puffin',
                'versionMatch' => array('Puffin/[VER]')
            )
        ),

        /**
         * Diigo browser family.
         *
         * @note https://github.com/serbanghita/Mobile-Detect/issues/7
         */
        'DiigoBrowser'   => array(
            'DiigoBrowser Mobile' => array(
                'isMobile'     => true,
                'match'        => 'DiigoBrowser',
                'versionMatch' => array('rv:[VER]')
            )
        ),

        /**
         * Mercury browser family.
         *
         * @note http://mercury-browser.com/index.html
         */
        'Mercury'        => array(
            'Mercury Mobile' => array(
                'isMobile'     => true,
                'match'        => '\bMercury\b',
                'versionMatch' => array('Mercury/[VER]')
            )
        ),

        /**
         * Bolt browser family.
         *
         * @note Bolt identifies itself as Safari.
         */
        'Bolt'           => array(
            'Bolt Mobile' => array(
                'isMobile'     => true,
                'match'        => 'bolt/[0-9.]+',
                'versionMatch' => array('BOLT/[VER]')
            )
        ),

        /**
         * Blazer browser family.
         */
        'Blazer'         => array(
            'Blazer Mobile' => array(
                'isMobile'     => true,
                'match'        => 'Blazer',
                'versionMatch' => array('Blazer/[VER]')
            )
        ),

        /**
         * TeaShark browser family.
         *
         * @note TeaShark identify itself as Safari.
         */
        'TeaShark'       => array(
            'TeaShark Mobile' => array(
                'isMobile'     => true,
                'match'        => 'TeaShark',
                'versionMatch' => array('TeaShark/[VER]')
            )
        ),

        /**
         * Generic browsers.
         *
         * @todo http://en.wikipedia.org/wiki/Midori_(web_browser)
         * 'Midori'       => 'midori',
         * @todo http://en.wikipedia.org/wiki/Minimo
         * http://en.wikipedia.org/wiki/Vision_Mobile_Browser
         */
        'GenericBrowser' => array(
            'Generic Mobile Browser' => array(
                'isMobile'     => true,
                'match'        => 'NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|MicroMessenger',
                'versionMatch' => false
            )

        ),
    );

    /**
     * Utilities.
     *
     * @var array
     */
    protected static $utilities = array(
        // Experimental. When a mobile device wants to switch to 'Desktop Mode'.
        // @ref: http://scottcate.com/technology/windows-phone-8-ie10-desktop-or-mobile/
        // @ref: https://github.com/serbanghita/Mobile-Detect/issues/57#issuecomment-15024011
        'DesktopMode' => 'WPDesktop',
        'TV'          => 'SonyDTV|HbbTV', // experimental
        'WebKit'      => '(webkit)[ /]([\w.]+)',
        'Bot'         => 'Googlebot|DoCoMo|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit',
        'MobileBot'   => 'Googlebot-Mobile|DoCoMo|YahooSeeker/M1A1-R2D2',
        'Console'     => '\b(Nintendo|Nintendo WiiU|PLAYSTATION|Xbox)\b',
        'Watch'       => 'SM-V700',
    );

    public static function getBrowsers()
    {
        return static::$browsers;
    }

    /**
     * Get all possible HTTP headers that
     * can contain the User-Agent string.
     *
     * @return array List of HTTP headers.
     */
    public function getUaHttpHeaders()
    {
        return self::$uaHttpHeaders;
    }

    public static function getMobileHeaders()
    {
        return static::$mobileHeaders;
    }

    public static function getOperatingSystems()
    {
        return static::$operatingSystems;
    }

    public static function getPhoneDevices()
    {
        return static::$phoneDevices;
    }

    public static function getTabletDevices()
    {
        return static::$tabletDevices;
    }

    public static function getUtilities()
    {
        return static::$utilities;
    }
}
