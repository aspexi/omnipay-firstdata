<?php

namespace Omnipay\FirstData\Model\RapidConnect\Common;

use Omnipay\Common\Helper;
use Omnipay\FirstData\Exception\RapidConnect\InvalidEntryModeException;
use Symfony\Component\HttpFoundation\ParameterBag;

class POSEntryMode
{
    use \Omnipay\FirstData\Model\RapidConnect\ParametersTrait;

    const UNSPECIFIED = '00';
    const MANUAL = '01';
    const VISA_CARD_ON_FILE = '10';
    const MAGNETICSTRIPE = '90';

    protected $validEntryModes = array(
        self::MAGNETICSTRIPE,
        self::MANUAL,
        self::UNSPECIFIED,
        self::VISA_CARD_ON_FILE,
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
     * @return POSEntryMode
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