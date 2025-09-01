namespace Detection\Cache;

use Psr\SimpleCache\CacheInterface;
use DateInterval;
use DateTime;

/**
 * In-memory cache implementation of PSR-16
 * @See https://www.php-fig.org/psr/psr-16/
 */
class Cache implements CacheInterface
{
    protected cache = [];

    /**
     * @inheritdoc
     * @throws CacheInvalidArgumentException
     */
    public function get(string key, var defaultValue = null)
    {
        this->checkKey(key);

        if isset this->cache[key] {
            if this->cache[key]["ttl"] === null || this->cache[key]["ttl"] > time() {
                return this->cache[key]["content"];
            }
            this->deleteSingle(key);
        }

        return defaultValue;
    }

    /**
     * @inheritdoc
     * @throws CacheInvalidArgumentException
     */
    public function set(string key, var value, var ttl = null) -> bool
    {
        this->checkKey(key);

        if typeof ttl == "integer" && ttl <= 0 {
            this->deleteSingle(key);
            return false;
        }

        let ttl = this->getTTL(ttl);

        if ttl !== null {
            let ttl = time() + ttl;
        }

        let this->cache[key] = ["ttl": ttl, "content": value];

        return true;
    }

    /** @inheritdoc */
    public function delete(string key) -> bool
    {
        this->checkKey(key);
        this->deleteSingle(key);
        return true;
    }

    /**
     * Deletes the cache item from memory.
     *
     * @param string key Cache key
     */
    private function deleteSingle(string key) -> void
    {
        unset this->cache[key];
    }

    /** @inheritdoc */
    public function clear() -> bool
    {
        let this->cache = [];
        return true;
    }

    /** @inheritdoc */
    public function has(string key) -> bool
    {
        this->checkKey(key);
        return isset this->cache[key];
    }

    /** @inheritdoc */
    public function getMultiple(iterable keys, var defaultValue = null) -> iterable
    {
        var data = [];
        var key;

        for key in keys {
            let data[key] = this->get(key, defaultValue);
        }

        return data;
    }

    /** @inheritdoc */
    public function setMultiple(iterable values, var ttl = null) -> bool
    {
        var result = [];
        var key, value;

        for key, value in values {
            let result[] = this->set(key, value, ttl);
        }

        return this->checkReturn(result);
    }

    /** @inheritdoc */
    public function deleteMultiple(iterable keys) -> bool
    {
        var key;
        for key in keys {
            this->delete(key);
        }
        return true;
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    protected function checkKey(string key) -> string
    {
        if key === "" || !preg_match("/^[A-Za-z0-9_.]{1,64}$/", key) {
            throw new CacheInvalidArgumentException("Invalid key: '" . key . "'. Must be alphanumeric, can contain _ and . and can be maximum of 64 chars.");
        }
        return key;
    }

    /**  */
    protected function getTTL(var ttl) -> int | null
    {
        if ttl instanceof DateInterval {
            var dt = new DateTime();
            dt->add(ttl);
            return dt->getTimestamp() - time();
        }

        if typeof ttl == "integer" {
            return ttl;
        }

        return null;
    }

    /**
     * Checks if at least one of the values is FALSE, then returns FALSE.
     *
     * @param bool[] booleans
     */
    protected function checkReturn(array booleans) -> bool
    {
        return !in_array(false, booleans, true);
    }

    /**
     * Get all cache keys.
     *
     * @internal Needed for testing purposes.
     * @return string[]
     */
    public function getKeys() -> array
    {
        return array_keys(this->cache);
    }
}
