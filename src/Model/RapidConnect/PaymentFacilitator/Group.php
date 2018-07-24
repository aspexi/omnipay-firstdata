<?php

namespace Omnipay\FirstData\Model\RapidConnect\PaymentFacilitator;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addPaymentFacilitatorGroup(\SimpleXMLElement $data)
    {
        //Payment Facilitator Group
        if ($this->getPaymentFacilitatorIndicator() !== null) {
            if (!$this->validatePaymentFacilitatorIndicator()) {
                throw new InvalidRequestException("Invalid payment facilitator indicator");
            }
            $data->PFGrp->PFInd = $this->getPaymentFacilitatorIndicator();
        }
        if ($this->getSellerID() !== null) {
            if (!$this->validateSellerID()) {
                throw new InvalidRequestException("Invalid seller id");
            }
            $data->PFGrp->SellerID = $this->getSellerID();
        }
        if ($this->getSubMerchantID() !== null) {
            if (!$this->validateSubMerchantID()) {
                throw new InvalidRequestException("Invalid sub merchant id");
            }
            $data->PFGrp->SubMerchID = $this->getSubMerchantID();
        }
        if ($this->getPaymentFacilitatorPhoneNumber() !== null) {
            if (!$this->validatePaymentFacilitatorPhoneNumber()) {
                throw new InvalidRequestException("Invalid payment facilitator phonenumber");
            }
            $data->PFGrp->PFPhoneNumber = $this->getPaymentFacilitatorPhoneNumber();
        }
    }

    /**
     * @return string
     */
    public function getPaymentFacilitatorIndicator()
    {
        return $this->getParameter('PaymentFacilitatorIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPaymentFacilitatorIndicator(string $value)
    {
        return $this->setParameter('PaymentFacilitatorIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validatePaymentFacilitatorIndicator()
    {
        $value = $this->getParameter('PaymentFacilitatorIndicator');
        $valid = array('Y');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getSellerID()
    {
        return $this->getParameter('SellerID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setSellerID(string $value)
    {
        return $this->setParameter('SellerID', $value);
    }


    /**
     * @return bool
     */
    public function validateSellerID()
    {
        $value = $this->getParameter('SellerID');
        if (!preg_match('/[0-9A-Za-z]{1,20}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSubMerchantID()
    {
        return $this->getParameter('SubMerchantID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setSubMerchantID(string $value)
    {
        return $this->setParameter('SubMerchantID', $value);
    }


    /**
     * @return bool
     */
    public function validateSubMerchantID()
    {
        $value = $this->getParameter('SubMerchantID');
        if (!preg_match('/[0-9]{1,15}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPaymentFacilitatorPhoneNumber()
    {
        return $this->getParameter('PaymentFacilitatorPhoneNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPaymentFacilitatorPhoneNumber(string $value)
    {
        return $this->setParameter('PaymentFacilitatorPhoneNumber', $value);
    }


    /**
     * @return bool
     */
    public function validatePaymentFacilitatorPhoneNumber()
    {
        $value = $this->getParameter('PaymentFacilitatorPhoneNumber');
        if (!preg_match('/[0-9]{1,20}/',$value)) {
            return false;
        }
        return true;
    }
}