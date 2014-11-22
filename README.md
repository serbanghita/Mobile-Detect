[![Build Status](https://travis-ci.org/serbanghita/Mobile-Detect.svg?branch=devel)](https://travis-ci.org/serbanghita/Mobile-Detect) [![Latest Stable Version](https://poser.pugx.org/mobiledetect/mobiledetectlib/v/stable.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib) [![Total Downloads](https://poser.pugx.org/mobiledetect/mobiledetectlib/downloads.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib) [![Daily Downloads](https://poser.pugx.org/mobiledetect/mobiledetectlib/d/daily.png)](https://packagist.org/packages/mobiledetect/mobiledetectlib) [![License](https://poser.pugx.org/mobiledetect/mobiledetectlib/license.svg)](https://packagist.org/packages/mobiledetect/mobiledetectlib)
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/serbanghita/Mobile-Detect?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

![Mobile Detect](http://demo.mobiledetect.net/logo-github.png)

> Motto: "Every business should have a mobile detection script to detect mobile readers."

<i>Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.</i>

> We're commited to make Mobile_Detect the best open-source mobile detection resource and this is why before each release we're running [unit tests](./tests), we also research and update the detection rules on <b>daily</b> and <b>weekly</b> basis.

Your website's _content strategy_ is important! You need a complete toolkit to deliver an experience that is  _optimized_, _fast_ and _relevant_ to your users. Mobile_Detect class is a [server-side detection](http://www.w3.org/TR/mwabp/#bp-devcap-detection) tool that can help you with your RWD strategy, it is not a replacement for CSS3 media queries or other forms of client-side feature detection.

##### This month updates

First of all a **BIG THANK YOU** to our growing community for your continuous support and for all the feedback received! I'm still working my way with the current issues and all the emails. 

Nick is almost done with all the code for the upcoming `3.0.0` so that I only have to integrate the new parsing engine. We will release minor `2.8.xx` versions until a feature freeze where we will switch to the new branch. You will all be announced before this and hopefully we can make the transition smooth for everyone.

<a href="http://trycatch.us/"><img align="left" src="http://assets.mobiledetect.net/img/try_catch_logo_80px.jpg" hspace="20"></a> Last but not least, special thanks for supporting us to our friends from [TryCatch.us](http://trycatch.us/) who _are set to carefully curate the most talented developers in Europe_!

Thank you all and we're excited for the new release!

##### Download and demo

|Download|Docs|Examples|
|-------------|-------------|-------------|
|[Go to releases](../../tags)|[Become a contributor](../../wiki/Become-a-contributor)|[Code examples](../../wiki/Code-examples)
|[Mobile_Detect.php](./Mobile_Detect.php)|[History](../../wiki/History)|[:iphone: Live demo!](http://is.gd/mobiletest)
|[Composer package](https://packagist.org/packages/mobiledetect/mobiledetectlib)|

##### Help

|Pledgie|Paypal|
|-------|------|
|[Donate :+1:](http://pledgie.com/campaigns/21856)|[Donate :beer:](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mobiledetectlib%40gmail%2ecom&lc=US&item_name=Mobile%20Detect&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)|


I'm currently paying for hosting and spend a lot of my family time to maintain the project and planning the future releases.
I would highly appreciate any money donations that will keep the research going.

Special thanks to the community :+1: for donations, [BrowserStack](http://browserstack.com) - for providing access to their great platform, [Zend](http://zend.com) - for donating licenses, [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

##### 3rd party modules / [Submit new](../../issues/new?title=New%203rd%20party%20module&body=Name, Link and Description of the module.)

:point_right: Keep `Mobile_Detect.php` class in a separate `module` and do NOT include it in your script core because of the high frequency of updates.
:point_right: When including the class into you `web application` or `module` always use `include_once '../path/to/Mobile_Detect.php` to prevent conflicts.

<table>

<tr>
  <td>Varnish Cache</td>
  <td>
    <p><a href="https://github.com/willemk/varnish-mobiletranslate">Varnish Mobile Detect</a> - Drop-in varnish solution to mobile user detection based on the Mobile-Detect library. Made by <a href="https://github.com/willemk">willemk</a></p>
    <p><a href="https://github.com/carlosabalde/mobiledetect2vcl">mobiledetect2vcl</a> - Python script to transform the Mobile Detect JSON database into an UA-based mobile detection VCL subroutine easily integrable in any Varnish Cache configuration. Made by <a href="https://github.com/carlosabalde">Carlos Abalde</a></p>
  </td>
</tr>

<tr>
  <td>WordPress</td>
  <td>
    <p><a href="http://wordpress.org/extend/plugins/wp-mobile-detect/">WordPress Mobile Detect</a> - Gives you the ability to wrap that infographic in a `[notdevice][/notdevice]` shortcode so at the server level <code>WordPress</code> will decide to show that content only if the user is NOT on a phone or tablet. Made by <a href="http://profiles.wordpress.org/professor44/">Jesse Friedman</a>.</p>

    <p><a href="http://wordpress.org/plugins/mobble/">mobble</a> - provides mobile related conditional functions for your site. e.g. is_iphone(), is_mobile() and is_tablet(). Made by Scott Evans.</p>

    <p><a href="https://github.com/iamspacehead/responsage">WordPress Responsage</a> - A small <code>WordPress</code> theme plugin that allows you to make your images responsive. Made by <a href="https://github.com/iamspacehead">Adrian Ciaschetti</a>.</p>

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
    <td><p><a href="http://www.yagendoo.com/en/blog/free-mobile-detection-plugin-for-joomla.html">yagendoo Joomla! Mobile Detection Plugin</a> - Lightweight PHP plugin for Joomla! that detects a mobile browser using the Mobile Detect class. Made by <a href="http://www.yagendoo.com/">yagendoo media</a>.</p></td>
 </tr>

 <tr>
     <td>Magento</td>
     <td><p><a href="http://www.magentocommerce.com/magento-connect/catalog/product/view/id/16835/">Magento</a> - This <code>Magento helper</code> from Optimise Web enables the use of all functions provided by MobileDetect.net.
     Made by <a href="http://www.kathirvel.com">Kathir Vel</a>.</p></td>
 </tr>

 <tr>
  <td>PrestaShop</td>
  <td><p><a href="http://www.prestashop.com/">PrestaShop</a> is a free, secure and open source shopping cart platform. Mobile_Detect is included in the default package since 1.5.x.</p></td>
 </tr>

 <tr>
  <td>Zend Framework</td>
  <td>
    <p><a href="https://github.com/neilime/zf2-mobile-detect.git">ZF2 Mobile-Detect</a> - Zend Framework 2 module that provides Mobile-Detect features (Mobile_Detect class as a service, helper for views and plugin controllers). Made by <a href="https://github.com/neilime">neilime</a></p>

   <p><a href="https://github.com/nikolaposa/MobileDetectModule">ZF2 MobileDetectModule</a> - Facilitates integration of a PHP MobileDetect class with some ZF2-based application. Has similar idea like the existing ZF2 Mobile-Detect module, but differs in initialization and provision routine of the actual Mobile_Detect class. Appropriate view helper and controller plugin also have different conceptions. Made by <a href="https://github.com/nikolaposa">Nikola Posa</a></p>
  </td>
 </tr>

  <tr>
    <td>Symfony</td>
    <td><p><a href="https://github.com/suncat2000/MobileDetectBundle">Symfony2 Mobile Detect Bundle</a> - The bundle for detecting mobile devices, manage mobile view and redirect to the mobile and tablet version.
        Made by <a href="https://github.com/suncat2000">Nikolay Ivlev</a>.</p>
        <p><a href="https://github.com/jbinfo/MobileDetectServiceProvider">Silex Mobile Detect Service Provider</a> - <code>Silex</code> service provider to interact with Mobile detect class methods. Made by <a href="https://github.com/jbinfo">Lhassan Baazzi</a>.</p>
     </td>
  </tr>

  <tr>
    <td>Laravel</td>
    <td>
    <p><a href="https://github.com/jenssegers/Laravel-Agent">Laravel-Agent</a> a user agent class for Laravel, based on Mobile Detect with some additional functionality. Made by <a href="https://github.com/jenssegers">Jens Segers</a>.</p>
    <p><a href="https://github.com/hisorange/browser-detect">BrowserDetect</a> is a browser &amp; mobile detection package, collects and wrap together the best user-agent identifiers for Laravel. Created by <a href="https://github.com/hisorange">Varga Zsolt</a>.</p>
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
  <td>Typo3</td>
  <td><a href="http://docs.typo3.org/typo3cms/extensions/px_mobiledetect/1.0.2/">px_mobiledetect</a> is an extension that helps to detect visitor's mobile device class (if that’s tablet or mobile device like smartphone). Made by Alexander Tretyak.</td>
</tr>

<tr>
  <td>Statamic</td>
  <td><p><a href="https://github.com/sergeifilippov/statamic-mobile-detect">Statamic CMS Mobile Detect</a> - <code>plugin</code>. Made by <a href="https://github.com/haikulab/statamic-mobile-detect">Sergei Filippov of Haiku Lab</a>.</p></td>
</tr>

<tr>
  <td>Kohana</td>
  <td><p><a href="https://github.com/madeinnordeste/kohana-mobile-detect">Kohana Mobile Detect</a> - an example of implementation of <code>Mobile_Detect</code> class with Kohana framework. Written by <a href="https://github.com/madeinnordeste">Luiz Alberto S. Ribeiro</a>.</p></td>
</tr>

<tr>
  <td>mobile-detect.js</td>
  <td><p>A <a href="https://github.com/hgoebl/mobile-detect.js">JavaScript port</a> of Mobile-Detect class. Made by <a href="https://github.com/hgoebl">Heinrich Goebl</a></p></td>
  </tr>

 <tr>
      <td>Perl</td>
      <td><p><a href="http://www.buzzerstar.com/development/">MobileDetect.pm</a> - <code>Perl module</code> for  Mobile Detect. Made by <a href="http://www.buzzerstar.com/">Sebastian Enger</a>.</p></td>
 </tr>

 <tr>
      <td>python</td>
      <td><p><a href="http://pypi.python.org/pypi/pymobiledetect">pymobiledetect</a> - Mobile detect <code>python package</code>. Made by Bas van Oostveen.</p></td>
 </tr>
 
 <tr>
	 <td>Ruby</td>
	 <td><p><a href="https://github.com/ktaragorn/mobile_detect">mobile_detect.rb</a> - A <code>Ruby gem</code> using the JSON data exposed by the php project and implementing a basic subset of the API (as much as can be done by the exposed data). Made by <a href="https://github.com/ktaragorn">Karthik T</a>.</p></td>
 </tr>

<tr>
	<td>GoMobileDetect</td>
	<td><p><a href="https://github.com/Shaked/gomobiledetect">GoMobileDetect</a> - Go port of Mobile Detect class. Made by <a href="https://github.com/Shaked">Shaked</a>.</p></td>
</tr>

 <tr>
    <td>MemHT</td>
    <td><p><a href="http://www.memht.com/">MemHT</a> is a Free PHP CMS and Blog that permit the creation and the management online of websites with few and easy steps. Has the class included in the core.</p></td>
 </tr>

 <tr>
  <td>concrete5</td>
  <td><p><a href="https://www.concrete5.org/">concrete5</a> is a CMS that is free and open source. The library is included in the core.</p></td>
 </tr>

 <tr>
  <td>engine7</td>
  <td><p><a href="https://github.com/gchiappe/exengine7">ExEngine 7</a> PHP Open Source Framework. The Mobile_Detect class is included in the engine.</p></td>
 </tr>

 <tr>
  <td>Zikula</td>
  <td><p><a href="http://zikula.org/">Zikula</a> is a free and open-source Content Management Framework, which allows you to run impressive websites and build powerful online applications. The core uses Mobile-Detect to switch to a special Mobile theme, using jQueryMobile</p></td>
 </tr>

<tr>
    <td>UserAgentInfo</td>
    <td><p><a href="https://github.com/quentin389/UserAgentInfo">UserAgentInfo</a> is a PHP class for parsing user agent strings (HTTP_USER_AGENT). Includes mobile checks, bot checks, browser types/versions and more.
Based on browscap, Mobile_Detect and ua-parser. Created for high traffic websites and fast batch processing. Made by <a href="https://github.com/quentin389">quentin389</a></p></td>
</tr>

<tr>
  <td>Craft CMS</td>
  <td><p><a href="https://github.com/lewisjenkins/craft-lj-mobiledetect">LJ Mobile Detect</a> is a simple implementation of Mobile Detect for Craft CMS. Made by <a href="https://github.com/lewisjenkins">Lewis Jenkins</a></p></td>
</tr>

</table>
