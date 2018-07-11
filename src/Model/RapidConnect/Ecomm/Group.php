<?php

namespace Omnipay\FirstData\Model\RapidConnect\Ecomm;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addEcommGroup(\SimpleXMLElement $data)
    {
        if ($this->getEcommTransactionIndicator() !== null) {
            if (!$this->validateEcommTransactionIndicator()) {
                throw new InvalidRequestException("Invalid ecomm transaction indicator");
            }
            $data->EcommGrp->EcommTxnInd = $this->getEcommTransactionIndicator();
        }
        if ($this->getCustomerServicePhoneNumber() !== null) {
            if (!$this->validateCustomerServicePhoneNumber()) {
                throw new InvalidRequestException("Invalid customer service phone number");
            }
            $data->EcommGrp->CustSvcPhoneNumber = $this->getCustomerServicePhoneNumber();
        }
        if ($this->getEcommURL() !== null) {
            if (!$this->validateEcommURL()) {
                throw new InvalidRequestException("Invalid ecomm url");
            }
            $data->EcommGrp->EcommURL = $this->getEcommURL();
        }
        if ($this->getMultipleClearingSequenceNumber() !== null) {
            if (!$this->validateMultipleClearingSequenceNumber()) {
                throw new InvalidRequestException("Invalid multiple clearing sequencenumber");
            }
            $data->EcommGrp->MCSN = $this->getMultipleClearingSequenceNumber();
        }
        if ($this->getMultipleClearingSequenceCount() !== null) {
            if (!$this->validateMultipleClearingSequenceCount()) {
                throw new InvalidRequestException("Invalid multiple clearing sequence count");
            }
            $data->EcommGrp->MCSC = $this->getMultipleClearingSequenceCount();
        }
    }

    /**
     * @return string
     */
    public function getEcommTransactionIndicator()
    {
        return $this->getParameter('EcommTransactionIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setEcommTransactionIndicator($value)
    {
        return $this->setParameter('EcommTransactionIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateEcommTransactionIndicator()
    {
        $value = $this->getParameter('EcommTransactionIndicator');
        $valid = array('01', '02', '03', '04', '05', '06', '07');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCustomerServicePhoneNumber()
    {
        return $this->getParameter('CustomerServicePhoneNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCustomerServicePhoneNumber($value)
    {
        return $this->setParameter('CustomerServicePhoneNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateCustomerServicePhoneNumber()
    {
        $value = $this->getParameter('CustomerServicePhoneNumber');
        if (!preg_match('/[0-9]{1,10}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getEcommURL()
    {
        return $this->getParameter('EcommURL');
    }


    /**
     * @param $value
     * @return string
     */
    public function setEcommURL($value)
    {
        return $this->setParameter('EcommURL', $value);
    }


    /**
     * @return bool
     */
    public function validateEcommURL()
    {
        $value = $this->getParameter('EcommURL');
        return strlen($value) >= 1 && strlen($value) <= 32;
    }


    /**
     * @return string
     */
    public function getMultipleClearingSequenceNumber()
    {
        return $this->getParameter('MultipleClearingSequenceNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMultipleClearingSequenceNumber($value)
    {
        return $this->setParameter('MultipleClearingSequenceNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateMultipleClearingSequenceNumber()
    {
        $value = $this->getParameter('MultipleClearingSequenceNumber');
        if (!preg_match('/[0123456789]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMultipleClearingSequenceCount()
    {
        return $this->getParameter('MultipleClearingSequenceCount');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMultipleClearingSequenceCount($value)
    {
        return $this->setParameter('MultipleClearingSequenceCount', $value);
    }


    /**
     * @return bool
     */
    public function validateMultipleClearingSequenceCount()
    {
        $value = $this->getParameter('MultipleClearingSequenceCount');
        if (!preg_match('/[0123456789]{2,2}/', $value)) {
            return false;
        }
        return true;
    }
}