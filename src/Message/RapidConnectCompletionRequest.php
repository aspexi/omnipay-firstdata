<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectCompletionRequest extends RapidConnectCreditRequest
{

	/**
	 * @return string
	 */
	public function getPymntSvc()
	{
		return $this->getParameter('PymntSvc');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setPymntSvc(string $value)
	{
		return $this->setParameter('PymntSvc', $value);
	}


	/**
	 * @return bool
	 */
	public function validatePymntSvc()
	{
		$value = $this->getParameter('PymntSvc');
		$valid = array('Incrmnt');
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
		$valid = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z');
		return in_array($value, $valid);
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
	public function getMCSN()
	{
		return $this->getParameter('MCSN');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMCSN(string $value)
	{
		return $this->setParameter('MCSN', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMCSN()
	{
		$value = $this->getParameter('MCSN');
		if (!preg_match('/[0123456789]{2,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getMCSC()
	{
		return $this->getParameter('MCSC');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setMCSC(string $value)
	{
		return $this->setParameter('MCSC', $value);
	}


	/**
	 * @return bool
	 */
	public function validateMCSC()
	{
		$value = $this->getParameter('MCSC');
		if (!preg_match('/[0123456789]{2,2}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getCardLevelResult()
	{
		return $this->getParameter('CardLevelResult');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCardLevelResult(string $value)
	{
		return $this->setParameter('CardLevelResult', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCardLevelResult()
	{
		$value = $this->getParameter('CardLevelResult');
		return strlen($value) >= 1 && strlen($value) <= 2;
	}


	/**
	 * @return string
	 */
	public function getPartShipInd()
	{
		return $this->getParameter('PartShipInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setPartShipInd(string $value)
	{
		return $this->setParameter('PartShipInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validatePartShipInd()
	{
		$value = $this->getParameter('PartShipInd');
		$valid = array('Partial');
		return in_array($value, $valid);
	}


	/**
	 * @return string
	 */
	public function getCHFullNmRes()
	{
		return $this->getParameter('CHFullNmRes');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCHFullNmRes(string $value)
	{
		return $this->setParameter('CHFullNmRes', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCHFullNmRes()
	{
		$value = $this->getParameter('CHFullNmRes');
		$valid = array('M', 'F', 'L', 'N', 'W', 'U', 'P', 'K', 'B');
		return in_array($value, $valid);
	}


	/**
	 * @return \SimpleXMLElement
	 */
	function getData()
	{
		$xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Request
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema" Version="3" ClientTimeout="30"
    xmlns="http://securetransport.dw/rcservice/xml">
    <ReqClientID>
        <DID></DID>
        <App></App>
        <Auth></Auth>
        <ClientRef></ClientRef>
    </ReqClientID>
    <Transaction>
        <ServiceID></ServiceID>
        <Payload></Payload>
    </Transaction>
</Request>
XML;
		$data = new \SimpleXMLElement($xml);
		$data->ReqClientID->DID = $this->getDID();
		$data->ReqClientID->APP = $this->getApp();
		$data->ReqClientID->ClientRef = $this->getClientRef();
		$data->Transaction->ServiceID = $this->getServiceID();

		$this->addCommonGroup($data);
		$this->addBillPaymentGroup($data);
		$this->addCardGroup($data);
		$this->addPinGroup($data);
		$this->addEcommGroup($data);
		$this->addVisaGroup($data);
		$this->addMastercardGroup($data);
		$this->addDiscoverGroup($data);
		$this->addAmexGroup($data);
		$this->addCustomerInfoGroup($data);
		$this->addOrderGroup($data);
		$this->addResponseGroup($data);
		$this->addOriginalAuthorizationGroup($data);
		$this->addProductCodeGroup($data);
		$this->addFileDownloadGroup($data);
		$this->addLodgingGroup($data);
		$this->addAutoRentalGroup($data);

		return $data;
	}


	function sendData($data)
	{
		$headers = array(
		    "Connection" => "keep-alive",
		    "Cache-Control" => "no-cache",
		    "Content-Type" => "text/xml"
		);
		$data = $data->saveXml();
		$httpResponse = $this->httpClient->request("POST", $this->getEndpoint(), $headers, $data);

		return $this->response = new RapidConnectResponse($this, $httpResponse->getBody()->getContents());
	}

    /**
     * @param \SimpleXMLElement $data
     */
    public function addCommonGroup(\SimpleXMLElement $data)
    {
        // Mandatory
        if (!$this->validatePymtType()) {
            throw new InvalidRequestException("Invalid payment type");
        }
        $data->CommonGrp->PymtType = $this->getPymtType();

        // Mandatory
        if (!$this->validateTxnType()) {
            throw new InvalidRequestException("Invalid transaction type");
        }
        $data->CommonGrp->TxnType = $this->getTxnType();

        // Mandatory
        if (!$this->validateLocalDateTime()) {
            throw new InvalidRequestException("Invalid local date and time");
        }
        $data->CommonGrp->LocalDateTime = $this->getLocalDateTime();

        // Mandatory
        if (!$this->validateTrnmsnDateTime()) {
            throw new InvalidRequestException("Invalid transmission date and time");
        }
        $data->CommonGrp->TrnmsnDateTime = $this->getTrnmsnDateTime();

        // Mandatory
        if (!$this->validateSTAN()) {
            throw new InvalidRequestException("Invalid stan");
        }
        $data->CommonGrp->STAN = $this->getSTAN();

        // Mandatory
        if (!$this->validateRefNum()) {
            throw new InvalidRequestException("Invalid reference number");
        }
        $data->CommonGrp->RefNum = $this->getRefNum();

        // Conditional
        if ($this->getOrderNum() !== null) {
            if (!$this->validateOrderNum()) {
                throw new InvalidRequestException("Invalid order number");
            }
            $data->CommonGrp->OrderNum = $this->getOrderNum();
        }

        // Mandatory
        if (!$this->validateTPPID()) {
            throw new InvalidRequestException("Invalid tpp id");
        }
        $data->CommonGrp->TPPID = $this->getTPPID();

        // Mandatory
        if (!$this->validateTermID()) {
            throw new InvalidRequestException("Invalid terminal id");
        }
        $data->CommonGrp->TermID = $this->getTermID();

        // Mandatory
        if (!$this->validateMerchID()) {
            throw new InvalidRequestException("Invalid merchant id");
        }
        $data->CommonGrp->MerchID = $this->getMerchID();

        // Conditional
        if ($this->getMerchCatCode() !== null) {
            if (!$this->validateMerchCatCode()) {
                throw new InvalidRequestException("Invalid merchant category code");
            }
            $data->CommonGrp->MerchCatCode = $this->getMerchCatCode();
        }

        // Mandatory
        if (!$this->validatePOSEntryMode()) {
            throw new InvalidRequestException("Invalid pos entry mode");
        }
        $data->CommonGrp->POSEntryMode = $this->getPOSEntryMode();

        // Mandatory
        if (!$this->validatePOSCondCode()) {
            throw new InvalidRequestException("Invalid pos condition code");
        }
        $data->CommonGrp->POSCondCode = $this->getPOSCondCode();

        // Mandatory
        if (!$this->validateTermCatCode()) {
            throw new InvalidRequestException("Invalid terminal category code");
        }
        $data->CommonGrp->TermCatCode = $this->getTermCatCode();

        // Mandatory
        if (!$this->validateTermEntryCapablt()) {
            throw new InvalidRequestException("Invalid terminal entry capability");
        }
        $data->CommonGrp->TermEntryCapablt = $this->getTermEntryCapablt();

        // Mandatory
        if (!$this->validateTxnAmt()) {
            throw new InvalidRequestException("Invalid transaction amount");
        }
        $data->CommonGrp->TxnAmt = $this->getTxnAmt();

        // Mandatory
        if (!$this->validateTxnCrncy()) {
            throw new InvalidRequestException("Invalid transaction currency");
        }
        $data->CommonGrp->TxnCrncy = $this->getTxnCrncy();

        // Mandatory
        if (!$this->validateTermLocInd()) {
            throw new InvalidRequestException("Invalid terminal location indicator");
        }
        $data->CommonGrp->TermLocInd = $this->getTermLocInd();

        // Mandatory
        if (!$this->validateCardCaptCap()) {
            throw new InvalidRequestException("Invalid card capture capability");
        }
        $data->CommonGrp->CardCaptCap = $this->getCardCaptCap();

        // Mandatory
        if (!$this->validateGroupID()) {
            throw new InvalidRequestException("Invalid group id");
        }
        $data->CommonGrp->GroupID = $this->getGroupID();

        // Conditional
        if ($this->getPOSID() !== null) {
            if (!$this->validatePOSID()) {
                throw new InvalidRequestException("Invalid pos id");
            }
            $data->CommonGrp->POSID = $this->getPOSID();
        }

        // Conditional
        if ($this->getClerkID() !== null) {
            if (!$this->validateClerkID()) {
                throw new InvalidRequestException("Invalid clerk id");
            }
            $data->CommonGrp->ClerkID = $this->getClerkID();
        }

        // Conditional
        if ($this->getSENum() !== null) {
            if (!$this->validateSENum()) {
                throw new InvalidRequestException("Invalid service entitlement number");
            }
            $data->CommonGrp->SENum = $this->getSENum();
        }

        // Conditional
        if ($this->getNetAccInd() !== null) {
            if (!$this->validateNetAccInd()) {
                throw new InvalidRequestException("Invalid network access indicator");
            }
            $data->CommonGrp->NetAccInd = $this->getNetAccInd();
        }

        // Optional
        if ($this->getMerchEcho() !== null) {
            if (!$this->validateMerchEcho()) {
                throw new InvalidRequestException("Invalid merchant echo");
            }
            $data->CommonGrp->MerchEcho = $this->getMerchEcho();
        }

        // Conditional
        if ($this->getWltID() !== null) {
            if (!$this->validateWltID()) {
                throw new InvalidRequestException("Invalid wallet identifier");
            }
            $data->CommonGrp->WltID = $this->getWltID();
        }

        // Conditional
        if ($this->getNonUSMerch() !== null) {
            if (!$this->validateNonUSMerch()) {
                throw new InvalidRequestException("Invalid non us merchant");
            }
            $data->CommonGrp->NonUSMerch = $this->getNonUSMerch();
        }

        // Conditional
        if ($this->getDevBatchID() !== null) {
            if (!$this->validateDevBatchID()) {
                throw new InvalidRequestException("Invalid device batch id");
            }
            $data->CommonGrp->DevBatchID = $this->getDevBatchID();
        }

        // Conditional
        if ($this->getDigWltInd() !== null) {
            if (!$this->validateDigWltInd()) {
                throw new InvalidRequestException("Invalid digital wallet indicator");
            }
            $data->CommonGrp->DigWltInd = $this->getDigWltInd();
        }

        // Conditional
        if ($this->getDigWltProgType() !== null) {
            if (!$this->validateDigWltProgType()) {
                throw new InvalidRequestException("Invalid digital wallet program type");
            }
            $data->CommonGrp->DigWltProgType = $this->getDigWltProgType();
        }

        // Conditional
        if ($this->getTranInit() !== null) {
            if (!$this->validateTranInit()) {
                throw new InvalidRequestException("Invalid transaction initiation");
            }
            $data->CommonGrp->TranInit = $this->getTranInit();
        }

        // Conditional
        if ($this->getPymntSvc() !== null) {
            if (!$this->validatePymntSvc()) {
                throw new InvalidRequestException("Invalid payment service");
            }
            $data->CommonGrp->PymntSvc = $this->getPymntSvc();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addBillPaymentGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getBillPymtTxnInd() !== null) {
            if (!$this->validateBillPymtTxnInd()) {
                throw new InvalidRequestException("Invalid bill payment transaction
		indicator");
            }
            $data->BillPayGrp->BillPymtTxnInd = $this->getBillPymtTxnInd();
        }

        // Conditional
        if ($this->getInstallInvNum() !== null) {
            if (!$this->validateInstallInvNum()) {
                throw new InvalidRequestException("Invalid installment payment invoice
		number");
            }
            $data->BillPayGrp->InstallInvNum = $this->getInstallInvNum();
        }

        // Conditional
        if ($this->getInstallPymntDesc() !== null) {
            if (!$this->validateInstallPymntDesc()) {
                throw new InvalidRequestException("Invalid installment payment description");
            }
            $data->BillPayGrp->InstallPymntDesc = $this->getInstallPymntDesc();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addCardGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getAcctNum() !== null) {
            if (!$this->validateAcctNum()) {
                throw new InvalidRequestException("Invalid account number");
            }
            $data->CardGrp->AcctNum = $this->getAcctNum();
        }

        // Conditional
        if ($this->getCardExpiryDate() !== null) {
            if (!$this->validateCardExpiryDate()) {
                throw new InvalidRequestException("Invalid card expiration date");
            }
            $data->CardGrp->CardExpiryDate = $this->getCardExpiryDate();
        }

        // Conditional
        if ($this->getCardType() !== null) {
            if (!$this->validateCardType()) {
                throw new InvalidRequestException("Invalid card type");
            }
            $data->CardGrp->CardType = $this->getCardType();
        }

        // Conditional
        if ($this->getAVSResultCode() !== null) {
            if (!$this->validateAVSResultCode()) {
                throw new InvalidRequestException("Invalid avs result code");
            }
            $data->CardGrp->AVSResultCode = $this->getAVSResultCode();
        }

        // Conditional
        if ($this->getCCVResultCode() !== null) {
            if (!$this->validateCCVResultCode()) {
                throw new InvalidRequestException("Invalid ccv result code");
            }
            $data->CardGrp->CCVResultCode = $this->getCCVResultCode();
        }

        // Conditional
        if ($this->getMVVMAID() !== null) {
            if (!$this->validateMVVMAID()) {
                throw new InvalidRequestException("Invalid mvv/maid");
            }
            $data->CardGrp->MVVMAID = $this->getMVVMAID();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addPinGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addEcommGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getEcommTxnInd() !== null) {
            if (!$this->validateEcommTxnInd()) {
                throw new InvalidRequestException("Invalid ecomm transaction indicator");
            }
            $data->EcommGrp->EcommTxnInd = $this->getEcommTxnInd();
        }

        // Conditional
        if ($this->getCustSvcPhoneNumber() !== null) {
            if (!$this->validateCustSvcPhoneNumber()) {
                throw new InvalidRequestException("Invalid customer service phone number");
            }
            $data->EcommGrp->CustSvcPhoneNumber = $this->getCustSvcPhoneNumber();
        }

        // Conditional
        if ($this->getEcommURL() !== null) {
            if (!$this->validateEcommURL()) {
                throw new InvalidRequestException("Invalid ecomm url");
            }
            $data->EcommGrp->EcommURL = $this->getEcommURL();
        }

        // Conditional
        if ($this->getMCSN() !== null) {
            if (!$this->validateMCSN()) {
                throw new InvalidRequestException("Invalid multiple clearing sequence
		number");
            }
            $data->EcommGrp->MCSN = $this->getMCSN();
        }

        // Conditional
        if ($this->getMCSC() !== null) {
            if (!$this->validateMCSC()) {
                throw new InvalidRequestException("Invalid multiple clearing sequence count");
            }
            $data->EcommGrp->MCSC = $this->getMCSC();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addVisaGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getACI() !== null) {
            if (!$this->validateACI()) {
                throw new InvalidRequestException("Invalid authorization characteristics
		indicator (aci)");
            }
            $data->VisaGrp->ACI = $this->getACI();
        }

        // Conditional
        if ($this->getMrktSpecificDataInd() !== null) {
            if (!$this->validateMrktSpecificDataInd()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->VisaGrp->MrktSpecificDataInd = $this->getMrktSpecificDataInd();
        }

        // Conditional
        if ($this->getCardLevelResult() !== null) {
            if (!$this->validateCardLevelResult()) {
                throw new InvalidRequestException("Invalid card level result code");
            }
            $data->VisaGrp->CardLevelResult = $this->getCardLevelResult();
        }

        // Conditional
        if ($this->getTransID() !== null) {
            if (!$this->validateTransID()) {
                throw new InvalidRequestException("Invalid transaction identifier");
            }
            $data->VisaGrp->TransID = $this->getTransID();
        }

        // Conditional
        if ($this->getVisaBID() !== null) {
            if (!$this->validateVisaBID()) {
                throw new InvalidRequestException("Invalid visa bid");
            }
            $data->VisaGrp->VisaBID = $this->getVisaBID();
        }

        // Conditional
        if ($this->getVisaAUAR() !== null) {
            if (!$this->validateVisaAUAR()) {
                throw new InvalidRequestException("Invalid visa auar");
            }
            $data->VisaGrp->VisaAUAR = $this->getVisaAUAR();
        }

        // Conditional
        if ($this->getSpendQInd() !== null) {
            if (!$this->validateSpendQInd()) {
                throw new InvalidRequestException("Invalid spend qualified indicator");
            }
            $data->VisaGrp->SpendQInd = $this->getSpendQInd();
        }

        // Conditional
        if ($this->getVisaAuthInd() !== null) {
            if (!$this->validateVisaAuthInd()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->VisaGrp->VisaAuthInd = $this->getVisaAuthInd();
        }

        // Conditional
        if ($this->getMrktSpecificDataInd() !== null) {
            if (!$this->validateMrktSpecificDataInd()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->VisaGrp->MrktSpecificDataInd = $this->getMrktSpecificDataInd();
        }

        // Conditional
        if ($this->getVisaAuthInd() !== null) {
            if (!$this->validateVisaAuthInd()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->VisaGrp->VisaAuthInd = $this->getVisaAuthInd();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addMastercardGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getMCMSDI() !== null) {
            if (!$this->validateMCMSDI()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->MCGrp->MCMSDI = $this->getMCMSDI();
        }

        // Conditional
        if ($this->getBanknetData() !== null) {
            if (!$this->validateBanknetData()) {
                throw new InvalidRequestException("Invalid banknet data");
            }
            $data->MCGrp->BanknetData = $this->getBanknetData();
        }

        // Conditional
        if ($this->getMCMSDI() !== null) {
            if (!$this->validateMCMSDI()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->MCGrp->MCMSDI = $this->getMCMSDI();
        }

        // Conditional
        if ($this->getCCVErrorCode() !== null) {
            if (!$this->validateCCVErrorCode()) {
                throw new InvalidRequestException("Invalid ccv error code");
            }
            $data->MCGrp->CCVErrorCode = $this->getCCVErrorCode();
        }

        // Conditional
        if ($this->getPOSEntryModeChg() !== null) {
            if (!$this->validatePOSEntryModeChg()) {
                throw new InvalidRequestException("Invalid pos entry mode change");
            }
            $data->MCGrp->POSEntryModeChg = $this->getPOSEntryModeChg();
        }

        // Conditional
        if ($this->getDevTypeInd() !== null) {
            if (!$this->validateDevTypeInd()) {
                throw new InvalidRequestException("Invalid device type indicator");
            }
            $data->MCGrp->DevTypeInd = $this->getDevTypeInd();
        }

        // Conditional
        if ($this->getMCAddData() !== null) {
            if (!$this->validateMCAddData()) {
                throw new InvalidRequestException("Invalid mastercard additional data");
            }
            $data->MCGrp->MCAddData = $this->getMCAddData();
        }

        // Conditional
        if ($this->getTranIntgClass() !== null) {
            if (!$this->validateTranIntgClass()) {
                throw new InvalidRequestException("Invalid transaction integrity class");
            }
            $data->MCGrp->TranIntgClass = $this->getTranIntgClass();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addDiscoverGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getDiscProcCode() !== null) {
            if (!$this->validateDiscProcCode()) {
                throw new InvalidRequestException("Invalid discover processing code");
            }
            $data->DSGrp->DiscProcCode = $this->getDiscProcCode();
        }

        // Conditional
        if ($this->getDiscPOSEntry() !== null) {
            if (!$this->validateDiscPOSEntry()) {
                throw new InvalidRequestException("Invalid discover pos entry mode");
            }
            $data->DSGrp->DiscPOSEntry = $this->getDiscPOSEntry();
        }

        // Conditional
        if ($this->getDiscRespCode() !== null) {
            if (!$this->validateDiscRespCode()) {
                throw new InvalidRequestException("Invalid discover response code");
            }
            $data->DSGrp->DiscRespCode = $this->getDiscRespCode();
        }

        // Conditional
        if ($this->getDiscPOSData() !== null) {
            if (!$this->validateDiscPOSData()) {
                throw new InvalidRequestException("Invalid discover pos data");
            }
            $data->DSGrp->DiscPOSData = $this->getDiscPOSData();
        }

        // Conditional
        if ($this->getDiscTransQualifier() !== null) {
            if (!$this->validateDiscTransQualifier()) {
                throw new InvalidRequestException("Invalid discover transaction qualifier");
            }
            $data->DSGrp->DiscTransQualifier = $this->getDiscTransQualifier();
        }

        // Conditional
        if ($this->getDiscNRID() !== null) {
            if (!$this->validateDiscNRID()) {
                throw new InvalidRequestException("Invalid discover nrid");
            }
            $data->DSGrp->DiscNRID = $this->getDiscNRID();
        }

        // Conditional
        if ($this->getMOTOInd() !== null) {
            if (!$this->validateMOTOInd()) {
                throw new InvalidRequestException("Invalid moto indicator");
            }
            $data->DSGrp->MOTOInd = $this->getMOTOInd();
        }

        // Conditional
        if ($this->getRegUserInd() !== null) {
            if (!$this->validateRegUserInd()) {
                throw new InvalidRequestException("Invalid registered user indicator");
            }
            $data->DSGrp->RegUserInd = $this->getRegUserInd();
        }

        // Conditional
        if ($this->getRegUserDate() !== null) {
            if (!$this->validateRegUserDate()) {
                throw new InvalidRequestException("Invalid registered user profile change
		date");
            }
            $data->DSGrp->RegUserDate = $this->getRegUserDate();
        }

        // Conditional
        if ($this->getPartShipInd() !== null) {
            if (!$this->validatePartShipInd()) {
                throw new InvalidRequestException("Invalid partial shipment indicator");
            }
            $data->DSGrp->PartShipInd = $this->getPartShipInd();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addAmexGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getAmExPOSData() !== null) {
            if (!$this->validateAmExPOSData()) {
                throw new InvalidRequestException("Invalid am ex pos data");
            }
            $data->AmexGrp->AmExPOSData = $this->getAmExPOSData();
        }

        // Conditional
        if ($this->getAmExTranID() !== null) {
            if (!$this->validateAmExTranID()) {
                throw new InvalidRequestException("Invalid am ex tran id");
            }
            $data->AmexGrp->AmExTranID = $this->getAmExTranID();
        }

        // Conditional
        if ($this->getGdSoldCd() !== null) {
            if (!$this->validateGdSoldCd()) {
                throw new InvalidRequestException("Invalid goods sold code");
            }
            $data->AmexGrp->GdSoldCd = $this->getGdSoldCd();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addCustomerInfoGroup(\SimpleXMLElement $data)
    {
        // Optional
        if ($this->getAVSBillingAddr() !== null) {
            if (!$this->validateAVSBillingAddr()) {
                throw new InvalidRequestException("Invalid avs/billing address");
            }
            $data->CustInfoGrp->AVSBillingAddr = $this->getAVSBillingAddr();
        }

        // Optional
        if ($this->getAVSBillingPostalCode() !== null) {
            if (!$this->validateAVSBillingPostalCode()) {
                throw new InvalidRequestException("Invalid avs/billing postal code");
            }
            $data->CustInfoGrp->AVSBillingPostalCode = $this->getAVSBillingPostalCode();
        }

        // Conditional
        if ($this->getCHFirstNm() !== null) {
            if (!$this->validateCHFirstNm()) {
                throw new InvalidRequestException("Invalid card holder first name");
            }
            $data->CustInfoGrp->CHFirstNm = $this->getCHFirstNm();
        }

        // Conditional
        if ($this->getCHLastNm() !== null) {
            if (!$this->validateCHLastNm()) {
                throw new InvalidRequestException("Invalid card holder last name");
            }
            $data->CustInfoGrp->CHLastNm = $this->getCHLastNm();
        }

        // Conditional
        if ($this->getCHFullNmRes() !== null) {
            if (!$this->validateCHFullNmRes()) {
                throw new InvalidRequestException("Invalid card holder full name result");
            }
            $data->CustInfoGrp->CHFullNmRes = $this->getCHFullNmRes();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addOrderGroup(\SimpleXMLElement $data)
    {
        // Optional
        if ($this->getOrderDate() !== null) {
            if (!$this->validateOrderDate()) {
                throw new InvalidRequestException("Invalid order date");
            }
            $data->OrderGrp->OrderDate = $this->getOrderDate();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addResponseGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addOriginalAuthorizationGroup(\SimpleXMLElement $data)
    {
        // Mandatory
        if (!$this->validateOrigAuthID()) {
            throw new InvalidRequestException("Invalid original authorization id");
        }
        $data->OrigAuthGrp->OrigAuthID = $this->getOrigAuthID();

        // Mandatory
        if (!$this->validateOrigLocalDateTime()) {
            throw new InvalidRequestException("Invalid original local date and time");
        }
        $data->OrigAuthGrp->OrigLocalDateTime = $this->getOrigLocalDateTime();

        // Mandatory
        if (!$this->validateOrigTranDateTime()) {
            throw new InvalidRequestException("Invalid original transmission date and
		time");
        }
        $data->OrigAuthGrp->OrigTranDateTime = $this->getOrigTranDateTime();

        // Mandatory
        if (!$this->validateOrigSTAN()) {
            throw new InvalidRequestException("Invalid original stan");
        }
        $data->OrigAuthGrp->OrigSTAN = $this->getOrigSTAN();

        // Mandatory
        if (!$this->validateOrigRespCode()) {
            throw new InvalidRequestException("Invalid original response code");
        }
        $data->OrigAuthGrp->OrigRespCode = $this->getOrigRespCode();

        // Conditional
        if ($this->getOrigAthNtwkID() !== null) {
            if (!$this->validateOrigAthNtwkID()) {
                throw new InvalidRequestException("Invalid original authorizing network id");
            }
            $data->OrigAuthGrp->OrigAthNtwkID = $this->getOrigAthNtwkID();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addProductCodeGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getServLvl() !== null) {
            if (!$this->validateServLvl()) {
                throw new InvalidRequestException("Invalid service level");
            }
            $data->ProdCodeGrp->ServLvl = $this->getServLvl();
        }

        // Conditional
        if ($this->getNumOfProds() !== null) {
            if (!$this->validateNumOfProds()) {
                throw new InvalidRequestException("Invalid number of products");
            }
            $data->ProdCodeGrp->NumOfProds = $this->getNumOfProds();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addFileDownloadGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addLodgingGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addAutoRentalGroup(\SimpleXMLElement $data)
    {
    }
}
