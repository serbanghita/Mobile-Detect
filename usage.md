---
icon: down-right
description: Learn how to use Mobile Detect library via composer
---

# How to use (with composer)

```
composer require mobiledetect/mobiledetectlib
```

```json
{
    "require": {
        "mobiledetect/mobiledetectlib": "4.8.09" // Change to the lastest version.
    }
}
```

```php
// (optional) You're app is probably already using composer autoloader.
require __DIR__ . '/vendor/autoload.php';

// (mandatory)
use Detection\MobileDetect;
$detect = new MobileDetect();

// (optional) By default the Mobile Detect library auto-detects the HTTP headers from $_SERVER global variable.
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) ...');

// Use whatever methods you want.
$isMobile = $detect->isMobile();
$isTablet = $detect->isTablet();

var_dump($isMobile);
var_dump($isTablet);

var_dump($detect); // debug
```
