<?php
namespace MobileDetect\Repository\Phone;

use MobileDetect\Repository\DeviceResultInterface;

class Phone implements DeviceResultInterface
{
    protected $identifier;
    protected $vendor;
    protected $matchType = 'regex';
    protected $identityMatches;
    protected $modelMatches = [];

    public function reload(array $properties)
    {
        // Reset
        $this->identifier = null;
        $this->vendor = null;
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
     * @return string
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * @param string $matchType
     * @return Phone
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
        return $this;
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
     * @return Phone
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
     * @return Phone
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
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
     * @return Phone
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
     * @return Phone
     */
    public function setModelMatches($modelMatches)
    {
        $this->modelMatches = $modelMatches;
        return $this;
    }


}