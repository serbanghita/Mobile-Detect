<?php
namespace MobileDetect\Repository\Browser;

use MobileDetect\Context;

class Browser
{
    protected $context;
    
    protected $vendor;
    protected $model;
    protected $triggersIsMobile = false;
    protected $matchType = 'regex';
    protected $identityMatches;
    protected $versionMatches;
    protected $versionHelper;

    public function setContext(Context $context)
    {
        $this->context = $context;
    }
    
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * @param string $matchType
     * @return Browser
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     * @return Browser
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Browser
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isTriggersIsMobile()
    {
        return $this->triggersIsMobile;
    }

    /**
     * @param boolean $triggersIsMobile
     * @return Browser
     */
    public function setTriggersIsMobile($triggersIsMobile)
    {
        $this->triggersIsMobile = $triggersIsMobile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentityMatches()
    {
        return $this->identityMatches;
    }

    /**
     * @param mixed $identityMatches
     * @return Browser
     */
    public function setIdentityMatches($identityMatches)
    {
        $this->identityMatches = $identityMatches;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersionMatches()
    {
        return $this->versionMatches;
    }

    /**
     * @param mixed $versionMatches
     * @return Browser
     */
    public function setVersionMatches($versionMatches)
    {
        $this->versionMatches = $versionMatches;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersionHelper()
    {
        return $this->versionHelper;
    }

    /**
     * @param mixed $versionHelper
     * @return Browser
     */
    public function setVersionHelper($versionHelper)
    {
        $this->versionHelper = $versionHelper;

        return $this;
    }
    
    
}