---
description: This is guide on how to use Mobile Detect PHP library in your project.
---

# Mobile Detect

## **What is it?**

Mobile Detect is a lightweight PHP package for detecting mobile devices (including tablets). \
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.

***

## **How does it work?**

MobileDetect class uses a list of regexes ordered by importance.

The regexes can be grouped as a `string` containing matching words separated by pipe: "`iPad|iPad.*Mobile`" or grouped into `arrays` of smaller strings sequences in order to avoid memory issues.

There are four types of regexes: `browsers`, `operatingSystems`, `mobile` and `tablet`.

All the regexes inside `MobileDetect.php` file refer to "mobile" devices, not "desktop" or other type of devices.

The library's main purpose is to detect "mobile" devices and attempt to figure out if the "mobile" device is a "phone" or a "tablet".

***

## **Can I test it on my devices?**

[https://demo.mobiledetect.net/](https://demo.mobiledetect.net/)

***

## **What version should I install?**

<table><thead><tr><th width="113">Version</th><th width="132">PHP version</th><th>How to use / install</th></tr></thead><tbody><tr><td>2.8.x</td><td>>=5.0</td><td><code>git checkout 2.8.x</code><br><code>include "Mobile_Detect.php"</code></td></tr><tr><td>3.74.x</td><td>=7.4,&#x3C;8.0</td><td><code>git checkout 3.74.x</code><br><code>include "src/MobileDetect.php"</code></td></tr><tr><td>4.8.x</td><td>>=8.0</td><td><code>git checkout 4.8.x</code><br><code>composer require mobiledetect/mobiledetectlib</code></td></tr></tbody></table>

***

## **How do I install it in my project?**

If you are using `composer` and it's autoload, then just install it via Composer.

If you want to install it manually, then it's probably better to use the branch "2.8.x" or "3.74.x".

Since "4.8.x" branch, the MobileDetect library is no longer stand-alone, it requires some extra classes for Cache and Exceptions.

***

## **How do I use it?**

```php
// 1. Include composer's autoloader
require __DIR__ . '/vendor/autoload.php';

use Detection\MobileDetect;
// Instantiate the class.
// Here you can inject your own caching system.
$detect = new MobileDetect();
// Set the user agent string from HTTP headers or manually.
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) ...');
// Finally, check for "mobile".
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
```

## Examples

```php
use Detection\MobileDetect;

require_once  __DIR__ . '/../vendor/autoload.php';

$detect = new MobileDetect();
// This is optional. We scan for known $_SERVER variables.
// See: https://github.com/serbanghita/Mobile-Detect/issues/948#issuecomment-1800271108
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/248.1.504392274 Mobile/15E148 Safari/604.1');
$isMobile = $detect->isMobile();
$isTablet = $detect->isTablet();
```

## Extending / Porting

[https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/MobileDetect.json](https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/MobileDetect.json)
