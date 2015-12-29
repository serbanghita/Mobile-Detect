<?php
namespace MobileDetect\Repository\Browser;

use MobileDetect\Context;
use MobileDetect\Matcher\BrowserMatcher;

class BrowserRepository
{
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
    protected static $data = array(
        /**
         * Microsoft Internet Explorer family
         *
         * @docs http://msdn.microsoft.com/en-us/library/ms537503(v=vs.85).aspx
         */
        'IE' => [
            'IE Mobile' => [
                'vendor' => 'Microsoft',
                'model' => 'IE Mobile',

                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['IEMobile|MSIEMobile|Trident/[0-9.]+; Touch; rv:[0-9.]+;'],
                        'matchType' => 'regex'
                    ]
                ],

                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident.*rv.[VER]']
                    ]
                ],

                'triggers' => [
                    ['isMobile' => true]
                ]
            ],

            'IE Desktop' => [
                'vendor' => 'Microsoft',
                'model' => 'IE Desktop',

                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['MSIE [0-9.]+;|Trident.*rv.[0-9.]+'],
                        'matchType' => 'regex'
                    ]
                ],

                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['MSIE [VER];', 'Trident.*rv.[VER]']
                    ]
                ],

                'triggers' => [
                    ['isMobile' => false]
                ]
            ],
        ],
        
        /**
         * Opera family
         */
        'Opera' => [
            'Opera Mini' => [
                'vendor' => 'Opera',
                'model' => 'Opera Mini',

                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['Opera.*Mini'],
                        'matchType' => 'regex'
                    ]
                ],
                
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Opera Mini/[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            'Opera Mobi' => [
                'vendor' => 'Opera',
                'model' => 'Opera Mobi',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Opera Mobi/[VER]', ' OPR/[VER]', 'Version/[VER]'],
                        'matchType' => 'regex'
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
    
            'Opera Coast' => [
                'vendor' => 'Opera',
                'model' => 'Opera Coast',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['Coast/[0-9.]+'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Coast/[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            'Opera Desktop' => [
                'vendor' => 'Opera',
                'model' => 'Opera Desktop',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['\bOpera\b| OPR/'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Opera/[VER]', ' OPR/[VER]', 'Version/[VER]']
                    ]
                ],

                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
        ],
        
        /**
         * Google Chrome browser family
         *
         * @docs https://developers.google.com/chrome/mobile/docs/user-agent
         */
        'Chrome' => [
            'Chrome Mobile' => [
                'vendor' => 'Google',
                'model' => 'Chrome Mobile',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'],
                    ]
                ],
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            'Chrome Desktop' => [
                'vendor' => 'Google',
                'model' => 'Chrome Desktop',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['\bChrome\b/[.0-9]*'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Chrome/[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => false]
                ]
            ],
        ],

        /**
         * NetFront browsers family.
         * @todo (Serban) Should we split this into NetFront and NetFrontLife? Mobile/Desktop
         * @docs http://en.wikipedia.org/wiki/NetFront
         */
        'NetFront' => [
            'NetFront Mobile' => [
                'vendor' => 'NetFront',
                'model' => 'NetFront Mobile',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['NetFront/[.0-9]+|NetFrontLifeBrowser|NF-Browser'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['NetFront/[VER]', 'NetFrontLifeBrowser/[VER]', 'Version/[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ]
        ],

        'Generic' => [
            /**
             * Dolfin family has only mobile browsers.
             * @docs https://en.wikipedia.org/wiki/Dolphin_Browser
             */
            'Dolfin' => [
                'vendor' => 'Dolfin',
                'model' => 'Dolfin',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['\bDolfin\b'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Dolfin/[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            /**
             * @docs http://www.ucweb.com/
             */
            'UCBrowser' => [
                'vendor' => 'UCWeb',
                'model' => 'UCBrowser',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['UC.*Browser|UCWEB'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['UCWEB[VER]', 'UCBrowser/[VER]']
                    ]
                    
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            'Silk' => [
                'vendor' => 'Amazon',
                'model' => 'Silk',
                
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['\bSilk\b'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Silk\[VER]']
                    ]
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],
            
            'Generic Mobile' => [
                'vendor' => 'Generic',
                'model' => 'Generic Mobile',
                
                'matchIdentity' => [
                        [
                            'context' => null,
                            'match' => [
                                'NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser',
                                'FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|UP.Browser|ObigoInternetBrowser'
                            ],
                            'matchType' => 'regex'
                        ]
                ],
                // @todo If this grows, then split into multiple generic browsers as they become important.
                'versionMatches' => [
                    [
                        'context' => null,
                        'match' => ['Version/[VER]', 'Safari/[VER]', 'Browser/[VER]']
                    ]
                    
                ],
                
                'triggers' => [
                    ['isMobile' => true]
                ]
            ]
        ],

        /**
         * Apple Safari family
         *
         * @docs http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/OptimizingforSafarioniPhone/OptimizingforSafarioniPhone.html#//apple_ref/doc/uid/TP40006517-SW3
         * @note Safari 7534.48.3 is actually Version 5.1.
         * @note On BlackBerry the Version is overwritten by the OS.
         */
        'Safari' => [

            'Safari Mobile' => [
                'vendor' => 'Apple',
                'model' => 'Safari Mobile',
                'matchIdentity' => [
                    [
                        'context' => ['isMobile' => true],
                        'match' => ['Safari/[0-9.]+'],
                        'matchType' => 'regex'
                    ],
                    [
                        'context' => null,
                        'match' => ['Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari|Android.*Safari'],
                        'matchType' => 'regex'
                    ]
                ],
                // @note: Safari 7534.48.3 is actually Version 5.1.
                // On BlackBerry the Version is overwritten by the OS.
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Safari/[VER]', 'Version/[VER]'],
                        'matchProcessor' => 'getSafariVersion'
                    ]
                ],
                'triggers' => [
                    ['isMobile' => true]
                ]
            ],

            'Safari Desktop' => [
                'vendor' => 'Apple',
                'model' => 'Safari Desktop',
                'matchIdentity' => [
                    [
                        'context' => null,
                        'match' => ['Safari/[0-9.]+'],
                        'matchType' => 'regex'
                    ]
                ],
                'matchVersion' => [
                    [
                        'context' => null,
                        'match' => ['Version/[VER]', 'Safari/[VER]'],
                        'matchType' => 'regex',
                        'matchProcessor' => 'getSafariVersion'
                    ]
                ],
                'triggers' => [
                    ['isMobile' => false]
                ]
            ]

        ]
    );

    // Updated from https://en.wikipedia.org/wiki/Safari_version_history
    public static function getSafariVersions()
    {
          return array(
              // On Mac OS.
              '0.8' => array('version' => '48', 'codename' => ''),
              '73' => array('version' => '0.9', 'codename' => ''),
              // v. 1.0
              '85' => array('version' => '1.0', 'codename' => ''),
              '85.8.5' => array('version' => '1.0.3', 'codename' => ''),
              '100' => array('version' => '1.1', 'codename' => ''),
              '125' => array('version' => '1.2', 'codename' => ''),
              '312' => array('version' => '1.3', 'codename' => ''),
              '312.3' => array('version' => '1.3.1', 'codename' => ''),
              '312.5' => array('version' => '1.3.2', 'codename' => ''),
              '312.6' => array('version' => '1.3.2', 'codename' => ''),
              '412' => array('version' => '2.0', 'codename' => ''),
              '416.11' => array('version' => '2.0.2', 'codename' => ''),
              '419.3' => array('version' => '2.0.4', 'codename' => ''),
              '522.11' => array('version' => '3.0', 'codename' => ''),
              '522.12' => array('version' => '3.0.2', 'codename' => ''),
              '522.12.1' => array('version' => '3.0.3', 'codename' => ''),
              '523.10' => array('version' => '3.0.4', 'codename' => ''),
              '525.13' => array('version' => '3.1', 'codename' => ''),
              '525.17' => array('version' => '3.1.1', 'codename' => ''),
              '525.20' => array('version' => '3.1.1', 'codename' => ''),
              '525.21' => array('version' => '3.1.2', 'codename' => ''),
              '525.26' => array('version' => '3.2', 'codename' => ''),
              '525.27' => array('version' => '3.2.1', 'codename' => ''),
              '525.28' => array('version' => '3.2.3', 'codename' => ''),
              '526.11.2' => array('version' => '4.0 Beta', 'codename' => ''),
              '528.16' => array('version' => array('4.0', '4.0 Beta'), 'codename' => ''),
              '528.17' => array('version' => array('4.0', '4.0 Beta'), 'codename' => ''),
              '530.17' => array('version' => array('4.0', '4.0.1'), 'codename' => ''),
              '530.18' => array('version' => '4.0.1', 'codename' => ''),
              '530.19' => array('version' => '4.0.2', 'codename' => ''),
              '531.9' => array('version' => '4.0.3', 'codename' => ''),
              '531.21.10' => array('version' => '4.0.4', 'codename' => ''),
              '531.22.7' => array('version' => '4.0.5', 'codename' => ''),
              '533.16' => array('version' => array('4.1', '5.0'), 'codename' => ''),
              '533.17.8' => array('version' => array('4.1.1', '5.0.1'), 'codename' => ''),
              '533.17.9' => array('version' => '5.0.2', 'codename' => ''),
              '533.18.5' => array('version' => array('4.1.2', '5.0.2'), 'codename' => ''),
              '533.19.4' => array('version' => array('4.1.3', '5.0.3'), 'codename' => ''),
              '533.20.27' => array('version' => '5.0.4', 'codename' => ''),
              '533.21.1' => array('version' => '5.0.5', 'codename' => ''),
              '533.22.3' => array('version' => '5.0.6', 'codename' => ''),

              // From https://bugs.webkit.org/show_bug.cgi?id=44230
              '534.6+' => array('version' => '5.0.1', 'codename' => ''),
              // From https://bugs.webkit.org/show_bug.cgi?id=45632
              '534.8' => array('version' => '5.0.2', 'codename' => ''),
              '534.8+' => array('version' => '5.0.2', 'codename' => ''),
              // From https://bugs.webkit.org/show_bug.cgi?id=48312
              '534.11' => array('version' => '5.0.2', 'codename' => ''),
              '534.11+' => array('version' => '5.0.2', 'codename' => ''),
              '534.48.3' => array('version' => '5.1', 'codename' => ''),
              '534.51.22' => array('version' => '5.1.1', 'codename' => ''),
              '534.52.7' => array('version' => '5.1.2', 'codename' => ''),
              '534.53.10' => array('version' => '5.1.3', 'codename' => ''),
              '534.54.16' => array('version' => '5.1.4', 'codename' => ''),
              '534.55.3' => array('version' => '5.1.5', 'codename' => ''),
              '534.56.5' => array('version' => '5.1.6', 'codename' => ''),
              '534.57.2' => array('version' => '5.1.7', 'codename' => ''),
              '534.58.2' => array('version' => '5.1.8', 'codename' => ''),
              '534.59.8' => array('version' => '5.1.9', 'codename' => ''),
              '534.59.10' => array('version' => '5.1.10', 'codename' => ''),
              '536.2' => array('version' => '5.1.2', 'codename' => ''),
              '536.2+' => array('version' => '5.1.2', 'codename' => ''),
              '536.25' => array('version' => '6.0', 'codename' => ''),
              '536.26' => array('version' => '6.0.1', 'codename' => ''),
              '536.26.17' => array('version' => '6.0.2', 'codename' => ''),
              '536.28.10' => array('version' => '6.0.3', 'codename' => ''),
              '536.29.13' => array('version' => '6.0.4', 'codename' => ''),
              '536.30.1' => array('version' => '6.0.5', 'codename' => ''),
              // From https://gist.github.com/rniwa/2721861
              '537.1+' => array('version' => '5.1.5', 'codename' => ''),
              '537.10' => array('version' => '5.1', 'codename' => ''),
              '537.10+' => array('version' => '5.1', 'codename' => ''),
              '537.43.58' => array('version' => '6.1', 'codename' => ''),
              '537.51.1' => array('version' => '', 'codename' => ''),
              '537.73.11' => array('version' => array('6.1.1', '7.0.1'), 'codename' => ''),
              // @todo fill gaps here from 6.1.2 to 6.2.7
              '537.85.17' => array('version' => array('6.2.8', '7.1.8'), 'codename' => ''),
              '537.71' => array('version' => '7.0', 'codename' => ''),
              // @todo fill gaps here for 7.0.2
              '537.75.14' => array('version' => '7.0.3', 'codename' => ''),
              '537.76.4' => array('version' => '7.0.4', 'codename' => ''),
              '537.77.4' => array('version' => '7.0.5', 'codename' => ''),
              '537.78.2' => array('version' => '7.0.6', 'codename' => ''),
              // @todo fill gaps here for 7.1 to 7.1.7
              '538.35.8' => array('version' => '8.0', 'codename' => ''),
              // @todo fill gaps here for 8.0.1 to 8.0.5
              '600.6.3' => array('version' => '8.0.6', 'codename' => ''),
              '600.7.12' => array('version' => '8.0.7', 'codename' => ''),
              // @todo fill gap here for 8.0.8

              // On Windows
              '522.11.3' => array('version' => '3.0', 'codename' => ''),
              '522.12.2' => array('version' => '3.0.1', 'codename' => ''),
              '522.13.1' => array('version' => '3.0.2', 'codename' => ''),
              '522.15.5' => array('version' => '3.0.3', 'codename' => ''),
              '523.12.9' => array('version' => '3.0.4', 'codename' => ''),
              '523.13' => array('version' => '3.0.4', 'codename' => ''),
              '523.15' => array('version' => '3.0.4', 'codename' => ''),
              '525.26.13' => array('version' => '3.2', 'codename' => ''),
              '525.27.1' => array('version' => '3.2.1', 'codename' => ''),
              '525.28.1' => array('version' => '3.2.2', 'codename' => ''),
              '525.29.1' => array('version' => '3.2.3', 'codename' => ''),
              '526.12.2' => array('version' => '4.0', 'codename' => ''),
              '528.1.1' => array('version' => '4.0', 'codename' => ''),
              '530.19.1' => array('version' => '4.0.2', 'codename' => ''),
              '531.9.1' => array('version' => '4.0.3', 'codename' => ''),
              '534.30' => array('version' => '5.1', 'codename' => ''),
              '534.50' => array('version' => '5.1', 'codename' => ''),

              // According to http://www.somegeekintn.com/blog/stuff/iosvers/
              '600.1.4' => array('version' => '600.1.4', 'codename' => 'Safari Mobile for iOS 8.x'),
              '9537.53' => array('version' => '9537.53', 'codename' => 'Safari Mobile for iOS 7.x'),
              '8536.25' => array('version' => '8536.25', 'codename' => 'Safari Mobile for iOS 6.x'),
              // Found this with iOS 6_1_3
              '7534.48.3' => array('version' => '7534.48.3', 'codename' => 'Safari Mobile for iOS 5.x'),
              // According to http://www.useragentstring.com/Safari5.0.2_id_18120.php
              '6533.18.5' => array('version' => '6533.18.5', 'codename' => 'Safari Mobile 5.0.2'),
              '6531.22.7' => array('version' => '6531.22.7', 'codename' => 'Safari Mobile'),
              '531.21.10' => array('version' => '531.21.10', 'codename' => 'Safari Mobile for iOS 3.2'),
              '528.16' => array('version' => '528.16', 'codename' => 'Safari Mobile'),
              '525.18.1' => array('version' => '525.18.1', 'codename' => 'Safari Mobile'),
              '525.20' => array('version' => '525.20', 'codename' => 'Safari Mobile')
          );
    }
    
    public static function getFamily($familyName)
    {
        return self::$data[$familyName];
    }

    public static function getSafariVersion($version)
    {
        $versions = self::getSafariVersions();
        return (isset($versions[$version])) ?  $versions[$version] : null;
    }

    public static function getAll()
    {
        return self::$data;
    }

    public static function search(Context $context)
    {
        $browser = new Browser();

        foreach (self::getAll() as $familyName => $items) {
            foreach ($items as $itemName => $itemData) {
                $browser->reload($itemData);
                $result = BrowserMatcher::matchItem($browser, $context);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
    }
}