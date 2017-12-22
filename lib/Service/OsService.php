<?php
namespace MobileDetect\Service;

class OsService
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
        // search in OsCollection()
        //   return OsItem
    }
}
