<?php

namespace Omnipay\FirstData\Message;

abstract class RapidConnectAbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
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
        $authKey2 = str_pad($this->getTermID(), 8, "0", STR_PAD_LEFT);
        return "{$this->getGroupID()}{$this->getMerchID()}|{$authKey2}";
    }
    
    /**
     * @return string
     */
    public function getClientRef() {
        return $this->getParameter('ClientRef');
    }

    /**
     * @param $clientRef
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setClientRef($clientRef) {
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

    public function getNetAccInd()
    {
        return $this->getParameter('NetAccInd');
    }

    public function setNetAccInd($value)
    {
        return $this->setParameter('NetAccInd', $value);
    }

    /**
     * @return mixed
     */
    public function getPLPOSDebitFlg()
    {
        return $this->getParameter('PLPOSDebitFlg');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPLPOSDebitFlg($value)
    {
        return $this->setParameter('PLPOSDebitFlg', $value);
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
	public function getPymtType()
	{
		return $this->getParameter('PymtType');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setPymtType(string $value)
	{
		return $this->setParameter('PymtType', $value);
	}


	/**
	 * @return bool
	 */
	public function validatePymtType()
	{
		$value = $this->getParameter('PymtType');
		$valid = array('AltCNP', 'Check', 'Credit', 'Debit', 'EBT', 'Fleet', 'PLDebit', 'Prepaid', 'PvtLabl');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getTxnType()
	{
		return $this->getParameter('TxnType');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTxnType(string $value)
	{
		return $this->setParameter('TxnType', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTxnType()
	{
		$value = $this->getParameter('TxnType');
		$valid = array('Activation', 'Authorization', 'BalanceInquiry', 'BalanceLock', 'BatchSettleDetail', 'BatchSettleL3', 'CanadaKeyRequest', 'CashAdvance', 'Cashout', 'CashoutActiveStatus', 'Change', 'CloseBatch', 'Completion', 'Custom', 'DisableInternetUse', 'EchoTest', 'FileDownload', 'FraudScore', 'GenerateKey', 'History', 'HostTotals', 'InternetActivation', 'Load', 'OpenBatch', 'PCL3AddDetail', 'Redemption', 'RedemptionUnlock', 'Refund', 'Reload', 'Sale', 'TACertAuthority', 'TAKeyRequest', 'TATokenRequest', 'Verification', 'VoucherClear');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getLocalDateTime()
	{
		return $this->getParameter('LocalDateTime');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setLocalDateTime(string $value)
	{
		return $this->setParameter('LocalDateTime', $value);
	}


	/**
	 * @return bool
	 */
	public function validateLocalDateTime()
	{
		$value = $this->getParameter('LocalDateTime');
		if (!preg_match('/[0-9]{14,14}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getTrnmsnDateTime()
	{
		return $this->getParameter('TrnmsnDateTime');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTrnmsnDateTime(string $value)
	{
		return $this->setParameter('TrnmsnDateTime', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTrnmsnDateTime()
	{
		$value = $this->getParameter('TrnmsnDateTime');
		if (!preg_match('/[0-9]{14,14}/',$value)) {
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
		if (!preg_match('/[0-9]{6,6}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getRefNum()
	{
		return $this->getParameter('RefNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRefNum(string $value)
	{
		return $this->setParameter('RefNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRefNum()
	{
		$value = $this->getParameter('RefNum');
		return strlen($value) >= 1 && strlen($value) <= 30;
	}


	/**
	 * @return string
	 */
	public function getOrderNum()
	{
		return $this->getParameter('OrderNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setOrderNum(string $value)
	{
		return $this->setParameter('OrderNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateOrderNum()
	{
		$value = $this->getParameter('OrderNum');
		if (!preg_match('/[0-9A-Z a-z]{1,15}/',$value)) {
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
		if (!preg_match('/[0-9A-Za-z]{6,6}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getTermID()
	{
		return $this->getParameter('TermID');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTermID(string $value)
	{
		return $this->setParameter('TermID', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTermID()
	{
		$value = $this->getParameter('TermID');
		if (!preg_match('/[0-9A-Za-z]{1,8}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getMerchID()
	{
		return $this->getParameter('MerchID');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMerchID(string $value)
	{
		return $this->setParameter('MerchID', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMerchID()
	{
		$value = $this->getParameter('MerchID');
		if (!preg_match('/[0-9A-Za-z]{1,16}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getMerchCatCode()
	{
		return $this->getParameter('MerchCatCode');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMerchCatCode(string $value)
	{
		return $this->setParameter('MerchCatCode', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMerchCatCode()
	{
		$value = $this->getParameter('MerchCatCode');
		if (!preg_match('/[0-9]{4,4}/',$value)) {
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
	 * @param string $value
	 * @return string
	 */
	public function setPOSEntryMode(string $value)
	{
		return $this->setParameter('POSEntryMode', $value);
	}


	/**
	 * @return bool
	 */
	public function validatePOSEntryMode()
	{
		$value = $this->getParameter('POSEntryMode');
		if (!preg_match('/[0-9]{3,3}/',$value)) {
		    return false;
		}
		if (!preg_match('/[0789][0123456789][0-4]/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getPOSCondCode()
	{
		return $this->getParameter('POSCondCode');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setPOSCondCode(string $value)
	{
		return $this->setParameter('POSCondCode', $value);
	}


	/**
	 * @return bool
	 */
	public function validatePOSCondCode()
	{
		$value = $this->getParameter('POSCondCode');
		$valid = array('00', '01', '02', '03', '04', '05', '06', '08', '59', '71');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getTermCatCode()
	{
		return $this->getParameter('TermCatCode');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTermCatCode(string $value)
	{
		return $this->setParameter('TermCatCode', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTermCatCode()
	{
		$value = $this->getParameter('TermCatCode');
		$valid = array('00', '01', '05', '06', '07', '08', '09', '12', '13', '17', '18');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getTermEntryCapablt()
	{
		return $this->getParameter('TermEntryCapablt');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTermEntryCapablt(string $value)
	{
		return $this->setParameter('TermEntryCapablt', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTermEntryCapablt()
	{
		$value = $this->getParameter('TermEntryCapablt');
		$valid = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getTxnAmt()
	{
		return $this->getParameter('TxnAmt');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTxnAmt(string $value)
	{
		return $this->setParameter('TxnAmt', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTxnAmt()
	{
		$value = $this->getParameter('TxnAmt');
		if (!preg_match('/[0123456789]{1,12}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getTxnCrncy()
	{
		return $this->getParameter('TxnCrncy');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTxnCrncy(string $value)
	{
		return $this->setParameter('TxnCrncy', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTxnCrncy()
	{
		$value = $this->getParameter('TxnCrncy');
		if (!preg_match('/[0-9]{3,3}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getTermLocInd()
	{
		return $this->getParameter('TermLocInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTermLocInd(string $value)
	{
		return $this->setParameter('TermLocInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTermLocInd()
	{
		$value = $this->getParameter('TermLocInd');
		$valid = array('0', '1');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getCardCaptCap()
	{
		return $this->getParameter('CardCaptCap');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCardCaptCap(string $value)
	{
		return $this->setParameter('CardCaptCap', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCardCaptCap()
	{
		$value = $this->getParameter('CardCaptCap');
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
		if (!preg_match('/[0-9A-Za-z]{5,13}/',$value)) {
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
		if (!preg_match('/[0-9]{1,4}/',$value)) {
		    return false;
		}
		return true;
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
	public function getSENum()
	{
		return $this->getParameter('SENum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setSENum(string $value)
	{
		return $this->setParameter('SENum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateSENum()
	{
		$value = $this->getParameter('SENum');
		if (!preg_match('/[0-9A-Za-z]{1,15}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getMerchEcho()
	{
		return $this->getParameter('MerchEcho');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMerchEcho(string $value)
	{
		return $this->setParameter('MerchEcho', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMerchEcho()
	{
		$value = $this->getParameter('MerchEcho');
		return strlen($value) >= 1 && strlen($value) <= 99;
	}


	/**
	 * @return string
	 */
	public function getWltID()
	{
		return $this->getParameter('WltID');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setWltID(string $value)
	{
		return $this->setParameter('WltID', $value);
	}


	/**
	 * @return bool
	 */
	public function validateWltID()
	{
		$value = $this->getParameter('WltID');
		if (!preg_match('/[0-9A-Za-z]{3,3}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getNonUSMerch()
	{
		return $this->getParameter('NonUSMerch');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setNonUSMerch(string $value)
	{
		return $this->setParameter('NonUSMerch', $value);
	}


	/**
	 * @return bool
	 */
	public function validateNonUSMerch()
	{
		$value = $this->getParameter('NonUSMerch');
		$valid = array('Canadian', 'Mexican');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getDevBatchID()
	{
		return $this->getParameter('DevBatchID');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setDevBatchID(string $value)
	{
		return $this->setParameter('DevBatchID', $value);
	}


	/**
	 * @return bool
	 */
	public function validateDevBatchID()
	{
		$value = $this->getParameter('DevBatchID');
		if (!preg_match('/[0-9A-Za-z]{1,4}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getDigWltInd()
	{
		return $this->getParameter('DigWltInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setDigWltInd(string $value)
	{
		return $this->setParameter('DigWltInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateDigWltInd()
	{
		$value = $this->getParameter('DigWltInd');
		$valid = array('Staged', 'Passthru');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getDigWltProgType()
	{
		return $this->getParameter('DigWltProgType');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setDigWltProgType(string $value)
	{
		return $this->setParameter('DigWltProgType', $value);
	}


	/**
	 * @return bool
	 */
	public function validateDigWltProgType()
	{
		$value = $this->getParameter('DigWltProgType');
		$valid = array('AndroidPay', 'ApplePay', 'MerchToken', 'PayButton', 'SamsungPay');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getTranInit()
	{
		return $this->getParameter('TranInit');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setTranInit(string $value)
	{
		return $this->setParameter('TranInit', $value);
	}


	/**
	 * @return bool
	 */
	public function validateTranInit()
	{
		$value = $this->getParameter('TranInit');
		$valid = array('Merchant', 'Terminal', 'Customer');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getInstallInvNum()
	{
		return $this->getParameter('InstallInvNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setInstallInvNum(string $value)
	{
		return $this->setParameter('InstallInvNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateInstallInvNum()
	{
		$value = $this->getParameter('InstallInvNum');
		return strlen($value) >= 1 && strlen($value) <= 12;
	}


	/**
	 * @return string
	 */
	public function getInstallPymntDesc()
	{
		return $this->getParameter('InstallPymntDesc');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setInstallPymntDesc(string $value)
	{
		return $this->setParameter('InstallPymntDesc', $value);
	}


	/**
	 * @return bool
	 */
	public function validateInstallPymntDesc()
	{
		$value = $this->getParameter('InstallPymntDesc');
		return strlen($value) >= 1 && strlen($value) <= 15;
	}


	/**
	 * @return string
	 */
	public function getAcctNum()
	{
		return $this->getParameter('AcctNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAcctNum(string $value)
	{
		return $this->setParameter('AcctNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAcctNum()
	{
		$value = $this->getParameter('AcctNum');
		if (!preg_match('/[0-9]{1,23}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getCardExpiryDate()
	{
		return $this->getParameter('CardExpiryDate');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCardExpiryDate(string $value)
	{
		return $this->setParameter('CardExpiryDate', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCardExpiryDate()
	{
		$value = $this->getParameter('CardExpiryDate');
		if (!preg_match('/[0-9]{6,8}/',$value)) {
		    return false;
		}
		return true;
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
		$valid = array('Amex', 'Diners', 'Discover', 'JCB', 'MaestroInt', 'MasterCard', 'Visa', 'GiftCard', 'PPayCL', 'CarCareOne', 'CostPlus', 'Dicks', 'Exxon', 'GenProp', 'Gulf', 'Shell', 'Sinclair', 'SpeedPass', 'Sunoco', 'ValeroUCC', 'Mexican', 'BPBusiness', 'Buypass', 'EssoFleet', 'ExxonFleet', 'FleetCor', 'FleetOne', 'MCFleet', 'ValeroFlt', 'VisaFleet', 'Voyager', 'Wex', 'Paypal');
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
		if (!preg_match('/[0-9]{1,10}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getInfoReqInd()
	{
		return $this->getParameter('InfoReqInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setInfoReqInd(string $value)
	{
		return $this->setParameter('InfoReqInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateInfoReqInd()
	{
		$value = $this->getParameter('InfoReqInd');
		$valid = array('Y');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getEcommTxnInd()
	{
		return $this->getParameter('EcommTxnInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setEcommTxnInd(string $value)
	{
		return $this->setParameter('EcommTxnInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateEcommTxnInd()
	{
		$value = $this->getParameter('EcommTxnInd');
		$valid = array('01', '02', '03', '04', '05', '06', '07');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getVisaAuthInd()
	{
		return $this->getParameter('VisaAuthInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setVisaAuthInd(string $value)
	{
		return $this->setParameter('VisaAuthInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateVisaAuthInd()
	{
		$value = $this->getParameter('VisaAuthInd');
		$valid = array('ReAuth', 'ReSubmit', 'EstAuth', 'CrdOnFile');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getDevTypeInd()
	{
		return $this->getParameter('DevTypeInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setDevTypeInd(string $value)
	{
		return $this->setParameter('DevTypeInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateDevTypeInd()
	{
		$value = $this->getParameter('DevTypeInd');
		if (!preg_match('/[0-9A-Za-z]{1,2}/',$value)) {
		    return false;
		}
		if (!preg_match('/[0-9]{1,1}/',$value)) {
		    return false;
		}
		if (!preg_match('/[1-9][0-9]/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getMOTOInd()
	{
		return $this->getParameter('MOTOInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMOTOInd(string $value)
	{
		return $this->setParameter('MOTOInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMOTOInd()
	{
		$value = $this->getParameter('MOTOInd');
		$valid = array('1', '2');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getRegUserInd()
	{
		return $this->getParameter('RegUserInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRegUserInd(string $value)
	{
		return $this->setParameter('RegUserInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRegUserInd()
	{
		$value = $this->getParameter('RegUserInd');
		$valid = array('Y', 'N');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getRegUserDate()
	{
		return $this->getParameter('RegUserDate');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRegUserDate(string $value)
	{
		return $this->setParameter('RegUserDate', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRegUserDate()
	{
		$value = $this->getParameter('RegUserDate');
		if (!preg_match('/[0-9]{8,8}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getGdSoldCd()
	{
		return $this->getParameter('GdSoldCd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setGdSoldCd(string $value)
	{
		return $this->setParameter('GdSoldCd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateGdSoldCd()
	{
		$value = $this->getParameter('GdSoldCd');
		$valid = array('1000');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getServLvl()
	{
		return $this->getParameter('ServLvl');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setServLvl(string $value)
	{
		return $this->setParameter('ServLvl', $value);
	}


	/**
	 * @return bool
	 */
	public function validateServLvl()
	{
		$value = $this->getParameter('ServLvl');
		$valid = array('F', 'S', 'N', 'X', 'O', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getNumOfProds()
	{
		return $this->getParameter('NumOfProds');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setNumOfProds(string $value)
	{
		return $this->setParameter('NumOfProds', $value);
	}


	/**
	 * @return bool
	 */
	public function validateNumOfProds()
	{
		$value = $this->getParameter('NumOfProds');
		$valid = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getFolioNum()
	{
		return $this->getParameter('FolioNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setFolioNum(string $value)
	{
		return $this->setParameter('FolioNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateFolioNum()
	{
		$value = $this->getParameter('FolioNum');
		return strlen($value) >= 1 && strlen($value) <= 12;
	}


	/**
	 * @return string
	 */
	public function getRoomNum()
	{
		return $this->getParameter('RoomNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRoomNum(string $value)
	{
		return $this->setParameter('RoomNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRoomNum()
	{
		$value = $this->getParameter('RoomNum');
		if (!preg_match('/[0-9A-Za-z]{1,6}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getLodRefNum()
	{
		return $this->getParameter('LodRefNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setLodRefNum(string $value)
	{
		return $this->setParameter('LodRefNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateLodRefNum()
	{
		$value = $this->getParameter('LodRefNum');
		if (!preg_match('/[0-9A-Za-z]{1,9}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getRoomRt()
	{
		return $this->getParameter('RoomRt');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRoomRt(string $value)
	{
		return $this->setParameter('RoomRt', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRoomRt()
	{
		$value = $this->getParameter('RoomRt');
		if (!preg_match('/[0-9]{1,9}/',$value)) {
		    return false;
		}
		return true;
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
		if (!preg_match('/[0-9]{1,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getExtraChrgs()
	{
		return $this->getParameter('ExtraChrgs');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setExtraChrgs(string $value)
	{
		return $this->setParameter('ExtraChrgs', $value);
	}


	/**
	 * @return bool
	 */
	public function validateExtraChrgs()
	{
		$value = $this->getParameter('ExtraChrgs');
		if (!preg_match('/[1234567]{1,6}/',$value)) {
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
		if (!preg_match('/[0-9A-Za-z]{2,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getRentalCtry()
	{
		return $this->getParameter('RentalCtry');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRentalCtry(string $value)
	{
		return $this->setParameter('RentalCtry', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRentalCtry()
	{
		$value = $this->getParameter('RentalCtry');
		if (!preg_match('/[0-9A-Za-z]{3,3}/',$value)) {
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
		if (!preg_match('/[0-9]{8,8}/',$value)) {
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
		if (!preg_match('/[0-9]{4,4}/',$value)) {
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
		if (!preg_match('/[0-9A-Za-z]{2,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getReturnCtry()
	{
		return $this->getParameter('ReturnCtry');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setReturnCtry(string $value)
	{
		return $this->setParameter('ReturnCtry', $value);
	}


	/**
	 * @return bool
	 */
	public function validateReturnCtry()
	{
		$value = $this->getParameter('ReturnCtry');
		if (!preg_match('/[0-9A-Za-z]{3,3}/',$value)) {
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
		if (!preg_match('/[0-9]{8,8}/',$value)) {
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
		if (!preg_match('/[0-9]{4,4}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getAmtExtraChrgs()
	{
		return $this->getParameter('AmtExtraChrgs');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAmtExtraChrgs(string $value)
	{
		return $this->setParameter('AmtExtraChrgs', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAmtExtraChrgs()
	{
		$value = $this->getParameter('AmtExtraChrgs');
		if (!preg_match('/[0-9]{1,8}/',$value)) {
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
	public function getAutoAgreeNum()
	{
		return $this->getParameter('AutoAgreeNum');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAutoAgreeNum(string $value)
	{
		return $this->setParameter('AutoAgreeNum', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAutoAgreeNum()
	{
		$value = $this->getParameter('AutoAgreeNum');
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
		if (!preg_match('/[0-9A-Za-z]{1,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getRentalExtraChrgs()
	{
		return $this->getParameter('RentalExtraChrgs');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setRentalExtraChrgs(string $value)
	{
		return $this->setParameter('RentalExtraChrgs', $value);
	}


	/**
	 * @return bool
	 */
	public function validateRentalExtraChrgs()
	{
		$value = $this->getParameter('RentalExtraChrgs');
		if (!preg_match('/[012345]{1,5}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getAutoNoShow()
	{
		return $this->getParameter('AutoNoShow');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAutoNoShow(string $value)
	{
		return $this->setParameter('AutoNoShow', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAutoNoShow()
	{
		$value = $this->getParameter('AutoNoShow');
		$valid = array('1');
		return in_array($value, $valid);
	}

    /**
     * @return string
     */
    public function getSettleInd()
    {
        return $this->getParameter('SettleInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setSettleInd(string $value)
    {
        return $this->setParameter('SettleInd', $value);
    }
    /**
     * @return bool
     */
    public function validateSettleInd()
    {
        $value = $this->getParameter('SettleInd');
        $valid = array('1', '2', '3');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getBillPymtTxnInd()
    {
        return $this->getParameter('BillPymtTxnInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setBillPymtTxnInd(string $value)
    {
        return $this->setParameter('BillPymtTxnInd', $value);
    }
    /**
     * @return bool
     */
    public function validateBillPymtTxnInd()
    {
        $value = $this->getParameter('BillPymtTxnInd');
        $valid = array('Single', 'Recurring', 'Installment', 'Deferred');
        return in_array($value, $valid);
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
    public function getCCVInd()
    {
        return $this->getParameter('CCVInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setCCVInd(string $value)
    {
        return $this->setParameter('CCVInd', $value);
    }
    /**
     * @return bool
     */
    public function validateCCVInd()
    {
        $value = $this->getParameter('CCVInd');
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
        if (!preg_match('/[0-9A-Za-z]{3,4}/',$value)) {
            return false;
        }
        return true;
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
        if (!preg_match('/[0-9A-F]{16,16}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getKeySerialNumData()
    {
        return $this->getParameter('KeySerialNumData');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setKeySerialNumData(string $value)
    {
        return $this->setParameter('KeySerialNumData', $value);
    }
    /**
     * @return bool
     */
    public function validateKeySerialNumData()
    {
        $value = $this->getParameter('KeySerialNumData');
        if (!preg_match('/[0-9A-Za-z]{20,20}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getACI()
    {
        return $this->getParameter('ACI');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setACI(string $value)
    {
        return $this->setParameter('ACI', $value);
    }
    /**
     * @return bool
     */
    public function validateACI()
    {
        $value = $this->getParameter('ACI');
        $valid = array('P', 'I', 'Y', 'R', 'A', 'B', 'C', 'E', 'F', 'J', 'K', 'N', 'S', 'T', 'U', 'V', 'W');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getMrktSpecificDataInd()
    {
        return $this->getParameter('MrktSpecificDataInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setMrktSpecificDataInd(string $value)
    {
        return $this->setParameter('MrktSpecificDataInd', $value);
    }
    /**
     * @return bool
     */
    public function validateMrktSpecificDataInd()
    {
        $value = $this->getParameter('MrktSpecificDataInd');
        $valid = array('BillPayment', 'Healthcare', 'Transit', 'EcomAgg', 'B2B', 'Hotel', 'AutoRental');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getExistingDebtInd()
    {
        return $this->getParameter('ExistingDebtInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setExistingDebtInd(string $value)
    {
        return $this->setParameter('ExistingDebtInd', $value);
    }
    /**
     * @return bool
     */
    public function validateExistingDebtInd()
    {
        $value = $this->getParameter('ExistingDebtInd');
        $valid = array('1');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getTransID()
    {
        return $this->getParameter('TransID');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setTransID(string $value)
    {
        return $this->setParameter('TransID', $value);
    }
    /**
     * @return bool
     */
    public function validateTransID()
    {
        $value = $this->getParameter('TransID');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }

    /**
     * @return string
     */
    public function getTaxAmtCapablt()
    {
        return $this->getParameter('TaxAmtCapablt');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setTaxAmtCapablt(string $value)
    {
        return $this->setParameter('TaxAmtCapablt', $value);
    }
    /**
     * @return bool
     */
    public function validateTaxAmtCapablt()
    {
        $value = $this->getParameter('TaxAmtCapablt');
        $valid = array('0', '1', 'VB', 'VC', 'VP', 'TX', 'NA');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getCheckoutInd()
    {
        return $this->getParameter('CheckoutInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setCheckoutInd(string $value)
    {
        return $this->setParameter('CheckoutInd', $value);
    }
    /**
     * @return bool
     */
    public function validateCheckoutInd()
    {
        $value = $this->getParameter('CheckoutInd');
        $valid = array('Y');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getQCI()
    {
        return $this->getParameter('QCI');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setQCI(string $value)
    {
        return $this->setParameter('QCI', $value);
    }
    /**
     * @return bool
     */
    public function validateQCI()
    {
        $value = $this->getParameter('QCI');
        $valid = array('Y', 'N');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getStoredCredInd()
    {
        return $this->getParameter('StoredCredInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setStoredCredInd(string $value)
    {
        return $this->setParameter('StoredCredInd', $value);
    }
    /**
     * @return bool
     */
    public function validateStoredCredInd()
    {
        $value = $this->getParameter('StoredCredInd');
        $valid = array('Initial', 'Subsequent');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getCofSchedInd()
    {
        return $this->getParameter('CofSchedInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setCofSchedInd(string $value)
    {
        return $this->setParameter('CofSchedInd', $value);
    }
    /**
     * @return bool
     */
    public function validateCofSchedInd()
    {
        $value = $this->getParameter('CofSchedInd');
        $valid = array('Scheduled', 'Unscheduled');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getMCMSDI()
    {
        return $this->getParameter('MCMSDI');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setMCMSDI(string $value)
    {
        return $this->setParameter('MCMSDI', $value);
    }
    /**
     * @return bool
     */
    public function validateMCMSDI()
    {
        $value = $this->getParameter('MCMSDI');
        $valid = array('BillPayment', 'Healthcare', 'Transit', 'EcomAgg', 'B2B', 'Hotel', 'AutoRental');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getBanknetData()
    {
        return $this->getParameter('BanknetData');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setBanknetData(string $value)
    {
        return $this->setParameter('BanknetData', $value);
    }
    /**
     * @return bool
     */
    public function validateBanknetData()
    {
        $value = $this->getParameter('BanknetData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getMCACI()
    {
        return $this->getParameter('MCACI');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setMCACI(string $value)
    {
        return $this->setParameter('MCACI', $value);
    }
    /**
     * @return bool
     */
    public function validateMCACI()
    {
        $value = $this->getParameter('MCACI');
        $valid = array('P', 'I');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getMCAddData()
    {
        return $this->getParameter('MCAddData');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setMCAddData(string $value)
    {
        return $this->setParameter('MCAddData', $value);
    }
    /**
     * @return bool
     */
    public function validateMCAddData()
    {
        $value = $this->getParameter('MCAddData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getFinAuthInd()
    {
        return $this->getParameter('FinAuthInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setFinAuthInd(string $value)
    {
        return $this->setParameter('FinAuthInd', $value);
    }
    /**
     * @return bool
     */
    public function validateFinAuthInd()
    {
        $value = $this->getParameter('FinAuthInd');
        $valid = array('0', '1');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getTranIntgClass()
    {
        return $this->getParameter('TranIntgClass');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setTranIntgClass(string $value)
    {
        return $this->setParameter('TranIntgClass', $value);
    }
    /**
     * @return bool
     */
    public function validateTranIntgClass()
    {
        $value = $this->getParameter('TranIntgClass');
        $valid = array('Checkout', 'Digital', 'EMV', 'Enhanced', 'Generic', 'Keyed', 'Swiped', 'Token', 'Unknown', 'UnknownCNP', 'Validated');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getDiscAuthInd()
    {
        return $this->getParameter('DiscAuthInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setDiscAuthInd(string $value)
    {
        return $this->setParameter('DiscAuthInd', $value);
    }
    /**
     * @return bool
     */
    public function validateDiscAuthInd()
    {
        $value = $this->getParameter('DiscAuthInd');
        $valid = array('ReAuth');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getDiscNRID()
    {
        return $this->getParameter('DiscNRID');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setDiscNRID(string $value)
    {
        return $this->setParameter('DiscNRID', $value);
    }
    /**
     * @return bool
     */
    public function validateDiscNRID()
    {
        $value = $this->getParameter('DiscNRID');
        if (!preg_match('/[0-9A-Za-z]{1,15}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getReAuthInd()
    {
        return $this->getParameter('ReAuthInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setReAuthInd(string $value)
    {
        return $this->setParameter('ReAuthInd', $value);
    }
    /**
     * @return bool
     */
    public function validateReAuthInd()
    {
        $value = $this->getParameter('ReAuthInd');
        $valid = array('Y');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getOrigSTAN()
    {
        return $this->getParameter('OrigSTAN');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setOrigSTAN(string $value)
    {
        return $this->setParameter('OrigSTAN', $value);
    }
    /**
     * @return bool
     */
    public function validateOrigSTAN()
    {
        $value = $this->getParameter('OrigSTAN');
        if (!preg_match('/[0-9]{6,6}/',$value)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getProgramInd()
    {
        return $this->getParameter('ProgramInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setProgramInd(string $value)
    {
        return $this->setParameter('ProgramInd', $value);
    }
    /**
     * @return bool
     */
    public function validateProgramInd()
    {
        $value = $this->getParameter('ProgramInd');
        $valid = array('1', '2', '3', '4', '5', '6');
        return in_array($value, $valid);
    }

    /**
     * @return string
     */
    public function getDelChrgInd()
    {
        return $this->getParameter('DelChrgInd');
    }
    /**
     * @param string $value
     * @return string
     */
    public function setDelChrgInd(string $value)
    {
        return $this->setParameter('DelChrgInd', $value);
    }
    /**
     * @return bool
     */
    public function validateDelChrgInd()
    {
        $value = $this->getParameter('DelChrgInd');
        $valid = array('DelChrg');
        return in_array($value, $valid);
    }
}
