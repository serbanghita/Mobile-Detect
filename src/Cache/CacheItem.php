<?php
namespace Detection\Cache;

use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
    protected string $key;
    protected string $value;

    public function __construct($key, $value = null)
    {
        $this->key = $key;
        if (!is_null($value)) {
            $this->value = $value;
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function get(): string
    {
        return $this->value;
    }

    public function isHit()
    {
        // TODO: Implement isHit() method.
    }

    public function set($value)
    {
        $this->value = $value;
    }

    public function expiresAt($expiration)
    {
        // TODO: Implement expiresAt() method.
    }

    public function expiresAfter($time)
    {
        // TODO: Implement expiresAfter() method.
    }
}