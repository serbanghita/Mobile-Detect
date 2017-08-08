![Mobile Detect](http://demo.mobiledetect.net/logo-github.png)

> Motto: "Every business should have a mobile detection script to detect mobile readers."

[![Build Status](https://travis-ci.org/serbanghita/Mobile-Detect.svg?branch=devel)](https://travis-ci.org/serbanghita/Mobile-Detect) 
[![Latest Stable Version](https://poser.pugx.org/mobiledetect/mobiledetectlib/v/stable.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib) 
[![Total Downloads](https://poser.pugx.org/mobiledetect/mobiledetectlib/downloads.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib) 
[![Daily Downloads](https://poser.pugx.org/mobiledetect/mobiledetectlib/d/daily.png)](https://packagist.org/packages/mobiledetect/mobiledetectlib) 
[![License](https://poser.pugx.org/mobiledetect/mobiledetectlib/license.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib)

*Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.*

We're committed to make Mobile_Detect the best open-source mobile detection resource and this is why before 
each release we're running [unit tests](./tests), we also research and update the detection rules on **daily** 
and **weekly** basis.

Your website's _content strategy_ is important! You need a complete toolkit to deliver an experience that is _optimized_, _fast_ and _relevant_ to your users. Mobile_Detect class is a [server-side detection](http://www.w3.org/TR/mwabp/#bp-devcap-detection) tool that can help you with your RWD strategy, it is not a replacement for CSS3 media queries or other forms of client-side feature detection.

##### Announcements

For `2.x` branch we are no longer taking optimizations pull requests, but only new regexes and User-Agents for our tests.
On `2.x` releases we are focusing on **new tablets only**. All the pull requests about TVs, bots or optimizations will be closed and analyzed after `3.0.0-beta` is released.

Still working on `3.0.0` branch to provide you with device detection!
We're really excited on this one!
We would like to speed this up, but life and family gets in the way ;)

Special thanks to **JetBrains** for providing licenses for **PHPStorm**. In case you never heard or tried PHPStorm, you're
clearly missing out! [Check PHPStorm](https://www.jetbrains.com/phpstorm/) out!

##### Download and demo

|Download|Docs|Examples|
|-------------|-------------|-------------|
|[Go to releases](../../tags)|[Become a contributor](../../wiki/Become-a-contributor)|[Code examples](../../wiki/Code-examples)
|[Mobile_Detect.php](./Mobile_Detect.php)|[History](../../wiki/History)|[:iphone: Live demo!](http://is.gd/mobiletest)
|[Composer package](https://packagist.org/packages/mobiledetect/mobiledetectlib)|

#### Continuous updates

You can use [composer](https://getcomposer.org/doc/00-intro.md) in your release and update process to make sure you have the latest Mobile_Detect version.

```
composer require mobiledetect/mobiledetectlib
```

```json
{
    "require": {
        "mobiledetect/mobiledetectlib": "^2.8"
    }
}
```

##### Help

|Pledgie|Paypal|
|-------|------|
|[Donate :+1:](https://pledgie.com/campaigns/21856)|[Donate :beer:](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mobiledetectlib%40gmail%2ecom&lc=US&item_name=Mobile%20Detect&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)|


I'm currently paying for hosting and spend a lot of my family time to maintain the project and planning the future releases.
I would highly appreciate any money donations that will keep the research going.

Special thanks to the community :+1: for donations, [BrowserStack](https://www.browserstack.com/) - for providing access to their great platform, [Zend](http://www.zend.com/) - for donating licenses, [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

##### 3rd party modules / [Submit new](../../issues/new?title=New%203rd%20party%20module&body=Name, Link and Description of the module.)

:point_right: Keep `Mobile_Detect.php` class in a separate `module` and do NOT include it in your script core because of the high frequency of updates.
:point_right: When including the class into you `web application` or `module` always use `include_once '../path/to/Mobile_Detect.php` to prevent conflicts.

**JavaScript**

* mobile-detect.js - A [JavaScript port](https://github.com/hgoebl/mobile-detect.js) of Mobile-Detect class. Made by [Heinrich Goebl](https://github.com/hgoebl).

**Varnish Cache**

* [Varnish Mobile Detect](https://github.com/willemk/varnish-mobiletranslate) - Drop-in varnish solution to mobile user 
detection based on the Mobile-Detect library. Made by [willemk](https://github.com/willemk).
* [mobiledetect2vcl](https://github.com/carlosabalde/mobiledetect2vcl) - Python script to transform the Mobile 
Detect JSON database into an UA-based mobile detection VCL subroutine easily integrable in any Varnish Cache 
configuration. Made by [Carlos Abalde](https://github.com/carlosabalde).

**LUA**

* [mobile-detect.lua](https://github.com/yourpalmark/mobile-detect.lua) is a port of Mobile-Detect to Lua for 
NGINX HTTP servers. Follows closely to mobile-detect.js. Supports all methods that server-side 
mobile-detect.js supports. Fully unit-tested and synced with Travis CI (Build Passing badge included). 
Made by [Mark Walters](https://github.com/yourpalmark).

**PHP**

**WordPress**

* [WordPress Mobile Detect](https://wordpress.org/plugins/wp-mobile-detect/) - Gives you the ability to wrap that 
infographic in a `[notdevice][/notdevice]` shortcode so at the server level WordPress will 
decide to show that content only if the user is NOT on a phone or tablet. 
Made by [Jesse Friedman](https://profiles.wordpress.org/professor44/).

* [mobble](https://wordpress.org/plugins/mobble/) - provides mobile related conditional functions for your site. 
e.g. `is_iphone()`, `is_mobile()` and `is_tablet()`. Made by Scott Evans.

* [WordPress Responsage](https://github.com/iamspacehead/responsage) - A small WordPress theme plugin that allows 
you to make your images responsive. Made by [Adrian Ciaschetti](https://github.com/iamspacehead).
    
* [WP247 Body Classes](https://wordpress.org/plugins/wp247-body-classes/) - Add unique classes to the `body` tag for 
easy styling based on various attributes (archive, user, post, mobile) and various WordPress "is" functions. 
Mobile attributes include type of device, Operating System, Browser, etc. Examples: .is-mobile, .is-not-mobile, 
.is-tablet, .is-ios, .is-not-ios, .is-androidos, .is-chromebrowser. 
Made by [wescleveland56](https://github.com/wescleveland56).

**Drupal**

* [Drupal Mobile Switch](https://www.drupal.org/project/mobile_switch) - The Mobile Switch Drupal module provides a 
automatic theme switch functionality for mobile devices, detected by Browscap or Mobile Detect. 
Made by [Siegfried Neumann](https://www.drupal.org/user/45267).

* [Drupal Context Mobile Detect](https://www.drupal.org/project/context_mobile_detect) - This is a Drupal context module 
which integrates Context and PHP Mobile Detect library.
Created by [Artem Shymko](https://www.drupal.org/user/432492).

* [Drupal Mobile Detect](https://www.drupal.org/project/mobile_detect) - Lightweight mobile detect module for Drupal
 created by [Matthew Donadio](https://www.drupal.org/user/325244).

**Joomla**

* [yagendoo Joomla! Mobile Detection Plugin](http://www.yagendoo.com/en/blog/free-mobile-detection-plugin-for-joomla.html) - Lightweight PHP plugin for Joomla! 
that detects a mobile browser using the Mobile Detect class.
Made by yagendoo media.
 
* [User Agent Detector plugin](https://github.com/renekreijveld/UserAgentDetector) - This system plugin detects the user 
agent of your website visitor and sets a session variable accordingly. Based on the user agent, the plugin detects if the 
site is running on a desktop pc, tablet or smartphone. It can also detect if the visitor is a spider bot (search engine). 
Session variable that is set: `ualayout`. Possible values: desktop, tablet, mobile, bot.
Made by @ReneKreijveld.

**Magento**

* [Magento helper](http://www.magentocommerce.com/magento-connect/catalog/product/view/id/16835/) from Optimise Web enables 
the use of all functions provided by Mobile Detect. Made by [Kathir Vel](http://www.kathirvel.com).

* [Magento 2 Mobile Detect Theme Change](https://github.com/EaDesgin/magento2-mobiledetect) is an extension for Magento 2 
that will change the theme or redirect to a different URL. Also containing a helper to check for the device type.

**PrestaShop**

* [PrestaShop](https://www.prestashop.com) is a free, secure and open source shopping cart platform. Mobile_Detect 
is included in the default package since 1.5.x.

**Laravel**

* [Agent](https://github.com/jenssegers/agent) is a user agent class for Laravel based on Mobile Detect with some 
additional functionality. 
Made by [Jens Segers](https://github.com/jenssegers).

* [BrowserDetect](https://github.com/hisorange/browser-detect) is a browser and mobile detection package, collects 
and wrap together the best user-agent identifiers for Laravel. 
Created by [Varga Zsolt](https://github.com/hisorange).

**Zend Framework**

* [ZF2 Mobile-Detect](https://github.com/neilime/zf2-mobile-detect.git) is a Zend Framework 2 module that provides 
Mobile-Detect features (Mobile_Detect class as a service, helper for views and plugin controllers). 
Made by [neilime](https://github.com/neilime).

* [ZF2 MobileDetectModule](https://github.com/nikolaposa/MobileDetectModule) facilitates integration of a PHP MobileDetect 
class with some ZF2-based application. Has similar idea like the existing ZF2 Mobile-Detect module, 
but differs in initialization and provision routine of the actual Mobile_Detect class. 
Appropriate view helper and controller plugin also have different conceptions. 
Made by [Nikola Posa](https://github.com/nikolaposa).

**Symfony**

* [Symfony2 Mobile Detect Bundle](https://github.com/suncat2000/MobileDetectBundle) is a bundle for detecting mobile devices, 
manage mobile view and redirect to the mobile and tablet version.
Made by [Nikolay Ivlev](https://github.com/suncat2000).

* [Silex Mobile Detect Service Provider](https://github.com/jbinfo/MobileDetectServiceProvider) is a service provider to 
interact with Mobile detect class methods.
Made by [Lhassan Baazzi](https://github.com/jbinfo).

**Slim Framework**

* [Slim_Mobile_Detect](https://github.com/zguillez/slim_mobile_detect) implements Mobile_Detect lib for different 
responses write on Slim Framework App.

**ExpressionEngine**

* [EE2 Detect Mobile](https://github.com/garethtdavies/detect-mobile) is a lightweight PHP plugin for EE2 that detects
 a mobile browser using the Mobile Detect class. Made by [Gareth Davies](https://github.com/garethtdavies).

**Yii Framework**

* [Yii Extension](https://github.com/iamsalnikov/MobileDetect) - Mobile detect plugin for Yii framework. 
Made by [Alexey Salnikov](https://github.com/iamsalnikov).

* [Yii Extension](https://github.com/candasm/yii1-mobile-detect-component) - Mobile detect component for Yii framework 
1.x version which supports composer package manager. Made by [Candas Minareci](https://github.com/candasm).

* [Yii2 Device Detect](https://github.com/alexandernst/yii2-device-detect/) - Yii2 extension for Mobile-Detect library. 
Made by [Alexander Nestorov](https://github.com/alexandernst).

**CakePHP**

* [CakePHP MobileDetect](https://github.com/chronon/CakePHP-MobileDetectComponent-Plugin) is a plugin component for 
CakePHP 2.x. Made by [Gregory Gaskill](https://github.com/chronon).

**FuelPHP**

* [Special Agent](https://github.com/rob-bar/special_agent) is a FuelPHP package which uses php-mobile-detect to 
determine whether a device is mobile or not. It overrides the Fuelphp Agent class its methods. 
Made by [Robbie Bardjin](https://github.com/rob-bar).


**TYPO3**

* [px_mobiledetect](https://typo3.org/extensions/repository/view/px_mobiledetect) is an extension that helps to detect 
visitor's mobile device class (if that’s tablet or mobile device like smartphone). Made by Alexander Tretyak.

**Other**

* [PageCache](https://github.com/mmamedov/page-cache) is a lightweight PHP library for full page cache, 
with built-in Mobile-Detect support. Made by [Muhammed Mamedov](https://github.com/mmamedov).

* [Statamic CMS Mobile Detect](https://github.com/haikulab/statamic-mobile-detect) is a plugin. 
Made by [Sergei Filippov](https://github.com/haikulab/statamic-mobile-detect) of Haiku Lab.

* [Kohana Mobile Detect](https://github.com/madeinnordeste/kohana-mobile-detect) is an example of implementation of 
Mobile_Detect class with Kohana framework. 
Written by [Luiz Alberto S. Ribeiro](https://github.com/madeinnordeste).

* [MemHT](https://www.memht.com) is a Free PHP CMS and Blog that permit the creation and the management online 
of websites with few and easy steps. Has the class included in the core.

* [concrete5](https://www.concrete5.org) is a CMS that is free and open source. The library is included in the core.

* [engine7](https://github.com/QOXCorp/exengine) is PHP Open Source Framework. The Mobile_Detect class is included in 
the engine.

* [Zikula](http://zikula.org) is a free and open-source Content Management Framework, which allows you to run 
impressive websites and build powerful online applications. The core uses Mobile-Detect to switch to a special 
Mobile theme, using jQueryMobile.

* [UserAgentInfo](https://github.com/quentin389/UserAgentInfo) is a PHP class for parsing user agent strings 
(HTTP_USER_AGENT). Includes mobile checks, bot checks, browser types/versions and more.
Based on browscap, Mobile_Detect and ua-parser. Created for high traffic websites and fast batch processing. 
Made by [quentin389](https://github.com/quentin389).

* [LJ Mobile Detect](https://github.com/lewisjenkins/craft-lj-mobiledetect) is a simple implementation of Mobile Detect 
for Craft CMS. Made by [Lewis Jenkins](https://github.com/lewisjenkins).

* [Grav Plugin Mobile Detect](https://github.com/dimitrilongo/grav-plugin-mobile-detect/) is a simple implementation 
of Mobile Detect for Grav CMS. Made by [Dimitri Longo](https://github.com/dimitrilongo).


**Perl**

 * [MobileDetect.pm](https://www.buzzerstar.com/development/) is a Perl module for Mobile Detect. 
 Made by [Sebastian Enger](https://devop.tools/).

**Python**

* [pymobiledetect](https://pypi.python.org/pypi/pymobiledetect) - Mobile detect python package. 
Made by Bas van Oostveen. 

**Ruby**

* [mobile_detect.rb](https://github.com/ktaragorn/mobile_detect) is a Ruby gem using the JSON data exposed by the 
php project and implementing a basic subset of the API (as much as can be done by the exposed data). 
Made by [Karthik T](https://github.com/ktaragorn).

**Go**

* [GoMobileDetect](https://github.com/Shaked/gomobiledetect) is a Go port of Mobile Detect class. 
Made by [https://github.com/Shaked](Shaked).


**LUA**

* [ua-lua](https://github.com/robinef/ua-lua) is a small lib written in LUA providing device type detection. 
ua-lua is detecting mobile or tablet devices based on user-agent inside nginx daemon. 
Made by [Frédéric Robinet](https://github.com/robinef).
