<?php
namespace MobileDetect\Repository\Browser;

use MobileDetect\Matcher;
use MobileDetect\MobileDetect;

class Browser
{
    protected $vendor;
    protected $model;
    protected $matchIdentity = [];
    protected $matchVersion = [];
    protected $triggers = [];

    public function reload(array $properties)
    {
        // Reset
        $this->vendor = null;
        $this->model;
        $this->matchIdentity = [];
        $this->matchVersion = [];
        $this->triggers = [];

        // Populate.
        foreach ($properties as $key => $value) {
            if (isset($this->{$key})) {
                $this->{$key} = $value;
            }
        }
        
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
     * @return array
     */
    public function getMatchIdentity()
    {
        return $this->matchIdentity;
    }

    /**
     * @param array $matchIdentity
     * @return Browser
     */
    public function setMatchIdentity($matchIdentity)
    {
        $this->matchIdentity = $matchIdentity;

        return $this;
    }

    /**
     * @return array
     */
    public function getMatchVersion()
    {
        return $this->matchVersion;
    }

    /**
     * @param array $matchVersion
     * @return Browser
     */
    public function setMatchVersion($matchVersion)
    {
        $this->matchVersion = $matchVersion;

        return $this;
    }

    /**
     * @return array
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * @param array $triggers
     * @return Browser
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;

        return $this;
    }
}