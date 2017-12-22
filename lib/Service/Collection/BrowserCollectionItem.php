<?php
namespace MobileDetect\Service\Collection;

class BrowserCollectionItem
{
    protected $item;

    public function __construct(\stdClass $item)
    {
        $this->init($item);
    }

    public function init(\stdClass $item)
    {
        $this->item = $item;
    }


}
