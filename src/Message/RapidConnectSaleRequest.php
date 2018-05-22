<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectSaleRequest extends RapidConnectCreditRequest
{

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

        // Optional
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

        // Optional
        if ($this->getClerkID() !== null) {
            if (!$this->validateClerkID()) {
                throw new InvalidRequestException("Invalid clerk id");
            }
            $data->CommonGrp->ClerkID = $this->getClerkID();
        }

        // Optional
        if ($this->getSENum() !== null) {
            if (!$this->validateSENum()) {
                throw new InvalidRequestException("Invalid service entitlement number");
            }
            $data->CommonGrp->SENum = $this->getSENum();
        }

        // Conditional
        if ($this->getPLPOSDebitFlg() !== null) {
            if (!$this->validatePLPOSDebitFlg()) {
                throw new InvalidRequestException("Invalid pinless pos debit flag");
            }
            $data->CommonGrp->PLPOSDebitFlg = $this->getPLPOSDebitFlg();
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

        // Optional
        if ($this->getTranInit() !== null) {
            if (!$this->validateTranInit()) {
                throw new InvalidRequestException("Invalid transaction initiation");
            }
            $data->CommonGrp->TranInit = $this->getTranInit();
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

        // Optional
        if ($this->getInstallInvNum() !== null) {
            if (!$this->validateInstallInvNum()) {
                throw new InvalidRequestException("Invalid installment payment invoice
            number");
            }
            $data->BillPayGrp->InstallInvNum = $this->getInstallInvNum();
        }

        // Optional
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
        if ($this->getTrack1Data() !== null) {
            if (!$this->validateTrack1Data()) {
                throw new InvalidRequestException("Invalid track 1 data");
            }
            $data->CardGrp->Track1Data = $this->getTrack1Data();
        }

        // Conditional
        if ($this->getTrack2Data() !== null) {
            if (!$this->validateTrack2Data()) {
                throw new InvalidRequestException("Invalid track 2 data");
            }
            $data->CardGrp->Track2Data = $this->getTrack2Data();
        }

        // Conditional
        if ($this->getCardType() !== null) {
            if (!$this->validateCardType()) {
                throw new InvalidRequestException("Invalid card type");
            }
            $data->CardGrp->CardType = $this->getCardType();
        }

        // Optional
        if ($this->getCCVInd() !== null) {
            if (!$this->validateCCVInd()) {
                throw new InvalidRequestException("Invalid ccv indicator");
            }
            $data->CardGrp->CCVInd = $this->getCCVInd();
        }

        // Optional
        if ($this->getCCVData() !== null) {
            if (!$this->validateCCVData()) {
                throw new InvalidRequestException("Invalid ccv data");
            }
            $data->CardGrp->CCVData = $this->getCCVData();
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
        // Conditional
        if ($this->getPINData() !== null) {
            if (!$this->validatePINData()) {
                throw new InvalidRequestException("Invalid pin data");
            }
            $data->PINGrp->PINData = $this->getPINData();
        }

        // Conditional
        if ($this->getKeySerialNumData() !== null) {
            if (!$this->validateKeySerialNumData()) {
                throw new InvalidRequestException("Invalid key serial number data");
            }
            $data->PINGrp->KeySerialNumData = $this->getKeySerialNumData();
        }
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
        if ($this->getExistingDebtInd() !== null) {
            if (!$this->validateExistingDebtInd()) {
                throw new InvalidRequestException("Invalid existing debt indicator");
            }
            $data->VisaGrp->ExistingDebtInd = $this->getExistingDebtInd();
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
        if ($this->getTaxAmtCapablt() !== null) {
            if (!$this->validateTaxAmtCapablt()) {
                throw new InvalidRequestException("Invalid tax amount capability");
            }
            $data->VisaGrp->TaxAmtCapablt = $this->getTaxAmtCapablt();
        }

        // Conditional
        if ($this->getCheckoutInd() !== null) {
            if (!$this->validateCheckoutInd()) {
                throw new InvalidRequestException("Invalid visa checkout indicator");
            }
            $data->VisaGrp->CheckoutInd = $this->getCheckoutInd();
        }

        // Conditional
        if ($this->getVisaAuthInd() !== null) {
            if (!$this->validateVisaAuthInd()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->VisaGrp->VisaAuthInd = $this->getVisaAuthInd();
        }

        // Conditional
        if ($this->getStoredCredInd() !== null) {
            if (!$this->validateStoredCredInd()) {
                throw new InvalidRequestException("Invalid stored credential indicator");
            }
            $data->VisaGrp->StoredCredInd = $this->getStoredCredInd();
        }

        // Conditional
        if ($this->getCofSchedInd() !== null) {
            if (!$this->validateCofSchedInd()) {
                throw new InvalidRequestException("Invalid card on file schedule indicator");
            }
            $data->VisaGrp->CofSchedInd = $this->getCofSchedInd();
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
        if ($this->getMCMSDI() !== null) {
            if (!$this->validateMCMSDI()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->MCGrp->MCMSDI = $this->getMCMSDI();
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
        if ($this->getFinAuthInd() !== null) {
            if (!$this->validateFinAuthInd()) {
                throw new InvalidRequestException("Invalid authorization type");
            }
            $data->MCGrp->FinAuthInd = $this->getFinAuthInd();
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
        if ($this->getDiscAuthInd() !== null) {
            if (!$this->validateDiscAuthInd()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->DSGrp->DiscAuthInd = $this->getDiscAuthInd();
        }

        // Optional
        if ($this->getMOTOInd() !== null) {
            if (!$this->validateMOTOInd()) {
                throw new InvalidRequestException("Invalid moto indicator");
            }
            $data->DSGrp->MOTOInd = $this->getMOTOInd();
        }

        // Optional
        if ($this->getRegUserInd() !== null) {
            if (!$this->validateRegUserInd()) {
                throw new InvalidRequestException("Invalid registered user indicator");
            }
            $data->DSGrp->RegUserInd = $this->getRegUserInd();
        }

        // Optional
        if ($this->getRegUserDate() !== null) {
            if (!$this->validateRegUserDate()) {
                throw new InvalidRequestException("Invalid registered user profile change
            date");
            }
            $data->DSGrp->RegUserDate = $this->getRegUserDate();
        }

        // Conditional
        if ($this->getDiscAuthInd() !== null) {
            if (!$this->validateDiscAuthInd()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->DSGrp->DiscAuthInd = $this->getDiscAuthInd();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addAmexGroup(\SimpleXMLElement $data)
    {
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

        // Optional
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
