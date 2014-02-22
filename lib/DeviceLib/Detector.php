<?php

namespace DeviceLib;

class Detector {

    /**
     * For static invocations of this class, this holds a singleton for those methods.
     *
     * @var Detector
     */
    protected static $instance;

    /**
     * Generates or gets a singleton for use with teh simple API.
     *
     * @return Detector A single instance for using with the simple static API.
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    // boolean detection methods
    public static function isMobile()
    {
        $device = static::getInstance()->detect();
        return $device->isMobile();
    }

    public static function isTablet(){}
    // OR
    public static function __callStatic($method, $args){}

    // static getters for properties
    public static function getBrowser(){}

    // Better, more advanced API
    /**
     * Creates a device with all the necessary context to determine all the given
     * properties of a device, including OS, browser, and any other context-based properties.
     *
     * {@see Device}
     *
     * @return Device
     */
    public function detect(){}
}
