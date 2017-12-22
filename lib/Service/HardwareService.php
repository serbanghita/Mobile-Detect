<?php
namespace MobileDetect\Service;

class HardwareService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function search()
    {
        // search in HardwareCollection()
        //   return HardwareItem
    }
}
