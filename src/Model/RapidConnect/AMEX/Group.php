<?php

namespace Omnipay\FirstData\Model\RapidConnect\AMEX;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addAMEXGroup(\SimpleXMLElement $data)
    {
        if ($this->getAmExPOSData() !== null) {
            if (!$this->validateAmExPOSData()) {
                throw new InvalidRequestException("Invalid am ex pos data");
            }
            $data->AmexGrp->AmExPOSData = $this->getAmExPOSData();
        }
        if ($this->getAmExTranID() !== null) {
            if (!$this->validateAmExTranID()) {
                throw new InvalidRequestException("Invalid am ex tran id");
            }
            $data->AmexGrp->AmExTranID = $this->getAmExTranID();
        }
        if ($this->getGoodsSoldCode() !== null) {
            if (!$this->validateGoodsSoldCode()) {
                throw new InvalidRequestException("Invalid goods sold code");
            }
            $data->AmexGrp->GdSoldCd = $this->getGoodsSoldCode();
        }
        if ($this->getReAuthIndicator() !== null) {
            if (!$this->validateReAuthIndicator()) {
                throw new InvalidRequestException("Invalid reauth indicator");
            }
            $data->AmexGrp->ReAuthInd = $this->getReAuthIndicator();
        }
    }

    /**
     * @return string
     */
    public function getAmExPOSData()
    {
        return $this->getParameter('AmExPOSData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAmExPOSData(string $value)
    {
        return $this->setParameter('AmExPOSData', $value);
    }


    /**
     * @return bool
     */
    public function validateAmExPOSData()
    {
        $value = $this->getParameter('AmExPOSData');
        if (!preg_match('/[0-9A-Za-z]{12,12}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAmExTranID()
    {
        return $this->getParameter('AmExTranID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAmExTranID(string $value)
    {
        return $this->setParameter('AmExTranID', $value);
    }


    /**
     * @return bool
     */
    public function validateAmExTranID()
    {
        $value = $this->getParameter('AmExTranID');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }


    /**
     * @return string
     */
    public function getGoodsSoldCode()
    {
        return $this->getParameter('GoodsSoldCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setGoodsSoldCode(string $value)
    {
        return $this->setParameter('GoodsSoldCode', $value);
    }


    /**
     * @return bool
     */
    public function validateGoodsSoldCode()
    {
        $value = $this->getParameter('GoodsSoldCode');
        $valid = array('1000');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getReAuthIndicator()
    {
        return $this->getParameter('ReAuthIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReAuthIndicator(string $value)
    {
        return $this->setParameter('ReAuthIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateReAuthIndicator()
    {
        $value = $this->getParameter('ReAuthIndicator');
        $valid = array('Y');
        return in_array($value, $valid);
    }
}