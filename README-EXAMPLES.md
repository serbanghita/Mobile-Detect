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
use Psr\SimpleCache\CacheInterface;

// Use any PSR-16 compatible cache
$redisCache = new YourRedisCacheAdapter();

$detect = new MobileDetect($redisCache);
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

When using MobileDetect in CLI scripts, workers, or daemons that process many different User-Agents, you should periodically clean up expired cache entries to prevent memory growth.

### Worker Example

```php
use Detection\MobileDetect;
use Detection\Cache\Cache;

$detect = new MobileDetect();
$cache = $detect->getCache();

$iterationCount = 0;

while ($userAgent = getNextUserAgentFromQueue()) {
    $detect->setUserAgent($userAgent);

    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();

    // Process the result...
    processDevice($userAgent, $isMobile, $isTablet);

    $iterationCount++;

    // Periodically clean up expired cache entries
    if ($iterationCount % 1000 === 0 && $cache instanceof Cache) {
        $evicted = $cache->evictExpired();
        echo "Evicted $evicted expired cache entries\n";
    }
}
```

### Batch Processing Example

```php
use Detection\MobileDetect;
use Detection\Cache\Cache;

$detect = new MobileDetect();

// Process a large batch of User-Agents
$userAgents = file('user-agents.txt', FILE_IGNORE_NEW_LINES);

foreach ($userAgents as $index => $ua) {
    $detect->setUserAgent($ua);

    $results[] = [
        'ua' => $ua,
        'mobile' => $detect->isMobile(),
        'tablet' => $detect->isTablet(),
    ];
}

// Clean up after batch processing
$cache = $detect->getCache();
if ($cache instanceof Cache) {
    $cache->evictExpired();
    // Or clear entirely if you're done
    $cache->clear();
}
```

## Framework Integration

### Laravel Middleware Example

```php
namespace App\Http\Middleware;

use Closure;
use Detection\MobileDetect;
use Illuminate\Http\Request;

class DetectMobileDevice
{
    public function handle(Request $request, Closure $next)
    {
        $detect = new MobileDetect();

        $request->attributes->set('is_mobile', $detect->isMobile());
        $request->attributes->set('is_tablet', $detect->isTablet());

        return $next($request);
    }
}
```

### Symfony Service Example

```php
// config/services.yaml
services:
    Detection\MobileDetect:
        public: true
```

```php
// In a controller
use Detection\MobileDetect;

class MyController
{
    public function index(MobileDetect $detect)
    {
        if ($detect->isMobile()) {
            return $this->render('mobile/index.html.twig');
        }

        return $this->render('desktop/index.html.twig');
    }
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
