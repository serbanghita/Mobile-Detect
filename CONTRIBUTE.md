<img src="http://demo.mobiledetect.net/logo-github.png">

> Motto: "Every business should have a mobile detection script to detect mobile readers."

## Contributing

<b>Forking the project</b>

<ol>
  <li>Clone the repository <code>https://github.com/serbanghita/Mobile-Detect.git</code> to your local drive.</li>
  <li>Switch to <code>devel</code> branch.</li>
  <li>Commit your changes to <code>Mobile_Detect.php</code> or whatever file.</li>
  <li>Commit tests (User-Agent strings) to<code>tests/UA_List.inc.php</code>. <u>It's important to put tests in if you change the regexes, otherwise the commit will not pass.</u></li>
  <li>Run the tests <code>php <a href="http://pear.phpunit.de/get/phpunit.phar" title="Download phpunit.phar">phpunit.phar</a> /path/to/mobiledetectlib/tests/phpunit.xml</code>. Check for errors.</li>
  <li>Run the code fix <code>php <a href="http://cs.sensiolabs.org/get/php-cs-fixer.phar">php-cs-fixer.phar</a> fix "/path/to/mobiledetectlib" --verbose --dry-run</code>. If there are errors run it again without <code>--dry-run</code>.</li>
  <li>Commit to <code>devel</code>. Push.</li>
  <li>The commit will be reviewed and merged into <code>master</code></li>
</ol>


<table>
  <tr>
    <td width="20%"><a href="https://github.com/serbanghita/Mobile-Detect/wiki/Road-to-2.9.9">2.9.9 version</a> <img alt="Dev status" src="https://travis-ci.org/serbanghita/Mobile-Detect.png?branch=devel" border="0"></td>
    <td>Work scheduled on the <code>2.x.x</code> branch (currently in production).</tr>
  <tr>
    <td><a href="https://github.com/serbanghita/Mobile-Detect/wiki/Road-to-3.0.0">3.0.0 version</a></td>
    <td>Work scheduled on the <code>3.x.x</code> branch. The new <code>3.0.0</code> version will feature: compatibility with <code>2.x</code>, array with devices details (including model name), device/os/browser version, browser grading utility, separate JSON regex.</td>
  </tr>
</table>