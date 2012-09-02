### About

Mobile\_Detect is a lightweight PHP class for detecting mobile devices. It uses the user-agent string combined with specific HTTP headers to detect the mobile environment.
**Note:** this project is _the same_ with [http://code.google.com/p/php-mobile-detect/](http://code.google.com/p/php-mobile-detect/). We are keeping both repositories updated until the transition to GitHub is completed.

We are proudly sponsored by ![BrowserStack](http://jquery.org/wp-content/uploads/2010/01/browserstack-150.png). [BrowserStack](http://www.browserstack.com) is a complete browser coverage tool (including mobile devices) for testing you web application.

<a href='http://www.pledgie.com/campaigns/18179'><img alt='Click here to lend your support to: Mobile Detect PHP class and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/18179.png?skin_name=chrome' border='0' /></a>

### Usage

Include and instantiate the class.
```
include 'Mobile_Detect.php';
$detect = new Mobile_Detect();
```
```
if ($detect->isMobile()) {
    // Any mobile device.
}
```
```
if($detect->isTablet()){
    // Any tablet device.
}
```

Check for a specific platform:
```
if($detect->isiOS()){
    // Code to run for the Apple's iOS platform.
}
```
```
if($detect->isAndroidOS()){
    // Code to run for the Google's Android platform.
}
```
Other case insensitive available methods are `isIphone()`, `isIpad()`, `isBlackBerry()`, `isKindle()`, `isOpera()`, etc. For the full list of available methods check the `demo.php` file or the wiki.