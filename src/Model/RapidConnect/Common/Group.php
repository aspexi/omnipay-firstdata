<?php

namespace Omnipay\FirstData\Model\RapidConnect\Common;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addCommonGroup(\SimpleXMLElement $data)
    {
        if ($this->getPaymentType() !== null) {
            if (!$this->validatePaymentType()) {
                throw new InvalidRequestException("Invalid payment type");
            }
            $data->CommonGrp->PymtType = $this->getPaymentType();
        }
        if ($this->getReversalReasonCode() !== null) {
            if (!$this->validateReversalReasonCode()) {
                throw new InvalidRequestException("Invalid reversal reason code");
            }
            $data->CommonGrp->ReversalInd = $this->getReversalReasonCode();
        }
        if ($this->getTransactionType() !== null) {
            if (!$this->validateTransactionType()) {
                throw new InvalidRequestException("Invalid transaction type");
            }
            $data->CommonGrp->TxnType = $this->getTransactionType();
        }
        if ($this->getLocalDateandTime() !== null) {
            if (!$this->validateLocalDateandTime()) {
                throw new InvalidRequestException("Invalid local date and time");
            }
            $data->CommonGrp->LocalDateTime = $this->getLocalDateandTime();
        }
        if ($this->getTransmissionDateandTime() !== null) {
            if (!$this->validateTransmissionDateandTime()) {
                throw new InvalidRequestException("Invalid transmission date and time");
            }
            $data->CommonGrp->TrnmsnDateTime = $this->getTransmissionDateandTime();
        }
        if ($this->getSTAN() !== null) {
            if (!$this->validateSTAN()) {
                throw new InvalidRequestException("Invalid stan");
            }
            $data->CommonGrp->STAN = $this->getSTAN();
        }
        if ($this->getReferenceNumber() !== null) {
            if (!$this->validateReferenceNumber()) {
                throw new InvalidRequestException("Invalid reference number");
            }
            $data->CommonGrp->RefNum = $this->getReferenceNumber();
        }
        if ($this->getOrderNumber() !== null) {
            if (!$this->validateOrderNumber()) {
                throw new InvalidRequestException("Invalid order number");
            }
            $data->CommonGrp->OrderNum = $this->getOrderNumber();
        }
        if ($this->getTPPID() !== null) {
            if (!$this->validateTPPID()) {
                throw new InvalidRequestException("Invalid tpp id");
            }
            $data->CommonGrp->TPPID = $this->getTPPID();
        }
        if ($this->getTerminalID() !== null) {
            if (!$this->validateTerminalID()) {
                throw new InvalidRequestException("Invalid terminal id");
            }
            $data->CommonGrp->TermID = $this->getTerminalID();
        }
        if ($this->getMerchantID() !== null) {
            if (!$this->validateMerchantID()) {
                throw new InvalidRequestException("Invalid merchant id");
            }
            $data->CommonGrp->MerchID = $this->getMerchantID();
        }
        if ($this->getMerchantCategoryCode() !== null) {
            if (!$this->validateMerchantCategoryCode()) {
                throw new InvalidRequestException("Invalid merchant category code");
            }
            $data->CommonGrp->MerchCatCode = $this->getMerchantCategoryCode();
        }
        if ($this->getPOSEntryMode() !== null) {
            if (!$this->validatePOSEntryMode()) {
                throw new InvalidRequestException("Invalid pos entry mode");
            }
            $data->CommonGrp->POSEntryMode = $this->getPOSEntryMode()->__toString();
        }
        if ($this->getPOSConditionCode() !== null) {
            if (!$this->validatePOSConditionCode()) {
                throw new InvalidRequestException("Invalid pos condition code");
            }
            $data->CommonGrp->POSCondCode = $this->getPOSConditionCode();
        }
        if ($this->getTerminalCategoryCode() !== null) {
            if (!$this->validateTerminalCategoryCode()) {
                throw new InvalidRequestException("Invalid terminal category code");
            }
            $data->CommonGrp->TermCatCode = $this->getTerminalCategoryCode();
        }
        if ($this->getTerminalEntryCapability() !== null) {
            if (!$this->validateTerminalEntryCapability()) {
                throw new InvalidRequestException("Invalid terminal entry capability");
            }
            $data->CommonGrp->TermEntryCapablt = $this->getTerminalEntryCapability();
        }
        if ($this->getTransactionAmount() !== null) {
            if (!$this->validateTransactionAmount()) {
                throw new InvalidRequestException("Invalid transaction amount");
            }
            $data->CommonGrp->TxnAmt = $this->getTransactionAmount();
        }
        if ($this->getTransactionCurrency() !== null) {
            if (!$this->validateTransactionCurrency()) {
                throw new InvalidRequestException("Invalid transaction currency: " . $this->getTransactionCurrency());
            }
            $data->CommonGrp->TxnCrncy = $this->getTransactionCurrency();
        }
        if ($this->getTerminalLocationIndicator() !== null) {
            if (!$this->validateTerminalLocationIndicator()) {
                throw new InvalidRequestException("Invalid terminal location indicator");
            }
            $data->CommonGrp->TermLocInd = $this->getTerminalLocationIndicator();
        }
        if ($this->getCardCaptureCapability() !== null) {
            if (!$this->validateCardCaptureCapability()) {
                throw new InvalidRequestException("Invalid card capture capability");
            }
            $data->CommonGrp->CardCaptCap = $this->getCardCaptureCapability();
        }
        if ($this->getGroupID() !== null) {
            if (!$this->validateGroupID()) {
                throw new InvalidRequestException("Invalid group id");
            }
            $data->CommonGrp->GroupID = $this->getGroupID();
        }
        if ($this->getPOSID() !== null) {
            if (!$this->validatePOSID()) {
                throw new InvalidRequestException("Invalid pos id");
            }
            $data->CommonGrp->POSID = $this->getPOSID();
        }
        if ($this->getSettlementIndicator() !== null) {
            if (!$this->validateSettlementIndicator()) {
                throw new InvalidRequestException("Invalid settlement indicator");
            }
            $data->CommonGrp->SettleInd = $this->getSettlementIndicator();
        }
        if ($this->getClerkID() !== null) {
            if (!$this->validateClerkID()) {
                throw new InvalidRequestException("Invalid clerk id");
            }
            $data->CommonGrp->ClerkID = $this->getClerkID();
        }
        if ($this->getServiceEntitlementNumber() !== null) {
            if (!$this->validateServiceEntitlementNumber()) {
                throw new InvalidRequestException("Invalid service entitlement number");
            }
            $data->CommonGrp->SENum = $this->getServiceEntitlementNumber();
        }
        if ($this->getPINLessPOSDebitFlag() !== null) {
            if (!$this->validatePINLessPOSDebitFlag()) {
                throw new InvalidRequestException("Invalid pinless pos debit flag");
            }
            $data->CommonGrp->PLPOSDebitFlg = $this->getPINLessPOSDebitFlag();
        }
        if ($this->getNetworkAccessIndicator() !== null) {
            if (!$this->validateNetworkAccessIndicator()) {
                throw new InvalidRequestException("Invalid network access indicator");
            }
            $data->CommonGrp->NetAccInd = $this->getNetworkAccessIndicator();
        }
        if ($this->getMerchantEcho() !== null) {
            if (!$this->validateMerchantEcho()) {
                throw new InvalidRequestException("Invalid merchant echo");
            }
            $data->CommonGrp->MerchEcho = $this->getMerchantEcho();
        }
        if ($this->getWalletIdentifier() !== null) {
            if (!$this->validateWalletIdentifier()) {
                throw new InvalidRequestException("Invalid wallet identifier");
            }
            $data->CommonGrp->WltID = $this->getWalletIdentifier();
        }
        if ($this->getNonUSMerchant() !== null) {
            if (!$this->validateNonUSMerchant()) {
                throw new InvalidRequestException("Invalid non us merchant");
            }
            $data->CommonGrp->NonUSMerch = $this->getNonUSMerchant();
        }
        if ($this->getDeviceBatchID() !== null) {
            if (!$this->validateDeviceBatchID()) {
                throw new InvalidRequestException("Invalid device batch id");
            }
            $data->CommonGrp->DevBatchID = $this->getDeviceBatchID();
        }
        if ($this->getDigitalWalletIndicator() !== null) {
            if (!$this->validateDigitalWalletIndicator()) {
                throw new InvalidRequestException("Invalid digital wallet indicator");
            }
            $data->CommonGrp->DigWltInd = $this->getDigitalWalletIndicator();
        }
        if ($this->getDigitalWalletProgramType() !== null) {
            if (!$this->validateDigitalWalletProgramType()) {
                throw new InvalidRequestException("Invalid digital wallet program type");
            }
            $data->CommonGrp->DigWltProgType = $this->getDigitalWalletProgramType();
        }
        if ($this->getTransactionInitiation() !== null) {
            if (!$this->validateTransactionInitiation()) {
                throw new InvalidRequestException("Invalid transaction initiation");
            }
            $data->CommonGrp->TranInit = $this->getTransactionInitiation();
        }
        if ($this->getPaymentService() !== null) {
            if (!$this->validatePaymentService()) {
                throw new InvalidRequestException("Invalid payment service");
            }
            $data->CommonGrp->PymntSvc = $this->getPaymentService();
        }
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->getParameter('PaymentType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPaymentType($value)
    {
        return $this->setParameter('PaymentType', $value);
    }


    /**
     * @return bool
     */
    public function validatePaymentType()
    {
        $value = $this->getParameter('PaymentType');
        $valid = array('AltCNP', 'Check', 'Credit', 'Debit', 'EBT', 'Fleet', 'PLDebit', 'Prepaid', 'PvtLabl');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getReversalReasonCode()
    {
        return $this->getParameter('ReversalReasonCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setReversalReasonCode($value)
    {
        return $this->setParameter('ReversalReasonCode', $value);
    }


    /**
     * @return bool
     */
    public function validateReversalReasonCode()
    {
        $value = $this->getParameter('ReversalReasonCode');
        $valid = array(
            'Timeout',
            'Void',
            'VoidFr',
            'TORVoid',
            'Partial',
            'EditErr',
            'MACVeri',
            'MACSync',
            'EncrErr',
            'SystErr'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTransactionType()
    {
        return $this->getParameter('TransactionType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionType($value)
    {
        return $this->setParameter('TransactionType', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionType()
    {
        $value = $this->getParameter('TransactionType');
        $valid = array(
            'Activation',
            'Authorization',
            'BalanceInquiry',
            'BalanceLock',
            'BatchSettleDetail',
            'BatchSettleL3',
            'CanadaKeyRequest',
            'CashAdvance',
            'Cashout',
            'CashoutActiveStatus',
            'Change',
            'CloseBatch',
            'Completion',
            'Custom',
            'DisableInternetUse',
            'EchoTest',
            'FileDownload',
            'FraudScore',
            'GenerateKey',
            'History',
            'HostTotals',
            'InternetActivation',
            'Load',
            'OpenBatch',
            'PCL3AddDetail',
            'Redemption',
            'RedemptionUnlock',
            'Refund',
            'Reload',
            'Sale',
            'TACertAuthority',
            'TAKeyRequest',
            'TATokenRequest',
            'Verification',
            'VoucherClear'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getLocalDateandTime()
    {
        return $this->getParameter('LocalDateandTime');
    }


    /**
     * @param $value
     * @return string
     */
    public function setLocalDateandTime($value)
    {
        return $this->setParameter('LocalDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateLocalDateandTime()
    {
        $value = $this->getParameter('LocalDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTransmissionDateandTime()
    {
        return $this->getParameter('TransmissionDateandTime');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransmissionDateandTime($value)
    {
        return $this->setParameter('TransmissionDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateTransmissionDateandTime()
    {
        $value = $this->getParameter('TransmissionDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSTAN()
    {
        return $this->getParameter('STAN');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSTAN($value)
    {
        return $this->setParameter('STAN', $value);
    }


    /**
     * @return bool
     */
    public function validateSTAN()
    {
        $value = $this->getParameter('STAN');
        if (!preg_match('/[0-9]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->getParameter('ReferenceNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setReferenceNumber($value)
    {
        return $this->setParameter('ReferenceNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateReferenceNumber()
    {
        $value = $this->getParameter('ReferenceNumber');
        return strlen($value) >= 1 && strlen($value) <= 30;
    }


    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getParameter('OrderNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOrderNumber($value)
    {
        return $this->setParameter('OrderNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateOrderNumber()
    {
        $value = $this->getParameter('OrderNumber');
        if (!preg_match('/[0-9A-Z a-z]{1,15}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTPPID()
    {
        return $this->getParameter('TPPID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTPPID($value)
    {
        return $this->setParameter('TPPID', $value);
    }


    /**
     * @return bool
     */
    public function validateTPPID()
    {
        $value = $this->getParameter('TPPID');
        if (!preg_match('/[0-9A-Za-z]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTerminalID()
    {
        return $this->getParameter('TerminalID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTerminalID($value)
    {
        return $this->setParameter('TerminalID', $value);
    }


    /**
     * @return bool
     */
    public function validateTerminalID()
    {
        $value = $this->getParameter('TerminalID');
        if (!preg_match('/[0-9A-Za-z]{1,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantID()
    {
        return $this->getParameter('MerchantID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMerchantID($value)
    {
        return $this->setParameter('MerchantID', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantID()
    {
        $value = $this->getParameter('MerchantID');
        if (!preg_match('/[0-9A-Za-z]{1,16}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantCategoryCode()
    {
        return $this->getParameter('MerchantCategoryCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMerchantCategoryCode($value)
    {
        return $this->setParameter('MerchantCategoryCode', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCategoryCode()
    {
        $value = $this->getParameter('MerchantCategoryCode');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPOSEntryMode()
    {
        return $this->getParameter('POSEntryMode');
    }


    /**
     * @param POSEntryMode $value
     * @return string
     */
    public function setPOSEntryMode($value)
    {
        if ($value && !$value instanceof POSEntryMode) {
            $value = new POSEntryMode($value);
        }

        return $this->setParameter('POSEntryMode', $value);
    }


    /**
     * @return bool
     */
    public function validatePOSEntryMode()
    {
        $value = $this->getParameter('POSEntryMode');
        $value->validate();
        return true;
    }


    /**
     * @return string
     */
    public function getPOSConditionCode()
    {
        return $this->getParameter('POSConditionCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPOSConditionCode($value)
    {
        return $this->setParameter('POSConditionCode', $value);
    }


    /**
     * @return bool
     */
    public function validatePOSConditionCode()
    {
        $value = $this->getParameter('POSConditionCode');
        $valid = array('00', '01', '02', '03', '04', '05', '06', '08', '59', '71');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTerminalCategoryCode()
    {
        return $this->getParameter('TerminalCategoryCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTerminalCategoryCode($value)
    {
        return $this->setParameter('TerminalCategoryCode', $value);
    }


    /**
     * @return bool
     */
    public function validateTerminalCategoryCode()
    {
        $value = $this->getParameter('TerminalCategoryCode');
        $valid = array('00', '01', '05', '06', '07', '08', '09', '12', '13', '17', '18');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTerminalEntryCapability()
    {
        return $this->getParameter('TerminalEntryCapability');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTerminalEntryCapability($value)
    {
        return $this->setParameter('TerminalEntryCapability', $value);
    }


    /**
     * @return bool
     */
    public function validateTerminalEntryCapability()
    {
        $value = $this->getParameter('TerminalEntryCapability');
        $valid = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTransactionAmount()
    {
        return $this->getParameter('TransactionAmount');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionAmount($value)
    {
        return $this->setParameter('TransactionAmount', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionAmount()
    {
        $value = $this->getParameter('TransactionAmount');
        if (!preg_match('/[0123456789]{1,12}/', $value)) {
            return false;
        }
        return true;
    }

    public function getCurrency()
    {
        return $this->getTransactionCurrency();
    }

    public function setCurrency($value)
    {
        return $this->setTransactionCurrency($value);
    }

    public function validateCurrency()
    {
        return $this->validateTransactionCurrency();
    }

    /**
     * @return string
     */
    public function getTransactionCurrency()
    {
        return $this->getParameter('TransactionCurrency');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionCurrency($value)
    {
        return $this->setParameter('TransactionCurrency', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionCurrency()
    {
        $value = $this->getParameter('TransactionCurrency');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTerminalLocationIndicator()
    {
        return $this->getParameter('TerminalLocationIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTerminalLocationIndicator($value)
    {
        return $this->setParameter('TerminalLocationIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateTerminalLocationIndicator()
    {
        $value = $this->getParameter('TerminalLocationIndicator');
        $valid = array('0', '1');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCardCaptureCapability()
    {
        return $this->getParameter('CardCaptureCapability');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardCaptureCapability($value)
    {
        return $this->setParameter('CardCaptureCapability', $value);
    }


    /**
     * @return bool
     */
    public function validateCardCaptureCapability()
    {
        $value = $this->getParameter('CardCaptureCapability');
        $valid = array('0', '1');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getGroupID()
    {
        return $this->getParameter('GroupID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setGroupID($value)
    {
        return $this->setParameter('GroupID', $value);
    }


    /**
     * @return bool
     */
    public function validateGroupID()
    {
        $value = $this->getParameter('GroupID');
        if (!preg_match('/[0-9A-Za-z]{5,13}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPOSID()
    {
        return $this->getParameter('POSID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPOSID($value)
    {
        return $this->setParameter('POSID', $value);
    }


    /**
     * @return bool
     */
    public function validatePOSID()
    {
        $value = $this->getParameter('POSID');
        if (!preg_match('/[0-9]{1,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSettlementIndicator()
    {
        return $this->getParameter('SettlementIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSettlementIndicator($value)
    {
        return $this->setParameter('SettlementIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateSettlementIndicator()
    {
        $value = $this->getParameter('SettlementIndicator');
        $valid = array('1', '2', '3');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getClerkID()
    {
        return $this->getParameter('ClerkID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setClerkID($value)
    {
        return $this->setParameter('ClerkID', $value);
    }


    /**
     * @return bool
     */
    public function validateClerkID()
    {
        $value = $this->getParameter('ClerkID');
        return strlen($value) >= 1 && strlen($value) <= 6;
    }


    /**
     * @return string
     */
    public function getServiceEntitlementNumber()
    {
        return $this->getParameter('ServiceEntitlementNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setServiceEntitlementNumber($value)
    {
        return $this->setParameter('ServiceEntitlementNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateServiceEntitlementNumber()
    {
        $value = $this->getParameter('ServiceEntitlementNumber');
        if (!preg_match('/[0-9A-Za-z]{1,15}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPINLessPOSDebitFlag()
    {
        return $this->getParameter('PINLessPOSDebitFlag');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPINLessPOSDebitFlag($value)
    {
        return $this->setParameter('PINLessPOSDebitFlag', $value);
    }


    /**
     * @return bool
     */
    public function validatePINLessPOSDebitFlag()
    {
        $value = $this->getParameter('PINLessPOSDebitFlag');
        $valid = array('1', 'C', 'D');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getNetworkAccessIndicator()
    {
        return $this->getParameter('NetworkAccessIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setNetworkAccessIndicator($value)
    {
        return $this->setParameter('NetworkAccessIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateNetworkAccessIndicator()
    {
        $value = $this->getParameter('NetworkAccessIndicator');
        $valid = array('1', 'C');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMerchantEcho()
    {
        return $this->getParameter('MerchantEcho');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMerchantEcho($value)
    {
        return $this->setParameter('MerchantEcho', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantEcho()
    {
        $value = $this->getParameter('MerchantEcho');
        return strlen($value) >= 1 && strlen($value) <= 99;
    }


    /**
     * @return string
     */
    public function getWalletIdentifier()
    {
        return $this->getParameter('WalletIdentifier');
    }


    /**
     * @param $value
     * @return string
     */
    public function setWalletIdentifier($value)
    {
        return $this->setParameter('WalletIdentifier', $value);
    }


    /**
     * @return bool
     */
    public function validateWalletIdentifier()
    {
        $value = $this->getParameter('WalletIdentifier');
        if (!preg_match('/[0-9A-Za-z]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getNonUSMerchant()
    {
        return $this->getParameter('NonUSMerchant');
    }


    /**
     * @param $value
     * @return string
     */
    public function setNonUSMerchant($value)
    {
        return $this->setParameter('NonUSMerchant', $value);
    }


    /**
     * @return bool
     */
    public function validateNonUSMerchant()
    {
        $value = $this->getParameter('NonUSMerchant');
        $valid = array('Canadian', 'Mexican');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getDeviceBatchID()
    {
        return $this->getParameter('DeviceBatchID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDeviceBatchID($value)
    {
        return $this->setParameter('DeviceBatchID', $value);
    }


    /**
     * @return bool
     */
    public function validateDeviceBatchID()
    {
        $value = $this->getParameter('DeviceBatchID');
        if (!preg_match('/[0-9A-Za-z]{1,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDigitalWalletIndicator()
    {
        return $this->getParameter('DigitalWalletIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDigitalWalletIndicator($value)
    {
        return $this->setParameter('DigitalWalletIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateDigitalWalletIndicator()
    {
        $value = $this->getParameter('DigitalWalletIndicator');
        $valid = array('Staged', 'Passthru');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getDigitalWalletProgramType()
    {
        return $this->getParameter('DigitalWalletProgramType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDigitalWalletProgramType($value)
    {
        return $this->setParameter('DigitalWalletProgramType', $value);
    }


    /**
     * @return bool
     */
    public function validateDigitalWalletProgramType()
    {
        $value = $this->getParameter('DigitalWalletProgramType');
        $valid = array('AndroidPay', 'ApplePay', 'MerchToken', 'PayButton', 'SamsungPay');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getTransactionInitiation()
    {
        return $this->getParameter('TransactionInitiation');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTransactionInitiation($value)
    {
        return $this->setParameter('TransactionInitiation', $value);
    }


    /**
     * @return bool
     */
    public function validateTransactionInitiation()
    {
        $value = $this->getParameter('TransactionInitiation');
        $valid = array('Merchant', 'Terminal', 'Customer');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getPaymentService()
    {
        return $this->getParameter('PaymentService');
    }


    /**
     * @param $value
     * @return string
     */
    public function setPaymentService($value)
    {
        return $this->setParameter('PaymentService', $value);
    }


    /**
     * @return bool
     */
    public function validatePaymentService()
    {
        $value = $this->getParameter('PaymentService');
        $valid = array('Incrmnt');
        return in_array($value, $valid);
    }
}