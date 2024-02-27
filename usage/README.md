---
description: Learn how to use Mobile Detect library.
---

# ⌨️ Usage

### Basic usage

1. Include composer's autoloader.

In case you are already using a PHP app, this step is probably already covered.

```php
require __DIR__ . '/vendor/autoload.php';
```

2. Instantiate the class.

```php
use Detection\MobileDetect;
$detect = new MobileDetect();
```

3. (Optional) Set the User-Agent.

Omit this step if your HTTP headers are available in `$_SERVER` global variable.

```php
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) ...');
```

4. Check for "mobile".

```php
$isMobile = $detect->isMobile();
$isTablet = $detect->isTablet()
```

### Simple example

In the following example, we instantiate the `MobileDetect` class which by default grabs the User-Agent string from `$_SERVER` and then after calling `$detect->isMobile()` it starts the detection process:

```php
$detect = new MobileDetect();
var_dump($detect->getUserAgent()); // "Mozilla/5.0 (Windows NT 10.0; Win64; x64) ..."

try {
    $isMobile = $detect->isMobile(); // bool(false)
    var_dump($isMobile);
} catch (\Detection\Exception\MobileDetectException $e) {
}
try {
    $isTablet = $detect->isTablet(); // bool(false)
    var_dump($isTablet);
} catch (\Detection\Exception\MobileDetectException $e) {
}
```

The `try/catch` blocks are optional but they can catch special cases where your server env is missing `$_SERVER` variables or the Cache system is throwing an exception.

### The constructor

```php
$detect = new MobileDetect(Cache $cache = null, array $config = [])
```

The constructor can receive an optional cache class compatible with [`Psr\SimpleCache\CacheInterface`](https://github.com/php-fig/simple-cache/blob/master/src/CacheInterface.php)

The constructor can also receive optional `$config` variables as follows:

<table><thead><tr><th width="276">Variable name</th><th width="146">Default value</th><th>Description</th></tr></thead><tbody><tr><td><code>autoInitOfHttpHeaders</code></td><td><code>true</code></td><td>Auto-initialization on HTTP headers from <code>$_SERVER['HTTP...']</code>. Disable this if you're going for performance and you want to manually set the User-Agent via <code>$detect->setUserAgent(...)</code></td></tr><tr><td><code>maximumUserAgentLength</code></td><td><code>500</code></td><td>Maximum HTTP User-Agent value allowed.</td></tr><tr><td></td><td></td><td></td></tr></tbody></table>
