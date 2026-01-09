<?php

declare(strict_types=1);

namespace Detection\Cache;

use Psr\SimpleCache\CacheInterface;
use DateInterval;
use DateTime;

use function is_int;
use function time;

/**
 * In-memory cache implementation of PSR-16
 * @See https://www.php-fig.org/psr/psr-16/
 */
class Cache implements CacheInterface
{
    protected array $cache = [];

    /**
     * @inheritdoc
     * @throws CacheInvalidArgumentException
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $this->checkKey($key);

        if (isset($this->cache[$key])) {
            if ($this->cache[$key]['ttl'] === null || $this->cache[$key]['ttl'] > time()) {
                return $this->cache[$key]['content'];
            }

            $this->deleteSingle($key);
        }

        return $default;
    }

    /**
     * @inheritdoc
     * @throws CacheInvalidArgumentException
     */
    public function set(string $key, mixed $value, int|DateInterval|null $ttl = null): bool
    {
        $this->checkKey($key);

        // From https://www.php-fig.org/psr/psr-16/ "Definitions" -> "Expiration"
        // If a negative or zero TTL is provided, the item MUST be deleted from the cache if it exists, as it is expired already.
        if (is_int($ttl) && $ttl <= 0) {
            $this->deleteSingle($key);
            return false;
        }

        $ttl = $this->getTTL($ttl);

        if ($ttl !== null) {
            $ttl = (time() + $ttl);
        }

        $this->cache[$key] = ['ttl' => $ttl, 'content' => $value];

        return true;
    }

    /** @inheritdoc */
    public function delete(string $key): bool
    {
        $this->checkKey($key);
        $this->deleteSingle($key);

        return true;
    }

    /**
     * Deletes the cache item from memory.
     *
     * @param string $key Cache key
     * @return void
     */
    private function deleteSingle(string $key): void
    {
        unset($this->cache[$key]);
    }

    /** @inheritdoc */
    public function clear(): bool
    {
        $this->cache = [];

        return true;
    }

    /**
     * @inheritdoc
     * @throws CacheInvalidArgumentException
     */
    public function has(string $key): bool
    {
        $this->checkKey($key);

        if (isset($this->cache[$key])) {
            if ($this->cache[$key]['ttl'] === null || $this->cache[$key]['ttl'] > time()) {
                return true;
            }

            $this->deleteSingle($key);
        }

        return false;
    }

    /** @inheritdoc */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $data = [];

        foreach ($keys as $key) {
            $data[$key] = $this->get($key, $default);
        }

        return $data;
    }

    /** @inheritdoc */
    public function setMultiple(iterable $values, int|DateInterval|null $ttl = null): bool
    {
        $return = [];

        foreach ($values as $key => $value) {
            $return[] = $this->set($key, $value, $ttl);
        }

        return $this->checkReturn($return);
    }

    /** @inheritdoc */
    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    protected function checkKey(string $key): string
    {

        if ($key === '' || !preg_match('/^[A-Za-z0-9_.]{1,64}$/', $key)) {
            throw new CacheInvalidArgumentException("Invalid key: '$key'. Must be alphanumeric, can contain _ and . and can be maximum of 64 chars.");
        }

        return $key;
    }

    /**  */
    protected function getTTL(DateInterval|int|null $ttl): ?int
    {

        if ($ttl instanceof DateInterval) {
            return (new DateTime())->add($ttl)->getTimeStamp() - time();
        }

        // We treat 0 as a valid value.
        if (is_int($ttl)) {
            return $ttl;
        }

        return null;
    }

    /**
     * @param bool[]|int[] $booleans
     */
    protected function checkReturn(array $booleans): bool
    {
        foreach ($booleans as $boolean) {
            if (!$boolean) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get all cache keys.
     *
     * @internal Needed for testing purposes.
     * @return array{string}
     */
    public function getKeys(): array
    {
        return array_keys($this->cache);
    }

    /**
     * Evict all expired items from the cache.
     *
     * Useful for long-running processes (CLI scripts, workers, daemons)
     * to periodically clean up expired entries and free memory.
     *
     * @return int Number of items evicted
     */
    public function evictExpired(): int
    {
        $evicted = 0;
        $now = time();

        foreach ($this->cache as $key => $item) {
            if ($item['ttl'] !== null && $item['ttl'] <= $now) {
                unset($this->cache[$key]);
                $evicted++;
            }
        }

        return $evicted;
    }
}
