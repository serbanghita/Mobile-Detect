<?php
/**
 * Mobile Detect Library
 * Motto: "Every business should have a mobile detection script to detect mobile readers"
 *
 * Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
 * It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.
 *
 * Homepage: http://mobiledetect.net
 * GitHub: https://github.com/serbanghita/Mobile-Detect
 * README: https://github.com/serbanghita/Mobile-Detect/blob/master/README.md
 * CONTRIBUTING: https://github.com/serbanghita/Mobile-Detect/blob/master/docs/CONTRIBUTING.md
 * KNOWN LIMITATIONS: https://github.com/serbanghita/Mobile-Detect/blob/master/docs/KNOWN_LIMITATIONS.md
 * EXAMPLES: https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
 *
 * @license https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE
 * @author  Serban Ghita <serbanghita@gmail.com> (since 2012)
 * @author  Nick Ilyin <nick.ilyin@gmail.com>
 * @author: Victor Stanciu <vic.stanciu@gmail.com> (original author)
 *
 * @version 3.74.0
 */
namespace Detection;

use BadMethodCallException;

/**
 * Auto-generated isXXXX() magic methods.
 * php export/dump_magic_methods.php
 *
 * @method bool isiPhone()
 * @method bool isBlackBerry()
 * @method bool isPixel()
 * @method bool isHTC()
 * @method bool isNexus()
 * @method bool isDell()
 * @method bool isMotorola()
 * @method bool isSamsung()
 * @method bool isLG()
 * @method bool isSony()
 * @method bool isAsus()
 * @method bool isXiaomi()
 * @method bool isNokiaLumia()
 * @method bool isMicromax()
 * @method bool isPalm()
 * @method bool isVertu()
 * @method bool isPantech()
 * @method bool isFly()
 * @method bool isWiko()
 * @method bool isiMobile()
 * @method bool isSimValley()
 * @method bool isWolfgang()
 * @method bool isAlcatel()
 * @method bool isNintendo()
 * @method bool isAmoi()
 * @method bool isINQ()
 * @method bool isOnePlus()
 * @method bool isGenericPhone()
 * @method bool isiPad()
 * @method bool isNexusTablet()
 * @method bool isGoogleTablet()
 * @method bool isSamsungTablet()
 * @method bool isKindle()
 * @method bool isSurfaceTablet()
 * @method bool isHPTablet()
 * @method bool isAsusTablet()
 * @method bool isBlackBerryTablet()
 * @method bool isHTCtablet()
 * @method bool isMotorolaTablet()
 * @method bool isNookTablet()
 * @method bool isAcerTablet()
 * @method bool isToshibaTablet()
 * @method bool isLGTablet()
 * @method bool isFujitsuTablet()
 * @method bool isPrestigioTablet()
 * @method bool isLenovoTablet()
 * @method bool isDellTablet()
 * @method bool isYarvikTablet()
 * @method bool isMedionTablet()
 * @method bool isArnovaTablet()
 * @method bool isIntensoTablet()
 * @method bool isIRUTablet()
 * @method bool isMegafonTablet()
 * @method bool isEbodaTablet()
 * @method bool isAllViewTablet()
 * @method bool isArchosTablet()
 * @method bool isAinolTablet()
 * @method bool isNokiaLumiaTablet()
 * @method bool isSonyTablet()
 * @method bool isPhilipsTablet()
 * @method bool isCubeTablet()
 * @method bool isCobyTablet()
 * @method bool isMIDTablet()
 * @method bool isMSITablet()
 * @method bool isSMiTTablet()
 * @method bool isRockChipTablet()
 * @method bool isFlyTablet()
 * @method bool isbqTablet()
 * @method bool isHuaweiTablet()
 * @method bool isNecTablet()
 * @method bool isPantechTablet()
 * @method bool isBronchoTablet()
 * @method bool isVersusTablet()
 * @method bool isZyncTablet()
 * @method bool isPositivoTablet()
 * @method bool isNabiTablet()
 * @method bool isKoboTablet()
 * @method bool isDanewTablet()
 * @method bool isTexetTablet()
 * @method bool isPlaystationTablet()
 * @method bool isTrekstorTablet()
 * @method bool isPyleAudioTablet()
 * @method bool isAdvanTablet()
 * @method bool isDanyTechTablet()
 * @method bool isGalapadTablet()
 * @method bool isMicromaxTablet()
 * @method bool isKarbonnTablet()
 * @method bool isAllFineTablet()
 * @method bool isPROSCANTablet()
 * @method bool isYONESTablet()
 * @method bool isChangJiaTablet()
 * @method bool isGUTablet()
 * @method bool isPointOfViewTablet()
 * @method bool isOvermaxTablet()
 * @method bool isHCLTablet()
 * @method bool isDPSTablet()
 * @method bool isVistureTablet()
 * @method bool isCrestaTablet()
 * @method bool isMediatekTablet()
 * @method bool isConcordeTablet()
 * @method bool isGoCleverTablet()
 * @method bool isModecomTablet()
 * @method bool isVoninoTablet()
 * @method bool isECSTablet()
 * @method bool isStorexTablet()
 * @method bool isVodafoneTablet()
 * @method bool isEssentielBTablet()
 * @method bool isRossMoorTablet()
 * @method bool isiMobileTablet()
 * @method bool isTolinoTablet()
 * @method bool isAudioSonicTablet()
 * @method bool isAMPETablet()
 * @method bool isSkkTablet()
 * @method bool isTecnoTablet()
 * @method bool isJXDTablet()
 * @method bool isiJoyTablet()
 * @method bool isFX2Tablet()
 * @method bool isXoroTablet()
 * @method bool isViewsonicTablet()
 * @method bool isVerizonTablet()
 * @method bool isOdysTablet()
 * @method bool isCaptivaTablet()
 * @method bool isIconbitTablet()
 * @method bool isTeclastTablet()
 * @method bool isOndaTablet()
 * @method bool isJaytechTablet()
 * @method bool isBlaupunktTablet()
 * @method bool isDigmaTablet()
 * @method bool isEvolioTablet()
 * @method bool isLavaTablet()
 * @method bool isAocTablet()
 * @method bool isMpmanTablet()
 * @method bool isCelkonTablet()
 * @method bool isWolderTablet()
 * @method bool isMediacomTablet()
 * @method bool isMiTablet()
 * @method bool isNibiruTablet()
 * @method bool isNexoTablet()
 * @method bool isLeaderTablet()
 * @method bool isUbislateTablet()
 * @method bool isPocketBookTablet()
 * @method bool isKocasoTablet()
 * @method bool isHisenseTablet()
 * @method bool isHudl()
 * @method bool isTelstraTablet()
 * @method bool isGenericTablet()
 * @method bool isAndroidOS()
 * @method bool isBlackBerryOS()
 * @method bool isPalmOS()
 * @method bool isSymbianOS()
 * @method bool isWindowsMobileOS()
 * @method bool isWindowsPhoneOS()
 * @method bool isiOS()
 * @method bool isiPadOS()
 * @method bool isSailfishOS()
 * @method bool isMeeGoOS()
 * @method bool isMaemoOS()
 * @method bool isJavaOS()
 * @method bool iswebOS()
 * @method bool isbadaOS()
 * @method bool isBREWOS()
 * @method bool isChrome()
 * @method bool isDolfin()
 * @method bool isOpera()
 * @method bool isSkyfire()
 * @method bool isEdge()
 * @method bool isIE()
 * @method bool isFirefox()
 * @method bool isBolt()
 * @method bool isTeaShark()
 * @method bool isBlazer()
 * @method bool isSafari()
 * @method bool isWeChat()
 * @method bool isUCBrowser()
 * @method bool isbaiduboxapp()
 * @method bool isbaidubrowser()
 * @method bool isDiigoBrowser()
 * @method bool isMercury()
 * @method bool isObigoBrowser()
 * @method bool isNetFront()
 * @method bool isGenericBrowser()
 * @method bool isPaleMoon()
 * @method bool isWebKit()
 * @method bool isConsole()
 * @method bool isWatch()
 */
interface MobileDetectInterface
{
    /**
     * Get the current script version.
     * This is useful for the demo.php file,
     * so people can check on what version they are testing
     * for mobile devices.
     *
     * @return string The version number in semantic version format.
     */
    public static function getScriptVersion(): string;

    /**
     * Set the HTTP Headers. Must be PHP-flavored. This method will reset existing headers.
     *
     * @param array|null $httpHeaders The headers to set. If null, then using PHP's _SERVER to extract
     *                           the headers. The default null is left for backwards compatibility.
     */
    public function setHttpHeaders(array $httpHeaders = null);

    /**
     * Retrieves the HTTP headers.
     *
     * @return array
     */
    public function getHttpHeaders(): array;

    /**
     * Retrieves a particular header. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * @param string $header The name of the header to retrieve. Can be HTTP compliant such as
     *                       "User-Agent" or "X-Device-User-Agent" or can be php-esque with the
     *                       all-caps, HTTP_ prefixed, underscore separated awesomeness.
     *
     * @return string|null The value of the header.
     */
    public function getHttpHeader(string $header): ?string;

    public function getMobileHeaders(): array;

    /**
     * Get all possible HTTP headers that
     * can contain the User-Agent string.
     *
     * @return array List of HTTP headers.
     */
    public function getUaHttpHeaders(): array;

    /**
     * Set CloudFront headers
     * http://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/header-caching.html#header-caching-web-device
     *
     * @param array|null $cfHeaders List of HTTP headers
     *
     * @return bool If there were CloudFront headers to be set
     */
    public function setCfHeaders(array $cfHeaders = null): bool;

    /**
     * Retrieves the cloudfront headers.
     *
     * @return array
     */
    public function getCfHeaders(): array;

    /**
     * Set the User-Agent to be used.
     *
     * @param string|null $userAgent The user agent string to set.
     *
     * @return string|null
     */
    public function setUserAgent(string $userAgent = null): ?string;

    /**
     * Retrieve the User-Agent.
     *
     * @return string|null The user agent if it's set.
     */
    public function getUserAgent(): ?string;

    public function getMatchingRegex(): ?string;

    public function getMatchesArray(): ?array;

    /**
     * Retrieve the list of known phone devices.
     *
     * @return array List of phone devices.
     */
    public static function getPhoneDevices(): array;

    /**
     * Retrieve the list of known tablet devices.
     *
     * @return array List of tablet devices.
     */
    public static function getTabletDevices(): array;

    /**
     * Alias for getBrowsers() method.
     *
     * @return array List of user agents.
     */
    public static function getUserAgents(): array;

    /**
     * Retrieve the list of known browsers. Specifically, the user agents.
     *
     * @return array List of browsers / user agents.
     */
    public static function getBrowsers(): array;

    /**
     * Method gets the mobile detection rules. This method is used for the magic methods $detect->is*().
     * Retrieve the current set of rules.
     *
     * @return array
     */
    public function getRules(): array;

    /**
     * Retrieve the list of mobile operating systems.
     *
     * @return array The list of mobile operating systems.
     */
    public static function getOperatingSystems(): array;

    /**
     * Check the HTTP headers for signs of mobile.
     * This is the fastest mobile check possible; it's used
     * inside isMobile() method.
     *
     * @return bool
     */
    public function checkHttpHeadersForMobile(): bool;

    /**
     * Magic overloading method.
     *
     * @method boolean is[...]()
     * @param string $name
     * @param array $arguments
     * @return bool
     * @throws BadMethodCallException when the method doesn't exist and doesn't start with 'is'
     */
    public function __call(string $name, array $arguments);

    /**
     * Check if the device is mobile.
     * Returns true if any type of mobile device detected, including special ones
     * @param string|null $userAgent  deprecated
     * @param array|null $httpHeaders deprecated
     * @return bool
     */
    public function isMobile(string $userAgent = null, array $httpHeaders = null): bool;

    /**
     * Check if the device is a tablet.
     * Return true if any type of tablet device is detected.
     *
     * @param string|null $userAgent   deprecated
     * @param array|null $httpHeaders deprecated
     * @return bool
     */
    public function isTablet(string $userAgent = null, array $httpHeaders = null): bool;

    /**
     * This method checks for a certain property in the
     * userAgent.
     * @param  string        $key
     * @param string|null $userAgent   deprecated
     * @param array|null $httpHeaders deprecated
     * @return bool
     *
     * @todo: The httpHeaders part is not yet used.
     */
    public function is(string $key, string $userAgent = null, array $httpHeaders = null): bool;

    /**
     * Some detection rules are relative (not standard),
     * because of the diversity of devices, vendors and
     * their conventions in representing the User-Agent or
     * the HTTP headers.
     *
     * This method will be used to check custom regexes against
     * the User-Agent string.
     *
     * @param string $regex
     * @param string|null $userAgent
     * @return bool
     *
     * @todo: search in the HTTP headers too.
     */
    public function match(string $regex, string $userAgent = null): bool;

    /**
     * Get the properties array.
     *
     * @return array
     */
    public static function getProperties(): array;

    /**
     * Prepare the version number.
     *
     * @param string $ver The string version, like "2.6.21.2152";
     *
     * @return float
     *
     * @todo Remove the error suppression from str_replace() call.
     */
    public function prepareVersionNo(string $ver): float;

    /**
     * Check the version of the given property in the User-Agent.
     * Will return a float number. (e.g. 2_0 will return 2.0, 4.3.1 will return 4.31)
     *
     * @param string $propertyName The name of the property. See self::getProperties() array
     *                             keys for all possible properties.
     * @param string $type         Either self::VERSION_TYPE_STRING to get a string value or
     *                             self::VERSION_TYPE_FLOAT indicating a float value. This parameter
     *                             is optional and defaults to self::VERSION_TYPE_STRING. Passing an
     *                             invalid parameter will default to the type as well.
     *
     * @return string|float|false The version of the property we are trying to extract.
     */
    public function version(string $propertyName, string $type = MobileDetect::VERSION_TYPE_STRING);
}
