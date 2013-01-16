<?php

$title = 'non-mobile test';

$html .= '<table id="results" class="tablesorter" cellspacing="1" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th>User-Agent</th>
        <th>isMobile</th>
        <th>isTablet</th>
        <th>Grade</th>
    </tr>
</thead>
<tbody>
    ';

foreach($nonmobile_userAgents as $userAgent){

    $detect->setUserAgent($userAgent);
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
    $grade = $detect->mobileGrade();

    $html .= '<tr>';
        $html .= '<td>'.$userAgent.'</td>';
        $html .= '<td>'.($isMobile ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td>'.($isTablet ? '<div class="true">true</div>' : '<div class="false">false</div>').'</td>';
        $html .= '<td><div class="grade'.$grade.'">'.$grade.'</div></td>';
    $html .= '</tr>';
}
$html .= '</tbody></table>';