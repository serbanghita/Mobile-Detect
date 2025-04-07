<?php

declare(strict_types=1);

namespace Detection\Cache;

use Psr\SimpleCache\CacheInterface;
use DateInterval;
use DateTime;
use InvalidArgumentException;
use Traversable;

use function is_array;
use function is_int;
use function iterator_to_array;
use function time;

/**
 * In-memory cache implementing https://www.php-fig.org/psr/psr-16/
 * This is a fallback, use something specialised like https://github.com/chillerlan/php-cache
 */
class Cache implements CacheInterface
{
    protected array $cache = [];

    /** @inheritdoc */
    public function get(string $key, mixed $default = null): mixed
    {
        $key = $this->checkKey($key);

        if (isset($this->cache[$key])) {
            if ($this->cache[$key]['ttl'] === null || $this->cache[$key]['ttl'] > time()) {
                return $this->cache[$key]['content'];
            }

            unset($this->cache[$key]);
        }

        return $default;
    }

    /** @inheritdoc */
    public function set(string $key, mixed $value, int|DateInterval|null $ttl = null): bool
    {
        $ttl = $this->getTTL($ttl);

        if ($ttl !== null) {
            $ttl = (time() + $ttl);
        }

        $this->cache[$this->checkKey($key)] = ['ttl' => $ttl, 'content' => $value];

        return true;
    }

    /** @inheritdoc */
    public function delete(string $key): bool
    {
        unset($this->cache[$this->checkKey($key)]);

        return true;
    }

    /** @inheritdoc */
    public function clear(): bool
    {
        $this->cache = [];

        return true;
    }

    /** @inheritdoc */
    public function has(string $key): bool
    {
        return $this->get($key) !== null;
    }

    /** @inheritdoc */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $data = [];

        foreach ($this->fromIterable($keys) as $key) {
            $data[$key] = $this->get($key, $default);
        }

        return $data;
    }

    /** @inheritdoc */
    public function setMultiple(iterable $values, int|DateInterval|null $ttl = null): bool
    {
        $return = [];

        foreach ($this->fromIterable($values) as $key => $value) {
            $return[] = $this->set($key, $value, $ttl);
        }

        return $this->checkReturn($return);
    }

    /** @inheritdoc */
    public function deleteMultiple(iterable $keys): bool
    {
        $return = [];

        foreach ($this->fromIterable($keys) as $key) {
            $return[] = $this->delete($key);
        }

        return $this->checkReturn($return);
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function checkKey(string $key): string
    {

        if (empty($key)) {
            throw new InvalidArgumentException('cache key is empty');
        }

        return $key;
    }

    /**  */
    protected function checkKeyArray(array $keys): array
    {

        foreach ($keys as $key) {
            $this->checkKey($key);
        }

        return $keys;
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function fromIterable(iterable $data): array
    {

        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof Traversable) {
            return iterator_to_array($data); // @codeCoverageIgnore
        }

        throw new InvalidArgumentException('invalid data');
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
            if (!(bool)$boolean) {
                return false; // @codeCoverageIgnore
            }
        }

        return true;
    }

    /**
     * Get all cache keys. Needed for testing purposes.
     *
     * @return array{string}
     */
    public function getKeys(): array
    {
        return array_keys($this->cache);
    }
}
