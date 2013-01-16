<?php
function __autoload($className){
	$dirs = array('/../');
	foreach($dirs as $dir){
		require_once dirname(__FILE__).$dir.$className.'.php';
	}
	
}