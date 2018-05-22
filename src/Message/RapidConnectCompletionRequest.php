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
		if (!$this->validatePaymentType()) {
		    throw new InvalidRequestException("Invalid payment type");
		}
		$data->CommonGrp->PymtType = $this->getPaymentType();

		// Mandatory
		if (!$this->validateTransactionType()) {
		    throw new InvalidRequestException("Invalid transaction type");
		}
		$data->CommonGrp->TxnType = $this->getTransactionType();

		// Mandatory
		if (!$this->validateLocalDateandTime()) {
		    throw new InvalidRequestException("Invalid local date and time");
		}
		$data->CommonGrp->LocalDateTime = $this->getLocalDateandTime();

		// Mandatory
		if (!$this->validateTransmissionDateandTime()) {
		    throw new InvalidRequestException("Invalid transmission date and time");
		}
		$data->CommonGrp->TrnmsnDateTime = $this->getTransmissionDateandTime();

		// Mandatory
		if (!$this->validateSTAN()) {
		    throw new InvalidRequestException("Invalid stan");
		}
		$data->CommonGrp->STAN = $this->getSTAN();

		// Mandatory
		if (!$this->validateReferenceNumber()) {
		    throw new InvalidRequestException("Invalid reference number");
		}
		$data->CommonGrp->RefNum = $this->getReferenceNumber();

		// Conditional
		if ($this->getOrderNumber() !== null) {
		if (!$this->validateOrderNumber()) {
		    throw new InvalidRequestException("Invalid order number");
		}
		$data->CommonGrp->OrderNum = $this->getOrderNumber();
		}

		// Mandatory
		if (!$this->validateTPPID()) {
		    throw new InvalidRequestException("Invalid tpp id");
		}
		$data->CommonGrp->TPPID = $this->getTPPID();

		// Mandatory
		if (!$this->validateTerminalID()) {
		    throw new InvalidRequestException("Invalid terminal id");
		}
		$data->CommonGrp->TermID = $this->getTerminalID();

		// Mandatory
		if (!$this->validateMerchantID()) {
		    throw new InvalidRequestException("Invalid merchant id");
		}
		$data->CommonGrp->MerchID = $this->getMerchantID();

		// Conditional
		if ($this->getMerchantCategoryCode() !== null) {
		if (!$this->validateMerchantCategoryCode()) {
		    throw new InvalidRequestException("Invalid merchant category code");
		}
		$data->CommonGrp->MerchCatCode = $this->getMerchantCategoryCode();
		}

		// Mandatory
		if (!$this->validatePOSEntryMode()) {
		    throw new InvalidRequestException("Invalid pos entry mode");
		}
		$data->CommonGrp->POSEntryMode = $this->getPOSEntryMode();

		// Mandatory
		if (!$this->validatePOSConditionCode()) {
		    throw new InvalidRequestException("Invalid pos condition code");
		}
		$data->CommonGrp->POSCondCode = $this->getPOSConditionCode();

		// Mandatory
		if (!$this->validateTerminalCategoryCode()) {
		    throw new InvalidRequestException("Invalid terminal category code");
		}
		$data->CommonGrp->TermCatCode = $this->getTerminalCategoryCode();

		// Mandatory
		if (!$this->validateTerminalEntryCapability()) {
		    throw new InvalidRequestException("Invalid terminal entry capability");
		}
		$data->CommonGrp->TermEntryCapablt = $this->getTerminalEntryCapability();

		// Mandatory
		if (!$this->validateTransactionAmount()) {
		    throw new InvalidRequestException("Invalid transaction amount");
		}
		$data->CommonGrp->TxnAmt = $this->getTransactionAmount();

		// Mandatory
		if (!$this->validateTransactionCurrency()) {
		    throw new InvalidRequestException("Invalid transaction currency");
		}
		$data->CommonGrp->TxnCrncy = $this->getTransactionCurrency();

		// Mandatory
		if (!$this->validateTerminalLocationIndicator()) {
		    throw new InvalidRequestException("Invalid terminal location indicator");
		}
		$data->CommonGrp->TermLocInd = $this->getTerminalLocationIndicator();

		// Mandatory
		if (!$this->validateCardCaptureCapability()) {
		    throw new InvalidRequestException("Invalid card capture capability");
		}
		$data->CommonGrp->CardCaptCap = $this->getCardCaptureCapability();

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
		if ($this->getServiceEntitlementNumber() !== null) {
		if (!$this->validateServiceEntitlementNumber()) {
		    throw new InvalidRequestException("Invalid service entitlement number");
		}
		$data->CommonGrp->SENum = $this->getServiceEntitlementNumber();
		}

		// Conditional
		if ($this->getNetworkAccessIndicator() !== null) {
		if (!$this->validateNetworkAccessIndicator()) {
		    throw new InvalidRequestException("Invalid network access indicator");
		}
		$data->CommonGrp->NetAccInd = $this->getNetworkAccessIndicator();
		}

		// Optional
		if ($this->getMerchantEcho() !== null) {
		if (!$this->validateMerchantEcho()) {
		    throw new InvalidRequestException("Invalid merchant echo");
		}
		$data->CommonGrp->MerchEcho = $this->getMerchantEcho();
		}

		// Conditional
		if ($this->getWalletIdentifier() !== null) {
		if (!$this->validateWalletIdentifier()) {
		    throw new InvalidRequestException("Invalid wallet identifier");
		}
		$data->CommonGrp->WltID = $this->getWalletIdentifier();
		}

		// Conditional
		if ($this->getNonUSMerchant() !== null) {
		if (!$this->validateNonUSMerchant()) {
		    throw new InvalidRequestException("Invalid non us merchant");
		}
		$data->CommonGrp->NonUSMerch = $this->getNonUSMerchant();
		}

		// Conditional
		if ($this->getDeviceBatchID() !== null) {
		if (!$this->validateDeviceBatchID()) {
		    throw new InvalidRequestException("Invalid device batch id");
		}
		$data->CommonGrp->DevBatchID = $this->getDeviceBatchID();
		}

		// Conditional
		if ($this->getDigitalWalletIndicator() !== null) {
		if (!$this->validateDigitalWalletIndicator()) {
		    throw new InvalidRequestException("Invalid digital wallet indicator");
		}
		$data->CommonGrp->DigWltInd = $this->getDigitalWalletIndicator();
		}

		// Conditional
		if ($this->getDigitalWalletProgramType() !== null) {
		if (!$this->validateDigitalWalletProgramType()) {
		    throw new InvalidRequestException("Invalid digital wallet program type");
		}
		$data->CommonGrp->DigWltProgType = $this->getDigitalWalletProgramType();
		}

		// Conditional
		if ($this->getTransactionInitiation() !== null) {
		if (!$this->validateTransactionInitiation()) {
		    throw new InvalidRequestException("Invalid transaction initiation");
		}
		$data->CommonGrp->TranInit = $this->getTransactionInitiation();
		}

		// Conditional
		if ($this->getPaymentService() !== null) {
		if (!$this->validatePaymentService()) {
		    throw new InvalidRequestException("Invalid payment service");
		}
		$data->CommonGrp->PymntSvc = $this->getPaymentService();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addBillPaymentGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getBillPaymentTransactionIndicator() !== null) {
		if (!$this->validateBillPaymentTransactionIndicator()) {
		    throw new InvalidRequestException("Invalid bill payment transaction
		indicator");
		}
		$data->BillPayGrp->BillPymtTxnInd = $this->getBillPaymentTransactionIndicator();
		}

		// Conditional
		if ($this->getInstallmentPaymentInvoiceNumber() !== null) {
		if (!$this->validateInstallmentPaymentInvoiceNumber()) {
		    throw new InvalidRequestException("Invalid installment payment invoice
		number");
		}
		$data->BillPayGrp->InstallInvNum = $this->getInstallmentPaymentInvoiceNumber();
		}

		// Conditional
		if ($this->getInstallmentPaymentDescription() !== null) {
		if (!$this->validateInstallmentPaymentDescription()) {
		    throw new InvalidRequestException("Invalid installment payment description");
		}
		$data->BillPayGrp->InstallPymntDesc = $this->getInstallmentPaymentDescription();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addCardGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getAccountNumber() !== null) {
		if (!$this->validateAccountNumber()) {
		    throw new InvalidRequestException("Invalid account number");
		}
		$data->CardGrp->AcctNum = $this->getAccountNumber();
		}

		// Conditional
		if ($this->getCardExpirationDate() !== null) {
		if (!$this->validateCardExpirationDate()) {
		    throw new InvalidRequestException("Invalid card expiration date");
		}
		$data->CardGrp->CardExpiryDate = $this->getCardExpirationDate();
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
		if ($this->getEcommTransactionIndicator() !== null) {
		if (!$this->validateEcommTransactionIndicator()) {
		    throw new InvalidRequestException("Invalid ecomm transaction indicator");
		}
		$data->EcommGrp->EcommTxnInd = $this->getEcommTransactionIndicator();
		}

		// Conditional
		if ($this->getCustomerServicePhoneNumber() !== null) {
		if (!$this->validateCustomerServicePhoneNumber()) {
		    throw new InvalidRequestException("Invalid customer service phone number");
		}
		$data->EcommGrp->CustSvcPhoneNumber = $this->getCustomerServicePhoneNumber();
		}

		// Conditional
		if ($this->getEcommURL() !== null) {
		if (!$this->validateEcommURL()) {
		    throw new InvalidRequestException("Invalid ecomm url");
		}
		$data->EcommGrp->EcommURL = $this->getEcommURL();
		}

		// Conditional
		if ($this->getMultipleClearingSequenceNumber() !== null) {
		if (!$this->validateMultipleClearingSequenceNumber()) {
		    throw new InvalidRequestException("Invalid multiple clearing sequence
		number");
		}
		$data->EcommGrp->MCSN = $this->getMultipleClearingSequenceNumber();
		}

		// Conditional
		if ($this->getMultipleClearingSequenceCount() !== null) {
		if (!$this->validateMultipleClearingSequenceCount()) {
		    throw new InvalidRequestException("Invalid multiple clearing sequence count");
		}
		$data->EcommGrp->MCSC = $this->getMultipleClearingSequenceCount();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addVisaGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getAuthorizationCharacteristicsIndicatorACI() !== null) {
		if (!$this->validateAuthorizationCharacteristicsIndicatorACI()) {
		    throw new InvalidRequestException("Invalid authorization characteristics
		indicator (aci)");
		}
		$data->VisaGrp->ACI = $this->getAuthorizationCharacteristicsIndicatorACI();
		}

		// Conditional
		if ($this->getMarketSpecificDataIndicator() !== null) {
		if (!$this->validateMarketSpecificDataIndicator()) {
		    throw new InvalidRequestException("Invalid market specific data indicator");
		}
		$data->VisaGrp->MrktSpecificDataInd = $this->getMarketSpecificDataIndicator();
		}

		// Conditional
		if ($this->getCardLevelResultCode() !== null) {
		if (!$this->validateCardLevelResultCode()) {
		    throw new InvalidRequestException("Invalid card level result code");
		}
		$data->VisaGrp->CardLevelResult = $this->getCardLevelResultCode();
		}

		// Conditional
		if ($this->getTransactionIdentifier() !== null) {
		if (!$this->validateTransactionIdentifier()) {
		    throw new InvalidRequestException("Invalid transaction identifier");
		}
		$data->VisaGrp->TransID = $this->getTransactionIdentifier();
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
		if ($this->getSpendQualifiedIndicator() !== null) {
		if (!$this->validateSpendQualifiedIndicator()) {
		    throw new InvalidRequestException("Invalid spend qualified indicator");
		}
		$data->VisaGrp->SpendQInd = $this->getSpendQualifiedIndicator();
		}

		// Conditional
		if ($this->getAuthIndicator() !== null) {
		if (!$this->validateAuthIndicator()) {
		    throw new InvalidRequestException("Invalid auth indicator");
		}
		$data->VisaGrp->VisaAuthInd = $this->getAuthIndicator();
		}

		// Conditional
		if ($this->getMarketSpecificDataIndicator() !== null) {
		if (!$this->validateMarketSpecificDataIndicator()) {
		    throw new InvalidRequestException("Invalid market specific data indicator");
		}
		$data->VisaGrp->MrktSpecificDataInd = $this->getMarketSpecificDataIndicator();
		}

		// Conditional
		if ($this->getAuthIndicator() !== null) {
		if (!$this->validateAuthIndicator()) {
		    throw new InvalidRequestException("Invalid auth indicator");
		}
		$data->VisaGrp->VisaAuthInd = $this->getAuthIndicator();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addMastercardGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getMarketSpecificDataIndicator() !== null) {
		if (!$this->validateMarketSpecificDataIndicator()) {
		    throw new InvalidRequestException("Invalid market specific data indicator");
		}
		$data->MCGrp->MCMSDI = $this->getMarketSpecificDataIndicator();
		}

		// Conditional
		if ($this->getBankNetData() !== null) {
		if (!$this->validateBankNetData()) {
		    throw new InvalidRequestException("Invalid banknet data");
		}
		$data->MCGrp->BanknetData = $this->getBankNetData();
		}

		// Conditional
		if ($this->getMarketSpecificDataIndicator() !== null) {
		if (!$this->validateMarketSpecificDataIndicator()) {
		    throw new InvalidRequestException("Invalid market specific data indicator");
		}
		$data->MCGrp->MCMSDI = $this->getMarketSpecificDataIndicator();
		}

		// Conditional
		if ($this->getCCVErrorCode() !== null) {
		if (!$this->validateCCVErrorCode()) {
		    throw new InvalidRequestException("Invalid ccv error code");
		}
		$data->MCGrp->CCVErrorCode = $this->getCCVErrorCode();
		}

		// Conditional
		if ($this->getPOSEntryModeChange() !== null) {
		if (!$this->validatePOSEntryModeChange()) {
		    throw new InvalidRequestException("Invalid pos entry mode change");
		}
		$data->MCGrp->POSEntryModeChg = $this->getPOSEntryModeChange();
		}

		// Conditional
		if ($this->getDeviceTypeIndicator() !== null) {
		if (!$this->validateDeviceTypeIndicator()) {
		    throw new InvalidRequestException("Invalid device type indicator");
		}
		$data->MCGrp->DevTypeInd = $this->getDeviceTypeIndicator();
		}

		// Conditional
		if ($this->getMasterCardAdditionalData() !== null) {
		if (!$this->validateMasterCardAdditionalData()) {
		    throw new InvalidRequestException("Invalid mastercard additional data");
		}
		$data->MCGrp->MCAddData = $this->getMasterCardAdditionalData();
		}

		// Conditional
		if ($this->getTransactionIntegrityClass() !== null) {
		if (!$this->validateTransactionIntegrityClass()) {
		    throw new InvalidRequestException("Invalid transaction integrity class");
		}
		$data->MCGrp->TranIntgClass = $this->getTransactionIntegrityClass();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addDiscoverGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getDiscoverProcessingCode() !== null) {
		if (!$this->validateDiscoverProcessingCode()) {
		    throw new InvalidRequestException("Invalid discover processing code");
		}
		$data->DSGrp->DiscProcCode = $this->getDiscoverProcessingCode();
		}

		// Conditional
		if ($this->getDiscoverPOSEntryMode() !== null) {
		if (!$this->validateDiscoverPOSEntryMode()) {
		    throw new InvalidRequestException("Invalid discover pos entry mode");
		}
		$data->DSGrp->DiscPOSEntry = $this->getDiscoverPOSEntryMode();
		}

		// Conditional
		if ($this->getDiscoverResponseCode() !== null) {
		if (!$this->validateDiscoverResponseCode()) {
		    throw new InvalidRequestException("Invalid discover response code");
		}
		$data->DSGrp->DiscRespCode = $this->getDiscoverResponseCode();
		}

		// Conditional
		if ($this->getDiscoverPOSData() !== null) {
		if (!$this->validateDiscoverPOSData()) {
		    throw new InvalidRequestException("Invalid discover pos data");
		}
		$data->DSGrp->DiscPOSData = $this->getDiscoverPOSData();
		}

		// Conditional
		if ($this->getDiscoverTransactionQualifier() !== null) {
		if (!$this->validateDiscoverTransactionQualifier()) {
		    throw new InvalidRequestException("Invalid discover transaction qualifier");
		}
		$data->DSGrp->DiscTransQualifier = $this->getDiscoverTransactionQualifier();
		}

		// Conditional
		if ($this->getDiscoverNRID() !== null) {
		if (!$this->validateDiscoverNRID()) {
		    throw new InvalidRequestException("Invalid discover nrid");
		}
		$data->DSGrp->DiscNRID = $this->getDiscoverNRID();
		}

		// Conditional
		if ($this->getMOTOIndicator() !== null) {
		if (!$this->validateMOTOIndicator()) {
		    throw new InvalidRequestException("Invalid moto indicator");
		}
		$data->DSGrp->MOTOInd = $this->getMOTOIndicator();
		}

		// Conditional
		if ($this->getRegisteredUserIndicator() !== null) {
		if (!$this->validateRegisteredUserIndicator()) {
		    throw new InvalidRequestException("Invalid registered user indicator");
		}
		$data->DSGrp->RegUserInd = $this->getRegisteredUserIndicator();
		}

		// Conditional
		if ($this->getRegisteredUserProfileChangeDate() !== null) {
		if (!$this->validateRegisteredUserProfileChangeDate()) {
		    throw new InvalidRequestException("Invalid registered user profile change
		date");
		}
		$data->DSGrp->RegUserDate = $this->getRegisteredUserProfileChangeDate();
		}

		// Conditional
		if ($this->getPartialShipmentIndicator() !== null) {
		if (!$this->validatePartialShipmentIndicator()) {
		    throw new InvalidRequestException("Invalid partial shipment indicator");
		}
		$data->DSGrp->PartShipInd = $this->getPartialShipmentIndicator();
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
		if ($this->getGoodsSoldCode() !== null) {
		if (!$this->validateGoodsSoldCode()) {
		    throw new InvalidRequestException("Invalid goods sold code");
		}
		$data->AmexGrp->GdSoldCd = $this->getGoodsSoldCode();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addCustomerInfoGroup(\SimpleXMLElement $data)
	{
		// Optional
		if ($this->getAVSBillingAddress() !== null) {
		if (!$this->validateAVSBillingAddress()) {
		    throw new InvalidRequestException("Invalid avs/billing address");
		}
		$data->CustInfoGrp->AVSBillingAddr = $this->getAVSBillingAddress();
		}

		// Optional
		if ($this->getAVSBillingPostalCode() !== null) {
		if (!$this->validateAVSBillingPostalCode()) {
		    throw new InvalidRequestException("Invalid avs/billing postal code");
		}
		$data->CustInfoGrp->AVSBillingPostalCode = $this->getAVSBillingPostalCode();
		}

		// Conditional
		if ($this->getCardHolderFirstName() !== null) {
		if (!$this->validateCardHolderFirstName()) {
		    throw new InvalidRequestException("Invalid card holder first name");
		}
		$data->CustInfoGrp->CHFirstNm = $this->getCardHolderFirstName();
		}

		// Conditional
		if ($this->getCardHolderLastName() !== null) {
		if (!$this->validateCardHolderLastName()) {
		    throw new InvalidRequestException("Invalid card holder last name");
		}
		$data->CustInfoGrp->CHLastNm = $this->getCardHolderLastName();
		}

		// Conditional
		if ($this->getCardHolderFullNameResult() !== null) {
		if (!$this->validateCardHolderFullNameResult()) {
		    throw new InvalidRequestException("Invalid card holder full name result");
		}
		$data->CustInfoGrp->CHFullNmRes = $this->getCardHolderFullNameResult();
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
		if (!$this->validateOriginalAuthorizationID()) {
		    throw new InvalidRequestException("Invalid original authorization id");
		}
		$data->OrigAuthGrp->OrigAuthID = $this->getOriginalAuthorizationID();

		// Mandatory
		if (!$this->validateOriginalLocalDateandTime()) {
		    throw new InvalidRequestException("Invalid original local date and time");
		}
		$data->OrigAuthGrp->OrigLocalDateTime = $this->getOriginalLocalDateandTime();

		// Mandatory
		if (!$this->validateOriginalTransmissionDateandTime()) {
		    throw new InvalidRequestException("Invalid original transmission date and
		time");
		}
		$data->OrigAuthGrp->OrigTranDateTime = $this->getOriginalTransmissionDateandTime();

		// Mandatory
		if (!$this->validateOriginalSTAN()) {
		    throw new InvalidRequestException("Invalid original stan");
		}
		$data->OrigAuthGrp->OrigSTAN = $this->getOriginalSTAN();

		// Mandatory
		if (!$this->validateOriginalResponseCode()) {
		    throw new InvalidRequestException("Invalid original response code");
		}
		$data->OrigAuthGrp->OrigRespCode = $this->getOriginalResponseCode();

		// Conditional
		if ($this->getOriginalAuthorizingNetworkID() !== null) {
		if (!$this->validateOriginalAuthorizingNetworkID()) {
		    throw new InvalidRequestException("Invalid original authorizing network id");
		}
		$data->OrigAuthGrp->OrigAthNtwkID = $this->getOriginalAuthorizingNetworkID();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addProductCodeGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getServiceLevel() !== null) {
		if (!$this->validateServiceLevel()) {
		    throw new InvalidRequestException("Invalid service level");
		}
		$data->ProdCodeGrp->ServLvl = $this->getServiceLevel();
		}

		// Conditional
		if ($this->getNumberofProducts() !== null) {
		if (!$this->validateNumberofProducts()) {
		    throw new InvalidRequestException("Invalid number of products");
		}
		$data->ProdCodeGrp->NumOfProds = $this->getNumberofProducts();
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
