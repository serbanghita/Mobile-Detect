<?php

namespace Detection\Cache;

/**
 * Simple cache item (key, value, ttl) that is being
 * used by all the detection methods of Mobile Detect class.
 */
class CacheItem
{
    /**
     * @var string Unique key for the cache record.
     */
    protected string $key;
    /**
     * @var bool|null Mobile Detect only needs to store booleans (e.g. "isMobile" => true)
     */
    protected bool|null $value = null;
    protected int|null $ttl = 0;
    public function __construct($key, $value = null, $ttl = null)
    {
        $this->key = $key;
        if (!is_null($value)) {
            $this->value = $value;
        }
        $this->ttl = $ttl;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function get(): string|bool
    {
        return $this->value;
    }

    public function set($value): void
    {
        $this->value = $value;
    }

    public function getTtl(): int|null
    {
        return $this->ttl;
    }
}
