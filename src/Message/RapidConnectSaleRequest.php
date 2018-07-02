<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectSaleRequest extends RapidConnectAbstractRequest
{
    /**
     * @return \SimpleXMLElement
     */
    function getData()
    {
        $data = $this->getBaseData();
        $gmf = $this->getBasePayload();

        $request = $gmf->{$this->getMessageType()};

        $commonGroup = $this->getCommonGroup();
        if ($commonGroup !== null) {
            $commonGroup->addCommonGroup($request);
        }

        // $this->addCommonGroup($request);
        $this->addAlternateMerchantNameandAddressGroup($request);
        $this->addBillPaymentGroup($request);
        $this->addCardGroup($request);
        $this->addPinGroup($request);
        $this->addEcommGroup($request);
        $this->addSecureTransactionGroup($request);
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

        $data->Transaction->Payload = $gmf->saveXML();

        return $data;
    }

    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
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

        // Optional
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
        $data->CommonGrp->POSEntryMode = $this->getPOSEntryMode()->__toString();

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

        // Optional
        if ($this->getClerkID() !== null) {
            if (!$this->validateClerkID()) {
                throw new InvalidRequestException("Invalid clerk id");
            }
            $data->CommonGrp->ClerkID = $this->getClerkID();
        }

        // Optional
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

        // Optional
        if ($this->getTransactionInitiation() !== null) {
            if (!$this->validateTransactionInitiation()) {
                throw new InvalidRequestException("Invalid transaction initiation");
            }
            $data->CommonGrp->TranInit = $this->getTransactionInitiation();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addAlternateMerchantNameandAddressGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getMerchantName() !== null) {
            if (!$this->validateMerchantName()) {
                throw new InvalidRequestException("Invalid merchant name");
            }
            $data->AltMerchNameAndAddrGrp->MerchName = $this->getMerchantName();
        }

        // Conditional
        if ($this->getMerchantAddress() !== null) {
            if (!$this->validateMerchantAddress()) {
                throw new InvalidRequestException("Invalid merchant address");
            }
            $data->AltMerchNameAndAddrGrp->MerchAddr = $this->getMerchantAddress();
        }

        // Conditional
        if ($this->getMerchantCity() !== null) {
            if (!$this->validateMerchantCity()) {
                throw new InvalidRequestException("Invalid merchant city");
            }
            $data->AltMerchNameAndAddrGrp->MerchCity = $this->getMerchantCity();
        }

        // Optional
        if ($this->getMerchantState() !== null) {
            if (!$this->validateMerchantState()) {
                throw new InvalidRequestException("Invalid merchant state");
            }
            $data->AltMerchNameAndAddrGrp->MerchState = $this->getMerchantState();
        }

        // Optional
        if ($this->getMerchantCounty() !== null) {
            if (!$this->validateMerchantCounty()) {
                throw new InvalidRequestException("Invalid merchant county");
            }
            $data->AltMerchNameAndAddrGrp->MerchCnty = $this->getMerchantCounty();
        }

        // Optional
        if ($this->getMerchantPostalCode() !== null) {
            if (!$this->validateMerchantPostalCode()) {
                throw new InvalidRequestException("Invalid merchant postal code");
            }
            $data->AltMerchNameAndAddrGrp->MerchPostalCode = $this->getMerchantPostalCode();
        }

        // Conditional
        if ($this->getMerchantCountry() !== null) {
            if (!$this->validateMerchantCountry()) {
                throw new InvalidRequestException("Invalid merchant country");
            }
            $data->AltMerchNameAndAddrGrp->MerchCtry = $this->getMerchantCountry();
        }

        // Conditional
        if ($this->getMerchantEmailAddress() !== null) {
            if (!$this->validateMerchantEmailAddress()) {
                throw new InvalidRequestException("Invalid merchant email address");
            }
            $data->AltMerchNameAndAddrGrp->MerchEmail = $this->getMerchantEmailAddress();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addBillPaymentGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getBillPaymentTransactionIndicator() !== null) {
            if (!$this->validateBillPaymentTransactionIndicator()) {
                throw new InvalidRequestException("Invalid bill payment transactionindicator");
            }
            $data->BillPayGrp->BillPymtTxnInd = $this->getBillPaymentTransactionIndicator();
        }

        // Optional
        if ($this->getInstallmentPaymentInvoiceNumber() !== null) {
            if (!$this->validateInstallmentPaymentInvoiceNumber()) {
                throw new InvalidRequestException("Invalid installment payment invoicenumber");
            }
            $data->BillPayGrp->InstallInvNum = $this->getInstallmentPaymentInvoiceNumber();
        }

        // Optional
        if ($this->getInstallmentPaymentDescription() !== null) {
            if (!$this->validateInstallmentPaymentDescription()) {
                throw new InvalidRequestException("Invalid installment payment description");
            }
            $data->BillPayGrp->InstallPymntDesc = $this->getInstallmentPaymentDescription();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addCardGroup(\SimpleXMLElement $data)
    {
        if ($card = $this->getCard()) {
            $this->setAccountNumber($card->getNumber());
            if ($ccv = $card->getCvv()) {
                $this->setCCVData($ccv);
                $this->setCCVIndicator('Prvded');
                $this->setCardExpirationDate($card->getExpiryDate('Ym'));
                $brand = $card->getBrand();
                if (array_key_exists($brand, $this->brandMap)) {
                    $value = $this->brandMap[$brand];
                }
                $this->setCardType($value);
            }
        }

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
        if ($this->getCCVIndicator() !== null) {
            if (!$this->validateCCVIndicator()) {
                throw new InvalidRequestException("Invalid ccv indicator");
            }
            $data->CardGrp->CCVInd = $this->getCCVIndicator();
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
                throw new InvalidRequestException("Invalid mvvmaid");
            }
            $data->CardGrp->MVVMAID = $this->getMVVMAID();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
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
        if ($this->getKeySerialNumberData() !== null) {
            if (!$this->validateKeySerialNumberData()) {
                throw new InvalidRequestException("Invalid key serial number data");
            }
            $data->PINGrp->KeySerialNumData = $this->getKeySerialNumberData();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
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
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addSecureTransactionGroup(\SimpleXMLElement $data)
    {
        // Optional
        if ($this->getVisaXID() !== null) {
            if (!$this->validateVisaXID()) {
                throw new InvalidRequestException("Invalid visa xid");
            }
            $data->SecrTxnGrp->VisaXID = $this->getVisaXID();
        }

        // Conditional
        if ($this->getVisaSecureTransactionAuthenticationData() !== null) {
            if (!$this->validateVisaSecureTransactionAuthenticationData()) {
                throw new InvalidRequestException("Invalid visa secure transactionauthentication data");
            }
            $data->SecrTxnGrp->VisaSecrTxnAD = $this->getVisaSecureTransactionAuthenticationData();
        }

        // Optional
        if ($this->getAmexXID() !== null) {
            if (!$this->validateAmexXID()) {
                throw new InvalidRequestException("Invalid amex xid");
            }
            $data->SecrTxnGrp->AmexXID = $this->getAmexXID();
        }

        // Conditional
        if ($this->getAmexSecureData() !== null) {
            if (!$this->validateAmexSecureData()) {
                throw new InvalidRequestException("Invalid amex secure data");
            }
            $data->SecrTxnGrp->AmexSecrAD = $this->getAmexSecureData();
        }

        // Conditional
        if ($this->getUCAFCollectionIndicator() !== null) {
            if (!$this->validateUCAFCollectionIndicator()) {
                throw new InvalidRequestException("Invalid ucaf collection indicator");
            }
            $data->SecrTxnGrp->UCAFCollectInd = $this->getUCAFCollectionIndicator();
        }

        // Conditional
        if ($this->getMasterCardSecureData() !== null) {
            if (!$this->validateMasterCardSecureData()) {
                throw new InvalidRequestException("Invalid mastercard secure data");
            }
            $data->SecrTxnGrp->MCSecrAD = $this->getMasterCardSecureData();
        }

        // Conditional
        if ($this->getDiscoverAuthenticationType() !== null) {
            if (!$this->validateDiscoverAuthenticationType()) {
                throw new InvalidRequestException("Invalid discover authentication type");
            }
            $data->SecrTxnGrp->DiscAuthType = $this->getDiscoverAuthenticationType();
        }

        // Conditional
        if ($this->getDiscoverSecureData() !== null) {
            if (!$this->validateDiscoverSecureData()) {
                throw new InvalidRequestException("Invalid discover secure data");
            }
            $data->SecrTxnGrp->DiscSecData = $this->getDiscoverSecureData();
        }
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addVisaGroup(\SimpleXMLElement $data)
    {
        // Conditional
        if ($this->getAuthorizationCharacteristicsIndicatorACI() !== null) {
            if (!$this->validateAuthorizationCharacteristicsIndicatorACI()) {
                throw new InvalidRequestException("Invalid authorization characteristicsindicator aci");
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
        if ($this->getExistingDebtIndicator() !== null) {
            if (!$this->validateExistingDebtIndicator()) {
                throw new InvalidRequestException("Invalid existing debt indicator");
            }
            $data->VisaGrp->ExistingDebtInd = $this->getExistingDebtIndicator();
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
        if ($this->getTaxAmountCapability() !== null) {
            if (!$this->validateTaxAmountCapability()) {
                throw new InvalidRequestException("Invalid tax amount capability");
            }
            $data->VisaGrp->TaxAmtCapablt = $this->getTaxAmountCapability();
        }

        // Conditional
        if ($this->getVisaCheckoutIndicator() !== null) {
            if (!$this->validateVisaCheckoutIndicator()) {
                throw new InvalidRequestException("Invalid visa checkout indicator");
            }
            $data->VisaGrp->CheckoutInd = $this->getVisaCheckoutIndicator();
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
     * @throws InvalidRequestException
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
        if ($this->getMarketSpecificDataIndicator() !== null) {
            if (!$this->validateMarketSpecificDataIndicator()) {
                throw new InvalidRequestException("Invalid market specific data indicator");
            }
            $data->MCGrp->MCMSDI = $this->getMarketSpecificDataIndicator();
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
     * @throws InvalidRequestException
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

        // Optional
        if ($this->getMOTOIndicator() !== null) {
            if (!$this->validateMOTOIndicator()) {
                throw new InvalidRequestException("Invalid moto indicator");
            }
            $data->DSGrp->MOTOInd = $this->getMOTOIndicator();
        }

        // Optional
        if ($this->getRegisteredUserIndicator() !== null) {
            if (!$this->validateRegisteredUserIndicator()) {
                throw new InvalidRequestException("Invalid registered user indicator");
            }
            $data->DSGrp->RegUserInd = $this->getRegisteredUserIndicator();
        }

        // Optional
        if ($this->getRegisteredUserProfileChangeDate() !== null) {
            if (!$this->validateRegisteredUserProfileChangeDate()) {
                throw new InvalidRequestException("Invalid registered user profile changedate");
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
     * @throws InvalidRequestException
     */
    public function addAmexGroup(\SimpleXMLElement $data)
    {
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
     * @throws InvalidRequestException
     */
    public function addCustomerInfoGroup(\SimpleXMLElement $data)
    {
        if ($card = $this->getCard()) {
            if ($card->getBillingAddress1() !== null || $card->getBillingAddress2() !== null) {
                $this->setAVSBillingAddress(
                    $card->getBillingAddress1() . "\n" . $card->getBillingAddress2()
                );
            }

            if ($card->getBillingPostcode() !== null) {
                $this->setAVSBillingPostalCode($card->getBillingPostcode());
            }
            if ($card->getFirstName() !== null) {
                $this->setCardHolderFirstName($card->getFirstName());

                if ($card->getLastName() !== null) {
                    $this->setCardHolderLastName($card->getLastName());
                }
            }
        }

        // Optional
        if ($this->getAVSBillingAddress() !== null) {
            if (!$this->validateAVSBillingAddress()) {
                throw new InvalidRequestException("Invalid avsbilling address");
            }
            $data->CustInfoGrp->AVSBillingAddr = $this->getAVSBillingAddress();
        }

        // Optional
        if ($this->getAVSBillingPostalCode() !== null) {
            if (!$this->validateAVSBillingPostalCode()) {
                throw new InvalidRequestException("Invalid avsbilling postal code");
            }
            $data->CustInfoGrp->AVSBillingPostalCode = $this->getAVSBillingPostalCode();
        }

        // Optional
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
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
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
     * @throws InvalidRequestException
     */
    public function addResponseGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addOriginalAuthorizationGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
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
     * @throws InvalidRequestException
     */
    public function addFileDownloadGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addLodgingGroup(\SimpleXMLElement $data)
    {
    }


    /**
     * @param \SimpleXMLElement $data
     * @throws InvalidRequestException
     */
    public function addAutoRentalGroup(\SimpleXMLElement $data)
    {
    }

}
