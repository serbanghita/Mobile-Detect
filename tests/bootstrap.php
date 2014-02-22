<?php

if (!file_exists($composer = dirname(__FILE__) . '/vendor/autoload.php')) {
    throw new RuntimeException("Please run 'composer install' first to set up autoloading.");
}

$autoloader = include $composer;

// @todo add the test namespace

