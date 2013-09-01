<?php 
class GradeTests extends PHPUnit_Framework_TestCase {
    private $instance;
    private static $items;
    function setUp()
    {
        $this->instance = new Mobile_Detect();
        parent::setUp();
    }
    public static function setUpBeforeClass()
    {
        //this method could be called multiple times
        if (!self::$items) {
            self::$items = include dirname(__FILE__).'/UA_List.inc.php';
        }
    }
    public function test_mobile_grades()
    {
        foreach (self::$items as $brand => $deviceArr) {
            foreach ($deviceArr as $userAgent => $conditions) {
                if (isset($conditions['mobileGrade'])) {
                    $this->instance->setUserAgent($userAgent);
                    $expect = $conditions['mobileGrade'];
                    $this->assertEquals($expect, $this->instance->mobileGrade(), print_r($conditions, true));
                }
            }
        }
    }
    public function test_unknown_ua_returns_c_grade ()
    {
        $this->instance->setUserAgent('UNKNOWN');
        $this->assertEquals(Mobile_Detect::MOBILE_GRADE_C, $this->instance->mobileGrade());
    }    
}
