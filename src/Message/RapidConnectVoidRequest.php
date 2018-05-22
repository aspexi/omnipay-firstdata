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
        if (!$this->validatePymtType()) {
            throw new InvalidRequestException("Invalid payment type");
        }
        $data->CommonGrp->PymtType = $this->getPymtType();

        // Mandatory
        if (!$this->validateReversalInd()) {
            throw new InvalidRequestException("Invalid reversal reason code");
        }
        $data->CommonGrp->ReversalInd = $this->getReversalInd();

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
        if ($this->getSettleInd() !== null) {
            if (!$this->validateSettleInd()) {
                throw new InvalidRequestException("Invalid settlement indicator");
            }
            $data->CommonGrp->SettleInd = $this->getSettleInd();
        }

        // Optional
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

        // Conditional
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
        if ($this->getTransID() !== null) {
            if (!$this->validateTransID()) {
                throw new InvalidRequestException("Invalid transaction identifier");
            }
            $data->VisaGrp->TransID = $this->getTransID();
        }

        // Conditional
        if ($this->getSpendQInd() !== null) {
            if (!$this->validateSpendQInd()) {
                throw new InvalidRequestException("Invalid spend qualified indicator");
            }
            $data->VisaGrp->SpendQInd = $this->getSpendQInd();
        }

        // Conditional
        if ($this->getQCI() !== null) {
            if (!$this->validateQCI()) {
                throw new InvalidRequestException("Invalid quasi-cash indicator");
            }
            $data->VisaGrp->QCI = $this->getQCI();
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
        if ($this->getMCACI() !== null) {
            if (!$this->validateMCACI()) {
                throw new InvalidRequestException("Invalid mastercard aci");
            }
            $data->MCGrp->MCACI = $this->getMCACI();
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

        // Conditional
        if ($this->getReAuthInd() !== null) {
            if (!$this->validateReAuthInd()) {
                throw new InvalidRequestException("Invalid re-auth indicator");
            }
            $data->AmexGrp->ReAuthInd = $this->getReAuthInd();
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
        if ($this->getOrigAuthID() !== null) {
            if (!$this->validateOrigAuthID()) {
                throw new InvalidRequestException("Invalid original authorization id");
            }
            $data->OrigAuthGrp->OrigAuthID = $this->getOrigAuthID();
        }

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
        // Conditional
        if ($this->getProgramInd() !== null) {
            if (!$this->validateProgramInd()) {
                throw new InvalidRequestException("Invalid program indicator");
            }
            $data->LodgingGrp->ProgramInd = $this->getProgramInd();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addAutoRentalGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getDelChrgInd() !== null) {
            if (!$this->validateDelChrgInd()) {
                throw new InvalidRequestException("Invalid delayed charge indicator");
            }
            $data->AutoRentalGrp->DelChrgInd = $this->getDelChrgInd();
        }
    }
}
