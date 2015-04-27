<?php
namespace MobileDetect\Properties;

interface PropertiesInterface
{
    public function set($key, $value);
    public function get($key);
    public function setAll($properties = array());
    public function getAll();
}