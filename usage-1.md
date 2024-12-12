---
description: Learn how to use Mobile Detect library step-by-step.
icon: down-right
---

# How to use (standalone)

```bash
git@github.com:serbanghita/Mobile-Detect.git
touch example.php
```

```php
<?php
// example.php contents

use Detection\Exception\MobileDetectException;
use Detection\MobileDetectStandalone;

require_once './Mobile-Detect/standalone/autoloader.php';
require_once './Mobile-Detect/src/MobileDetectStandalone.php';

$detection = new MobileDetectStandalone();
$detection->setUserAgent('iPad');

try {
    var_dump($detection);
    var_dump($detection->isMobile());
} catch (MobileDetectException $e) {
    print_r($e);
}


```
