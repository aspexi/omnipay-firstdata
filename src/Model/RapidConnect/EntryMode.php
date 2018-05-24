<?php

namespace Omnipay\FirstData\Model\RapidConnect;

use Omnipay\Common\Helper;
use Omnipay\FirstData\Exception\RapidConnect\InvalidEntryModeException;
use Symfony\Component\HttpFoundation\ParameterBag;

class EntryMode
{
    const UNSPECIFIED = '00';
    const MANUAL = '01';
    const MAGNETICSTRIPE = '90';

    protected $validEntryModes = array(
        self::MAGNETICSTRIPE,
        self::MANUAL,
        self::UNSPECIFIED,
    );

    protected $parameters;

    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    public function __toString()
    {
        return $this->getEntryMode().$this->getPinCapability();
    }

    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * Get all parameters.
     *
     * @return array An associative array of parameters.
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return EntryMode provides a fluent interface.
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    public function validate()
    {
        foreach (array('entryMode', 'pinCapability') as $key) {
            if (!$this->getParameter($key )) {
                throw new InvalidEntryModeException("The $key parameter is required");
            }
        }

        if (!in_array($this->getEntryMode(), $this->validEntryModes))  {
            throw new InvalidEntryModeException("Invalid entry mode");
        }

        if (!PINAuthenticationCapability::IsValidPAC($this->getPinCapability())) {
            throw new InvalidEntryModeException("Invalid pin capability");
        }
    }

    /**
     * @return string
     */
    public function getEntryMode()
    {
        return $this->getParameter('entryMode');
    }

    /**
     * @param $value
     * @return EntryMode
     */
    public function setEntryMode($value)
    {
        return $this->setParameter('entryMode', $value);
    }

    /**
     * @return string
     */
    public function getPinCapability()
    {
        return $this->getParameter('pinCapability');
    }

    /**
     * @param $value
     */
    public function setPinCapability($value)
    {
        return $this->setParameter('pinCapability', $value);
    }
}