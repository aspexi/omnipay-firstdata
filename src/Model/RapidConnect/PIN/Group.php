<?php

namespace Omnipay\FirstData\Model\RapidConnect\PIN;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addPINGroup(\SimpleXMLElement $data)
    {
        if ($this->getPINData() !== null) {
            if (!$this->validatePINData()) {
                throw new InvalidRequestException("Invalid pin data");
            }
            $data->PINGrp->PINData = $this->getPINData();
        }
        if ($this->getKeySerialNumberData() !== null) {
            if (!$this->validateKeySerialNumberData()) {
                throw new InvalidRequestException("Invalid key serial number data");
            }
            $data->PINGrp->KeySerialNumData = $this->getKeySerialNumberData();
        }
    }

    /**
     * @return string
     */
    public function getPINData()
    {
        return $this->getParameter('PINData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPINData(string $value)
    {
        return $this->setParameter('PINData', $value);
    }


    /**
     * @return bool
     */
    public function validatePINData()
    {
        $value = $this->getParameter('PINData');
        if (!preg_match('/[0-9A-F]{16,16}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getKeySerialNumberData()
    {
        return $this->getParameter('KeySerialNumberData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setKeySerialNumberData(string $value)
    {
        return $this->setParameter('KeySerialNumberData', $value);
    }


    /**
     * @return bool
     */
    public function validateKeySerialNumberData()
    {
        $value = $this->getParameter('KeySerialNumberData');
        if (!preg_match('/[0-9A-Za-z]{20,20}/', $value)) {
            return false;
        }
        return true;
    }
}