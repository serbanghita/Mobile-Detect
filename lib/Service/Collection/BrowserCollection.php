<?php
namespace MobileDetect\Service\Collection;

class BrowserCollection
{
    private $collection;

    public function __construct(\stdClass $collection)
    {
        $this->collection = $collection;
    }


}
