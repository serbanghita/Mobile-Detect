<?php

namespace Detection\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheItemPool implements CacheItemPoolInterface
{
    /**
     * @var array{cache_key:string, cache_value:CacheItemInterface} $cache_db
     */
    protected array $cache_db = [];
    public function getItem($key): CacheItemInterface
    {
        // @todo: throw exception if key not in cache.
        return $this->cache_db[$key];
    }

    public function getItems(array $keys = [])
    {
        // TODO: Implement getItems() method.
    }

    /**
     * Get all items for cache. Used for unit tests and debug.
     * @return array
     */
    public function getAllItems(): array
    {
        return $this->cache_db;
    }

    public function hasItem($key): bool
    {
        if (!is_string($key)) {
            return false;
        }
        return isset($this->cache_db[$key]);
    }

    public function clear(): void
    {
        $this->cache_db = [];
    }

    public function deleteItem($key): void
    {
        unset($this->cache_db[$key]);
    }

    public function deleteItems(array $keys)
    {
        // TODO: Implement deleteItems() method.
    }

    public function save(CacheItemInterface $item): void
    {
        $this->cache_db[$item->getKey()] = $item;
    }

    public function saveDeferred(CacheItemInterface $item)
    {
        // TODO: Implement saveDeferred() method.
    }

    public function commit()
    {
        // TODO: Implement commit() method.
    }
}
