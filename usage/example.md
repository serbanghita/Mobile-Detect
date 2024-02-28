---
description: A simple example of how to use MobileDetect library.
---

# Example

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
