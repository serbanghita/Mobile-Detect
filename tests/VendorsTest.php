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
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
class VendorsTest extends PHPUnit_Framework_TestCase
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

                if (!is_array($conditions)) { continue; }

                $this->detect->setUserAgent($userAgent);

                foreach ($conditions as $condition => $assert) {

                    // Currently not supporting version and model here.
                    // @todo: I need to split this tests!
                    if ( in_array($condition, array('model') ) ) { continue; } // 'version',

                    switch ($condition) {

                        case 'version':
                            // Android, iOS, Chrome, Build, etc.
                            foreach ($assert as $assertKey => $assertValue) {
                                //if ($brand == 'Apple') {
                                //	echo 'UA ('.$condition.'('.$assertKey.') === '.$assertValue.'): '.$userAgent . "\n";
                                //}
                                $this->assertTrue( $this->detect->$condition( $assertKey ) == $assertValue, 'UA ('.$condition.'('.$assertKey.') === '.$assertValue.'): '.$userAgent);
                            }

                        break;

                        default:
                            $this->assertTrue( $this->detect->$condition() === $assert, 'UA ('.$condition.'): '.$userAgent);
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
