---
description: Learn how to use Mobile Detect library.
---

# ⌨️ Library

1. ### Include composer's autoloader.

In case you are already using a PHP app, this step is probably already covered.

```php
require __DIR__ . '/vendor/autoload.php';
```

2. ### Instantiate the class.

```php
use Detection\MobileDetect;
$detect = new MobileDetect();
```

3. ### (Optional) Set the User-Agent.

Omit this step if your HTTP headers are available in `$_SERVER` global variable.

```php
$detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 14_7 like Mac OS X) ...');
```

4. ### Check for "mobile".

```php
$isMobile = $detect->isMobile();
$isTablet = $detect->isTablet()
```
