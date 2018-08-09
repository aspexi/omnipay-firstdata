<?php

namespace Omnipay\FirstData\Model\RapidConnect\Mastercard;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addMastercardGroup(\SimpleXMLElement $data)
    {
        if ($this->getBankNetData() !== null) {
            if (!$this->validateBankNetData()) {
                throw new InvalidRequestException("Invalid banknet data");
            }
            $data->MCGrp->BanknetData = $this->getBankNetData();
        }
        if ($this->getMarketSpecificDataIndicator() !== null) {
            if (!$this->validateMarketSpecificDataIndicator()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->MCGrp->MCMSDI = $this->getMarketSpecificDataIndicator();
        }
        if ($this->getCCVErrorCode() !== null) {
            if (!$this->validateCCVErrorCode()) {
                throw new InvalidRequestException("Invalid ccv error code");
            }
            $data->MCGrp->CCVErrorCode = $this->getCCVErrorCode();
        }
        if ($this->getPOSEntryModeChange() !== null) {
            if (!$this->validatePOSEntryModeChange()) {
                throw new InvalidRequestException("Invalid pos entry mode change");
            }
            $data->MCGrp->POSEntryModeChg = $this->getPOSEntryModeChange();
        }
        if ($this->getTransactionEditErrorCode() !== null) {
            if (!$this->validateTransactionEditErrorCode()) {
                throw new InvalidRequestException("Invalid transaction edit error code");
            }
            $data->MCGrp->TranEditErrCode = $this->getTransactionEditErrorCode();
        }
        if ($this->getMastercardPOSData() !== null) {
            if (!$this->validateMastercardPOSData()) {
                throw new InvalidRequestException("Invalid mastercard pos data");
            }
            $data->MCGrp->MCPOSData = $this->getMastercardPOSData();
        }
        if ($this->getDeviceTypeIndicator() !== null) {
            if (!$this->validateDeviceTypeIndicator()) {
                throw new InvalidRequestException("Invalid device type indicator");
            }
            $data->MCGrp->DevTypeInd = $this->getDeviceTypeIndicator();
        }
        if ($this->getMastercardACI() !== null) {
            if (!$this->validateMastercardACI()) {
                throw new InvalidRequestException("Invalid mastercard aci");
            }
            $data->MCGrp->MCACI = $this->getMastercardACI();
        }
        if ($this->getMastercardAdditionalData() !== null) {
            if (!$this->validateMastercardAdditionalData()) {
                throw new InvalidRequestException("Invalid mastercard additional data");
            }
            $data->MCGrp->MCAddData = $this->getMastercardAdditionalData();
        }
        if ($this->getAuthorizationType() !== null) {
            if (!$this->validateAuthorizationType()) {
                throw new InvalidRequestException("Invalid authorization type");
            }
            $data->MCGrp->FinAuthInd = $this->getAuthorizationType();
        }
        if ($this->getTransactionIntegrityClass() !== null) {
            if (!$this->validateTransactionIntegrityClass()) {
                throw new InvalidRequestException("Invalid transaction integrity class");
            }
            $data->MCGrp->TranIntgClass = $this->getTransactionIntegrityClass();
        }
    }

    /**
     * @return string
     */
    public function getBankNetData()
    {
        return $this->getParameter('BankNetData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setBankNetData($value)
    {
        return $this->setParameter('BankNetData', $value);
    }


    /**
     * @return bool
     */
    public function validateBankNetData()
    {
        $value = $this->getParameter('BankNetData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCCVErrorCode()
    {
        return $this->getParameter('CCVErrorCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCCVErrorCode($value)
    {
        return $this->setParameter('CCVErrorCode', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVErrorCode()
    {
        $value = $this->getParameter('CCVErrorCode');
        $valid = array('Y');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getPOSEntryModeChange()
    {
        return $this->getParameter('POSEntryModeChange');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPOSEntryModeChange($value)
    {
        return $this->setParameter('POSEntryModeChange', $value);
    }


    /**
     * @return bool
     */
    public function validatePOSEntryModeChange()
    {
        $value = $this->getParameter('POSEntryModeChange');
        $valid = array('Y');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTransactionEditErrorCode()
    {
        return $this->getParameter('TransactionEditErrorCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionEditErrorCode($value)
    {
        return $this->setParameter('TransactionEditErrorCode', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionEditErrorCode()
    {
        $value = $this->getParameter('TransactionEditErrorCode');
        if (!preg_match('/[0-9A-Za-z]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMastercardPOSData()
    {
        return $this->getParameter('MastercardPOSData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMastercardPOSData($value)
    {
        return $this->setParameter('MastercardPOSData', $value);
    }


    /**
     * @return bool
     */
    public function validateMastercardPOSData()
    {
        $value = $this->getParameter('MastercardPOSData');
        if (!preg_match('/[0-9A-Za-z]{12,12}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDeviceTypeIndicator()
    {
        return $this->getParameter('DeviceTypeIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDeviceTypeIndicator($value)
    {
        return $this->setParameter('DeviceTypeIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateDeviceTypeIndicator()
    {
        $value = $this->getParameter('DeviceTypeIndicator');
        if (!preg_match('/[0-9A-Za-z]{1,2}/', $value)) {
            return false;
        }
        if (!preg_match('/[0-9]{1,1}/', $value)) {
            return false;
        }
        if (!preg_match('/[1-9][0-9]/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMastercardACI()
    {
        return $this->getParameter('MastercardACI');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMastercardACI($value)
    {
        return $this->setParameter('MastercardACI', $value);
    }


    /**
     * @return bool
     */
    public function validateMastercardACI()
    {
        $value = $this->getParameter('MastercardACI');
        $valid = array('P', 'I');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMastercardAdditionalData()
    {
        return $this->getParameter('MastercardAdditionalData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMastercardAdditionalData($value)
    {
        return $this->setParameter('MastercardAdditionalData', $value);
    }


    /**
     * @return bool
     */
    public function validateMastercardAdditionalData()
    {
        $value = $this->getParameter('MastercardAdditionalData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAuthorizationType()
    {
        return $this->getParameter('AuthorizationType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAuthorizationType($value)
    {
        return $this->setParameter('AuthorizationType', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizationType()
    {
        $value = $this->getParameter('AuthorizationType');
        $valid = array('0', '1');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTransactionIntegrityClass()
    {
        return $this->getParameter('TransactionIntegrityClass');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionIntegrityClass($value)
    {
        return $this->setParameter('TransactionIntegrityClass', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionIntegrityClass()
    {
        $value = $this->getParameter('TransactionIntegrityClass');
        $valid = array(
            'Checkout',
            'Digital',
            'EMV',
            'Enhanced',
            'Generic',
            'Keyed',
            'Swiped',
            'Token',
            'Unknown',
            'UnknownCNP',
            'Validated'
        );
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getMarketSpecificDataIndicator()
    {
        return $this->getParameter('MarketSpecificDataIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMarketSpecificDataIndicator($value)
    {
        return $this->setParameter('MarketSpecificDataIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateMarketSpecificDataIndicator()
    {
        $value = $this->getParameter('MarketSpecificDataIndicator');
        $valid = array('BillPaymentGroup', 'Healthcare', 'Transit', 'EcomAgg', 'B2B', 'Hotel', 'AutoRental');
        return in_array($value, $valid);
    }
}