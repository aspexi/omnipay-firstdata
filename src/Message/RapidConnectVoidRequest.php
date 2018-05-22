<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectVoidRequest extends RapidConnectReversalRequest
{

	/**
	 * @return string
	 */
	public function getReversalInd()
	{
		return $this->getParameter('ReversalInd');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setReversalInd(string $value)
	{
		return $this->setParameter('ReversalInd', $value);
	}


	/**
	 * @return bool
	 */
	public function validateReversalInd()
	{
		$value = $this->getParameter('ReversalInd');
		$valid = array('Timeout', 'Void', 'VoidFr', 'TORVoid', 'Partial', 'EditErr', 'MACVeri', 'MACSync', 'EncrErr', 'SystErr');
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
		if (!$this->validateReversalReasonCode()) {
		    throw new InvalidRequestException("Invalid reversal reason code");
		}
		$data->CommonGrp->ReversalInd = $this->getReversalReasonCode();

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
		if ($this->getSettlementIndicator() !== null) {
		if (!$this->validateSettlementIndicator()) {
		    throw new InvalidRequestException("Invalid settlement indicator");
		}
		$data->CommonGrp->SettleInd = $this->getSettlementIndicator();
		}

		// Optional
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
		if ($this->getPINLessPOSDebitFlag() !== null) {
		if (!$this->validatePINLessPOSDebitFlag()) {
		    throw new InvalidRequestException("Invalid pinless pos debit flag");
		}
		$data->CommonGrp->PLPOSDebitFlg = $this->getPINLessPOSDebitFlag();
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
		if ($this->getTransactionIdentifier() !== null) {
		if (!$this->validateTransactionIdentifier()) {
		    throw new InvalidRequestException("Invalid transaction identifier");
		}
		$data->VisaGrp->TransID = $this->getTransactionIdentifier();
		}

		// Conditional
		if ($this->getSpendQualifiedIndicator() !== null) {
		if (!$this->validateSpendQualifiedIndicator()) {
		    throw new InvalidRequestException("Invalid spend qualified indicator");
		}
		$data->VisaGrp->SpendQInd = $this->getSpendQualifiedIndicator();
		}

		// Conditional
		if ($this->getQuasiCashIndicator() !== null) {
		if (!$this->validateQuasiCashIndicator()) {
		    throw new InvalidRequestException("Invalid quasi-cash indicator");
		}
		$data->VisaGrp->QCI = $this->getQuasiCashIndicator();
		}

		// Conditional
		if ($this->getAuthIndicator() !== null) {
		if (!$this->validateAuthIndicator()) {
		    throw new InvalidRequestException("Invalid auth indicator");
		}
		$data->VisaGrp->VisaAuthInd = $this->getAuthIndicator();
		}

		// Conditional
		if ($this->getStoredCredentialIndicator() !== null) {
		if (!$this->validateStoredCredentialIndicator()) {
		    throw new InvalidRequestException("Invalid stored credential indicator");
		}
		$data->VisaGrp->StoredCredInd = $this->getStoredCredentialIndicator();
		}

		// Conditional
		if ($this->getCardOnFileScheduleIndicator() !== null) {
		if (!$this->validateCardOnFileScheduleIndicator()) {
		    throw new InvalidRequestException("Invalid card on file schedule indicator");
		}
		$data->VisaGrp->CofSchedInd = $this->getCardOnFileScheduleIndicator();
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
		if ($this->getMasterCardACI() !== null) {
		if (!$this->validateMasterCardACI()) {
		    throw new InvalidRequestException("Invalid mastercard aci");
		}
		$data->MCGrp->MCACI = $this->getMasterCardACI();
		}

		// Conditional
		if ($this->getMasterCardAdditionalData() !== null) {
		if (!$this->validateMasterCardAdditionalData()) {
		    throw new InvalidRequestException("Invalid mastercard additional data");
		}
		$data->MCGrp->MCAddData = $this->getMasterCardAdditionalData();
		}

		// Conditional
		if ($this->getAuthorizationType() !== null) {
		if (!$this->validateAuthorizationType()) {
		    throw new InvalidRequestException("Invalid authorization type");
		}
		$data->MCGrp->FinAuthInd = $this->getAuthorizationType();
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
		if ($this->getAuthIndicator() !== null) {
		if (!$this->validateAuthIndicator()) {
		    throw new InvalidRequestException("Invalid auth indicator");
		}
		$data->DSGrp->DiscAuthInd = $this->getAuthIndicator();
		}

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
		if ($this->getAuthIndicator() !== null) {
		if (!$this->validateAuthIndicator()) {
		    throw new InvalidRequestException("Invalid auth indicator");
		}
		$data->DSGrp->DiscAuthInd = $this->getAuthIndicator();
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

		// Conditional
		if ($this->getReAuthIndicator() !== null) {
		if (!$this->validateReAuthIndicator()) {
		    throw new InvalidRequestException("Invalid re-auth indicator");
		}
		$data->AmexGrp->ReAuthInd = $this->getReAuthIndicator();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addCustomerInfoGroup(\SimpleXMLElement $data)
	{
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addOrderGroup(\SimpleXMLElement $data)
	{
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
		// Conditional
		if ($this->getOriginalAuthorizationID() !== null) {
		if (!$this->validateOriginalAuthorizationID()) {
		    throw new InvalidRequestException("Invalid original authorization id");
		}
		$data->OrigAuthGrp->OrigAuthID = $this->getOriginalAuthorizationID();
		}

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
		// Conditional
		if ($this->getProgramIndicator() !== null) {
		if (!$this->validateProgramIndicator()) {
		    throw new InvalidRequestException("Invalid program indicator");
		}
		$data->LodgingGrp->ProgramInd = $this->getProgramIndicator();
		}
	}


	/**
	 * @param \SimpleXMLElement $data
	 */
	public function addAutoRentalGroup(\SimpleXMLElement $data)
	{
		// Conditional
		if ($this->getDelayedChargeIndicator() !== null) {
		if (!$this->validateDelayedChargeIndicator()) {
		    throw new InvalidRequestException("Invalid delayed charge indicator");
		}
		$data->AutoRentalGrp->DelChrgInd = $this->getDelayedChargeIndicator();
		}
	}

}
