# The constructor

```php
$detect = new MobileDetect(Cache $cache = null, array $config = [])
```

The constructor can receive an optional cache class compatible with [`Psr\SimpleCache\CacheInterface`](https://github.com/php-fig/simple-cache/blob/master/src/CacheInterface.php)

The constructor can also receive optional `$config` variables as follows:

<table><thead><tr><th width="276">Variable name</th><th width="131">Default value</th><th>Description</th></tr></thead><tbody><tr><td><code>autoInitOfHttpHeaders</code></td><td><code>true</code></td><td>Auto-initialization on HTTP headers from <code>$_SERVER['HTTP...']</code>. Disable this if you're going for performance and you want to manually set the User-Agent via <code>$detect->setUserAgent(...)</code></td></tr><tr><td><code>maximumUserAgentLength</code></td><td><code>500</code></td><td>Maximum HTTP User-Agent value allowed.</td></tr></tbody></table>
