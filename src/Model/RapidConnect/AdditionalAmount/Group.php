<?php

namespace Omnipay\FirstData\Model\RapidConnect\AdditionalAmount;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{

    public function addAdditionalAmountGroup(\SimpleXMLElement $data)
    {
        if ($this->getAdditionalAmount() !== null) {
            if (!$this->validateAdditionalAmount()) {
                throw new InvalidRequestException("Invalid additional amount");
            }
            $data->AddAmt = $this->getAdditionalAmount();
        }
        if ($this->getAdditionalAmountCurrency() !== null) {
            if (!$this->validateAdditionalAmountCurrency()) {
                throw new InvalidRequestException("Invalid additional amount currency");
            }
            $data->AddAmtCrncy = $this->getAdditionalAmountCurrency();
        }
        if ($this->getAdditionalAmountType() !== null) {
            if (!$this->validateAdditionalAmountType()) {
                throw new InvalidRequestException("Invalid additional amount type");
            }
            $data->AddAmtType = $this->getAdditionalAmountType();
        }
        if ($this->getAdditionalAmountAccountType() !== null) {
            if (!$this->validateAdditionalAmountAccountType()) {
                throw new InvalidRequestException("Invalid additional amount account type");
            }
            $data->AddAmtAcctType = $this->getAdditionalAmountAccountType();
        }
        if ($this->getPartialAuthorizationApprovalCapability() !== null) {
            if (!$this->validatePartialAuthorizationApprovalCapability()) {
                throw new InvalidRequestException("Invalid partial authorization approvalcapability");
            }
            $data->PartAuthrztnApprvlCapablt = $this->getPartialAuthorizationApprovalCapability();
        }
    }

    /**
     * @return string
     */
    public function getAdditionalAmount()
    {
        return $this->getParameter('AdditionalAmount');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmount(string $value)
    {
        return $this->setParameter('AdditionalAmount', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmount()
    {
        $value = $this->getParameter('AdditionalAmount');
        if (!preg_match('/[\-]{0,1}[0123456789]{1,12}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAdditionalAmountCurrency()
    {
        return $this->getParameter('AdditionalAmountCurrency');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmountCurrency(string $value)
    {
        return $this->setParameter('AdditionalAmountCurrency', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmountCurrency()
    {
        $value = $this->getParameter('AdditionalAmountCurrency');
        if (!preg_match('/[0-9]{3,3}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAdditionalAmountType()
    {
        return $this->getParameter('AdditionalAmountType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmountType(string $value)
    {
        return $this->setParameter('AdditionalAmountType', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmountType()
    {
        $value = $this->getParameter('AdditionalAmountType');
        $valid = array('Cashback', 'Surchrg', 'Hltcare', 'Transit', 'RX', 'Vision', 'Clinical', 'Dental', 'Copay', 'FirstAuthAmt', 'PreAuthAmt', 'TotalAuthAmt', 'Tax', 'Fee', 'BegBal', 'EndingBal', 'AvailBal', 'LedgerBal', 'HoldBal', 'OrigReqAmt', 'OpenToBuy', 'Fuel', 'Service', 'eWICDiscount');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getAdditionalAmountAccountType()
    {
        return $this->getParameter('AdditionalAmountAccountType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmountAccountType(string $value)
    {
        return $this->setParameter('AdditionalAmountAccountType', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmountAccountType()
    {
        $value = $this->getParameter('AdditionalAmountAccountType');
        if (!preg_match('/[0-9A-Za-z]{1,15}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPartialAuthorizationApprovalCapability()
    {
        return $this->getParameter('PartialAuthorizationApprovalCapability');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPartialAuthorizationApprovalCapability(string $value)
    {
        return $this->setParameter('PartialAuthorizationApprovalCapability', $value);
    }


    /**
     * @return bool
     */
    public function validatePartialAuthorizationApprovalCapability()
    {
        $value = $this->getParameter('PartialAuthorizationApprovalCapability');
        $valid = array('0', '1');
        return in_array($value, $valid);
    }
}