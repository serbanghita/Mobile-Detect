---
description: How to install and use the library
---

# 📦 Install

## **What version should I install?**

<table><thead><tr><th width="113">Version</th><th width="135">PHP version</th><th>How to use / install</th></tr></thead><tbody><tr><td>2.8.x</td><td>>=5.0</td><td><code>git checkout 2.8.x</code><br><code>include "Mobile_Detect.php"</code></td></tr><tr><td>3.74.x</td><td>=7.4,&#x3C;8.0</td><td><code>git checkout 3.74.x</code><br><code>include "src/MobileDetect.php"</code></td></tr><tr><td>4.8.x</td><td>>=8.0</td><td><code>git checkout 4.8.x</code><br><code>composer require mobiledetect/mobiledetectlib</code></td></tr></tbody></table>

## **How do I install it in my project?**

If you are using `composer` and it's autoload, then just install it via Composer.

```sh
composer require mobiledetect/mobiledetectlib
```

If you want to install it manually, then it's probably better to use the branch "2.8.x" or "3.74.x".

Since "4.8.x" branch, the MobileDetect library is no longer stand-alone, it requires some extra classes for Cache and Exceptions.
