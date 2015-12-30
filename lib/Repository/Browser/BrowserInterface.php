<?php
namespace MobileDetect\Repository\Browser;

interface BrowserInterface
{
    public function setFamily($family);
    public function getFamily();

    public function setIdentifier($identifier);
    public function getIdentifier();

    public function setVendor($vendor);
    public function getVendor();

    public function setModel($model);
    public function getModel();

    public function setVersion($version);
    public function getVersion();

    public function setMatchIdentity(array $matchIdentity);
    public function getMatchIdentity();
    
    public function setMatchVersion(array $matchVersion);
    public function getMatchVersion();
    
    public function setTriggers(array $triggers);
    public function getTriggers();
}