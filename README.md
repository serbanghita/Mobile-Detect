![Mobile Detect](http://demo.mobiledetect.net/logo-github.png)

### The lightweight PHP class for detecting mobile devices.

> Mobile\_Detect is a lightweight PHP class for detecting mobile devices. It uses the user-agent string combined with specific HTTP headers to detect the mobile environment.

### History

The first version of the script was developed by Victor Stanciu in 2010. 
In December 2011, [Serban Ghita](http://twitter.com/serbanghita) updated the first version and fixed all the bugs, then launched the 2.0 version which marks a new mindset and also featuring tablet detection.

Throughout 2012, the script has been updated constantly and we have received tons of feedback and requests. In July 2012 we moved from [Google Code](http://code.google.com/p/php-mobile-detect/) to GitHub.com in order to quickly accommodate the frequent updates and to involve more people.

### How reliable is this script? How frequent do you update it? How?

The script is as reliable as server-side detection can be. This is not a replacement for RWD (media queries) or other forms of client-side detection. Read W3C's Mobile Web Application Best Practices [Prefer Server-Side Detection Where Possible](http://www.w3.org/TR/mwabp/#bp-devcap-detection) section.

In order to detect phones and tablets (new ones and legacy) we're testing the library against HTTP headers and User-Agents that we find on the internet and through the demo.php file (See: http://is.gd/mobiletest). Sometimes is hard to distinguish between a phone and a tablet, this is why we're constantly researching a lot of mobile vendors sites, checking product codes and new releases. You can see some of our 'tests' by checking the [test](https://github.com/serbanghita/Mobile-Detect/tree/master/tests) folder. 

We are working on a database and API that will automate this process in the near future.

### Roadmap and future development. Contribute!

[![Devel Build Status](https://travis-ci.org/serbanghita/Mobile-Detect.png?branch=devel)](https://travis-ci.org/serbanghita/Mobile-Detect)

We are preparing [v.3.0](https://github.com/serbanghita/Mobile-Detect/wiki/Roadmap) and we need your support! The new milestone will mean great features like: basic detection kept untouched, full array with devices details, device/os/browser version utility, jQuery Mobile browser grading utility, source-code that can be easely updated.

<a href='http://www.pledgie.com/campaigns/18179'><img alt='Click here to lend your support to: Funding development of Mobile_Detect 3.0 and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/18179.png?skin_name=chrome' border='0' /></a>

Sponsored by the community and by [BrowserStack](http://www.browserstack.com) - the complete browser coverage tool (including mobile devices) for testing you web application.
Special thanks to [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

### Usage

Include and instantiate the class:
```php
<?php
include 'Mobile_Detect.php';
$detect = new Mobile_Detect();
```
Basic usage, looking for mobile devices or tablets:
```php
<?php
if ($detect->isMobile()) {
    // Any mobile device.
}
```

```php
<?php
if($detect->isTablet()){
    // Any tablet device.
}
```

Check for a specific platform with the help of the magic methods:
```php
<?php
if($detect->isiOS()){
    // Code to run for the Apple's iOS platform.
}
```

```php
<?php
if($detect->isAndroidOS()){
    // Code to run for the Google's Android platform.
}
```
Other case insensitive available methods are `isIphone()`, `isIpad()`, `isBlackBerry()`, `isKindle()`, `isOpera()`, etc. For the full list of available methods check the `demo.php` file.

Alternative method `is()` for checking specific properties (in beta):
```php
<?php
$detect->is('Chrome')
$detect->is('iOS')
$detect->is('UC Browser')
[...]
```

Batch mode using `setUserAgent()`:
```php
<?php
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
[...]
);
foreach($userAgents as $userAgent){
  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.
}
```

Get the `version()` of components (in beta):
```php
<?php
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone') // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
[...]
```

### Projects that are using the class

<table>
 <tr>
  <td><a href="http://www.concrete5.org">concrete5</a></td>
  <td><code>concrete5</code> is a CMS that is free and open source.</td>
 </tr>
 <tr>
    <td><a href="http://pypi.python.org/pypi/pymobiledetect">pymobiledetect</a></td>
	<td>Mobile detect <code>python package</code>. Made by Bas van Oostveen.</td>
 </tr>
 <tr>
	<td><a href="http://www.prestashop.com">PrestaShop</a></td>
	<td>Free, secure and open source shopping cart platform. Since 1.5.x</td>
 </tr> 
  <tr>
	<td><a href="http://www.reviewsforjoomla.com">JReviews</a></td>
	<td>Review Script for <code>Joomla</code>, CCK and PHP Directory Script.</td>
 </tr> 
  <tr>
	<td><a href="https://github.com/suncat2000/MobileDetectBundle">Symphony2 Mobile Detect Bundle</a></td>
	<td><code>Symfony2</code> bundle for detect mobile devices, manage mobile view and redirect to the mobile and tablet version. Made by <a href="https://github.com/suncat2000">Nikolay Ivlev</a>.</td>
 </tr> 
  <tr>
	<td><a href="https://github.com/garethtdavies/detect-mobile">ExpressionEngine</a></td>
	<td>Lightweight PHP plugin for <code>EE2</code> that detects a mobile browser using the Mobile Detect class. Made by <a href="https://github.com/garethtdavies">Gareth Davies</a>.</td>
 </tr> 

 <tr>
 	<td><a href="https://github.com/iamsalnikov/MobileDetect">Yii Extension</a></td>
 	<td>Mobile detect plugin for Yii framework. Made by <a href="https://github.com/iamsalnikov">Alexey Salnikov</a>.</td>
 </tr>

   <tr>
	<td><a href="http://drupal.org/project/mobile_switch">Drupal Mobile Switch</a></td>
	<td>The Mobile Switch <code>Drupal</code> module provides a automatic theme switch functionality for mobile devices, detected by Browscap or Mobile Detect. Made by <a href="http://drupal.org/user/45267">Siegfried Neumann</a>.</td>
 </tr> 
   <tr>
	<td><a href="http://drupal.org/project/mobile_detect">Drupal Mobile Detect</a></td>
	<td>Lightweight mobile detect module for <code>Drupal</code> created by <a href="http://drupal.org/user/325244">Matthew Donadio</a></td>
 </tr> 
   <tr>
	<td><a href="http://drupal.org/project/context_mobile_detect">Drupal Context Mobile Detect</a></td>
	<td>This is a <code>Drupal context</code> module which integrates Context and PHP Mobile Detect library. Created by <a href="http://drupal.org/user/432492">Artem Shymko</a>.</td>
 </tr> 
    <tr>
	<td><a href="http://wordpress.org/extend/plugins/wp-mobile-detect/">Wordpress Mobile Detect</a></td>
	<td>WP Mobile Detect gives you the ability to wrap that infographic in a [notdevice][/notdevice] shortcode so at the server level <code>WordPress</code> will decide to show that content only if the user is NOT on a phone or tablet. Made by <a href="http://profiles.wordpress.org/professor44/">Jesse Friedman</a>.</td>
 </tr>

     <tr>
	<td><a href="https://github.com/iamspacehead/responsage">Wordpress Responsage</a></td>
	<td>A small <code>WordPress</code> theme plugin that allows you to make your images responsive. Made by <a href="https://github.com/iamspacehead">Adrian Ciaschetti</a>.</td>
 </tr> 
 
    <tr>
	<td><a href="http://tt-rss.org/redmine/projects/tt-rss/wiki">Tiny Tiny RSS</a></td>
	<td>An open source web-based news feed (RSS/Atom) reader and aggregator, designed to allow you to read news from any location, while feeling as close to a real desktop application as possible.</td>
 </tr> 
    <tr>
	<td><a href="http://code.google.com/p/bconsole/">bConsole</a></td>
	<td>Creates a panel that sits on top of a browser-based project and provides information about the client machine and browser.</td>
 </tr> 
 
</table>

Is your project using `Mobile_Detect` the library? [Let us know](https://github.com/serbanghita/Mobile-Detect/issues/new?title=New%20script%20using%20Mobile_Detect&body=Name and Description of your script.)!
