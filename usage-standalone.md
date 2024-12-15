---
icon: down-right
description: Learn how to use Mobile Detect library step-by-step.
---

# How to use (standalone)

```bash
git clone git@github.com:serbanghita/Mobile-Detect.git
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
