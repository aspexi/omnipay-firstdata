<?php

namespace Omnipay\FirstData\Message;

use Omnipay\FirstData\Model\RapidConnect\EntryMode;

abstract class RapidConnectAbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|RapidConnectResponse
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    function sendData($data)
    {
        $headers = array(
            "Connection" => "keep-alive",
            "Cache-Control" => "no-cache",
            "Content-Type" => "text/xml"
        );
        $data = $data->saveXml();
        $this->httpClient->setSslVerification(false, false);
        $httpResponse = $this->httpClient->post($this->getLiveEndpoint(), $headers, $data)->send();

        return $this->response = new RapidConnectResponse($this, $httpResponse->getBody(true));
    }

    /**
     * @return string
     */
    public function getApp()
    {
        return $this->getParameter('App');
    }

    /**
     * @param string $app
     */
    public function setApp($app)
    {
        return $this->setParameter('App', $app);
    }

    /**
     * @return string
     */
    public function getAuth()
    {
        $authKey2 = str_pad($this->getTerminalID(), 8, "0", STR_PAD_LEFT);
        return "{$this->getGroupID()}{$this->getMerchantID()}|{$authKey2}";
    }

    /**
     * @return string
     */
    public function getClientRef()
    {
        return $this->getParameter('ClientRef');
    }

    /**
     * @param $clientRef
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setClientRef($clientRef)
    {
        return $this->setParameter('ClientRef');
    }

    /**
     * @return string
     */
    public function getDID()
    {
        return $this->getParameter('DID');
    }

    /**
     * @param string $dId
     */
    public function setDID($dId)
    {
        return $this->setParameter('DID', $dId);
    }

    /**
     * @return mixed
     */
    public function getIndustry()
    {
        return $this->getParameter('industry');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setIndustry($value)
    {
        return $this->setParameter('industry', $value);
    }

    /**
     * @return mixed
     */
    public function getLiveEndpoint()
    {
        return $this->getParameter('liveEndpoint');
    }

    /**
     * @param $liveEndpoint
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLiveEndpoint($liveEndpoint)
    {
        return $this->setParameter('liveEndpoint', $liveEndpoint);
    }

    /**
     * @param $serviceId
     * @return mixed
     */
    public function getServiceID()
    {
        return $this->getParameter('ServiceID');
    }

    /**
     * @param $serviceId
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setServiceID($serviceId)
    {
        return $this->setParameter('ServiceID', $serviceId);
    }

    // -- Generated -- //

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->getParameter('PaymentType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPaymentType(string $value)
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
     * @param string $value
     * @return string
     */
    public function setReversalReasonCode(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransactionType(string $value)
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
     * @param string $value
     * @return string
     */
    public function setLocalDateandTime(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransmissionDateandTime(string $value)
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
     * @param string $value
     * @return string
     */
    public function setSTAN(string $value)
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
     * @param string $value
     * @return string
     */
    public function setReferenceNumber(string $value)
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
     * @param string $value
     * @return string
     */
    public function setOrderNumber(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTPPID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTerminalID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setMerchantID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setMerchantCategoryCode(string $value)
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
     * @param EntryMode $value
     * @return string
     */
    public function setPOSEntryMode($value)
    {
        if ($value && !$value instanceof EntryMode) {
            $value = new EntryMode($value);
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
     * @param string $value
     * @return string
     */
    public function setPOSConditionCode(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTerminalCategoryCode(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTerminalEntryCapability(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransactionAmount(string $value)
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


    /**
     * @return string
     */
    public function getTransactionCurrency()
    {
        return $this->getParameter('TransactionCurrency');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTransactionCurrency(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTerminalLocationIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setCardCaptureCapability(string $value)
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
     * @param string $value
     * @return string
     */
    public function setGroupID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setPOSID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setSettlementIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setClerkID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setServiceEntitlementNumber(string $value)
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
     * @param string $value
     * @return string
     */
    public function setPINLessPOSDebitFlag(string $value)
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
     * @param string $value
     * @return string
     */
    public function setNetworkAccessIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setMerchantEcho(string $value)
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
     * @param string $value
     * @return string
     */
    public function setWalletIdentifier(string $value)
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
     * @param string $value
     * @return string
     */
    public function setNonUSMerchant(string $value)
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
     * @param string $value
     * @return string
     */
    public function setDeviceBatchID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setDigitalWalletIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setDigitalWalletProgramType(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransactionInitiation(string $value)
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
     * @param string $value
     * @return string
     */
    public function setPaymentService(string $value)
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


    /**
     * @return string
     */
    public function getBillPaymentTransactionIndicator()
    {
        return $this->getParameter('BillPaymentTransactionIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setBillPaymentTransactionIndicator(string $value)
    {
        return $this->setParameter('BillPaymentTransactionIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateBillPaymentTransactionIndicator()
    {
        $value = $this->getParameter('BillPaymentTransactionIndicator');
        $valid = array('Single', 'Recurring', 'Installment', 'Deferred');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMerchantAdviceCode()
    {
        return $this->getParameter('MerchantAdviceCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantAdviceCode(string $value)
    {
        return $this->setParameter('MerchantAdviceCode', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantAdviceCode()
    {
        $value = $this->getParameter('MerchantAdviceCode');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getInstallmentPaymentInvoiceNumber()
    {
        return $this->getParameter('InstallmentPaymentInvoiceNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setInstallmentPaymentInvoiceNumber(string $value)
    {
        return $this->setParameter('InstallmentPaymentInvoiceNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateInstallmentPaymentInvoiceNumber()
    {
        $value = $this->getParameter('InstallmentPaymentInvoiceNumber');
        return strlen($value) >= 1 && strlen($value) <= 12;
    }


    /**
     * @return string
     */
    public function getInstallmentPaymentDescription()
    {
        return $this->getParameter('InstallmentPaymentDescription');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setInstallmentPaymentDescription(string $value)
    {
        return $this->setParameter('InstallmentPaymentDescription', $value);
    }


    /**
     * @return bool
     */
    public function validateInstallmentPaymentDescription()
    {
        $value = $this->getParameter('InstallmentPaymentDescription');
        return strlen($value) >= 1 && strlen($value) <= 15;
    }


    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->getParameter('AccountNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAccountNumber(string $value)
    {
        return $this->setParameter('AccountNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateAccountNumber()
    {
        $value = $this->getParameter('AccountNumber');
        if (!preg_match('/[0-9]{1,23}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCardExpirationDate()
    {
        return $this->getParameter('CardExpirationDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardExpirationDate(string $value)
    {
        return $this->setParameter('CardExpirationDate', $value);
    }


    /**
     * @return bool
     */
    public function validateCardExpirationDate()
    {
        $value = $this->getParameter('CardExpirationDate');
        if (!preg_match('/[0-9]{6,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTrack1Data()
    {
        return $this->getParameter('Track1Data');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTrack1Data(string $value)
    {
        return $this->setParameter('Track1Data', $value);
    }


    /**
     * @return bool
     */
    public function validateTrack1Data()
    {
        $value = $this->getParameter('Track1Data');
        return strlen($value) >= 1 && strlen($value) <= 76;
    }

    /**
     * @return string
     */
    public function getTrack2Data()
    {
        return $this->getParameter('Track2Data');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTrack2Data(string $value)
    {
        return $this->setParameter('Track2Data', $value);
    }


    /**
     * @return bool
     */
    public function validateTrack2Data()
    {
        $value = $this->getParameter('Track2Data');
        return strlen($value) >= 1 && strlen($value) <= 37;
    }


    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->getParameter('CardType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardType(string $value)
    {
        return $this->setParameter('CardType', $value);
    }


    /**
     * @return bool
     */
    public function validateCardType()
    {
        $value = $this->getParameter('CardType');
        $valid = array(
            'Amex',
            'Diners',
            'Discover',
            'JCB',
            'MaestroInt',
            'MasterCard',
            'Visa',
            'GiftCard',
            'PPayCL',
            'CarCareOne',
            'CostPlus',
            'Dicks',
            'Exxon',
            'GenProp',
            'Gulf',
            'Shell',
            'Sinclair',
            'SpeedPass',
            'Sunoco',
            'ValeroUCC',
            'Mexican',
            'BPBusiness',
            'Buypass',
            'EssoFleet',
            'ExxonFleet',
            'FleetCor',
            'FleetOne',
            'MCFleet',
            'ValeroFlt',
            'VisaFleet',
            'Voyager',
            'Wex',
            'Paypal'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getAVSResultCode()
    {
        return $this->getParameter('AVSResultCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAVSResultCode(string $value)
    {
        return $this->setParameter('AVSResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateAVSResultCode()
    {
        $value = $this->getParameter('AVSResultCode');
        $valid = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'I',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'R',
            'S',
            'T',
            'U',
            'W',
            'X',
            'Y',
            'Z'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCCVIndicator()
    {
        return $this->getParameter('CCVIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCCVIndicator(string $value)
    {
        return $this->setParameter('CCVIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVIndicator()
    {
        $value = $this->getParameter('CCVIndicator');
        $valid = array('Ntprvd', 'Prvded', 'Illegible', 'NtOnCrd');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCCVData()
    {
        return $this->getParameter('CCVData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCCVData(string $value)
    {
        return $this->setParameter('CCVData', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVData()
    {
        $value = $this->getParameter('CCVData');
        if (!preg_match('/[0-9A-Za-z]{3,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCCVResultCode()
    {
        return $this->getParameter('CCVResultCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCCVResultCode(string $value)
    {
        return $this->setParameter('CCVResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVResultCode()
    {
        $value = $this->getParameter('CCVResultCode');
        $valid = array('Match', 'NoMtch', 'NotPrc', 'NotPrv', 'NotPrt', 'Unknwn');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMVVMAID()
    {
        return $this->getParameter('MVVMAID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMVVMAID(string $value)
    {
        return $this->setParameter('MVVMAID', $value);
    }


    /**
     * @return bool
     */
    public function validateMVVMAID()
    {
        $value = $this->getParameter('MVVMAID');
        if (!preg_match('/[0-9]{1,10}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCardInfoRequestIndicator()
    {
        return $this->getParameter('CardInfoRequestIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setCardInfoRequestIndicator(string $value)
    {
        return $this->setParameter('CardInfoRequestIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateCardInfoRequestIndicator()
    {
        $value = $this->getParameter('CardInfoRequestIndicator');
        $valid = array('Y');
        return in_array($value, $valid);
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


    /**
     * @return string
     */
    public function getEcommTransactionIndicator()
    {
        return $this->getParameter('EcommTransactionIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setEcommTransactionIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setCustomerServicePhoneNumber(string $value)
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
     * @param string $value
     * @return string
     */
    public function setEcommURL(string $value)
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
     * @param string $value
     * @return string
     */
    public function setMultipleClearingSequenceNumber(string $value)
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
     * @param string $value
     * @return string
     */
    public function setMultipleClearingSequenceCount(string $value)
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


    /**
     * @return string
     */
    public function getAuthorizationCharacteristicsIndicatorACI()
    {
        return $this->getParameter('AuthorizationCharacteristicsIndicatorACI');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAuthorizationCharacteristicsIndicatorACI(string $value)
    {
        return $this->setParameter('AuthorizationCharacteristicsIndicatorACI', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizationCharacteristicsIndicatorACI()
    {
        $value = $this->getParameter('AuthorizationCharacteristicsIndicatorACI');
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
     * @param string $value
     * @return string
     */
    public function setMarketSpecificDataIndicator(string $value)
    {
        return $this->setParameter('MarketSpecificDataIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateMarketSpecificDataIndicator()
    {
        $value = $this->getParameter('MarketSpecificDataIndicator');
        $valid = array('BillPayment', 'Healthcare', 'Transit', 'EcomAgg', 'B2B', 'Hotel', 'AutoRental');
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
     * @param string $value
     * @return string
     */
    public function setExistingDebtIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setCardLevelResultCode(string $value)
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
     * @param string $value
     * @return string
     */
    public function setSourceReasonCode(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransactionIdentifier(string $value)
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
     * @param string $value
     * @return string
     */
    public function setVisaBID(string $value)
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
     * @param string $value
     * @return string
     */
    public function setVisaAUAR(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTaxAmountCapability(string $value)
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
     * @param string $value
     * @return string
     */
    public function setSpendQualifiedIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setVisaCheckoutIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setQuasiCashIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setAuthIndicator(string $value)
    {
        return $this->setParameter('AuthIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthIndicator()
    {
        $value = $this->getParameter('AuthIndicator');
        $valid = array('ReAuth');
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
     * @param string $value
     * @return string
     */
    public function setStoredCredentialIndicator(string $value)
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
     * @param string $value
     * @return string
     */
    public function setCardOnFileScheduleIndicator(string $value)
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


    /**
     * @return string
     */
    public function getBankNetData()
    {
        return $this->getParameter('BankNetData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setBankNetData(string $value)
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
     * @param string $value
     * @return string
     */
    public function setCCVErrorCode(string $value)
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
     * @param string $value
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
     * @param string $value
     * @return string
     */
    public function setTransactionEditErrorCode(string $value)
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
    public function getMasterCardPOSData()
    {
        return $this->getParameter('MasterCardPOSData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMasterCardPOSData(string $value)
    {
        return $this->setParameter('MasterCardPOSData', $value);
    }


    /**
     * @return bool
     */
    public function validateMasterCardPOSData()
    {
        $value = $this->getParameter('MasterCardPOSData');
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
     * @param string $value
     * @return string
     */
    public function setDeviceTypeIndicator(string $value)
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
    public function getMasterCardACI()
    {
        return $this->getParameter('MasterCardACI');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMasterCardACI(string $value)
    {
        return $this->setParameter('MasterCardACI', $value);
    }


    /**
     * @return bool
     */
    public function validateMasterCardACI()
    {
        $value = $this->getParameter('MasterCardACI');
        $valid = array('P', 'I');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMasterCardAdditionalData()
    {
        return $this->getParameter('MasterCardAdditionalData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMasterCardAdditionalData(string $value)
    {
        return $this->setParameter('MasterCardAdditionalData', $value);
    }


    /**
     * @return bool
     */
    public function validateMasterCardAdditionalData()
    {
        $value = $this->getParameter('MasterCardAdditionalData');
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
     * @param string $value
     * @return string
     */
    public function setAuthorizationType(string $value)
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
     * @param string $value
     * @return string
     */
    public function setTransactionIntegrityClass(string $value)
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
    public function getDiscoverProcessingCode()
    {
        return $this->getParameter('DiscoverProcessingCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverProcessingCode(string $value)
    {
        return $this->setParameter('DiscoverProcessingCode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverProcessingCode()
    {
        $value = $this->getParameter('DiscoverProcessingCode');
        if (!preg_match('/[0-9A-Za-z]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverPOSEntryMode()
    {
        return $this->getParameter('DiscoverPOSEntryMode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverPOSEntryMode(string $value)
    {
        return $this->setParameter('DiscoverPOSEntryMode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverPOSEntryMode()
    {
        $value = $this->getParameter('DiscoverPOSEntryMode');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverResponseCode()
    {
        return $this->getParameter('DiscoverResponseCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverResponseCode(string $value)
    {
        return $this->setParameter('DiscoverResponseCode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverResponseCode()
    {
        $value = $this->getParameter('DiscoverResponseCode');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverPOSData()
    {
        return $this->getParameter('DiscoverPOSData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverPOSData(string $value)
    {
        return $this->setParameter('DiscoverPOSData', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverPOSData()
    {
        $value = $this->getParameter('DiscoverPOSData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverTransactionQualifier()
    {
        return $this->getParameter('DiscoverTransactionQualifier');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverTransactionQualifier(string $value)
    {
        return $this->setParameter('DiscoverTransactionQualifier', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverTransactionQualifier()
    {
        $value = $this->getParameter('DiscoverTransactionQualifier');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverNRID()
    {
        return $this->getParameter('DiscoverNRID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverNRID(string $value)
    {
        return $this->setParameter('DiscoverNRID', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverNRID()
    {
        $value = $this->getParameter('DiscoverNRID');
        if (!preg_match('/[0-9A-Za-z]{1,15}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMOTOIndicator()
    {
        return $this->getParameter('MOTOIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMOTOIndicator(string $value)
    {
        return $this->setParameter('MOTOIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateMOTOIndicator()
    {
        $value = $this->getParameter('MOTOIndicator');
        $valid = array('1', '2');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getRegisteredUserIndicator()
    {
        return $this->getParameter('RegisteredUserIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRegisteredUserIndicator(string $value)
    {
        return $this->setParameter('RegisteredUserIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateRegisteredUserIndicator()
    {
        $value = $this->getParameter('RegisteredUserIndicator');
        $valid = array('Y', 'N');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getRegisteredUserProfileChangeDate()
    {
        return $this->getParameter('RegisteredUserProfileChangeDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRegisteredUserProfileChangeDate(string $value)
    {
        return $this->setParameter('RegisteredUserProfileChangeDate', $value);
    }


    /**
     * @return bool
     */
    public function validateRegisteredUserProfileChangeDate()
    {
        $value = $this->getParameter('RegisteredUserProfileChangeDate');
        if (!preg_match('/[0-9]{8,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPartialShipmentIndicator()
    {
        return $this->getParameter('PartialShipmentIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPartialShipmentIndicator(string $value)
    {
        return $this->setParameter('PartialShipmentIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validatePartialShipmentIndicator()
    {
        $value = $this->getParameter('PartialShipmentIndicator');
        $valid = array('Partial');
        return in_array($value, $valid);
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


    /**
     * @return string
     */
    public function getOrderDate()
    {
        return $this->getParameter('OrderDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOrderDate(string $value)
    {
        return $this->setParameter('OrderDate', $value);
    }


    /**
     * @return bool
     */
    public function validateOrderDate()
    {
        $value = $this->getParameter('OrderDate');
        if (!preg_match('/[0-9]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->getParameter('ResponseCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setResponseCode(string $value)
    {
        return $this->setParameter('ResponseCode', $value);
    }


    /**
     * @return bool
     */
    public function validateResponseCode()
    {
        $value = $this->getParameter('ResponseCode');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAuthorizationID()
    {
        return $this->getParameter('AuthorizationID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAuthorizationID(string $value)
    {
        return $this->setParameter('AuthorizationID', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizationID()
    {
        $value = $this->getParameter('AuthorizationID');
        if (!preg_match('/[0-9A-Z a-z]{1,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAdditionalResponseData()
    {
        return $this->getParameter('AdditionalResponseData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalResponseData(string $value)
    {
        return $this->setParameter('AdditionalResponseData', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalResponseData()
    {
        $value = $this->getParameter('AdditionalResponseData');
        return strlen($value) >= 1 && strlen($value) <= 50;
    }


    /**
     * @return string
     */
    public function getSettlementDate()
    {
        return $this->getParameter('SettlementDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setSettlementDate(string $value)
    {
        return $this->setParameter('SettlementDate', $value);
    }


    /**
     * @return bool
     */
    public function validateSettlementDate()
    {
        $value = $this->getParameter('SettlementDate');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAuthorizingNetworkID()
    {
        return $this->getParameter('AuthorizingNetworkID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAuthorizingNetworkID(string $value)
    {
        return $this->setParameter('AuthorizingNetworkID', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizingNetworkID()
    {
        $value = $this->getParameter('AuthorizingNetworkID');
        if (!preg_match('/[0-9A-Za-z]{1,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAuthorizingNetworkName()
    {
        return $this->getParameter('AuthorizingNetworkName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAuthorizingNetworkName(string $value)
    {
        return $this->setParameter('AuthorizingNetworkName', $value);
    }


    /**
     * @return bool
     */
    public function validateAuthorizingNetworkName()
    {
        $value = $this->getParameter('AuthorizingNetworkName');
        return strlen($value) >= 1 && strlen($value) <= 10;
    }


    /**
     * @return string
     */
    public function getRoutingIndicator()
    {
        return $this->getParameter('RoutingIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRoutingIndicator(string $value)
    {
        return $this->setParameter('RoutingIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateRoutingIndicator()
    {
        $value = $this->getParameter('RoutingIndicator');
        if (!preg_match('/[0-9A-Za-z]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSignatureIndicator()
    {
        return $this->getParameter('SignatureIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setSignatureIndicator(string $value)
    {
        return $this->setParameter('SignatureIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateSignatureIndicator()
    {
        $value = $this->getParameter('SignatureIndicator');
        if (!preg_match('/[0-9]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getErrorData()
    {
        return $this->getParameter('ErrorData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setErrorData(string $value)
    {
        return $this->setParameter('ErrorData', $value);
    }


    /**
     * @return bool
     */
    public function validateErrorData()
    {
        $value = $this->getParameter('ErrorData');
        return strlen($value) >= 1 && strlen($value) <= 255;
    }


    /**
     * @return string
     */
    public function getSettlementTransactionType()
    {
        return $this->getParameter('SettlementTransactionType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setSettlementTransactionType(string $value)
    {
        return $this->setParameter('SettlementTransactionType', $value);
    }


    /**
     * @return bool
     */
    public function validateSettlementTransactionType()
    {
        $value = $this->getParameter('SettlementTransactionType');
        if (!preg_match('/[0-9A-Za-z]{1,1}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalAuthorizationID()
    {
        return $this->getParameter('OriginalAuthorizationID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalAuthorizationID(string $value)
    {
        return $this->setParameter('OriginalAuthorizationID', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalAuthorizationID()
    {
        $value = $this->getParameter('OriginalAuthorizationID');
        if (!preg_match('/[0-9A-Z a-z]{1,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalLocalDateandTime()
    {
        return $this->getParameter('OriginalLocalDateandTime');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalLocalDateandTime(string $value)
    {
        return $this->setParameter('OriginalLocalDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalLocalDateandTime()
    {
        $value = $this->getParameter('OriginalLocalDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalTransmissionDateandTime()
    {
        return $this->getParameter('OriginalTransmissionDateandTime');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalTransmissionDateandTime(string $value)
    {
        return $this->setParameter('OriginalTransmissionDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalTransmissionDateandTime()
    {
        $value = $this->getParameter('OriginalTransmissionDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalSTAN()
    {
        return $this->getParameter('OriginalSTAN');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalSTAN(string $value)
    {
        return $this->setParameter('OriginalSTAN', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalSTAN()
    {
        $value = $this->getParameter('OriginalSTAN');
        if (!preg_match('/[0-9]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalResponseCode()
    {
        return $this->getParameter('OriginalResponseCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalResponseCode(string $value)
    {
        return $this->setParameter('OriginalResponseCode', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalResponseCode()
    {
        $value = $this->getParameter('OriginalResponseCode');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalAuthorizingNetworkID()
    {
        return $this->getParameter('OriginalAuthorizingNetworkID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setOriginalAuthorizingNetworkID(string $value)
    {
        return $this->setParameter('OriginalAuthorizingNetworkID', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalAuthorizingNetworkID()
    {
        $value = $this->getParameter('OriginalAuthorizingNetworkID');
        if (!preg_match('/[0-9A-Za-z]{1,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getServiceLevel()
    {
        return $this->getParameter('ServiceLevel');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setServiceLevel(string $value)
    {
        return $this->setParameter('ServiceLevel', $value);
    }


    /**
     * @return bool
     */
    public function validateServiceLevel()
    {
        $value = $this->getParameter('ServiceLevel');
        $valid = array('F', 'S', 'N', 'X', 'O', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getNumberofProducts()
    {
        return $this->getParameter('NumberofProducts');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setNumberofProducts(string $value)
    {
        return $this->setParameter('NumberofProducts', $value);
    }


    /**
     * @return bool
     */
    public function validateNumberofProducts()
    {
        $value = $this->getParameter('NumberofProducts');
        $valid = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getFileType()
    {
        return $this->getParameter('FileType');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setFileType(string $value)
    {
        return $this->setParameter('FileType', $value);
    }


    /**
     * @return bool
     */
    public function validateFileType()
    {
        $value = $this->getParameter('FileType');
        $valid = array(
            'EMV2KEY',
            'MAIL',
            'CARDTABLE',
            'DYNCRDTBL',
            'SITECFG',
            'FUELRPT',
            'HOSTDISC',
            'RECTXT',
            'TABLE',
            'TERMAIL',
            'MEXLOCBIN',
            'MEXPVLBIN'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getFolioNumber()
    {
        return $this->getParameter('FolioNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setFolioNumber(string $value)
    {
        return $this->setParameter('FolioNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateFolioNumber()
    {
        $value = $this->getParameter('FolioNumber');
        return strlen($value) >= 1 && strlen($value) <= 12;
    }


    /**
     * @return string
     */
    public function getRoomNumber()
    {
        return $this->getParameter('RoomNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRoomNumber(string $value)
    {
        return $this->setParameter('RoomNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateRoomNumber()
    {
        $value = $this->getParameter('RoomNumber');
        if (!preg_match('/[0-9A-Za-z]{1,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getLodgingReferenceNumber()
    {
        return $this->getParameter('LodgingReferenceNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setLodgingReferenceNumber(string $value)
    {
        return $this->setParameter('LodgingReferenceNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateLodgingReferenceNumber()
    {
        $value = $this->getParameter('LodgingReferenceNumber');
        if (!preg_match('/[0-9A-Za-z]{1,9}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRoomRate()
    {
        return $this->getParameter('RoomRate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRoomRate(string $value)
    {
        return $this->setParameter('RoomRate', $value);
    }


    /**
     * @return bool
     */
    public function validateRoomRate()
    {
        $value = $this->getParameter('RoomRate');
        if (!preg_match('/[0-9]{1,9}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getProgramIndicator()
    {
        return $this->getParameter('ProgramIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setProgramIndicator(string $value)
    {
        return $this->setParameter('ProgramIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateProgramIndicator()
    {
        $value = $this->getParameter('ProgramIndicator');
        $valid = array('1', '2', '3', '4', '5', '6');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->getParameter('Duration');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDuration(string $value)
    {
        return $this->setParameter('Duration', $value);
    }


    /**
     * @return bool
     */
    public function validateDuration()
    {
        $value = $this->getParameter('Duration');
        if (!preg_match('/[0-9]{1,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getExtraCharges()
    {
        return $this->getParameter('ExtraCharges');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setExtraCharges(string $value)
    {
        return $this->setParameter('ExtraCharges', $value);
    }


    /**
     * @return bool
     */
    public function validateExtraCharges()
    {
        $value = $this->getParameter('ExtraCharges');
        if (!preg_match('/[1234567]{1,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRentalCity()
    {
        return $this->getParameter('RentalCity');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalCity(string $value)
    {
        return $this->setParameter('RentalCity', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalCity()
    {
        $value = $this->getParameter('RentalCity');
        return strlen($value) >= 1 && strlen($value) <= 18;
    }


    /**
     * @return string
     */
    public function getRentalState()
    {
        return $this->getParameter('RentalState');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalState(string $value)
    {
        return $this->setParameter('RentalState', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalState()
    {
        $value = $this->getParameter('RentalState');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRentalCountry()
    {
        return $this->getParameter('RentalCountry');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalCountry(string $value)
    {
        return $this->setParameter('RentalCountry', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalCountry()
    {
        $value = $this->getParameter('RentalCountry');
        if (!preg_match('/[0-9A-Za-z]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRentalDate()
    {
        return $this->getParameter('RentalDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalDate(string $value)
    {
        return $this->setParameter('RentalDate', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalDate()
    {
        $value = $this->getParameter('RentalDate');
        if (!preg_match('/[0-9]{8,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRentalTime()
    {
        return $this->getParameter('RentalTime');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalTime(string $value)
    {
        return $this->setParameter('RentalTime', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalTime()
    {
        $value = $this->getParameter('RentalTime');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getReturnCity()
    {
        return $this->getParameter('ReturnCity');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReturnCity(string $value)
    {
        return $this->setParameter('ReturnCity', $value);
    }


    /**
     * @return bool
     */
    public function validateReturnCity()
    {
        $value = $this->getParameter('ReturnCity');
        return strlen($value) >= 1 && strlen($value) <= 18;
    }


    /**
     * @return string
     */
    public function getReturnState()
    {
        return $this->getParameter('ReturnState');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReturnState(string $value)
    {
        return $this->setParameter('ReturnState', $value);
    }


    /**
     * @return bool
     */
    public function validateReturnState()
    {
        $value = $this->getParameter('ReturnState');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getReturnCountry()
    {
        return $this->getParameter('ReturnCountry');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReturnCountry(string $value)
    {
        return $this->setParameter('ReturnCountry', $value);
    }


    /**
     * @return bool
     */
    public function validateReturnCountry()
    {
        $value = $this->getParameter('ReturnCountry');
        if (!preg_match('/[0-9A-Za-z]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getReturnDate()
    {
        return $this->getParameter('ReturnDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReturnDate(string $value)
    {
        return $this->setParameter('ReturnDate', $value);
    }


    /**
     * @return bool
     */
    public function validateReturnDate()
    {
        $value = $this->getParameter('ReturnDate');
        if (!preg_match('/[0-9]{8,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getReturnTime()
    {
        return $this->getParameter('ReturnTime');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setReturnTime(string $value)
    {
        return $this->setParameter('ReturnTime', $value);
    }


    /**
     * @return bool
     */
    public function validateReturnTime()
    {
        $value = $this->getParameter('ReturnTime');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAmountExtraCharges()
    {
        return $this->getParameter('AmountExtraCharges');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAmountExtraCharges(string $value)
    {
        return $this->setParameter('AmountExtraCharges', $value);
    }


    /**
     * @return bool
     */
    public function validateAmountExtraCharges()
    {
        $value = $this->getParameter('AmountExtraCharges');
        if (!preg_match('/[0-9]{1,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRenterName()
    {
        return $this->getParameter('RenterName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRenterName(string $value)
    {
        return $this->setParameter('RenterName', $value);
    }


    /**
     * @return bool
     */
    public function validateRenterName()
    {
        $value = $this->getParameter('RenterName');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }


    /**
     * @return string
     */
    public function getAutoRentalAgreementNumber()
    {
        return $this->getParameter('AutoRentalAgreementNumber');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAutoRentalAgreementNumber(string $value)
    {
        return $this->setParameter('AutoRentalAgreementNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateAutoRentalAgreementNumber()
    {
        $value = $this->getParameter('AutoRentalAgreementNumber');
        return strlen($value) >= 1 && strlen($value) <= 12;
    }


    /**
     * @return string
     */
    public function getRentalDuration()
    {
        return $this->getParameter('RentalDuration');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalDuration(string $value)
    {
        return $this->setParameter('RentalDuration', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalDuration()
    {
        $value = $this->getParameter('RentalDuration');
        if (!preg_match('/[0-9A-Za-z]{1,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getRentalExtraCharges()
    {
        return $this->getParameter('RentalExtraCharges');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRentalExtraCharges(string $value)
    {
        return $this->setParameter('RentalExtraCharges', $value);
    }


    /**
     * @return bool
     */
    public function validateRentalExtraCharges()
    {
        $value = $this->getParameter('RentalExtraCharges');
        if (!preg_match('/[012345]{1,5}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAutoRentalNoShow()
    {
        return $this->getParameter('AutoRentalNoShow');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAutoRentalNoShow(string $value)
    {
        return $this->setParameter('AutoRentalNoShow', $value);
    }


    /**
     * @return bool
     */
    public function validateAutoRentalNoShow()
    {
        $value = $this->getParameter('AutoRentalNoShow');
        $valid = array('1');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getDelayedChargeIndicator()
    {
        return $this->getParameter('DelayedChargeIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDelayedChargeIndicator(string $value)
    {
        return $this->setParameter('DelayedChargeIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateDelayedChargeIndicator()
    {
        $value = $this->getParameter('DelayedChargeIndicator');
        $valid = array('DelChrg');
        return in_array($value, $valid);
    }
}
