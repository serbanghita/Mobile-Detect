<?php
namespace MobileDetect\Repository\OperatingSystem;

class OperatingSystem
{
    protected $vendor = null;
    protected $model = null;
    protected $matchIdentity = [];
    protected $matchVersion = [];
    protected $triggers = [];

    public function reload(array $properties)
    {
        // Reset.
        $this->vendor = null;
        $this->model = null;
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
     * @return null
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param null $vendor
     * @return OperatingSystem
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param null $model
     * @return OperatingSystem
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
     * @return OperatingSystem
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
     * @return OperatingSystem
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
     * @return OperatingSystem
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;

        return $this;
    }
}