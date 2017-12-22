<?php
namespace MobileDetect\Repository\Device;

use MobileDetect\Device\DeviceType;
use MobileDetect\Matcher\Matcher;

interface DeviceInterface
{
    public function setType($type = DeviceType::DESKTOP);
    public function getType();
    
    public function setMatchType($matchType = Matcher::MATCH_REGEX);
    public function getMatchType();
    
    public function setIdentifier($identifier);
    public function getIdentifier();
    
    public function setVendor($vendor);
    public function getVendor();
    
    public function setModel($model);
    public function getModel();
    
    public function setVersion($version);
    public function getVersion();
    
    public function setMatchIdentity($matchIdentity);
    public function getMatchIdentity();
    
    public function setMatchModelAndVersion($matchModelAndVersion);
    public function getMatchModelAndVersion();

    public function setTriggers(array $triggers);
    public function getTriggers();
}