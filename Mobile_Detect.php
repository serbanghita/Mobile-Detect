<?php
/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 * @author      Serban Ghita <serbanghita@gmail.com>
 *              Victor Stanciu <vic.stanciu@gmail.com> (until v.1.0)
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        Official page: http://mobiledetect.net
 *              GitHub Repository: https://github.com/serbanghita/Mobile-Detect
 *              Google Code Old Page: http://code.google.com/p/php-mobile-detect/
 */

class Mobile_Detect {

    protected $scriptVersion = '2.5.4';

    // External info.
    protected $userAgent = null;
    protected $httpHeaders;

    // Arrays holding all detection rules.
    protected $mobileDetectionRules = null;
    protected $mobileDetectionRulesExtended = null;
    // Type of detection to use.
    protected $detectionType = 'mobile'; // mobile, extended @todo: refactor this.

    // List of mobile devices (phones)
    protected $phoneDevices = array(
        'iPhone'        => '\biPhone.*Mobile|\biPod|\biTunes',
        'BlackBerry'    => 'BlackBerry|rim[0-9]+',
        'HTC'           => 'HTC|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6425|001HT|Inspire 4G',
        'Nexus'         => 'Nexus (?:One|S)|Galaxy.*Nexus|Android.*Nexus.*Mobile',
        // @todo: Is 'Dell Streak' a tablet or a phone? ;)
        'Dell'          => 'Dell\b.*(?:Streak|Aero|Venue|Flash|Smoke|Mini 3iX)|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
        'Motorola'      => 'Motorola|\bDroid\b.*Build|DROIDX|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|i867|i940|\bMB(?:200|300|501|502|508|511|520|525|526|611|612|632|810|855|860|861|865|870)|\bME(?:501|502|511|525|600|632|722|811|860|863|865)|\bMT(?:620|710|716|720|810|870|917)|WX435|WX445|\bXT(?:300|301|311|316|317|319|320|390|502|530|531|532|535|603|610|611|615|681|701|702|711|720|800|806|860|862|875|882|883|894|909|910|912|928)',
        'Samsung'       => 'Samsung|BGT-S5230|\bGT-(?:B(?:2100|2700|2710|3210|3310|3410|3730|3740|5510|5512|5722|6520|7300|7320|7330|7350|7510|7722|7800)|C(?:3010|3011|3060|3200|3212|3212I|3222|3300|3300K|3303|3303K|3310|3322|3330|3350|3500|3510|3530|3630|3780|5010|5212|6620|6625|6712)|E(?:1050|1070|1075|1080|1081|1085|1087|1100|1107|1110|1120|1125|1130|1160|1170|1175|1180|1182|1200|1210|1225|1230|1390|2100|2120|2121|2152|2220|2222|2230|2232|2250|2370|2550|2652|3210|3213)|I(?:5500|5503|5700|5800|5801|6410|6420|7110|7410|7500|8000|8150|8160|8320|8330|8350|8530|8700|8703|8910|9000|9001|9003|9010|9020|9023|9070|9100|9103|9220|9250|9300|9305)|M(?:3510|5650|7500|7600|7603|8800|8910)|N7000|P(?:6810|7100)|S(?:3110|3310|3350|3353|3370|3650|3653|3770|3850|5210|5220|5229|5230|5233|5250|5253|5260|5263|5270|5300|5330|5350|5360|5363|5369|5380|5380D|5560|5570|5600|5603|5610|5620|5660|5670|5690|5750|5780|5830|5839|6102|6500|7070|7200|7220|7230|7233|7250|7500|7530|7550|8000|8003|8500|8530|8600))|\bSCH-(?:A(?:310|530|570|610|630|650|790|795|850|870|890|930|950|970|990)|I(?:100|110|400|405|500|510|515|600|730|760|770|830|909|910|920)|LC11|N150|N300|R100|R300|R351|R400|R410|T300|U310|U320|U350|U360|U365|U370|U380|U410|U430|U450|U460|U470|U490|U540|U550|U620|U640|U650|U660|U700|U740|U750|U810|U820|U900|U940|U960)|SCS-26UC|SGH-(?:A107|A117|A127|A137|A157|A167|A177|A187|A197|A227|A237|A257|A437|A517|A597|A637|A657|A667|A687|A697|A707|A717|A727|A737|A747|A767|A777|A797|A817|A827|A837|A847|A867|A877|A887|A897|A927|B100|B130|B200|B220|C100|C110|C120|C130|C140|C160|C170|C180|C200|C207|C210|C225|C230|C417|C450|D307|D347|D357|D407|D415|D780|D807|D980|E105|E200|E315|E316|E317|E335|E590|E635|E715|E890|F300|F480|I200|I300|I320|I550|I577|I600|I607|I617|I627|I637|I677|I700|I717|I727|I777|I780|I827|I847|I857|I896|I897|I900|I907|I917|I927|I937|I997|J150|J200|L170|L700|M110|M150|M200|N105|N500|N600|N620|N625|N700|N710|P107|P207|P300|P310|P520|P735|P777|Q105|R210|R220|R225|S105|S307|T109|T119|T139|T209|T219|T229|T239|T249|T259|T309|T319|T329|T339|T349|T359|T369|T379|T409|T429|T439|T459|T469|T479|T499|T509|T519|T539|T559|T589|T609|T619|T629|T639|T659|T669|T679|T709|T719|T729|T739|T746|T749|T759|T769|T809|T819|T839|T919|T929|T939|T959|T989|U100|U200|U800|V205|V206|X100|X105|X120|X140|X426|X427|X475|X495|X497|X507|X600|X610|X620|X630|X700|X820|X890|Z130|Z150|Z170|ZX10|ZX20)|SHW-M110|SPH-(?:A120|A400|A420|A460|A500|A560|A600|A620|A660|A700|A740|A760|A790|A800|A820|A840|A880|A900|A940|A960|D600|D700|D710|D720|I300|I325|I330|I350|I500|I600|I700|L700|M100|M220|M240|M300|M305|M320|M330|M350|M360|M370|M380|M510|M540|M550|M560|M570|M580|M610|M620|M630|M800|M810|M850|M900|M910|M920|M930|N100|N200|N240|N300|N400|Z400)|SWC-E100|GT-N7100|GT-N8010',
        'Sony'          => 'sony|LT18i|E10i',
        'Asus'          => 'Asus.*Galaxy',
        'Palm'          => '\bPalm', // source|avantgo|blazer|elaine|hiptop|plucker|xiino ; @todo - complete the regex?
        'Vertu'         => 'Vertu', // Just for fun ;)
        // @ref: http://www.pantech.co.kr/en/prod/prodList.do?gbrand=VEGA (PANTECH)
        // Most of the VEGA devices are legacy. PANTECH seem to be newer devices based on Android.
        'Pantech'       => 'PANTECH|\bIM-A(?:850S|840S|830L|830K|830S|820L|810K|810S|800S|725L|780L|775C|770K|760S|750K|740S|730S|720L|710K|690L|690S|650S|630K|600S)|IM-T100K|VEGA PTL21|ADR910L|CDM8992|TXT8045|ADR8995|IS11PT|IS06|CDM8999|TXT8040|C790|P(?:T(?:00[1-3])|8010|6030|6020|9070|4100|9060|5000|2030|6010|8000|9050|2020|9020|2000|7040|7000)',
        // @ref: http://www.fly-phone.com/devices/smartphones/ ; Included only smartphones.
        'Fly'           => '\bIQ(?:230|444|450|440|442|441|245|256|236|255|235|245|275|240|285|280|270|260|250)',
        'GenericPhone'  => 'PDA;|PPC;|SAGEM|mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.(?:browser|link)|vodafone|wap|nokia|Series(?:40|60)|S60|SonyEricsson|N900|MAUI.*WAP.*Browser|LG-P500'
    );
    // List of tablet devices.
    protected $tabletDevices = array(
        'BlackBerryTablet'  => 'PlayBook|RIM Tablet',
        'iPad'              => 'iPad', // @todo: check for mobile friendly emails topic.
        'NexusTablet'       => '^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$',
        // @reference: http://www.labnol.org/software/kindle-user-agent-string/20378/
        'Kindle'            => 'Kindle|Silk.*Accelerated',
        'SamsungTablet'     => 'SAMSUNG.*Tablet|Galaxy.*Tab|GT-P1000|GT-P1010|GT-P6210|GT-P6800|GT-P6810|GT-P7100|GT-P7300|GT-P7310|GT-P7500|GT-P7510|SCH-I800|SCH-I815|SCH-I905|SGH-I957|SGH-I987|SGH-T849|SGH-T859|SGH-T869|SPH-P100|GT-P3100|GT-P3110|GT-P5100|GT-P5110|GT-P6200|GT-P7320|GT-P7511|GT-N8000|GT-P8510|SGH-I497|SPH-P500|SGH-T779|SCH-I705|SCH-I915|GT-N8013|GT-P3113|GT-P5113|GT-P8110|GT-N8010|GT-N8005|GT-N8020|GT-P1013|GT-P6201|GT-P6810|GT-P7501',
        'HTCtablet'         => 'HTC Flyer|HTC Jetstream|HTC-P715a|HTC EVO View 4G|PG41200',
        'MotorolaTablet'    => 'xoom|sholest|MZ615|MZ605|MZ505|MZ601|MZ602|MZ603|MZ604|MZ606|MZ607|MZ608|MZ609|MZ615|MZ616|MZ617',
        'AsusTablet'        => 'Transformer|TF101',
        'NookTablet'        => 'Android.*Nook|NookColor|nook browser|BNTV250A|LogicPD Zoom2',
        // @ref: http://www.acer.ro/ac/ro/RO/content/drivers
        // @ref: http://www.packardbell.co.uk/pb/en/GB/content/download (Packard Bell is part of Acer)
        'AcerTablet'        => 'Android.*\b(A100|A101|A200|A500|A501|A510|A700|A701|W500|W500P|W501|W501P|G100|G100W)\b',
        // @ref: http://eu.computers.toshiba-europe.com/innovation/family/Tablets/1098744/banner_id/tablet_footerlink/
        // @ref: http://us.toshiba.com/tablets/tablet-finder
        // @ref: http://www.toshiba.co.jp/regza/tablet/
        'ToshibaTablet'     => 'Android.*AT(?:100|105|200|205|270|275|300|305|1S5|500|570|700|830)',
        'YarvikTablet'      => 'Android.*TAB(?:210|211|224|250|260|264|310|360|364|410|411|420|424|450|460|461|464|465|467|468)',
        'MedionTablet'      => 'Android.*\bOYO\b|LIFE.*(P9212|P9514|P9516|S9512)|LIFETAB',
        'ArnovaTablet'      => 'AN10G2|AN7bG3|AN7fG3|AN8G3|AN8cG3|AN7G3|AN9G3|AN7dG3|AN7dG3ST|AN7dG3ChildPad|AN10bG3|AN10bG3DT',
        // @reference: http://wiki.archosfans.com/index.php?title=Main_Page
        'ArchosTablet'      => 'Android.*ARCHOS|101G9|80G9',
        // @reference: http://en.wikipedia.org/wiki/NOVO7
        'AinolTablet'       => 'Novo7',
        // @todo: inspect http://esupport.sony.com/US/p/select-system.pl?DIRECTOR=DRIVER
        'SonyTablet'        => 'Sony Tablet',
        // @ref: db + http://www.cube-tablet.com/buy-products.html
        'CubeTablet'        => 'Android.*(K8GT|U9GT|U10GT|U16GT|U17GT|U18GT|U19GT|U20GT|U23GT|U30GT)',
        // @ref: http://www.cobyusa.com/?p=pcat&pcat_id=3001
        'CobyTablet'        => 'MID(?:1042|1045|1125|1126|7012|7014|7034|7035|7036|7042|7048|7127|8042|8048|8127|9042|9740|9742|7022|7010)',
        // @ref: http://pdadb.net/index.php?m=pdalist&list=SMiT (NoName Chinese Tablets)
        // @ref: http://www.imp3.net/14/show.php?itemid=20454
        'SMiTTablet'        => 'Android.*(\bMID\b|MID-560|MTV-T1200|MTV-PND531|MTV-P1101|MTV-PND530)',
        // @ref: http://www.rock-chips.com/index.php?do=prod&pid=2
        'RockChipTablet'    => 'Android.*RK(?:2818|2918|3066)|RK2738|RK2808A',
        // @ref: http://www.telstra.com.au/home-phone/thub-2/
        'TelstraTablet'     => 'T-Hub2',
        // @ref: http://www.fly-phone.com/devices/tablets/ ; http://www.fly-phone.com/service/
        'FlyTablet'         => 'IQ310|Fly Vision',
        // @ref: http://www.bqreaders.com/gb/tablets-prices-sale.html
        'bqTablet'          => '\bbq\b.*(Elcano|Curie|Edison|Maxwell|Kepler|Pascal|Tesla|Hypatia|Platon|Newton|Livingstone|Cervantes|Avant)',
        // @ref: http://www.huaweidevice.com/worldwide/productFamily.do?method=index&directoryId=5011&treeId=3290
        // @ref: http://www.huaweidevice.com/worldwide/downloadCenter.do?method=index&directoryId=3372&treeId=0&tb=1&type=software (including legacy tablets)
        'HuaweiTablet'      => 'MediaPad|IDEOS S7|S7-201c|S7-202u|S7-101|S7-103|S7-104|S7-105|S7-106|S7-201|S7-Slim',
        'GenericTablet'     => 'Android.*\b97D\b|Tablet(?!.*PC)|ViewPad7|LG-V909|MID7015|BNTV250A|LogicPD Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b|hp-tablet',
    );
    // List of mobile Operating Systems.
    protected $operatingSystems = array(
        'AndroidOS'         => 'Android',
        'BlackBerryOS'      => 'blackberry|rim tablet os',
        'PalmOS'            => 'PalmOS|avantgo|blazer|elaine|hiptop|palm|plucker|xiino',
        'SymbianOS'         => 'Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\bS60\b',
        // @reference: http://en.wikipedia.org/wiki/Windows_Mobile
        'WindowsMobileOS'   => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
        // @reference: http://en.wikipedia.org/wiki/Windows_Phone
        // http://wifeng.cn/?r=blog&a=view&id=106
        // http://nicksnettravels.builttoroam.com/post/2011/01/10/Bogus-Windows-Phone-7-User-Agent-String.aspx
        'WindowsPhoneOS'   => 'Windows Phone OS|XBLWP7|ZuneWP7',
        'iOS'               => 'iphone|ipod|ipad',
        'FlashLiteOS'       => '',
        // http://en.wikipedia.org/wiki/MeeGo
        // @todo: research MeeGo in UAs
        'MeeGoOS'           => 'MeeGo',
        // http://en.wikipedia.org/wiki/Maemo
        // @todo: research Maemo in UAs
        'MaemoOS'           => 'Maemo',
        'JavaOS'            => 'J2ME/MIDP|Java/',
        'webOS'             => 'webOS|hpwOS',
        'badaOS'            => '\bBada\b',
        'BREWOS'            => 'BREW',
    );
    // List of mobile User Agents.
    protected $userAgents = array(
        // @reference: https://developers.google.com/chrome/mobile/docs/user-agent
        'Chrome'          => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
        'Dolfin'          => '\bDolfin\b',
        'Opera'           => 'Opera.*Mini|Opera.*Mobi|Android.*Opera',
        'Skyfire'         => 'Skyfire',
        'IE'              => 'IEMobile|MSIEMobile',
        'Firefox'         => 'fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile',
        'Bolt'            => 'bolt',
        'TeaShark'        => 'teashark',
        'Blazer'          => 'Blazer',
        // @reference: http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/OptimizingforSafarioniPhone/OptimizingforSafarioniPhone.html#//apple_ref/doc/uid/TP40006517-SW3
        'Safari'          => 'Version.*Mobile.*Safari|Safari.*Mobile',
        // @ref: http://en.wikipedia.org/wiki/Midori_(web_browser)
        //'Midori'          => 'midori',
        'Tizen'           => 'Tizen',
        'UCBrowser'       => 'UC.*Browser|UCWEB',
        // @ref: https://github.com/serbanghita/Mobile-Detect/issues/7
        'DiigoBrowser'    => 'DiigoBrowser',
        // http://www.puffinbrowser.com/index.php
        'Puffin'            => 'Puffin',
        // @reference: http://en.wikipedia.org/wiki/Minimo
        // http://en.wikipedia.org/wiki/Vision_Mobile_Browser
        'GenericBrowser'  => 'NokiaBrowser|OviBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision'
    );
    // Utilities.
    protected $utilities = array(
        'WebKit'        => '(webkit)[ /]([\w.]+)',
        'Bot'           => 'Googlebot|DoCoMo|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit',
        'MobileBot'     => 'Googlebot-Mobile|DoCoMo|YahooSeeker/M1A1-R2D2',
    );
    // Properties list.
    // @reference: http://user-agent-string.info/list-of-ua#Mobile Browser
    const VER = '([\w._]+)';
    protected $properties = array(

        // Build
        'Mobile'        => 'Mobile/[VER]',
        'Build'         => 'Build/[VER]',
        'Version'       => 'Version/[VER]',
        'VendorID'      => 'VendorID/[VER]',

        // Devices
        'iPad'          => 'iPad.*CPU[a-z ]+[VER]',
        'iPhone'        => 'iPhone.*CPU[a-z ]+[VER]',
        'iPod'          => 'iPod.*CPU[a-z ]+[VER]',
        //'BlackBerry'    => array('BlackBerry[VER]', 'BlackBerry [VER];'),
        'Kindle'        => 'Kindle/[VER]',

        // Browser
        'Chrome'        => 'Chrome/[VER]',
        'CriOS'         => 'CriOS/[VER]',
        'Dolfin'        => 'Dolfin/[VER]',
        // @reference: https://developer.mozilla.org/en-US/docs/User_Agent_Strings_Reference
        'Firefox'       => 'Firefox/[VER]',
        'Fennec'        => 'Fennec/[VER]',
        // @reference: http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
        'IEMobile'      => array('IEMobile/[VER];', 'IEMobile [VER]'),
        'MSIE'          => 'MSIE [VER];',
        // http://en.wikipedia.org/wiki/NetFront
        'NetFront'      => 'NetFront/[VER]',
        'NokiaBrowser'  => 'NokiaBrowser/[VER]',
        'NokiaBrowser'  => 'NokiaBrowser/[VER]',
        'Opera'         => 'Version/[VER]',
        'Opera Mini'    => 'Opera Mini/[VER]',
        'Opera Mobi'    => 'Version/[VER]',
        'UC Browser'    => 'UC Browser[VER]',
        'Safari'        => 'Version/[VER]',
        'Skyfire'       => 'Skyfire/[VER]',
        'Tizen'         => 'Tizen/[VER]',
        'Webkit'        => 'webkit[ /][VER]',

        // Engine
        'Gecko'         => 'Gecko/[VER]',
        'Trident'       => 'Trident/[VER]',
        'Presto'        => 'Presto/[VER]',

        // OS
        'Android'          => 'Android [VER]',
        'BlackBerry'       => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]'),
        'BREW'             => 'BREW [VER]',
        'Java'             => 'Java/[VER]',
        // @reference: http://windowsteamblog.com/windows_phone/b/wpdev/archive/2011/08/29/introducing-the-ie9-on-windows-phone-mango-user-agent-string.aspx
        // @reference: http://en.wikipedia.org/wiki/Windows_NT#Releases
        'Windows Phone OS' => 'Windows Phone OS [VER]',
        'Windows Phone'    => 'Windows Phone [VER]',
        'Windows CE'       => 'Windows CE/[VER]',
        // http://social.msdn.microsoft.com/Forums/en-US/windowsdeveloperpreviewgeneral/thread/6be392da-4d2f-41b4-8354-8dcee20c85cd
        'Windows NT'       => 'Windows NT [VER]',
        'Symbian'          => array('SymbianOS/[VER]', 'Symbian/[VER]'),
        'webOS'            => array('webOS/[VER]', 'hpwOS/[VER];'),


    );

    function __construct(){

        $this->setHttpHeaders();
        $this->setUserAgent();

        $this->setMobileDetectionRules();
        $this->setMobileDetectionRulesExtended();

    }


    /**
    * Get the current script version.
    * This is useful for the demo.php file,
    * so people can check on what version they are testing
    * for mobile devices.
    */
    public function getScriptVersion(){

        return $this->scriptVersion;

    }

    public function setHttpHeaders($httpHeaders = null){

        if(!empty($httpHeaders)){
            $this->httpHeaders = $httpHeaders;
        } else {
            foreach($_SERVER as $key => $value){
                if(substr($key,0,5)=='HTTP_'){
                    $this->httpHeaders[$key] = $value;
                }
            }
        }

    }

    public function getHttpHeaders(){

        return $this->httpHeaders;

    }

    public function setUserAgent($userAgent = null){

        if(!empty($userAgent)){
            $this->userAgent = $userAgent;
        } else {
            $this->userAgent    = isset($this->httpHeaders['HTTP_USER_AGENT']) ? $this->httpHeaders['HTTP_USER_AGENT'] : null;

            if(empty($this->userAgent)){
                $this->userAgent = isset($this->httpHeaders['HTTP_X_DEVICE_USER_AGENT']) ? $this->httpHeaders['HTTP_X_DEVICE_USER_AGENT'] : null;
            }
            // Header can occur on devices using Opera Mini (can expose the real device type). Let's concatenate it (we need this extra info in the regexes).
            if(!empty($this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'])){
                $this->userAgent .= ' '.$this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'];
            }
        }

    }

    public function getUserAgent(){

        return $this->userAgent;

    }

    function setDetectionType($type = null){

        $this->detectionType = (!empty($type) ? $type : 'mobile');

    }

    public function getPhoneDevices(){

        return $this->phoneDevices;

    }

    public function getTabletDevices(){

        return $this->tabletDevices;

    }

    /**
     * Method sets the mobile detection rules.
     *
     * This method is used for the magic methods $detect->is*()
     */
    public function setMobileDetectionRules(){
        // Merge all rules together.
        $this->mobileDetectionRules = array_merge(
            $this->phoneDevices,
            $this->tabletDevices,
            $this->operatingSystems,
            $this->userAgents
        );

    }

    /**
     * Method sets the mobile detection rules + utilities.
     * The reason this is separate is because utilities rules
     * don't necessary imply mobile.
     *
     * This method is used inside the new $detect->is('stuff') method.
     *
     * @return bool
     */
    public function setMobileDetectionRulesExtended(){

        // Merge all rules together.
        $this->mobileDetectionRulesExtended = array_merge(
            $this->phoneDevices,
            $this->tabletDevices,
            $this->operatingSystems,
            $this->userAgents,
            $this->utilities
        );

    }

    /**
     * @return array
     */
    public function getRules()
    {

        if($this->detectionType=='extended'){
            return $this->mobileDetectionRulesExtended;
        } else {
            return $this->mobileDetectionRules;
        }

    }

/**
* Check the HTTP headers for signs of mobile.
* This is the fastest mobile check possible; it's used
* inside isMobile() method.
* @return boolean
*/
    public function checkHttpHeadersForMobile(){

        if(
            isset($this->httpHeaders['HTTP_ACCEPT']) &&
                (strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/x-obml2d') !== false || // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/vnd.rim.html') !== false || // BlackBerry devices.
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'text/vnd.wap.wml') !== false ||
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/vnd.wap.xhtml+xml') !== false) ||
            isset($this->httpHeaders['HTTP_X_WAP_PROFILE'])             || // @todo: validate
            isset($this->httpHeaders['HTTP_X_WAP_CLIENTID'])            ||
            isset($this->httpHeaders['HTTP_WAP_CONNECTION'])            ||
            isset($this->httpHeaders['HTTP_PROFILE'])                   ||
            isset($this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'])      || // Reported by Nokia devices (eg. C3)
            isset($this->httpHeaders['HTTP_X_NOKIA_IPADDRESS'])         ||
            isset($this->httpHeaders['HTTP_X_NOKIA_GATEWAY_ID'])        ||
            isset($this->httpHeaders['HTTP_X_ORANGE_ID'])               ||
            isset($this->httpHeaders['HTTP_X_VODAFONE_3GPDPCONTEXT'])   ||
            isset($this->httpHeaders['HTTP_X_HUAWEI_USERID'])           ||
            isset($this->httpHeaders['HTTP_UA_OS'])                     || // Reported by Windows Smartphones.
            isset($this->httpHeaders['HTTP_X_MOBILE_GATEWAY'])          || // Reported by Verizon, Vodafone proxy system.
            isset($this->httpHeaders['HTTP_X_ATT_DEVICEID'])            || // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e
            //HTTP_X_NETWORK_TYPE = WIFI
            ( isset($this->httpHeaders['HTTP_UA_CPU']) &&
                    $this->httpHeaders['HTTP_UA_CPU'] == 'ARM'          // Seen this on a HTC.
            )
        ){

            return true;

        }

        return false;

    }

    /**
     * Magic overloading method.
     *
     * @method boolean is[...]()
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {

        $this->setDetectionType('mobile');

        $key = substr($name, 2);
        return $this->matchUAAgainstKey($key);

    }

    /**
    * Find a detection rule that matches the current User-agent.
    *
    * @param null $userAgent deprecated
    * @return boolean
    */
    private function matchDetectionRulesAgainstUA($userAgent = null){

        // Begin general search.
        foreach($this->getRules() as $_regex){
            if(empty($_regex)){ continue; }
            if( $this->match($_regex, $userAgent) ){
                //var_dump( $_regex );
                return true;
            }
        }

        return false;

    }

    /**
    * Search for a certain key in the rules array.
    * If the key is found the try to match the corresponding
    * regex agains the User-agent.
    *
    * @param string $key
    * @param null $userAgent deprecated
    * @return mixed
    */
    private function matchUAAgainstKey($key, $userAgent = null){

        // Make the keys lowercase so we can match: isIphone(), isiPhone(), isiphone(), etc.
        $key = strtolower($key);
        $_rules = array_change_key_case($this->getRules());

        if(array_key_exists($key, $_rules)){
            if(empty($_rules[$key])){ return null; }
            return $this->match($_rules[$key], $userAgent);
        }

        return false;

    }

    /**
    * Check if the device is mobile.
    * Returns true if any type of mobile device detected, including special ones
    * @param null $userAgent deprecated
    * @param null $httpHeaders deprecated
    * @return bool
    */
    public function isMobile($userAgent = null, $httpHeaders = null) {

        if($httpHeaders){ $this->setHttpHeaders($httpHeaders); }
        if($userAgent){ $this->setUserAgent($userAgent); }

        $this->setDetectionType('mobile');

        if ($this->checkHttpHeadersForMobile()) {
            return true;
        } else {
            return $this->matchDetectionRulesAgainstUA();
        }

    }

    /**
    * Check if the device is a tablet.
    * Return true if any type of tablet device is detected.
     *
     * @param null $userAgent deprecated
     * @param null $httpHeaders deprecated
     * @return bool
    */
    public function isTablet($userAgent = null, $httpHeaders = null) {

        $this->setDetectionType('mobile');

        foreach($this->tabletDevices as $_regex){
            if($this->match($_regex, $userAgent)){
                return true;
            }
        }

	    return false;

    }

    /**
     * This method checks for a certain property in the
     * userAgent.
     * @todo: The httpHeaders part is not yet used.
     *
     * @param $key
     * @param string $userAgent deprecated
     * @param string $httpHeaders deprecated
     * @return bool|int|null
     */
    public function is($key, $userAgent = null, $httpHeaders = null){


        // Set the UA and HTTP headers only if needed (eg. batch mode).
        if($httpHeaders) $this->setHttpHeaders($httpHeaders);
        if($userAgent) $this->setUserAgent($userAgent);

        $this->setDetectionType('extended');

        return $this->matchUAAgainstKey($key);

    }

    public function getOperatingSystems(){

        return $this->operatingSystems;

    }

    /**
     * Some detection rules are relative (not standard),
     * because of the diversity of devices, vendors and
     * their conventions in representing the User-Agent or
     * the HTTP headers.
     *
     * This method will be used to check custom regexes against
     * the User-Agent string.
     *
     * @param $regex
     * @param string $userAgent
     * @return bool
     *
     * @todo: search in the HTTP headers too.
     */
    function match($regex, $userAgent=null){

        // Escape the special character which is the delimiter.
        $regex = str_replace('/', '\/', $regex);

        return (bool)preg_match('/'.$regex.'/is', (!empty($userAgent) ? $userAgent : $this->userAgent));

    }

    /**
     * Get the properties array.
     * @return array
     */
    function getProperties(){

        return $this->properties;

    }

    /**
     * Prepare the version number.
     *
     * @param $ver
     * @return int
     */
    function prepareVersionNo($ver){

        $ver = str_replace(array('_', ' ', '/'), array('.', '.', '.'), $ver);
        $arrVer = explode('.', $ver, 2);
        $arrVer[1] = @str_replace('.', '', $arrVer[1]); // @todo: treat strings versions.
        $ver = (float)implode('.', $arrVer);

        return $ver;

    }

    /**
     * Check the version of the given property in the User-Agent.
     * Will return a float number. (eg. 2_0 will return 2.0, 4.3.1 will return 4.31)
     *
     * @param string $propertyName
     * @return mixed $version
     */
    function version($propertyName){

        $properties = $this->getProperties();

        // If the property is found in the User-Agent then move to the next step.
        if(stripos($this->userAgent, $propertyName)!==false){

            // Prepare the pattern to be matched.
            // Make sure we always deal with an array (string is converted).
            $properties[$propertyName] = (array)$properties[$propertyName];

            foreach($properties[$propertyName] as $propertyMatchString){

                $propertyPattern = str_replace('[VER]', self::VER, $propertyMatchString);

                // Escape the special character which is the delimiter.
                $propertyPattern = str_replace('/', '\/', $propertyPattern);

                // Identify and extract the version.
                preg_match('/'.$propertyPattern.'/is', $this->userAgent, $match);

                if(!empty($match[1])){
                    $version = $this->prepareVersionNo($match[1]);
                    return $version;
                }

            }

            return 0;

        }

        return false;

    }

    function mobileGrade(){

        $isMobile = $this->isMobile();

        if(
            // Apple iOS 3.2-5.1 - Tested on the original iPad (4.3 / 5.0), iPad 2 (4.3), iPad 3 (5.1), original iPhone (3.1), iPhone 3 (3.2), 3GS (4.3), 4 (4.3 / 5.0), and 4S (5.1)
            $this->version('iPad')>=4.3 ||
            $this->version('iPhone')>=3.1 ||
            $this->version('iPod')>=3.1 ||

            // Android 2.1-2.3 - Tested on the HTC Incredible (2.2), original Droid (2.2), HTC Aria (2.1), Google Nexus S (2.3). Functional on 1.5 & 1.6 but performance may be sluggish, tested on Google G1 (1.5)
            // Android 3.1 (Honeycomb)  - Tested on the Samsung Galaxy Tab 10.1 and Motorola XOOM
            // Android 4.0 (ICS)  - Tested on a Galaxy Nexus. Note: transition performance can be poor on upgraded devices
            // Android 4.1 (Jelly Bean)  - Tested on a Galaxy Nexus and Galaxy 7
            ( $this->version('Android')>2.1 && $this->is('Webkit') ) ||

            // Windows Phone 7-7.5 - Tested on the HTC Surround (7.0) HTC Trophy (7.5), LG-E900 (7.5), Nokia Lumia 800
            $this->version('Windows Phone OS')>=7.0 ||

            // Blackberry 7 - Tested on BlackBerry® Torch 9810
            // Blackberry 6.0 - Tested on the Torch 9800 and Style 9670
            $this->version('BlackBerry')>=6.0 ||
            // Blackberry Playbook (1.0-2.0) - Tested on PlayBook
            $this->match('Playbook.*Tablet') ||

            // Palm WebOS (1.4-2.0) - Tested on the Palm Pixi (1.4), Pre (1.4), Pre 2 (2.0)
            ( $this->version('webOS')>=1.4 && $this->match('Palm|Pre|Pixi') ) ||
            // Palm WebOS 3.0  - Tested on HP TouchPad
            $this->match('hp.*TouchPad') ||

            // Firefox Mobile (12 Beta) - Tested on Android 2.3 device
            ( $this->is('Firefox') && $this->version('Firefox')>=12 ) ||

            // Chrome for Android - Tested on Android 4.0, 4.1 device
            ( $this->is('Chrome') && $this->is('AndroidOS') && $this->version('Android')>=4.0 ) ||

            // Skyfire 4.1 - Tested on Android 2.3 device
            ( $this->is('Skyfire') && $this->version('Skyfire')>=4.1 && $this->is('AndroidOS') && $this->version('Android')>=2.3 ) ||

            // Opera Mobile 11.5-12: Tested on Android 2.3
            ( $this->is('Opera') && $this->version('Opera Mobi')>11 && $this->is('AndroidOS') ) ||

            // Meego 1.2 - Tested on Nokia 950 and N9
            $this->is('MeeGoOS') ||

            // Tizen (pre-release) - Tested on early hardware
            $this->is('Tizen') ||

            // Samsung Bada 2.0 - Tested on a Samsung Wave 3, Dolphin browser
            // @todo: more tests here!
            $this->is('Dolfin') && $this->version('Bada')>=2.0 ||

            // UC Browser - Tested on Android 2.3 device
            ( ($this->is('UC Browser') || $this->is('Dolfin')) && $this->version('Android')>=2.3 ) ||

            // Kindle 3 and Fire  - Tested on the built-in WebKit browser for each
            ( $this->match('Kindle Fire') ||
            $this->is('Kindle') && $this->version('Kindle')>=3.0 ) ||

            // Nook Color 1.4.1 - Tested on original Nook Color, not Nook Tablet
            $this->is('AndroidOS') && $this->is('NookTablet') ||

            // Chrome Desktop 11-21 - Tested on OS X 10.7 and Windows 7
            $this->version('Chrome')>=11 && !$isMobile ||

            // Safari Desktop 4-5 - Tested on OS X 10.7 and Windows 7
            $this->version('Safari')>=5.0 && !$isMobile ||

            // Firefox Desktop 4-13 - Tested on OS X 10.7 and Windows 7
            $this->version('Firefox')>=4.0 && !$isMobile ||

            // Internet Explorer 7-9 - Tested on Windows XP, Vista and 7
            $this->version('MSIE')>=7.0 && !$isMobile ||

            // Opera Desktop 10-12 - Tested on OS X 10.7 and Windows 7
            // @reference: http://my.opera.com/community/openweb/idopera/
            $this->version('Opera')>=10 && !$isMobile


        ){
            return 'A';
        }

        if(
            // Blackberry 5.0: Tested on the Storm 2 9550, Bold 9770
            $this->version('BlackBerry')>=5 && $this->version('BlackBerry')<6 ||

            //Opera Mini (5.0-6.5) - Tested on iOS 3.2/4.3 and Android 2.3
            ( $this->version('Opera Mini')>=5.0 && $this->version('Opera Mini')<=6.5 &&
            ($this->version('Android')>=2.3 || $this->is('iOS')) ) ||

            // Nokia Symbian^3 - Tested on Nokia N8 (Symbian^3), C7 (Symbian^3), also works on N97 (Symbian^1)
            $this->match('NokiaN8|NokiaC7|N97.*Series60|Symbian/3') ||

            // @todo: report this (tested on Nokia N71)
            $this->version('Opera Mobi')>=11 && $this->is('SymbianOS')

            ){
            return 'B';
        }

        if(
            // Blackberry 4.x - Tested on the Curve 8330
            $this->version('BlackBerry')<5.0 ||
            // Windows Mobile - Tested on the HTC Leo (WinMo 5.2)
            $this->match('MSIEMobile|Windows CE.*Mobile') || $this->version('Windows Mobile')<=5.2


        ){

            return 'C';

        }

        // All older smartphone platforms and featurephones - Any device that doesn't support media queries will receive the basic, C grade experience
        return 'C';


    }


}
