<?php
namespace MobileDetect\Result;

use MobileDetect\Http\Request;

class Context
{
    /**
     * @var Request
     */
    public $request;

    public $hardwareItem;

    public $browserItem;

    public $osItem;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }
}
