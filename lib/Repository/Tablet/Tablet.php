<?php
namespace MobileDetect\Repository\Tablet;

use MobileDetect\Repository\DeviceResultInterface;

class Tablet implements DeviceResultInterface
{
    protected $identifier;
    protected $vendor;
    protected $model;
    protected $matchType = 'regex';
    protected $identityMatches;
    protected $modelMatches = [];

    public function reload(array $properties)
    {
        // Reset
        $this->identifier = null;
        $this->vendor = null;
        $this->model = null;
        $this->matchType = 'regex';
        $this->identityMatches = null;
        $this->modelMatches = [];

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
    public function getIdentityMatches()
    {
        return $this->identityMatches;
    }

    /**
     * @param mixed $identityMatches
     * @return Tablet
     */
    public function setIdentityMatches($identityMatches)
    {
        $this->identityMatches = $identityMatches;
        return $this;
    }

    /**
     * @return array
     */
    public function getModelMatches()
    {
        return $this->modelMatches;
    }

    /**
     * @param array $modelMatches
     * @return Tablet
     */
    public function setModelMatches($modelMatches)
    {
        $this->modelMatches = $modelMatches;
        return $this;
    }


}