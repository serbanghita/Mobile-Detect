# MobileDetect Usage Examples

This document provides code examples for common MobileDetect usage scenarios.

## Basic Usage

### Installation

```bash
composer require mobiledetect/mobiledetectlib
```

### Simple Detection

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

if ($detect->isMobile()) {
    // Any mobile device (phones or tablets)
}

if ($detect->isTablet()) {
    // Tablets only
}

if ($detect->isMobile() && !$detect->isTablet()) {
    // Phones only
}
```

### Detect Specific Devices

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

// Detect specific platforms
if ($detect->isiOS()) {
    // iOS device
}

if ($detect->isAndroidOS()) {
    // Android device
}

// Detect specific devices
if ($detect->isiPhone()) {
    // iPhone
}

if ($detect->isiPad()) {
    // iPad
}

if ($detect->isSamsung()) {
    // Samsung device
}

if ($detect->isSamsungTablet()) {
    // Samsung tablet
}
```

### Detect Browsers

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

if ($detect->isChrome()) {
    // Chrome browser
}

if ($detect->isSafari()) {
    // Safari browser
}

if ($detect->isFirefox()) {
    // Firefox browser
}

if ($detect->isOpera()) {
    // Opera browser
}

if ($detect->isEdge()) {
    // Edge browser
}
```

### Get Version Information

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

// Get version as string
$iOSVersion = $detect->version('iOS');  // e.g., "15_0"

// Get version as float
$iOSVersion = $detect->version('iOS', 'float');  // e.g., 15.0

// Get browser versions
$chromeVersion = $detect->version('Chrome');
$safariVersion = $detect->version('Safari');
```

## Advanced Usage

### Manual User-Agent Setting

```php
use Detection\MobileDetect;

// Disable auto-initialization for better performance
$detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);

// Set User-Agent manually
$detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)...');

if ($detect->isMobile()) {
    // Handle mobile
}
```

### Custom HTTP Headers

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

// Set custom headers (useful for proxy/CDN scenarios)
$detect->setHttpHeaders([
    'HTTP_USER_AGENT' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)...',
    'HTTP_ACCEPT' => 'text/html,application/xhtml+xml...',
]);
```

### Using the `is()` Method

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

// Generic check using rule name
$detect->is('iOS');        // Same as $detect->isiOS()
$detect->is('iPhone');     // Same as $detect->isiPhone()
$detect->is('Chrome');     // Same as $detect->isChrome()
$detect->is('mobile');     // Same as $detect->isMobile()
$detect->is('tablet');     // Same as $detect->isTablet()
```

### Custom Cache Implementation

```php
use Detection\MobileDetect;
use Detection\Cache\Cache;
use Psr\SimpleCache\CacheInterface;

// Use any PSR-16 compatible cache
$redisCache = new YourRedisCacheAdapter();

$detect = new MobileDetect($redisCache);

// Or tune the bundled in-memory cache's max entries
// (default is 1000; entries beyond the cap are evicted FIFO).
$detect = new MobileDetect(new Cache(5000));
```

### Custom Cache Key Function

```php
use Detection\MobileDetect;

// Custom cache key with salt
$detect = new MobileDetect(null, [
    'cacheKeyFn' => fn($key) => sha1($key . 'my-salt'),
]);

// Or use a different hashing algorithm
$detect = new MobileDetect(null, [
    'cacheKeyFn' => fn($key) => md5($key),
]);
```

### Custom Cache TTL

```php
use Detection\MobileDetect;
use DateInterval;

// TTL as integer (seconds)
$detect = new MobileDetect(null, [
    'cacheTtl' => 3600,  // 1 hour
]);

// TTL as DateInterval
$detect = new MobileDetect(null, [
    'cacheTtl' => new DateInterval('PT2H'),  // 2 hours
]);
```

## Long-Running Processes

When using MobileDetect in CLI scripts, workers, or daemons (RoadRunner, Laravel Octane, FrankenPHP worker mode, Swoole, 
ReactPHP, queue workers) that reuse a single `MobileDetect` instance across many distinct User-Agents, 
the in-memory cache would otherwise grow without bound.

**Default-safe since 4.11.0**: the bundled `Detection\Cache\Cache` enforces a hard cap (1000 entries by default, FIFO eviction).  
Tune via `new Cache($n)` for higher legitimate UA cardinality, or inject a different PSR-16 adapter (Redis, APCu, Memcached, Filesystem) — 
that adapter's eviction policy is then the operator's responsibility. Note that `evictExpired()` only removes entries whose TTL has elapsed; 
under the default 86 400 s TTL it does **not** bound cache size by cardinality.  

Use the `$maxEntries` cap (or `clear()`) for that.

### Worker Example

`setUserAgent()` replaces only the User-Agent. The HTTP headers captured when the instance was created
(`Accept`, `X-WAP-Profile`, `X-OperaMini-Phone-UA`, the CloudFront viewer headers, ...) stay in place and keep
deciding `isMobile()` and the cache key for every later call. In an HTTP worker, either create a new instance
per request and share one `Cache`, or reset the headers of the reused instance with `setHttpHeaders()` (it also
derives the User-Agent from the headers you pass).

```php
use Detection\MobileDetect;
use Detection\Cache\Cache;

// HTTP worker (RoadRunner, Octane, FrankenPHP, Swoole): a fresh instance per request, one shared cache.
$cache = new Cache();

while ($request = getNextRequest()) {
    $detect = new MobileDetect($cache, ['autoInitOfHttpHeaders' => false]);
    // PHP-style server array of the current request (HTTP_USER_AGENT, HTTP_ACCEPT, ...),
    // e.g. $request->server->all() in Symfony/Laravel.
    $detect->setHttpHeaders($request->server->all());

    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
}

// Queue worker: User-Agent strings only, no HTTP headers involved, so one instance can be reused.
$detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);

while ($userAgent = getNextUserAgentFromQueue()) {
    $detect->setUserAgent($userAgent);

    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
}
```

## CloudFront Integration

MobileDetect automatically recognizes Amazon CloudFront headers for device detection.

```php
use Detection\MobileDetect;

// When behind CloudFront with device detection enabled,
// these headers are automatically used:
// - HTTP_CLOUDFRONT_IS_MOBILE_VIEWER
// - HTTP_CLOUDFRONT_IS_TABLET_VIEWER
// - HTTP_CLOUDFRONT_IS_DESKTOP_VIEWER

$detect = new MobileDetect();

// Works automatically when CloudFront headers are present
if ($detect->isMobile()) {
    // Mobile device detected via CloudFront
}

// Not behind CloudFront? Any client can send these headers, so turn the override off.
$detect = new MobileDetect(null, ['trustCloudFrontHeaders' => false]);
```

## Debugging

### Get Matching Information

```php
use Detection\MobileDetect;

$detect = new MobileDetect();
$detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)...');

$detect->isMobile();

// Get the regex that matched
$matchingRegex = $detect->getMatchingRegex();

// Get the matches array
$matches = $detect->getMatchesArray();
```

### Access Cache Directly

```php
use Detection\MobileDetect;

$detect = new MobileDetect();

// Get the cache instance
$cache = $detect->getCache();

// Check cached keys (for debugging)
if ($cache instanceof \Detection\Cache\Cache) {
    $keys = $cache->getKeys();
    print_r($keys);
}
```
