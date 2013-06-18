<table width="100%" border="0">
  <td><img src="http://demo.mobiledetect.net/logo-github.png"></td>
  <td width="120">
    <ol>
      <li><a href="https://github.com/serbanghita/Mobile-Detect/blob/master/README.md#demo">Demo</a></li>
      <li><a href="https://github.com/serbanghita/Mobile-Detect/blob/master/README.md#download">Download</a></li>
      <li><a href="https://github.com/serbanghita/Mobile-Detect/blob/master/README.md#help">Help!</a></li>
      <li><a href="https://github.com/serbanghita/Mobile-Detect/blob/master/README.md#code-examples">Examples</li>
      <li><a href="https://github.com/serbanghita/Mobile-Detect/blob/master/README.md#3rd-party-modules--submit-new">3<sup>rd</sup> party</a></li>
    </ol>
  </td>
</table>
> Motto: "Every business should have a mobile detection script to detect mobile readers."

<i>Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.</i>

You may consider this script as being part of the <b>RESS</b> (Responsive Web Design with Server-Side Component) movement. You can find out more on the topic by reading these articles: [Improve Mobile Support With Server-Side-Enhanced Responsive Design](http://mobile.smashingmagazine.com/2013/04/09/improve-mobile-support-with-server-side-enhanced-responsive-design/) and [RESS: Responsive Design + Server Side Components](http://www.lukew.com/ff/entry.asp?1392).

## Demo

http://is.gd/mobiletest (redirects to demo.mobiledetect.net) - Point your device browser to this URL.

##### How reliable is this script?

The script is as reliable as Server-Side detection can be. This is not a replacement for Responsive Web Design (media queries)
or other forms of Client-Side detection. Read W3C's Mobile Web Application Best Practices [Prefer Server-Side Detection Where Possible](http://www.w3.org/TR/mwabp/#bp-devcap-detection) section.
We're running [automated tests](./tests) to make sure the we don't break the detection every time we update it with new devices and also to avoid regex collisions.

The script is updated on <b>daily</b> and <b>weekly</b> basis, so make sure you keep following the updates!
Sometimes is hard to distinguish between a phone and a tablet, this is why we're constantly researching a lot of mobile vendors sites, checking product codes and new releases.

We are working on a database and API that will automate this process.

## Download

<a href="https://github.com/serbanghita/Mobile-Detect/tags">Latest releases</a>, <a href="https://github.com/serbanghita/Mobile-Detect/blob/devel/Mobile_Detect.php">Latest dev branch</a>, <a href="https://packagist.org/packages/mobiledetect/mobiledetectlib">composer package</a>

## Help

<a href='http://www.pledgie.com/campaigns/18179'><img alt='Click here to lend your support to: Funding development of Mobile_Detect 3.0 and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/18179.png?skin_name=chrome' border='0' /></a>

I'm currently paying for hosting and spend a lot of my family time to maintain the project and planning the future releases.
I would highly appreciate any money donations that will keep the research going.

Sponsored by the community and by [BrowserStack](http://www.browserstack.com) - the complete browser coverage tool (including mobile devices) for testing you web application.
Special thanks to [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

##### Roadmap and How to contribute to the code

<table>
  <tr>
    <td width="20%"><a href="https://github.com/serbanghita/Mobile-Detect/wiki/Road-to-2.9.9">Road to 2.9.9 version</a> <img alt="Dev status" src="https://travis-ci.org/serbanghita/Mobile-Detect.png?branch=devel" border="0"></td>
    <td>Work scheduled on the <code>2.x.x</code> branch (currently in production).
      <p>Contribute directly to <code>Mobile_Detect.php</code>, then write appropriate tests into <code>manual_tests/mobilePerVendor_useragents.inc.php</code>. Commit changes to the <code>devel</code> branch. I will merge the commits into <code>master</code> later.</p>
      <p>Contribute by adding tests (User-Agent strings) to <code>manual_tests/mobilePerVendor_useragents.inc.php</code></p>
    </td>
  </tr>
  <tr>
    <td><a href="https://github.com/serbanghita/Mobile-Detect/wiki/Road-to-3.0.0">Road to 3.0.0 version</a></td>
    <td>Work scheduled on the <code>3.x.x</code> branch. The new <code>3.0.0</code> version will feature: compatibility with <code>2.x</code>, array with devices details (including model name), device/os/browser version, browser grading utility, separate JSON regex.</td>
  </tr>
</table>

##### History

The first version of the script was developed by Victor Stanciu in 2010.
In December 2011, [Serban Ghita](http://twitter.com/serbanghita) updated the first version and fixed all the bugs, then launched the 2.0 version which marks a new mindset and also featuring tablet detection.

Throughout 2012, the script has been updated constantly and we have received tons of feedback and requests. In July 2012 we moved from [Google Code](http://code.google.com/p/php-mobile-detect/) to GitHub.com in order to quickly accommodate the frequent updates and to involve more people.

## Code examples

```php
<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {

}

// Any tablet device.
if( $detect->isTablet() ){

}

// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet() ){

}

// Check for a specific platform with the help of the magic methods:
if( $detect->isiOS() ){

}

if( $detect->isAndroidOS() ){

}

// Alternative method is() for checking specific properties.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->is('Chrome')
$detect->is('iOS')
$detect->is('UC Browser')
// [...]

// Batch mode using setUserAgent():
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
// [...]
);
foreach($userAgents as $userAgent){

  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.

}

// Get the version() of components.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone') // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
// [...]
```

## 3rd party modules / [Submit new](https://github.com/serbanghita/Mobile-Detect/issues/new?title=New%203rd%20party%20module&body=Name, Link and Description of the module.)

<table>

<tr>
  <td>Wordpress</td>
  <td>
    <p><a href="http://wordpress.org/extend/plugins/wp-mobile-detect/">Wordpress Mobile Detect</a> - Gives you the ability to wrap that infographic in a [notdevice][/notdevice] shortcode so at the server level <code>WordPress</code> will decide to show that content only if the user is NOT on a phone or tablet. Made by <a href="http://profiles.wordpress.org/professor44/">Jesse Friedman</a>.</p>

    <p><a href="http://wordpress.org/plugins/mobble/">mobble</a> - provides mobile related conditional functions for your site. e.g. is_iphone(), is_mobile() and is_tablet(). Made by Scott Evans.</p>

    <p><a href="https://github.com/iamspacehead/responsage">Wordpress Responsage</a> - A small <code>WordPress</code> theme plugin that allows you to make your images responsive. Made by <a href="https://github.com/iamspacehead">Adrian Ciaschetti</a>.</p>

    <p><a href="http://wordpress.org/plugins/social-popup/">Social PopUP</a> - This plugin will display a popup or splash screen when a new user visit your site showing a Google+, Twitter and Facebook follow links. It uses Mobile_Detect to detect mobile devices.</p>
  </td>
</tr>

<tr>
  <td>Drupal</td>
  <td>
    <p><a href="http://drupal.org/project/mobile_switch">Drupal Mobile Switch</a> - The Mobile Switch <code>Drupal</code> module provides a automatic theme switch functionality for mobile devices,
    detected by Browscap or Mobile Detect. Made by <a href="http://drupal.org/user/45267">Siegfried Neumann</a>.</p>

      <p><a href="http://drupal.org/project/context_mobile_detect">Drupal Context Mobile Detect</a> - This is a <code>Drupal context</code> module which integrates Context and PHP Mobile Detect library.
      Created by <a href="http://drupal.org/user/432492">Artem Shymko</a>.</p>

      <p><a href="http://drupal.org/project/mobile_detect">Drupal Mobile Detect</a> - Lightweight mobile detect module for <code>Drupal</code> created by <a href="http://drupal.org/user/325244">Matthew Donadio</a></p>
  </td>
</tr>

  <tr>
    <td>Joomla</td>
    <td>No module submitted yet.</td>
 </tr>

 <tr>
     <td>Magento</td>
     <td><p><a href="http://www.magentocommerce.com/magento-connect/catalog/product/view/id/16835/">Magento</a> - This <code>Magento helper</code> from Optimise Web enables the use of all functions provided by MobileDetect.net.
     Made by <a href="http://www.kathirvel.com">Kathir Vel</a>.</p></td>
 </tr>

 <tr>
  <td>PrestaShop</td>
  <td><p>Free, secure and open source shopping cart platform. Included in the distribution since 1.5.x.</p></td>
 </tr>

  <tr>
    <td>Symfony</td>
    <td><p><a href="https://github.com/suncat2000/MobileDetectBundle">Symfony2 Mobile Detect Bundle</a> - The bundle for detecting mobile devices, manage mobile view and redirect to the mobile and tablet version.
        Made by <a href="https://github.com/suncat2000">Nikolay Ivlev</a>.</p>
        <p><a href="https://github.com/jbinfo/MobileDetectServiceProvider">Silex Mobile Detect Service Provider</a> - <code>Silex</code> service provider to interact with Mobile detect class methods. Made by <a href="https://github.com/jbinfo">Lhassan Baazzi</a>.</p>
     </td>
  </tr>

  <tr>
    <td>ExpressionEngine</td>
    <td><p><a href="https://github.com/garethtdavies/detect-mobile">EE2 Detect Mobile</a> - Lightweight PHP plugin for <code>EE2</code> that detects a mobile browser using the Mobile Detect class. Made by <a href="https://github.com/garethtdavies">Gareth Davies</a>.</p></td>
 </tr>

 <tr>
  <td>Yii Framework</td>
  <td><p><a href="https://github.com/iamsalnikov/MobileDetect">Yii Extension</a> - Mobile detect plugin for Yii framework. Made by <a href="https://github.com/iamsalnikov">Alexey Salnikov</a>.</p></td>
 </tr>

<tr>
    <td>CakePHP</td>
    <td><p><a href="https://github.com/chronon/CakePHP-MobileDetectComponent-Plugin">CakePHP MobileDetect</a> - <code>plugin</code> component for <code>CakePHP</code> 2.x. Made by <a href="https://github.com/chronon">Gregory Gaskill</a></p></td>
</tr>

<tr>
    <td>FuelPHP</td>
    <td><a href="https://github.com/rob-bar/special_agent">Special Agent</a> is a FuelPHP package which uses php-mobile-detect to determine whether a device is mobile or not.
It overrides the Fuelphp Agent class its methods. Made by <a href="https://github.com/rob-bar">Robbie Bardjin</a>.</td>
</tr>

<tr>
  <td>Statamic</td>
  <td><p><a href="https://github.com/sergeifilippov/statamic-mobile-detect">Statamic CMS Mobile Detect</a> - <code>plugin</code>. Made by <a href="https://github.com/sergeifilippov">Sergei Filippov</a>.</p></td>
</tr>

 <tr>
      <td>python</td>
      <td><p><a href="http://pypi.python.org/pypi/pymobiledetect">pymobiledetect</a> - Mobile detect <code>python package</code>. Made by Bas van Oostveen.</p></td>
 </tr>

 <tr>
    <td>MemHT</td>
    <td><p><code>MemHT</code> is a Free PHP CMS and Blog that permit the creation and the management online of websites with few and easy steps. Has the class included in the core.</p></td>
 </tr>

 <tr>
  <td>concrete5</td>
  <td><p><code>concrete5</code> is a CMS that is free and open source. The library is included in the core.</p></td>
 </tr>

</table>
