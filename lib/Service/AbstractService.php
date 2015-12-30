<?php
namespace MobileDetect\Service;

use MobileDetect\Result\Result;

abstract class AbstractService
{
    protected $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    protected function getResult()
    {
        return $this->result;
    }
    
    abstract public function detect();
}