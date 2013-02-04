<?php

$title = 'mobile per vendor test';

$html .= '<table id="results" class="tablesorter" cellspacing="1" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th>User-Agent</th>
        <th>isMobile</th>
        <th>isTablet</th>
        <th>isBrand</th>
    </tr>
</thead>
<tbody>';

foreach($mobilePerVendor_userAgents as $brand => $deviceArr){

    $html .= '
    <tr>
        <th colspan="4" class="brand">'.$brand.'</th>
    </tr>
    ';

    foreach($deviceArr as $userAgent => $conditions){

        $userAgentString = (is_array($conditions) ? $userAgent : $conditions );

        $detect->setUserAgent($userAgentString);
        $isMobile = $detect->isMobile();
        $isTablet = $detect->isTablet();
        $isBrand  = $detect->is($brand);
        //$matchDesire = $detect->match('Android.*(Desire|ADR6200|001HT|HTCA8180|A320e)|HTC.*Desire|Desire([\w ]+)?HD|Desire([\w ]+)?S|Desire([\w ]+)?C|HTC_GOF_U');

        $html .= '<tr>';
            $html .= '<td>'.$userAgentString.'</td>';
            $html .= '<td>'.($isMobile ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
            $html .= '<td>'.($isTablet ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
            $html .= '<td>'.($isBrand ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '</tr>';

    }

}

$html .= '</tbody></table>';
