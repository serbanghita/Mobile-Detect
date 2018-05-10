<?php

use PHPUnit\Framework\TestCase;

/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
class UserAgentTest extends TestCase
{
    protected $detect;
    protected static $ualist = array();
    protected static $json;

    public function setUp()
    {
        $this->detect = new Mobile_Detect;
    }

    public static function generateJson()
    {
        //in case this gets run multiple times
        if (isset(self::$json)) {
            return self::$json;
        }

        //the json and PHP formatted files
        $jsonFile = dirname(__FILE__) . '/ualist.json';
        $phpFile = dirname(__FILE__) . '/UA_List.inc.php';

        //currently stored as a PHP array
        $list = include $phpFile;

        //check recency of the file
        if (file_exists($jsonFile) && is_readable($jsonFile)) {
            //read the json file
            $json = json_decode(file_get_contents($jsonFile), true);

            //check that the hash matches
            $hash = isset($json['hash']) ? $json['hash'] : null;

            if ($hash == sha1(serialize($list))) {
                //file is up to date, just read the json file
                self::$json = $json['user_agents'];

                return self::$json;
            }
        }


        //uses the UA_List.inc.php to generate a json file
        if (file_exists($jsonFile) && !is_writable($jsonFile)) {
            throw new RuntimeException("Need to be able to create/update $jsonFile from UA_List.inc.php.");
        }

        if (!is_writable(dirname($jsonFile))) {
            throw new RuntimeException("Insufficient permissions to create this file: $jsonFile");
        }



        //print_r($list['Acer']); exit;

        $json = array();

        foreach ($list as $vendor => $vendorList) {
            foreach ($vendorList as $userAgent => $props) {
                if (is_int($userAgent)) {
                    //this means that the user agent is the props
                    $userAgent = $props;
                    $props = array();
                }

                $tmp = array(
                    'vendor' => $vendor,
                    'user_agent' => $userAgent
                );

                if (isset($props['isMobile'])) {
                    $tmp['mobile'] = $props['isMobile'];
                }

                if (isset($props['isTablet'])) {
                    $tmp['tablet'] = $props['isTablet'];
                }

                if (isset($props['version'])) {
                    $tmp['version'] = $props['version'];
                }

                if (isset($props['model'])) {
                    $tmp['model'] = $props['model'];
                }

                $json[] = $tmp;
            }
        }

        //save the hash
        $hash = sha1(serialize($list));
        $json = array(
            'hash' => $hash,
            'user_agents' => $json
        );

        if (defined('JSON_PRETTY_PRINT')) {
            $jsonString = json_encode($json, JSON_PRETTY_PRINT);
        } else {
            $jsonString = json_encode($json);
        }

        file_put_contents($jsonFile, $jsonString);
        self::$json = $json['user_agents'];

        return self::$json;
    }

    public static function setUpBeforeClass()
    {
        //generate json file first
        self::generateJson();

        //get the generated JSON data
        $json = self::$json;

        //make a list that is usable by functions (THE ORDER OF THE KEYS MATTERS!)
        foreach ($json as $userAgent) {
            $tmp = array();
            $tmp[] = isset($userAgent['user_agent']) ? $userAgent['user_agent'] : null;
            $tmp[] = isset($userAgent['mobile']) ? $userAgent['mobile'] : null;
            $tmp[] = isset($userAgent['tablet']) ? $userAgent['tablet'] : null;
            $tmp[] = isset($userAgent['version']) ? $userAgent['version'] : null;
            $tmp[] = isset($userAgent['model']) ? $userAgent['model'] : null;
            $tmp[] = isset($userAgent['vendor']) ? $userAgent['vendor'] : null;

            self::$ualist[] = $tmp;
        }
    }

    public function userAgentData()
    {
        if (!count(self::$ualist)) {
            self::setUpBeforeClass();
        }

        return self::$ualist;
    }

    /**
     * @medium
     * @dataProvider userAgentData
     */
    public function testUserAgents($userAgent, $isMobile, $isTablet, $version, $model, $vendor)
    {
        //make sure we're passed valid data
        if (!is_string($userAgent) || !is_bool($isMobile) || !is_bool($isTablet)) {
            $this->markTestIncomplete("The User-Agent $userAgent does not have sufficient information for testing.");

            return;
        }

        //setup
        $this->detect->setUserAgent($userAgent);

        //is mobile?
        $this->assertEquals($isMobile, $this->detect->isMobile());

        //is tablet?
        $this->assertEquals($isTablet, $this->detect->isTablet(), 'FAILED: ' . $userAgent . ' isTablet: ' . $isTablet);

        if (isset($version)) {
            foreach ($version as $condition => $assertion) {
                $this->assertEquals($assertion, $this->detect->version($condition), 'FAILED UA (version("'.$condition.'")): '.$userAgent);
            }
        }

        //version property tests
        if (isset($version)) {
            foreach ($version as $property => $stringVersion) {
                $v = $this->detect->version($property);
                $this->assertSame($stringVersion, $v);
            }
        }

        //@todo: model test, not sure how exactly yet
        //@todo: vendor test. The below is theoretical, but fails 50% of the tests...
        /*if (isset($vendor)) {
            $method = "is$vendor";
            $this->assertTrue($this->detect->{$method}(), "Expected Mobile_Detect::{$method}() to be true.");
        }*/
    }
}
