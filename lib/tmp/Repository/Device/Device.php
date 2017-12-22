<?php
namespace MobileDetect\Repository\Device;

class Device implements DeviceInterface
{
    protected $identifier;
    protected $vendor;
    protected $model;
    protected $matchType = 'regex';
    protected $matchIdentity;
    protected $matchModelAndVersion = [];

    public function reload(array $properties)
    {
        // Reset
        $this->identifier = null;
        $this->vendor = null;
        $this->model = null;
        $this->matchType = 'regex';
        $this->matchIdentity = null;
        $this->matchModelAndVersion = [];

        foreach ($properties as $key => $value) {
            if (isset($this->{$key})) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     * @return Tablet
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
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
     * @return Tablet
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
     * @return Tablet
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
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
     * @return Tablet
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatchIdentity()
    {
        return $this->matchIdentity;
    }

    /**
     * @param mixed $matchIdentity
     * @return Tablet
     */
    public function setMatchIdentity($matchIdentity)
    {
        $this->matchIdentity = $matchIdentity;
        return $this;
    }

    /**
     * @return array
     */
    public function getMatchModelAndVersion()
    {
        return $this->matchModelAndVersion;
    }

    /**
     * @param array $matchModelAndVersion
     * @return Tablet
     */
    public function setMatchModelAndVersion($matchModelAndVersion)
    {
        $this->matchModelAndVersion = $matchModelAndVersion;
        return $this;
    }


}