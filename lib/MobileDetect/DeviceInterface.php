<?php

namespace MobileDetect;

interface DeviceInterface
{
    public static function create(array $props = array());

    public function getType();

    public function getModel();

    public function getModelVersion();

    public function getOperatingSystem();

    public function getOperatingSystemVersion();

    public function getBrowser();

    public function getBrowserVersion();

    public function getUserAgent();

    public function isMobile();

    public function isDesktop();

    public function isTablet();

    public function isBot();

    public function toArray();

    public function getVersion($key);
}
