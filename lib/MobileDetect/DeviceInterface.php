<?php

namespace MobileDetect;

interface DeviceInterface
{
    /**
     * A factory definition.
     *
     * @param array $props An array of properties to create an instance.
     *
     * @return DeviceInterface
     */
    public static function create(array $props = array());

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
     * Retrieve the version for a particular property in the user agent.
     *
     * @param $key string The key to retrieve the version for.
     *
     * @return string|null A string if the version exists for the key.
     */
    public function getVersion($key);
}
