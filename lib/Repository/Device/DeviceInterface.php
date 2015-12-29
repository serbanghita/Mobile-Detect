<?php
namespace MobileDetect\Repository\Device;

interface DeviceInterface
{
    public function getMatchType();
    public function getIdentifier();
    public function getVendor();
    public function getModel();
    public function getMatchIdentity();
    public function getMatchModelAndVersion();
}