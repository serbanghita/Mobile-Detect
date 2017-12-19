<?php
namespace MobileDetect;

class MobileDetect
{
    const VERSION = '3.0.0-alpha';
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}

