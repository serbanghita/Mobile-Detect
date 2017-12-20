<?php
namespace MobileDetect;

use MobileDetect\Http\Request;

class MobileDetect
{
    const VERSION = '3.0.0-alpha';
    public $request;

    public function __construct(Request $request = null)
    {
        if (!is_null($request)) {
            $request = new Request();
        }

        $this->request = $request;
    }
}

