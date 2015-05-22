<?php
namespace MobileDetect;

abstract class AbstractStack
{
    protected $data = [];

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function setAll($data = array())
    {
        $this->data = $data;
    }

    public function getAll()
    {
        return $this->data;
    }

    public function destroy()
    {
        $this->data = [];
    }
}