<?php
namespace MobileDetect\Data;

interface DataInterface
{
    public function set($key, $value);
    public function get($key);
    public function setAll($data = array());
    public function getAll();
}