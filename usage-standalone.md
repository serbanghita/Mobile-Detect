---
icon: down-right
description: Learn how to use Mobile Detect library step-by-step.
---

# How to use (standalone)

```bash
git clone git@github.com:serbanghita/Mobile-Detect.git
git checkout 4.8.x
```

Or without `git`, just go to [https://github.com/serbanghita/Mobile-Detect](https://github.com/serbanghita/Mobile-Detect) and click on the green button "Code" -> "Download ZIP" (by default you get 4.8.x version).

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
