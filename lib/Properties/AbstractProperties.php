<?php
namespace MobileDetect\Properties;

abstract class AbstractProperties
{
    protected $properties = array();

    public function set($key, $value)
    {
        $this->properties[$key] = $value;
    }

    public function get($key)
    {
        return $this->properties[$key];
    }

    public function setAll($properties = array())
    {
        $this->properties = $properties;
    }

    public function getAll()
    {
        return $this->properties;
    }
}