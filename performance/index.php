<?php
timer_start();
function timer_start() {
    global $timestart;
    $timestart = microtime( true );
    return true;
}
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $timeend = microtime( true );
    $timetotal = $timeend - $timestart;
    $r = ( function_exists( 'number_format_i18n' ) ) ? number_format_i18n( $timetotal, $precision ) : number_format( $timetotal, $precision );
    if ( $display )
        echo $r;
    return $r;
}
class profiler {
    
    const ROUND = 10;
    public static $items = array();
    public static function profile($label, $time = false)
    {
        if ($time)
            self::$items[$label] = $time;
        else
            self::$items[$label] = timer_stop(0, self::ROUND);
        
    }
    public static function getProfile()
    {
        if (count(self::$items) == 0 )
            return '';
        $str = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
        $str .= '<tr><th>Label</th><th>Total Exec Time</th><th>Step Exec Time</th></tr>';
        $start_time = reset(self::$items);
        $last_exec_time = 0;
        foreach (self::$items as $label=>$time) {
            $exec_time = round(($time - $start_time), self::ROUND);
            $this_step_time =  $exec_time - $last_exec_time;
            $last_exec_time = $exec_time;
            $color = self::getColor($this_step_time);
            $str .= "<tr><td>$label</td><td>$exec_time s</td><td style=\"background-color:$color\" >$this_step_time</td></tr>";
        }
        $str .= '</table>';
    
        return $str;
    }
    public static function  displayProfile ()
    {
        echo self::getProfile();
    }
    private static function getColor ($time)
    {
        if ($time > 0.2 )
            $color = "#ffb6af";
        elseif ($time > 0.1)
        $color = '#fafdae';
        else
            $color = '#d4f5a8';
    
        return $color;
    }
}
require_once dirname(__FILE__) . '/../Mobile_Detect.php';
class PerformanceTest
{

    protected $detect;

    protected static $items;

    public function __construct()
    {
        $this->detect = new Mobile_Detect();
        $this->setUpBeforeClass();
    }

    public static function setUpBeforeClass ()
    {
        // this method could be called multiple times
        if (! self::$items) {
            self::$items = require_once dirname(__FILE__) . '/../tests/UA_List.inc.php';
        }
    }

    public function testisMobileIsTablet ()
    {
        foreach (self::$items as $brand => $deviceArr) {
            foreach ($deviceArr as $userAgent => $conditions) {
                $this->detect->setUserAgent($userAgent);
                $this->detect->isMobile();
                $this->detect->isTablet();
            }
        }
    }

    public function testVersion ()
    {
        foreach (self::$items as $brand => $deviceArr) {
            foreach ($deviceArr as $userAgent => $conditions) {
                if (! is_array($conditions) || ! isset($conditions['version'])) {
                    continue;
                }
                
                $this->detect->setUserAgent($userAgent);
                foreach ($conditions['version'] as $condition => $assertion) {
                    $this->detect->version($condition); 
                }
            }
        }
    }
}

profiler::profile('init');
$p = new PerformanceTest();
profiler::profile('loaded ua strings');
$p->testisMobileIsTablet();
profiler::profile('done testisMobileIsTablet');
$p->testVersion();
profiler::profile('done testVersion');
profiler::displayProfile();