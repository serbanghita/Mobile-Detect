<?php
//save my dir
$dot = dirname(__FILE__);

if (!file_exists($composer = dirname($dot) . '/vendor/autoload.php')) {
    throw new RuntimeException("Please run 'composer install' first to set up autoloading. $composer");
}

/** @var \Composer\Autoload\ClassLoader $autoloader */
$autoloader = include $composer;

$autoloader->add('DeviceLibTest\\', $dot);

define('TEST_ROOT_PATH', $dot);
