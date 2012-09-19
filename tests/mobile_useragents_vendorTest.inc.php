<?php

$title = 'mobile per vendor test';

$html .= '<table id="results" class="tablesorter" cellspacing="1" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th>User-Agent</th>
        <th>isMobile</th>
        <th>isTablet</th>
        <th>isHTC</th>
        <th>matchDesire</th>
        ';
        //foreach($detect->getOperatingSystems() as $os => $regex):
        //	$html .= '<th>'.$os.'</th>';
        //endforeach;
    $html .= '
    </tr>
</thead>
<tbody>';

foreach($mobilePerVendor_userAgents['HTC'] as $userAgent){

    $detect->setUserAgent($userAgent);
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
    $isHTC    = $detect->isHTC();
    $matchDesire = $detect->match('Android.*(Desire|ADR6200|001HT|HTCA8180|A320e)|HTC.*Desire|Desire([\w ]+)?HD|Desire([\w ]+)?S|Desire([\w ]+)?C|HTC_GOF_U');

    $html .= '<tr>';
        $html .= '<td>'.$userAgent.'</td>';
        $html .= '<td>'.($isMobile ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td>'.($isTablet ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        //foreach($detect->getOperatingSystems() as $os => $regex):
        //	$tmpCheck = $detect->is($os);
        //	$html .= '<td>'.($tmpCheck ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        //endforeach;
        $html .= '<td>'.($isHTC ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td>'.($matchDesire ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';