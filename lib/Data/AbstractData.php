<?php
namespace MobileDetect\Data;

abstract class AbstractData
{
    protected $data = array();

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function setAll($data = array())
    {
        $this->data = $data;
    }

    public function getAll()
    {
        return $this->data;
    }
}