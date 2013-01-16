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
 * @copyright   2012 Serban Ghita.
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://mobiledetect.net
 */
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);


include '../Mobile_Detect.php';
$detect = new Mobile_Detect();

/*
$detect->setUserAgent('Mozilla/5.0 (Linux; U; Android 4.0.3; nl-nl; SAMSUNG GT-I9100/I9100BULPD Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30');
$isMobile = $detect->isMobile(); var_dump ($isMobile);
$isTablet = $detect->istablet(); var_dump ($isTablet);
$version = $detect->version('Android'); var_dump ($version);
$isSafari = $detect->isSafari(); var_dump ($isSafari);
$grade = $detect->mobileGrade(); var_dump ($grade);
exit;
*/


include 'test_list.inc.php';


$htmltemplate = '
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>'.$title.'</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#results").tablesorter({sortList: [[3,0]]});
    });
    </script>
    <style type="text/css">
     body, table, td { font-size:90%; font-family: Arial, serif; }
     .true { background:green; color:white; padding:1px; }
     .false { background: #ccc; color:white;padding:1px; }
     .gradeA { background: #74B64A; color:white; font-weight:bold;padding:1px; }
     .gradeB { background: #69C; color:white; font-weight:bold;padding:1px; }
     .gradeC { background: #FC3; color:white; font-weight:bold;padding:1px; }
     #results { border-collapse: collapse; }
     #results tr:hover { background: yellow; }
     #results th { border:1px solid #333; background:#eee; cursor:pointer; }
     #results th.brand { text-align:left; }
     #results td { border:1px solid #333; white-space:nowrap; }
    </style>
  </head>
  <body>
    <h1>'.$title.'</h1>
    <p>'.$description.'</p>

    '.$html.'

  </body>
</html>';

echo $htmltemplate;