<?php
namespace MobileDetect\Service;

class BrowserService
{
    protected $request;
    protected $context;

    public function __construct(Request $request, Context $context)
    {
        $this->request = $request;
        $this->context = $context;
    }

    public function search()
    {
        // search in BrowserCollection()
        //   return BrowserItem
    }
}
