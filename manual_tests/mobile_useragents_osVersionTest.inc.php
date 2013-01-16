<?php

$title = 'mobile OS version test';

$html .= '<table id="results" class="tablesorter" cellspacing="1" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th>User-Agent</th>
        <th>isMobile</th>
        <th>isTablet</th>
        ';
        foreach($detect->getOperatingSystems() as $os => $regex):
        	$html .= '<th>'.$os.'</th>';
        endforeach;
    $html .= '
    </tr>
</thead>
<tbody>';

foreach($mobile_userAgents as $userAgent){

    $detect->setUserAgent($userAgent);
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();

    $html .= '<tr>';
        $html .= '<td>'.$userAgent.'</td>';
        $html .= '<td>'.($isMobile ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td>'.($isTablet ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        foreach($detect->getOperatingSystems() as $os => $regex):
        	$tmpCheck = $detect->is($os);
        	$html .= '<td>'.($tmpCheck ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        endforeach;
    $html .= '</tr>';
}

$html .= '</tbody></table>';