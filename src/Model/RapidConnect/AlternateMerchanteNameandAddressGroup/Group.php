<?php

namespace Omnipay\FirstData\Model\RapidConnect\AlternateMerchantNameandAddressGroup;

class Group
{
    use \Omnipay\FirstData\Model\RapidConnect\ParametersTrait;

    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    public function addAlternateMerchantNameandAddressGroup(\SimpleXMLElement $data)
    {
        if ($this->getMerchantName() !== null) {
            if (!$this->validateMerchantName()) {
                throw new InvalidRequestException("Invalid merchant name");
            }
            $data->AltMerchNameAndAddrGrp->MerchName = $this->getMerchantName();
        }
        if ($this->getMerchantAddress() !== null) {
            if (!$this->validateMerchantAddress()) {
                throw new InvalidRequestException("Invalid merchant address");
            }
            $data->AltMerchNameAndAddrGrp->MerchAddr = $this->getMerchantAddress();
        }
        if ($this->getMerchantCity() !== null) {
            if (!$this->validateMerchantCity()) {
                throw new InvalidRequestException("Invalid merchant city");
            }
            $data->AltMerchNameAndAddrGrp->MerchCity = $this->getMerchantCity();
        }
        if ($this->getMerchantState() !== null) {
            if (!$this->validateMerchantState()) {
                throw new InvalidRequestException("Invalid merchant state");
            }
            $data->AltMerchNameAndAddrGrp->MerchState = $this->getMerchantState();
        }
        if ($this->getMerchantCounty() !== null) {
            if (!$this->validateMerchantCounty()) {
                throw new InvalidRequestException("Invalid merchant county");
            }
            $data->AltMerchNameAndAddrGrp->MerchCnty = $this->getMerchantCounty();
        }
        if ($this->getMerchantPostalCode() !== null) {
            if (!$this->validateMerchantPostalCode()) {
                throw new InvalidRequestException("Invalid merchant postal code");
            }
            $data->AltMerchNameAndAddrGrp->MerchPostalCode = $this->getMerchantPostalCode();
        }
        if ($this->getMerchantCountry() !== null) {
            if (!$this->validateMerchantCountry()) {
                throw new InvalidRequestException("Invalid merchant country");
            }
            $data->AltMerchNameAndAddrGrp->MerchCtry = $this->getMerchantCountry();
        }
        if ($this->getMerchantEmailAddress() !== null) {
            if (!$this->validateMerchantEmailAddress()) {
                throw new InvalidRequestException("Invalid merchant email address");
            }
            $data->AltMerchNameAndAddrGrp->MerchEmail = $this->getMerchantEmailAddress();
        }
    }

    /**
     * @return string
     */
    public function getMerchantName()
    {
        return $this->getParameter('MerchantName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantName(string $value)
    {
        return $this->setParameter('MerchantName', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantName()
    {
        $value = $this->getParameter('MerchantName');
        return strlen($value) >= 1 && strlen($value) <= 38;
    }


    /**
     * @return string
     */
    public function getMerchantAddress()
    {
        return $this->getParameter('MerchantAddress');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantAddress(string $value)
    {
        return $this->setParameter('MerchantAddress', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantAddress()
    {
        $value = $this->getParameter('MerchantAddress');
        return strlen($value) >= 1 && strlen($value) <= 30;
    }


    /**
     * @return string
     */
    public function getMerchantCity()
    {
        return $this->getParameter('MerchantCity');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCity(string $value)
    {
        return $this->setParameter('MerchantCity', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCity()
    {
        $value = $this->getParameter('MerchantCity');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }


    /**
     * @return string
     */
    public function getMerchantState()
    {
        return $this->getParameter('MerchantState');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantState(string $value)
    {
        return $this->setParameter('MerchantState', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantState()
    {
        $value = $this->getParameter('MerchantState');
        if (!preg_match('/[0-9A-Za-z]{2,2}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantCounty()
    {
        return $this->getParameter('MerchantCounty');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCounty(string $value)
    {
        return $this->setParameter('MerchantCounty', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCounty()
    {
        $value = $this->getParameter('MerchantCounty');
        if (!preg_match('/[0-9A-Za-z]{3,3}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantPostalCode()
    {
        return $this->getParameter('MerchantPostalCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantPostalCode(string $value)
    {
        return $this->setParameter('MerchantPostalCode', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantPostalCode()
    {
        $value = $this->getParameter('MerchantPostalCode');
        if (!preg_match('/[0-9A-Z a-z]{1,9}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantCountry()
    {
        return $this->getParameter('MerchantCountry');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCountry(string $value)
    {
        return $this->setParameter('MerchantCountry', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCountry()
    {
        $value = $this->getParameter('MerchantCountry');
        if (!preg_match('/[0-9]{3,3}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantEmailAddress()
    {
        return $this->getParameter('MerchantEmailAddress');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantEmailAddress(string $value)
    {
        return $this->setParameter('MerchantEmailAddress', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantEmailAddress()
    {
        $value = $this->getParameter('MerchantEmailAddress');
        return strlen($value) >= 1 && strlen($value) <= 40;
    }
}