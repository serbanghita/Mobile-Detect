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
 * @author      Nick Ilyin <nick.ilyin@gmail.com>
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */

class UAProvider
{
    /**
     * The file with the JSON goodies, relative to this class.
     */
    const JSON_FILE = 'ualist.json';

    /**
     * The JSON data once it's loaded.
     */
    protected static $data;

    /**
     * Loads the data from the file.
     *
     * @return array The data.
     */
    protected static function loadData()
    {
        if (self::$data) {
            return self::$data;
        }

        //full path
        $file = dirname(__FILE__) . '/' . self::JSON_FILE;

        if (!file_exists($file)) {
            throw new RuntimeException("The file $file does not exist.");
        }

        if (!is_readable($file)) {
            throw new RuntimeException("The current permissions on $file restrict you from reading it. It's chmod time.");
        }

        //read and convert
        $raw = file_get_contents($file);
        $json = @json_decode($raw, true);

        if (!$json) {
            throw new RuntimeException("This file contains invalid JSON data: $file.");
        }

        //The present format holds a hash value becuase we're converting from PHP. It'll go away eventually
        if (isset($json['hash']) && isset($json['user_agents'])) {
            $json = $json['user_agents'];
        }

        self::$data = $json;

        return self::$data;
    }

    /**
     * Retrieve the data in a flat array. This is exactly the format in which the JSON is stored.
     *
     * @return array The array of user agents.
     */
    public static function getDataAsFlatArray()
    {
        if (!self::$data) {
            self::loadData();
        }

        return self::$data;
    }

    /**
     * Retrieve the data ordered by the vendor in subarrays. This mimics the format of the UA_List.inc.php
     * file that we had before.
     *
     * @return array The array of arrays listed by vendor.
     */
    public static function getDataAsVendorArray()
    {
        //cache the vendors array since it's a tad compute heavy
        static $vendors;

        if ($vendors) {
            return $vendors;
        }

        //iterate and extract
        $vendors = array();
        $data    = self::loadData();

        foreach ($data as $obj) {
            if (!isset($vendors[$obj['vendor']])) {
                $vendors[$obj['vendor']] = array();
            }

            //check if we have any tests
            if (count($obj) == 2 && isset($obj['vendor']) && isset($obj['user_agent'])) {
                //empty!
                $vendors[$obj['vendor']][] = $obj['user_agent'];
            } else {
                //has tests
                $tests = array();

                //make sure you add only those that exist
                if (array_key_exists('mobile', $obj)) {
                    $tests['isMobile'] = $obj['mobile'];
                }
                if (array_key_exists('tablet', $obj)) {
                    $tests['isTablet'] = $obj['tablet'];
                }
                if (array_key_exists('version', $obj)) {
                    $tests['version'] = $obj['version'];
                }
                if (array_key_exists('model', $obj)) {
                    $tests['model'] = $obj['model'];
                }
                $vendors[$obj['vendor']][$obj['user_agent']] = $tests;
            }
        }

        return $vendors;
    }
}
