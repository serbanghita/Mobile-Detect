<?php

use PHPUnit\Framework\TestCase;

/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
class VendorsTest extends TestCase
{
    protected $detect;
    protected static $items;

    public function setUp()
    {
        $this->detect = new Mobile_Detect;

    }

    public static function setUpBeforeClass()
    {
        //this method could be called multiple times
        if (!self::$items) {
            self::$items = include dirname(__FILE__).'/UA_List.inc.php';
        }
    }

    public function testisMobileIsTablet()
    {
        foreach (self::$items as $brand => $deviceArr) {
            foreach ($deviceArr as $userAgent => $conditions) {
                if (!is_array($conditions)) {
                    continue;
                }

                $this->detect->setUserAgent($userAgent);

                foreach ($conditions as $condition => $assert) {
                    // Currently not supporting version and model here.
                    // @todo: I need to split this tests!
                    if (in_array($condition, array('model'))) {
                        continue;
                    } // 'version',

                    switch ($condition) {
                        case 'version':
                            // Android, iOS, Chrome, Build, etc.
                            foreach ($assert as $assertKey => $assertValue) {
                                //if ($brand == 'Apple') {
                                //	echo 'UA ('.$condition.'('.$assertKey.') === '.$assertValue.'): '.$userAgent . "\n";
                                //}
                                $this->assertSame( $this->detect->$condition( $assertKey ), $assertValue, 'UA ('.$condition.'('.$assertKey.') === '.$assertValue.'): '.$userAgent);
                            }
                            break;

                        default:
                            $this->assertSame($this->detect->$condition(), $assert, 'UA ('.$condition.'): '.$userAgent);
                            break;
                    }

                }

            }

        }

    }

    public function testVersion()
    {
        foreach (self::$items as $brand => $deviceArr) {

            foreach ($deviceArr as $userAgent => $conditions) {

                if ( !is_array($conditions) || !isset($conditions['version']) ) { continue; }

                $this->detect->setUserAgent($userAgent);

                foreach ($conditions['version'] as $condition => $assertion) {

                    $this->assertEquals( $this->detect->version($condition), $assertion, 'UA (version("'.$condition.'")): '.$userAgent );

                }

            }

        }

    }

}
