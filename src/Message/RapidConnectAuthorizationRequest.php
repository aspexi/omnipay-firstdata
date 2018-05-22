<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectAuthorizationRequest extends RapidConnectCreditRequest
{
    protected $txnType = 'Authorization';

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
        if (!preg_match('/[0-9A-Za-z]{1,6}/', $value)) {
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
        if (!preg_match('/[0-9A-Za-z]{1,9}/', $value)) {
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
        if (!preg_match('/[0-9]{1,9}/', $value)) {
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
        if (!preg_match('/[0-9]{1,2}/', $value)) {
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
        if (!preg_match('/[0-9A-Za-z]{1,2}/', $value)) {
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
        if (!preg_match('/[012345]{1,5}/', $value)) {
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
        $data->ReqClientID->Auth = $this->getAuth();
        $data->ReqClientID->ClientRef = $this->getClientRef();
        $data->Transaction->ServiceID = $this->getServiceID();

        $this->setTxnType($this->txnType);

        $gmf = new \SimpleXMLElement('<GMF/>');
        $gmf->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $gmf->addAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $gmf->addAttribute('xmlns', 'com/firstdata/Merchant/gmfV1.1');

        $request = $gmf->addChild("<{$this->requestType}/>");

        $this->addCommonGroup($request);
        $this->addBillPaymentGroup($request);
        $this->addCardGroup($request);
        $this->addPinGroup($request);
        $this->addEcommGroup($request);
        $this->addVisaGroup($request);
        $this->addMastercardGroup($request);
        $this->addDiscoverGroup($request);
        $this->addAmexGroup($request);
        $this->addCustomerInfoGroup($request);
        $this->addOrderGroup($request);
        $this->addResponseGroup($request);
        $this->addOriginalAuthorizationGroup($request);
        $this->addProductCodeGroup($request);
        $this->addFileDownloadGroup($request);
        $this->addLodgingGroup($request);
        $this->addAutoRentalGroup($request);

        $data->Transaction->Payload = htmlspecialchars('<?xml version="1.0" encoding="UTF-8"?>' . $gmf->saveXML());

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

        // Optional
        if ($this->getInfoReqInd() !== null) {
            if (!$this->validateInfoReqInd()) {
                throw new InvalidRequestException("Invalid card info request indicator");
            }
            $data->CardGrp->InfoReqInd = $this->getInfoReqInd();
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
        if ($this->getDiscNRID() !== null) {
            if (!$this->validateDiscNRID()) {
                throw new InvalidRequestException("Invalid discover nrid");
            }
            $data->DSGrp->DiscNRID = $this->getDiscNRID();
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
        // Conditional
        if ($this->getOrigSTAN() !== null) {
            if (!$this->validateOrigSTAN()) {
                throw new InvalidRequestException("Invalid original stan");
            }
            $data->OrigAuthGrp->OrigSTAN = $this->getOrigSTAN();
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
        // Optional
        if ($this->getFolioNum() !== null) {
            if (!$this->validateFolioNum()) {
                throw new InvalidRequestException("Invalid folio number");
            }
            $data->LodgingGrp->FolioNum = $this->getFolioNum();
        }

        // Optional
        if ($this->getRoomNum() !== null) {
            if (!$this->validateRoomNum()) {
                throw new InvalidRequestException("Invalid room number");
            }
            $data->LodgingGrp->RoomNum = $this->getRoomNum();
        }

        // Optional
        if ($this->getLodRefNum() !== null) {
            if (!$this->validateLodRefNum()) {
                throw new InvalidRequestException("Invalid lodging reference number");
            }
            $data->LodgingGrp->LodRefNum = $this->getLodRefNum();
        }

        // Optional
        if ($this->getRoomRt() !== null) {
            if (!$this->validateRoomRt()) {
                throw new InvalidRequestException("Invalid room rate");
            }
            $data->LodgingGrp->RoomRt = $this->getRoomRt();
        }

        // Conditional
        if ($this->getProgramInd() !== null) {
            if (!$this->validateProgramInd()) {
                throw new InvalidRequestException("Invalid program indicator");
            }
            $data->LodgingGrp->ProgramInd = $this->getProgramInd();
        }

        // Conditional
        if ($this->getDuration() !== null) {
            if (!$this->validateDuration()) {
                throw new InvalidRequestException("Invalid duration");
            }
            $data->LodgingGrp->Duration = $this->getDuration();
        }

        // Conditional
        if ($this->getExtraChrgs() !== null) {
            if (!$this->validateExtraChrgs()) {
                throw new InvalidRequestException("Invalid extra charges");
            }
            $data->LodgingGrp->ExtraChrgs = $this->getExtraChrgs();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     */
    public function addAutoRentalGroup(\SimpleXMLElement $data)
    {
        // Optional
        if ($this->getRentalCity() !== null) {
            if (!$this->validateRentalCity()) {
                throw new InvalidRequestException("Invalid rental city");
            }
            $data->AutoRentalGrp->RentalCity = $this->getRentalCity();
        }

        // Optional
        if ($this->getRentalState() !== null) {
            if (!$this->validateRentalState()) {
                throw new InvalidRequestException("Invalid rental state");
            }
            $data->AutoRentalGrp->RentalState = $this->getRentalState();
        }

        // Optional
        if ($this->getRentalCtry() !== null) {
            if (!$this->validateRentalCtry()) {
                throw new InvalidRequestException("Invalid rental country");
            }
            $data->AutoRentalGrp->RentalCtry = $this->getRentalCtry();
        }

        // Conditional
        if ($this->getRentalDate() !== null) {
            if (!$this->validateRentalDate()) {
                throw new InvalidRequestException("Invalid rental date");
            }
            $data->AutoRentalGrp->RentalDate = $this->getRentalDate();
        }

        // Conditional
        if ($this->getRentalTime() !== null) {
            if (!$this->validateRentalTime()) {
                throw new InvalidRequestException("Invalid rental time");
            }
            $data->AutoRentalGrp->RentalTime = $this->getRentalTime();
        }

        // Optional
        if ($this->getReturnCity() !== null) {
            if (!$this->validateReturnCity()) {
                throw new InvalidRequestException("Invalid return city");
            }
            $data->AutoRentalGrp->ReturnCity = $this->getReturnCity();
        }

        // Optional
        if ($this->getReturnState() !== null) {
            if (!$this->validateReturnState()) {
                throw new InvalidRequestException("Invalid return state");
            }
            $data->AutoRentalGrp->ReturnState = $this->getReturnState();
        }

        // Optional
        if ($this->getReturnCtry() !== null) {
            if (!$this->validateReturnCtry()) {
                throw new InvalidRequestException("Invalid return country");
            }
            $data->AutoRentalGrp->ReturnCtry = $this->getReturnCtry();
        }

        // Conditional
        if ($this->getReturnDate() !== null) {
            if (!$this->validateReturnDate()) {
                throw new InvalidRequestException("Invalid return date");
            }
            $data->AutoRentalGrp->ReturnDate = $this->getReturnDate();
        }

        // Optional
        if ($this->getReturnTime() !== null) {
            if (!$this->validateReturnTime()) {
                throw new InvalidRequestException("Invalid return time");
            }
            $data->AutoRentalGrp->ReturnTime = $this->getReturnTime();
        }

        // Optional
        if ($this->getAmtExtraChrgs() !== null) {
            if (!$this->validateAmtExtraChrgs()) {
                throw new InvalidRequestException("Invalid amount extra charges");
            }
            $data->AutoRentalGrp->AmtExtraChrgs = $this->getAmtExtraChrgs();
        }

        // Conditional
        if ($this->getRenterName() !== null) {
            if (!$this->validateRenterName()) {
                throw new InvalidRequestException("Invalid renter name");
            }
            $data->AutoRentalGrp->RenterName = $this->getRenterName();
        }

        // Conditional
        if ($this->getAutoAgreeNum() !== null) {
            if (!$this->validateAutoAgreeNum()) {
                throw new InvalidRequestException("Invalid auto rental agreement number");
            }
            $data->AutoRentalGrp->AutoAgreeNum = $this->getAutoAgreeNum();
        }

        // Conditional
        if ($this->getRentalDuration() !== null) {
            if (!$this->validateRentalDuration()) {
                throw new InvalidRequestException("Invalid rental duration");
            }
            $data->AutoRentalGrp->RentalDuration = $this->getRentalDuration();
        }

        // Conditional
        if ($this->getRentalExtraChrgs() !== null) {
            if (!$this->validateRentalExtraChrgs()) {
                throw new InvalidRequestException("Invalid rental extra charges");
            }
            $data->AutoRentalGrp->RentalExtraChrgs = $this->getRentalExtraChrgs();
        }

        // Conditional
        if ($this->getAutoNoShow() !== null) {
            if (!$this->validateAutoNoShow()) {
                throw new InvalidRequestException("Invalid auto rental no show");
            }
            $data->AutoRentalGrp->AutoNoShow = $this->getAutoNoShow();
        }

        // Conditional
        if ($this->getDelChrgInd() !== null) {
            if (!$this->validateDelChrgInd()) {
                throw new InvalidRequestException("Invalid delayed charge indicator");
            }
            $data->AutoRentalGrp->DelChrgInd = $this->getDelChrgInd();
        }
    }
}
