<?php
/**
 * Mobile Detect
 * 
 * @usage      require_once 'Mobile_Detect.php';
 *             $detect = new Mobile_Detect();
 *             $detect->isMobile() or $detect->isTablet()
 * 
 *             For more specific usage see the documentation inside the class.
 *             $detect->isAndroidOS() or $detect->isiPhone() ...
 * 
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Mobile_Detect {
    
    protected $detectionRules;
    protected $userAgent = null;
    protected $accept = null;
    // Assume the visitor has a desktop environment.
    protected $isMobile = false;
    protected $isTablet = false;
    protected $phoneDeviceName = null;
    protected $tabletDevicename = null;
    protected $operatingSystemName = null;
    protected $userAgentName = null;
    // List of mobile devices (phones)
    protected $phoneDevices = array(     
            'iPhone' => '(iPhone.*Mobile|iPod|iTunes)',            
            'BlackBerry' => 'BlackBerry|rim[0-9]+',
            'HTC' => 'HTC|Desire',
            'Nexus' => 'Nexus One|Nexus S',
            'DellStreak' => 'Dell Streak',
            'Motorola' => '\bDroid\b.*Build|HRI39|MOT\-',
            'Samsung' => 'Samsung|GT-P1000|SGH-T959D',
            'Sony' => 'E10i',
            'Asus' => 'Asus.*Galaxy',
            'Palm' => 'PalmSource|Palm', // avantgo|blazer|elaine|hiptop|plucker|xiino
            'GenericPhone' => '(mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|wap|nokia|SonyEricsson|N900|\bPPC\b|MAUI.*WAP.*Browser)'
    );
    // List of tablet devices.
    protected $tabletDevices = array(
        'BlackBerryTablet' => 'PlayBook|RIM Tablet',
        'iPad' => 'iPad.*Mobile',
        'Kindle' => 'Kindle|Silk.*Accelerated',
        'SamsungTablet' => 'SCH\-I800|GT\-P1000',
        'MotorolaTablet' => 'xoom|sholest',
        'AsusTablet' => 'Transformer|TF101',
        'GenericTablet' => 'Tablet|ViewPad7|LG\-V909|MID7015|BNTV250A|LogicPD Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b',
    );
    // List of mobile Operating Systems.
    protected $operatingSystems = array(
        'AndroidOS' => '(android.*mobile|android(?!.*mobile))',
        'BlackBerryOS' => '(blackberry|rim tablet os)',
        'PalmOS' => '(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)',
        'SymbianOS' => 'Symbian',
        'WindowsMobileOS' => 'IEMobile|Windows Phone|Windows CE.*(PPC|Smartphone)|MSIEMobile|Window Mobile|XBLWP7',
        'iOS' => '(iphone|ipod|ipad)',
        'FlashLiteOS' => '',
        'JavaOS' => '',
        'NokiaOS' => '',
        'webOS' => '',
        'badaOS' => '',
        'BREWOS' => '',
    );
    // List of mobile User Agents.
    protected $userAgents = array(      
      'Chrome' => '\bCrMo\b',
      'Dolfin' => 'Dolfin',
      'Opera' => '(Opera.*Mini|Opera.*Mobi)',  
      'Skyfire' => 'skyfire',      
      'IE' => 'ie*mobile',
      'Firefox' => 'fennec|firefox.*maemo',
      'Bolt' => 'bolt',
      'TeaShark' => 'teashark',
      'Blazer' => 'Blazer',
      'Safari' => 'Mobile*Safari',
      'Midori' => 'midori',
      'GenericBrowser' => 'NokiaBrowser'
    );
    
    function __construct(){
        
        // Merge all rules together.
        $this->detectionRules = array_merge(
                                            $this->phoneDevices, 
                                            $this->tabletDevices, 
                                            $this->operatingSystems, 
                                            $this->userAgents
                                            );
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->accept = $_SERVER['HTTP_ACCEPT'];  
        
        if (
		isset($_SERVER['HTTP_X_WAP_PROFILE']) ||
                isset($_SERVER['HTTP_X_WAP_CLIENTID']) ||
                isset($_SERVER['HTTP_WAP_CONNECTION']) ||
		isset($_SERVER['HTTP_PROFILE']) ||
		isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) || // Reported by Nokia devices (eg. C3)
                isset($_SERVER['HTTP_X_NOKIA_IPADDRESS']) ||
                isset($_SERVER['HTTP_X_NOKIA_GATEWAY_ID']) ||
                isset($_SERVER['HTTP_X_ORANGE_ID']) ||
                isset($_SERVER['HTTP_X_VODAFONE_3GPDPCONTEXT']) ||
                isset($_SERVER['HTTP_X_HUAWEI_USERID']) ||
                isset($_SERVER['HTTP_UA_OS']) // Reported by Windows Smartphones
		) {
                $this->isMobile = true;
        } elseif (!empty($this->accept) && (strpos($this->accept, 'text/vnd.wap.wml') !== false || strpos($this->accept, 'application/vnd.wap.xhtml+xml') !== false)) {
                $this->isMobile = true;
        } else {
                $this->_detect();
        }        
        
    }
	
    public function getRules()
    {
        return $this->detectionRules;
    }
    
    /**
     * 
     * @method boolean isiPhone()
     * @method boolean isBlackBerry()
     * @method boolean isHTC()
     * @method boolean isNexus()
     * @method boolean isDellStreak()
     * @method boolean isMotorola()
     * @method boolean isSamsung()
     * @method boolean isSony()
     * @method boolean isAsus()
     * @method boolean isPalm()
     *
     * @method boolean isBlackBerryTablet()
     * @method boolean isiPad()
     * @method boolean isKindle()
     * @method boolean isSamsungTablet()
     * @method boolean isMotorolaTablet()
     * @method boolean isAsusTablet()
     *       
     * @method boolean isAndroidOS()
     * @method boolean isBlackBerryOS()
     * @method boolean isPalmOS()
     * @method boolean isSymbianOS()
     * @method boolean isWindowsMobileOS()
     * @method boolean isiOS()
     * 
     * @method boolean isChrome()
     * @method boolean isDolfin()
     * @method boolean isOpera()
     * @method boolean isSkyfire()
     * @method boolean isIE()
     * @method boolean isFirefox()
     * @method boolean isBolt()
     * @method boolean isTeaShark()
     * @method boolean isBlazer()
     * @method boolean isSafari()
     * @method boolean isMidori()
     *   
     * @param string $name
     * @param array $arguments
     * @return mixed 
     */
    public function __call($name, $arguments)
    {
                
        $key = substr($name, 2);
        return $this->_detect($key);
        
    }
	
    private function _detect($key='')
    {

        if(empty($key)){ 

            // Begin general search.
            foreach($this->detectionRules as $_key => $_regex){
                if(empty($_regex)){ continue; }
                if(preg_match('/'.$_regex.'/is', $this->userAgent)){
                    $this->isMobile = true;
                    return true;
                } 
            }
            return false;

        } else {
            
            // Search for a certain key.
            // Make the keys lowecase so we can match: isIphone(), isiPhone(), isiphone(), etc.
            $key = strtolower($key);
            $_rules = array_change_key_case($this->detectionRules);
            
            if(array_key_exists($key, $_rules)){
                if(empty($_rules[$key])){ return null; }
                if(preg_match('/'.$_rules[$key].'/is', $this->userAgent)){
                    $this->isMobile = true;
                    return true;
                } else {
                    return false;
                }           
            } else {
                trigger_error("Method $name is not defined", E_USER_WARNING);
            }	

        }

    }
        
    /**
    * Returns true if any type of mobile device detected, including special ones
    * @return bool
    */
    public function isMobile()
    {
            return $this->isMobile;
    } 
    
    /**
     * Return true if any type of tablet device is detected.
     * @return boolean 
     */
    public function isTablet()
    {
        
        foreach($this->tabletDevices as $_key => $_regex){
            if(preg_match('/'.$_regex.'/is', $this->userAgent)){
                $this->isTablet = true;
                return true;
            }
        }
        
        return false;        
            
    }
    
    
}