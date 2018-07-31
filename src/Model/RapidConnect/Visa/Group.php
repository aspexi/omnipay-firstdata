<?php

namespace Omnipay\FirstData\Model\RapidConnect\Visa;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addVisaGroup(\SimpleXMLElement $data)
    {
        if ($this->getAuthorizationCharacteristicsIndicator() !== null) {
            if (!$this->validateAuthorizationCharacteristicsIndicator()) {
                throw new InvalidRequestException("Invalid authorization characteristicsindicator aci");
            }
            $data->VisaGrp->ACI = $this->getAuthorizationCharacteristicsIndicator();
        }
        if ($this->getMarketSpecificDataIndicator() !== null) {
            if (!$this->validateMarketSpecificDataIndicator()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->VisaGrp->MrktSpecificDataInd = $this->getMarketSpecificDataIndicator();
        }
        if ($this->getExistingDebtIndicator() !== null) {
            if (!$this->validateExistingDebtIndicator()) {
                throw new InvalidRequestException("Invalid existing debt indicator");
            }
            $data->VisaGrp->ExistingDebtInd = $this->getExistingDebtIndicator();
        }
        if ($this->getCardLevelResultCode() !== null) {
            if (!$this->validateCardLevelResultCode()) {
                throw new InvalidRequestException("Invalid card level result code");
            }
            $data->VisaGrp->CardLevelResult = $this->getCardLevelResultCode();
        }
        if ($this->getSourceReasonCode() !== null) {
            if (!$this->validateSourceReasonCode()) {
                throw new InvalidRequestException("Invalid source reason code");
            }
            $data->VisaGrp->SourceReasonCode = $this->getSourceReasonCode();
        }
        if ($this->getTransactionIdentifier() !== null) {
            if (!$this->validateTransactionIdentifier()) {
                throw new InvalidRequestException("Invalid transaction identifier");
            }
            $data->VisaGrp->TransID = $this->getTransactionIdentifier();
        }
        if ($this->getVisaBID() !== null) {
            if (!$this->validateVisaBID()) {
                throw new InvalidRequestException("Invalid visa bid");
            }
            $data->VisaGrp->VisaBID = $this->getVisaBID();
        }
        if ($this->getVisaAUAR() !== null) {
            if (!$this->validateVisaAUAR()) {
                throw new InvalidRequestException("Invalid visa auar");
            }
            $data->VisaGrp->VisaAUAR = $this->getVisaAUAR();
        }
        if ($this->getTaxAmountCapability() !== null) {
            if (!$this->validateTaxAmountCapability()) {
                throw new InvalidRequestException("Invalid tax amount capability");
            }
            $data->VisaGrp->TaxAmtCapablt = $this->getTaxAmountCapability();
        }
        if ($this->getSpendQualifiedIndicator() !== null) {
            if (!$this->validateSpendQualifiedIndicator()) {
                throw new InvalidRequestException("Invalid spend qualified indicator");
            }
            $data->VisaGrp->SpendQInd = $this->getSpendQualifiedIndicator();
        }
        if ($this->getVisaCheckoutIndicator() !== null) {
            if (!$this->validateVisaCheckoutIndicator()) {
                throw new InvalidRequestException("Invalid visa checkout indicator");
            }
            $data->VisaGrp->CheckoutInd = $this->getVisaCheckoutIndicator();
        }
        if ($this->getQuasiCashIndicator() !== null) {
            if (!$this->validateQuasiCashIndicator()) {
                throw new InvalidRequestException("Invalid quasicash indicator");
            }
            $data->VisaGrp->QCI = $this->getQuasiCashIndicator();
        }
        if ($this->getAuthIndicator() !== null) {
            if (!$this->validateAuthIndicator()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->VisaGrp->VisaAuthInd = $this->getAuthIndicator();
        }
        if ($this->getStoredCredentialIndicator() !== null) {
            if (!$this->validateStoredCredentialIndicator()) {
                throw new InvalidRequestException("Invalid stored credential indicator");
            }
            $data->VisaGrp->StoredCredInd = $this->getStoredCredentialIndicator();
        }
        if ($this->getCardOnFileScheduleIndicator() !== null) {
            if (!$this->validateCardOnFileScheduleIndicator()) {
                throw new InvalidRequestException("Invalid card on file schedule indicator");
            }
            $data->VisaGrp->CofSchedInd = $this->getCardOnFileScheduleIndicator();
        }
    }

    /**
     * @return string
     */
    public function getAuthorizationCharacteristicsIndicator()
    {
        return $this->getParameter('AuthorizationCharacteristicsIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAuthorizationCharacteristicsIndicator($value)
    {
        return $this->setParameter('AuthorizationCharacteristicsIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizationCharacteristicsIndicator()
    {
        $value = $this->getParameter('AuthorizationCharacteristicsIndicator');
        $valid = array('P', 'I', 'Y', 'R', 'A', 'B', 'C', 'E', 'F', 'J', 'K', 'N', 'S', 'T', 'U', 'V', 'W');
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

    /**
     * @return string
     */
    public function getExistingDebtIndicator()
    {
        return $this->getParameter('ExistingDebtIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setExistingDebtIndicator($value)
    {
        return $this->setParameter('ExistingDebtIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateExistingDebtIndicator()
    {
        $value = $this->getParameter('ExistingDebtIndicator');
        $valid = array('1');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCardLevelResultCode()
    {
        return $this->getParameter('CardLevelResultCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardLevelResultCode($value)
    {
        return $this->setParameter('CardLevelResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateCardLevelResultCode()
    {
        $value = $this->getParameter('CardLevelResultCode');
        return strlen($value) >= 1 && strlen($value) <= 2;
    }


    /**
     * @return string
     */
    public function getSourceReasonCode()
    {
        return $this->getParameter('SourceReasonCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSourceReasonCode($value)
    {
        return $this->setParameter('SourceReasonCode', $value);
    }


    /**
     * @return bool
     */
    public function validateSourceReasonCode()
    {
        $value = $this->getParameter('SourceReasonCode');
        if (!preg_match('/[0-9A-Za-z]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTransactionIdentifier()
    {
        return $this->getParameter('TransactionIdentifier');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionIdentifier($value)
    {
        return $this->setParameter('TransactionIdentifier', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionIdentifier()
    {
        $value = $this->getParameter('TransactionIdentifier');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }


    /**
     * @return string
     */
    public function getVisaBID()
    {
        return $this->getParameter('VisaBID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setVisaBID($value)
    {
        return $this->setParameter('VisaBID', $value);
    }


    /**
     * @return bool
     */
    public function validateVisaBID()
    {
        $value = $this->getParameter('VisaBID');
        return strlen($value) >= 1 && strlen($value) <= 10;
    }


    /**
     * @return string
     */
    public function getVisaAUAR()
    {
        return $this->getParameter('VisaAUAR');
    }


    /**
     * @param $value
     * @return string
     */
    public function setVisaAUAR($value)
    {
        return $this->setParameter('VisaAUAR', $value);
    }


    /**
     * @return bool
     */
    public function validateVisaAUAR()
    {
        $value = $this->getParameter('VisaAUAR');
        if (!preg_match('/[0-9A-F]{12,12}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTaxAmountCapability()
    {
        return $this->getParameter('TaxAmountCapability');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTaxAmountCapability($value)
    {
        return $this->setParameter('TaxAmountCapability', $value);
    }


    /**
     * @return bool
     */
    public function validateTaxAmountCapability()
    {
        $value = $this->getParameter('TaxAmountCapability');
        $valid = array('0', '1', 'VB', 'VC', 'VP', 'TX', 'NA');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getSpendQualifiedIndicator()
    {
        return $this->getParameter('SpendQualifiedIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSpendQualifiedIndicator($value)
    {
        return $this->setParameter('SpendQualifiedIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateSpendQualifiedIndicator()
    {
        $value = $this->getParameter('SpendQualifiedIndicator');
        if (!preg_match('/[0-9A-Za-z]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getVisaCheckoutIndicator()
    {
        return $this->getParameter('VisaCheckoutIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setVisaCheckoutIndicator($value)
    {
        return $this->setParameter('VisaCheckoutIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateVisaCheckoutIndicator()
    {
        $value = $this->getParameter('VisaCheckoutIndicator');
        $valid = array('Y');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getQuasiCashIndicator()
    {
        return $this->getParameter('QuasiCashIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setQuasiCashIndicator($value)
    {
        return $this->setParameter('QuasiCashIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateQuasiCashIndicator()
    {
        $value = $this->getParameter('QuasiCashIndicator');
        $valid = array('Y', 'N');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getAuthIndicator()
    {
        return $this->getParameter('AuthIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAuthIndicator($value)
    {
        return $this->setParameter('AuthIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthIndicator()
    {
        $value = $this->getParameter('AuthIndicator');
        $valid = array('ReAuth', 'Resubmit', 'EstAuth', 'CrdOnFile');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getStoredCredentialIndicator()
    {
        return $this->getParameter('StoredCredentialIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setStoredCredentialIndicator($value)
    {
        return $this->setParameter('StoredCredentialIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateStoredCredentialIndicator()
    {
        $value = $this->getParameter('StoredCredentialIndicator');
        $valid = array('Initial', 'Subsequent');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCardOnFileScheduleIndicator()
    {
        return $this->getParameter('CardOnFileScheduleIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardOnFileScheduleIndicator($value)
    {
        return $this->setParameter('CardOnFileScheduleIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateCardOnFileScheduleIndicator()
    {
        $value = $this->getParameter('CardOnFileScheduleIndicator');
        $valid = array('Scheduled', 'Unscheduled');
        return in_array($value, $valid);
    }
}