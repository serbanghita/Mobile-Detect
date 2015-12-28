<?php
namespace MobileDetect\Repository;

interface DeviceResultInterface
{
    public function getMatchType();
    public function getIdentifier();
    public function getVendor();
    public function getIdentityMatches();
    public function getModelMatches();
}