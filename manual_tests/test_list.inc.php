<?php
switch($_GET['test']){

	case 'nexusTest':

		include 'mobile_useragents_Nexus.inc.php';

	break;

	case 'gradeTest':
		require_once 'mobile_useragents.inc.php';
		include 'mobile_useragents_gradeTest.inc.php';
	break;

	case 'osVersionTest':
		require_once 'mobile_useragents.inc.php';
		require_once 'mobile_useragents_osVersionTest.inc.php';
	break;

	case 'nonmobileTest':
		require_once 'nonmobile_useragents.inc.php';
		require_once 'nonmobile_useragents_nonmobileTest.inc.php';
	break;

	case 'vendorTest':
		require_once 'mobilePerVendor_useragents.inc.php';
		require_once 'mobile_useragents_vendorTest.inc.php';
	break;

	default:
	$title = 'Tests';
	$description = 'Various tests to demonstrate the usage and coverage of Mobile_Detect class.<br>
	You can contribute by forking us on <a href="https://github.com/serbanghita/Mobile-Detect">GitHub</a>.';
	$html = '
	<ol>
		<li><a href="test.php?test=gradeTest">Browser grade test</a></li>
		<li><a href="test.php?test=osVersionTest">OS version test</a></li>
		<li><a href="test.php?test=nonmobileTest">Non-mobile test</a></li>
		<li><a href="test.php?test=vendorTest">Vendor specific tests</a></li>
		<li><a href="test.php?test=nexusTest">Nexus test</a>
	</ol>
	';

}
