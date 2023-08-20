<?php
namespace Detection\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheFactory
{
    public static function createPool(): CacheItemPoolInterface
    {
        return new CacheItemPool();
    }

    public static function createItem(string $key, $value = null): CacheItemInterface
    {
        return new CacheItem($key, $value);
    }
}