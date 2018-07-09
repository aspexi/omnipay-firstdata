<?php

namespace Omnipay\FirstData\Model\RapidConnect\CustomerInfo;

use Omnipay\Common\CreditCard;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addCustomerInfoGroup(\SimpleXMLElement $data)
    {
        if ($this->getAVSBillingAddress() !== null) {
            if (!$this->validateAVSBillingAddress()) {
                throw new InvalidRequestException("Invalid AVS billing address");
            }
            $data->CustInfoGrp->AVSBillingAddr = $this->getAVSBillingAddress();
        }
        if ($this->getAVSBillingPostalCode() !== null) {
            if (!$this->validateAVSBillingPostalCode()) {
                throw new InvalidRequestException("Invalid AVS billing postal code");
            }
            $data->CustInfoGrp->AVSBillingPostalCode = $this->getAVSBillingPostalCode();
        }
        if ($this->getCardHolderFirstName() !== null) {
            if (!$this->validateCardHolderFirstName()) {
                throw new InvalidRequestException("Invalid card holder first name");
            }
            $data->CustInfoGrp->CHFirstNm = $this->getCardHolderFirstName();
        }
        if ($this->getCardHolderLastName() !== null) {
            if (!$this->validateCardHolderLastName()) {
                throw new InvalidRequestException("Invalid card holder last name");
            }
            $data->CustInfoGrp->CHLastNm = $this->getCardHolderLastName();
        }
        if ($this->getCardHolderFullNameResult() !== null) {
            if (!$this->validateCardHolderFullNameResult()) {
                throw new InvalidRequestException("Invalid card holder full name result");
            }
            $data->CustInfoGrp->CHFullNmRes = $this->getCardHolderFullNameResult();
        }
    }

    /**
     * @return string
     */
    public function getAVSBillingAddress()
    {
        return $this->getParameter('AVSBillingAddress');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAVSBillingAddress(string $value)
    {
        return $this->setParameter('AVSBillingAddress', $value);
    }


    /**
     * @return bool
     */
    public function validateAVSBillingAddress()
    {
        $value = $this->getParameter('AVSBillingAddress');
        return strlen($value) >= 1 && strlen($value) <= 30;
    }


    /**
     * @return string
     */
    public function getAVSBillingPostalCode()
    {
        return $this->getParameter('AVSBillingPostalCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAVSBillingPostalCode(string $value)
    {
        return $this->setParameter('AVSBillingPostalCode', $value);
    }


    /**
     * @return bool
     */
    public function validateAVSBillingPostalCode()
    {
        $value = $this->getParameter('AVSBillingPostalCode');
        if (!preg_match('/[0-9A-Z a-z]{1,10}/', $value)) {
            return false;
        }
        return true;
    }


    public function getCard()
    {
        return $this->getParameter('card');
    }


    public function setCard($value)
    {
        if ($value && !$value instanceof CreditCard) {
            $value = new CreditCard($value);
        }

        $billingAddress = "";
        if ($value->getBillingAddress1()) {
            $billingAddress .= $value->getBillingAddress1();
        }

        if ($value->getBillingAddress2()) {
            if (!empty($billingAddress)) {
                $billingAddress .= "\n"; // add newline
            }
            $billingAddress .= $value->getBillingAddress2();
        }

        if (!empty($billingAddress)) {
            $this->setAVSBillingAddress($billingAddress);
        }

        if ($value->getBillingPostcode()) {
            $this->setAVSBillingPostalCode($value->getBillingPostcode());
        }

        return $this->setParameter('card', $value);
    }


    /**
     * @return string
     */
    public function getCardHolderFirstName()
    {
        return $this->getParameter('CardHolderFirstName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardHolderFirstName(string $value)
    {
        return $this->setParameter('CardHolderFirstName', $value);
    }


    /**
     * @return bool
     */
    public function validateCardHolderFirstName()
    {
        $value = $this->getParameter('CardHolderFirstName');
        return strlen($value) >= 1 && strlen($value) <= 35;
    }


    /**
     * @return string
     */
    public function getCardHolderLastName()
    {
        return $this->getParameter('CardHolderLastName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardHolderLastName(string $value)
    {
        return $this->setParameter('CardHolderLastName', $value);
    }


    /**
     * @return bool
     */
    public function validateCardHolderLastName()
    {
        $value = $this->getParameter('CardHolderLastName');
        return strlen($value) >= 1 && strlen($value) <= 35;
    }


    /**
     * @return string
     */
    public function getCardHolderFullNameResult()
    {
        return $this->getParameter('CardHolderFullNameResult');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardHolderFullNameResult(string $value)
    {
        return $this->setParameter('CardHolderFullNameResult', $value);
    }


    /**
     * @return bool
     */
    public function validateCardHolderFullNameResult()
    {
        $value = $this->getParameter('CardHolderFullNameResult');
        $valid = array('M', 'F', 'L', 'N', 'W', 'U', 'P', 'K', 'B');
        return in_array($value, $valid);
    }
}