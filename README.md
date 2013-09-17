<img src="http://demo.mobiledetect.net/logo-github.png">

> Motto: "Every business should have a mobile detection script to detect mobile readers."

<i>Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.</i>

You may consider this script as being part of the <b>RESS</b> (Responsive Web Design with Server-Side Component) movement. You can find out more on the topic by reading these articles: <a href="http://mobile.smashingmagazine.com/2013/04/09/improve-mobile-support-with-server-side-enhanced-responsive-design/">Improve Mobile Support With Server-Side-Enhanced Responsive Design</a> and <a href="http://www.lukew.com/ff/entry.asp?1392">RESS: Responsive Design + Server Side Components</a>. Related presentations: <a href="http://www.slideshare.net/pgodel/creating-mobile-apps-with-php-symfony2">Creating mobile apps with PHP &amp; Symfony2 (2013)</a>, <a href="http://www.w3.org/2013/Talks/responsive-design.pdf">Responsive Design (2013)</a>

##### How reliable is this script?

The script is as reliable as Server-Side detection can be. This is not a replacement for Responsive Web Design (media queries)
or other forms of Client-Side detection. Read W3C's Mobile Web Application Best Practices [Prefer Server-Side Detection Where Possible](http://www.w3.org/TR/mwabp/#bp-devcap-detection) section.
We're running [automated tests](./tests) to make sure the we don't break the detection every time we update it with new devices and also to avoid regex collisions.

The script is updated on <b>daily</b> and <b>weekly</b> basis, so make sure you keep following the updates!
Sometimes is hard to distinguish between a phone and a tablet, this is why we're constantly researching a lot of mobile vendors sites, checking product codes and new releases.

##### Download and demo

<a href="https://github.com/serbanghita/Mobile-Detect/tags">Latest releases</a>, <a href="https://github.com/serbanghita/Mobile-Detect/blob/devel/Mobile_Detect.php">Latest dev branch</a>, <a href="https://packagist.org/packages/mobiledetect/mobiledetectlib">composer package</a>

See also: <a href="https://github.com/serbanghita/Mobile-Detect/wiki/Become-a-contributor">:bulb: Become a contributor</a> / <a href="https://github.com/serbanghita/Mobile-Detect/wiki/History">:coffee: History</a> / <a href="https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples">:point_right: Code examples</a> /
<a href="http://is.gd/mobiletest">:iphone: Live demo!</a> (point your device browser to this URL)

##### Help

<a href="http://pledgie.com/campaigns/21856"><img alt='Click here to lend your support to: Research and development of Mobile Detect library!' src='http://www.pledgie.com/campaigns/21856.png?skin_name=chrome' border='0' /></a>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mobiledetectlib%40gmail%2ecom&lc=US&item_name=Mobile%20Detect&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0"></a>

I'm currently paying for hosting and spend a lot of my family time :family: to maintain the project and planning the future releases.
I would highly appreciate any money donations that will keep the research going.

Special thanks to the community :+1: for donations, [BrowserStack](http://browserstack.com) - for providing access to their great platform, [Zend](http://zend.com) - for donating licenses, [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

##### 3rd party modules / [Submit new](https://github.com/serbanghita/Mobile-Detect/issues/new?title=New%203rd%20party%20module&body=Name, Link and Description of the module.)

:point_right: The recommendation is that you keep Mobile_Detect.php class in a separate module and not include it in your script core because of the high frequency of updates.

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
    <td><p><a href="http://www.yagendoo.com/en/blog/free-mobile-detection-plugin-for-joomla.html">yagendoo Joomla! Mobile Detection Plugin</a> - Lightweight PHP plugin for Joomla! that detects a mobile browser using the Mobile Detect class. Made by <a href="http://www.yagendoo.com/">yagendoo media</a>.</p></td>
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
  <td>Zend Framework</td>
  <td><p><a href="https://github.com/neilime/zf2-mobile-detect.git">ZF2 Mobile-Detect</a> - Zend Framework 2 module that provides Mobile-Detect features (Mobile_Detect class as a service, helper for views and plugin controllers). Made by <a href="https://github.com/neilime">neilime</a></p></td>
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
  <td>mobile-detect.js</td>
  <td><p>A <a href="https://github.com/hgoebl/mobile-detect.js">JavaScript port</a> of Mobile-Detect class. Made by <a href="https://github.com/hgoebl">Heinrich Goebl</a></p></td>
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
<td>RexBrowscap</td>
<td><p><a href="https://github.com/jdlx/_rex_browscap">RexBrowscap</a> - Addon for Redaxo CMS - bundles phpbrowscap, mobile-detect and some client side funcs for detecting UA capabilities in one package. Made by <a href="https://github.com/jdlx">jdlx</a></p></td>
</tr>

<tr>
  <td>Craft CMS</td>
  <td><p><a href="https://github.com/lewisjenkins/craft-lj-mobiledetect">LJ Mobile Detect</a> is a simple implementation of Mobile Detect for Craft CMS. Made by <a href="https://github.com/lewisjenkins">Lewis Jenkins</a></p></td>
</tr>

</table>
