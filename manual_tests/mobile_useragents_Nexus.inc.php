<?php
$mobile_Nexus = array(

		'Mozilla/5.0 (Linux; U; Android 2.2; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
		'Mozilla/5.0 (Linux; U; Android 2.1; en-us; Nexus One Build/ERD62) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
		'Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
		'Mozilla/5.0 (Linux; Android 4.2; Nexus 7 Build/JOP40C) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19',
		'Mozilla/5.0 (Linux; U; Android; en_us; Nexus 7 Build/) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 NetFrontLifeBrowser/2.3 Mobile (Dragonfruit)',
		'Mozilla/5.0 (Linux; U; Android 4.1.2; it-it; Galaxy Nexus Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',


	);

$title = 'Nexus mobile test';

$html .= '<table id="results" class="tablesorter" cellspacing="1" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th>User-Agent</th>
        <th>isMobile</th>
        <th>isTablet</th>
        <th>ScentiaMobile Check</th>
        <th>DeviceAtlas Check</th>
    </tr>
</thead>
<tbody>
    ';

foreach($mobile_Nexus as $userAgent){

    $detect->setUserAgent($userAgent);
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();

    $html .= '<tr>';
        $html .= '<td>'.$userAgent.'</td>';
        $html .= '<td>'.($isMobile ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td>'.($isTablet ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td><a href="http://tools.scientiamobile.com/?user-agent-string='.urlencode($userAgent).'" target="_blank">Check</a></td>';
        $html .= '<td><a href="https://deviceatlas.com/device-data/user-agent-tester" target="_blank">Check (needs Login)</a></td>';
    $html .= '</tr>';
}
$html .= '</tbody></table>';