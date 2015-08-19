<?php
namespace MobileDetect\Device;

interface DeviceInterface
{
    /**
     * Retrieves the type of device. See the Type class for possible values.
     *
     * @return int One of the Type constants.
     */
    public function getType();

    /**
     * Retrieve the model.
     *
     * @return string The model.
     */
    public function getModel();

    /**
     * Retrieve the model version.
     *
     * @return string The model version.
     */
    public function getModelVersion();

    /**
     * Retrieve the operating system.
     *
     * @return string The operating system.
     */
    public function getOperatingSystem();

    /**
     * Retrieve the operating system version.
     *
     * @return string The operating system version.
     */
    public function getOperatingSystemVersion();

    /**
     * Retrieve the browser.
     *
     * @return string The browser.
     */
    public function getBrowser();

    /**
     * Retrieve the browser version.
     *
     * @return string The browser version.
     */
    public function getBrowserVersion();

    /**
     * Retrieve the user agent.
     *
     * @return string The user agent.
     */
    public function getUserAgent();

    /**
     * Check if this is a mobile device.
     *
     * @return bool True if mobile device.
     */
    public function isMobile();

    /**
     * Check if this is a desktop device.
     *
     * @return bool True if desktop device.
     */
    public function isDesktop();

    /**
     * Check if this is a tablet device.
     *
     * @return bool True if tablet device.
     */
    public function isTablet();

    /**
     * Check if this is a bot
     *
     * @return bool True if this is a bot.
     */
    public function isBot();

    /**
     * Retrieve a hash of all the properties for this device.
     *
     * @return array A hash of properties.
     */
    public function toArray();

    /**
     * Factory method to create a Device instance.
     * 
     * @param array $prop
     * @return mixed
     */
    public static function create(array $prop);
}