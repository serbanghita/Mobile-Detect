<img src="http://demo.mobiledetect.net/logo-github.png">
> Motto: "Every business should have a mobile detection script to detect mobile readers."

[![Coverage Status](https://coveralls.io/repos/serbanghita/Mobile-Detect/badge.svg?branch=devel-3-refactoring)](https://coveralls.io/r/serbanghita/Mobile-Detect?branch=devel-3-refactoring)
[![Build Status](https://travis-ci.org/serbanghita/Mobile-Detect.png?branch=devel-3-refactoring)](https://travis-ci.org/serbanghita/Mobile-Detect)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serbanghita/Mobile-Detect/badges/quality-score.png?b=devel-3-refactoring)](https://scrutinizer-ci.com/g/serbanghita/Mobile-Detect/?branch=devel-3-refactoring)

## Installing

Using composer.

## Getting started

When you want to detect information about a device, you simply need to detect it.

```php
$mobileDetect = new MobileDetect();
$device = $mobileDetect->detect();

if ($device->isMobile()) {
  // hooray!
}
```

Once you've detected your device, you have an array of methods available to you to retrieve various properties about your device, such as browser, operating system, vendor, model, and any version for these or any other properties.

```php
echo "You are using " . $device->getBrowser() . " browser with version "
  . " with version " . $device->getBrowserVersion();
```

You may also be looking for a very specific version in your device:

```php
echo "You are using WebKit version: " . $device->getVersion('WebKit');
```

Here's a list of all the methods on the `Device` class that you can utilize:

 * @todo plz list me
 * list
 * it

@ todo user apache_get_headers

## Shortcuts

There are static shortcuts available for quick usage.

```php
use MobileDetect\MobileDetect;

if (MobileDetect::isMobile() || MobileDetect::isTablet()) {
  $browser        = MobileDetect::getBrowser();
  $browserVersion = MobileDetect::getBrowserVersion();
  $os             = MobileDetect::getOperatingSystem();
  $osver          = MobileDetect::getOperatingSystemVersion();
  $model          = MobileDetect::getModel();
  $modelVersion   = MobileDetect::getModelVersion();
  $vendor         = MobileDetect::getVendor();
}
```

These methods aren't particularly performant, but are offered for simpler usage if the developer so desires.

## Caching

As of Mobile Detect version 3, caching is supported and can be utilized with any caching library by utilizing closures that you set in your bootstraps. You need to provide a cache setter and a cache getter. Here's a simple example where you write the object to disk:

```php
$mobileDetect = new MobileDetect();
$mobileDetect->setCacheSetter(function($key, $obj){
  $ser = serialize($obj);
  file_put_contents('/tmp/' . $key, $ser);
  return true;
});

$mobileDetect->setCacheGetter(function($key){
  $file = '/tmp/' . $key;
  
  if (file_exists($file) && is_readable($file)) {
    $raw = file_get_contents($file);
    return unserialize($raw);
  }
});
```

The key that is used in caching is the user agent header, which is either automatically detected using the `$_SERVER` suberglobal or can be injected into the constructor during initialization.

## Questions

**Why does my device not have a model version?**

Detection is based off of known or popular patterns in user agent strings. Not all devices or user agents are known, nor do all types get reported in the user agent. We encourage you to report user agents that you find may be not fully detectable with the device class. Please open a Github issue and provide the user agent to us.
  
 **Why can I not get version by float anymore?**
 
 The `version_compare` method in PHP uses strings and provides any type of version comparison necessary. The ability to convert to floats is unnecessary given this method.
 
 **Why are there no more device grades?**
 
 Device grades are very expensive to detect and can add significant overhead and this type of detection is on-par with browser-specific code versus capability-detection in JavaScript.
 
 **Why are there no more quick detection methods based off of some special headers?**
 
 They don't provide the big picture and their usefulness is dependent on their popularity. However, it's unclear that these headers were ever ubiquitous enough to warrant the additional runtime necessary for inspecting them. Regardless, device information cannot be built with these headers and so their usefulness is very limted.

