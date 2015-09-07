<?php
namespace MobileDetect\Providers;

abstract class AbstractProvider implements ProviderInterface
{
    protected $data;

    public function getAll()
    {
        return $this->data;
    }

    public function search()
    {

    }
}