<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\CreditCard;
use \Omnipay\Common\Message\AbstractRequest;

use Omnipay\FirstData\Model\RapidConnect\EntryMode;

use Omnipay\FirstData\Model\RapidConnect\AdditionalAmount;
use Omnipay\FirstData\Model\RapidConnect\AlternateMerchantNameandAddress;
use Omnipay\FirstData\Model\RapidConnect\AMEX;
use Omnipay\FirstData\Model\RapidConnect\BillPayment;
use Omnipay\FirstData\Model\RapidConnect\Card;
use Omnipay\FirstData\Model\RapidConnect\Common;
use Omnipay\FirstData\Model\RapidConnect\CustomerInfo;
use Omnipay\FirstData\Model\RapidConnect\Discover;
use Omnipay\FirstData\Model\RapidConnect\Ecomm;
use Omnipay\FirstData\Model\RapidConnect\Mastercard;
use Omnipay\FirstData\Model\RapidConnect\Order;
use Omnipay\FirstData\Model\RapidConnect\OriginalAuthorization;
use Omnipay\FirstData\Model\RapidConnect\PaymentFacilitator;
use Omnipay\FirstData\Model\RapidConnect\PIN;
use Omnipay\FirstData\Model\RapidConnect\ProductCode;
use Omnipay\FirstData\Model\RapidConnect\SecureTransaction;
use Omnipay\FirstData\Model\RapidConnect\Visa;

abstract class RapidConnectAbstractRequest extends AbstractRequest
{
    const BRAND_AMEX = 'Amex';
    const BRAND_DINERS_CLUB = 'Diners';
    const BRAND_DISCOVER = 'Discover';
    const BRAND_JCB = 'JCB';
    const BRAND_MAESTRO = 'MaestroInt';
    const BRAND_MASTERCARD = 'MasterCard';
    const BRAND_VISA = 'Visa';

    protected $brandMap = array(
        CreditCard::BRAND_AMEX => RapidConnectAbstractRequest::BRAND_AMEX,
        CreditCard::BRAND_DINERS_CLUB => RapidConnectAbstractRequest::BRAND_DINERS_CLUB,
        CreditCard::BRAND_DISCOVER => RapidConnectAbstractRequest::BRAND_DISCOVER,
        CreditCard::BRAND_JCB => RapidConnectAbstractRequest::BRAND_JCB,
        CreditCard::BRAND_MAESTRO => RapidConnectAbstractRequest::BRAND_MAESTRO,
        CreditCard::BRAND_MASTERCARD => RapidConnectAbstractRequest::BRAND_MASTERCARD,
        CreditCard::BRAND_VISA => RapidConnectAbstractRequest::BRAND_VISA,
    );

    final public static function BuildRequestArray(
        array $requestData,
        RapidConnectAbstractRequest $request,
        RapidConnectResponse $response
    ) {
        $setupFromResponse = function (
            string $groupName,
            array $fieldNames,
            array $requestData,
            RapidConnectResponse $response
        ) {
            $group = $response->{'get' . $groupName}();
            if ($group === null) {
                return $requestData;
            }

            $fromResponse = [];
            foreach ($fieldNames as $fieldName) {
                if (!isset($group->{$fieldName})) {
                    continue;
                }
                $fromResponse[$fieldName] = $group->{$fieldName}->__toString();
            }

            if (count($fromResponse) > 0) {
                if (!array_key_exists($groupName, $requestData)) {
                    $requestData[$groupName] = [];
                }

                foreach ($fromResponse as $fieldName => $value) {
                    $requestData[$groupName][$fieldName] = $value;
                }
            }

            return $requestData;
        };

        $setupFromOriginalRequest = function(
            string $groupName,
            array $fieldNames,
            array $requestData,
            RapidConnectAbstractRequest $request
        ) {
            $group = $request->{'get' . $groupName}();
            if ($group === null) {
                return $requestData;
            }

            $fromRequest = [];
            foreach ($fieldNames as $fieldName) {
                $value = $group->{'get' . $fieldName}();
                if ($value === null) {
                    continue;
                }
                $fromRequest[$fieldName] = $value;
            }

            if (count($fromRequest) > 0) {
                if (!array_key_exists($groupName, $requestData)) {
                    $requestData[$groupName] = [];
                }

                foreach ($fromRequest as $fieldName => $value) {
                    $requestData[$groupName][$fieldName] = $value;
                }
            }

            return $requestData;
        };

        // Alternate Merchant Name and Address Group
        $requestData = $setupFromOriginalRequest(
            'AlternateMerchantNameandAddressGroup',
            [
                'MerchantName',
                'MerchantAddress',
                'MerchantCity',
                'MerchantState',
                'MerchantCounty',
                'MerchantPostalCode',
                'MerchantCountry',
                'MerchantEmailAddress',
            ],
            $requestData,
            $request
        );

        // Bill Payment Group
       $requestData = $setupFromOriginalRequest(
           'BillPaymentGroup',
           [ 'InstallmentPaymentInvoiceNumber', 'InstallmentPaymentDescription' ],
           $requestData,
           $request
       );

        // Discover Group
        $requestData = $setupFromOriginalRequest(
            'DiscoverGroup',
            ['MOTOIndicator'],
            $requestData,
            $request
        );

        $requestData = $setupFromResponse(
            'DiscoverGroup',
            [
                'DiscProcCode',
                'DiscPOSEntry',
                'DiscRespCode',
                'DiscPOSData',
                'DiscTransQualifier',
                'DiscNRID'
            ],
            $requestData,
            $response
        );

        // Ecomm Group
        $requestData = $setupFromOriginalRequest(
            'EcommGroup',
            ['EcommTransactionIndicator'],
            $requestData,
            $request
        );

        // Mastercard Group
        $requestData = $setupFromResponse(
            'MastercardGroup',
            ['TranIntgClass'],
            $requestData,
            $response
        );

        // Visa Group
        $requestData = $setupFromOriginalRequest(
            'VisaGroup',
            [
                'MarketSpecificDataIndicator',
                'TransactionIdentifier',
                'StoredCredentialIndicator',
            ],
            $requestData,
            $request
        );

        $requestData = $setupFromResponse(
            'VisaGroup',
            ['CofSchedInd'],
            $requestData,
            $response
        );

        // OriginalAuthorizationGroup
        $fields = [
            'AuthorizationID',
            'LocalDateandTime',
            'TransmissionDateandTime',
            'STAN',
            'ResponseCode',
        ];

        if (!array_key_exists('OriginalAuthorizationGroup', $requestData)) {
            $requestData['OriginalAuthorizationGroup'] = [];
        }

        foreach ($fields as $field) {
            $requestData['OriginalAuthorizationGroup']['Original'.$field] =
                $response->{'get'.$field}();
        }

        return $requestData;
    }

    public function getAdditionalAmountGroups()
    {
        return $this->getParameter('AdditionalAmountGroups');
    }

    public function setAdditionalAmountGroups($value)
    {
        if ($value && !$value instanceof AdditionalAmount\Iterator) {
            $value = new AdditionalAmount\Iterator($value);
        }

        return $this->setParameter('AdditionalAmountGroups', $value);
    }

    public function getAlternateMerchantNameandAddressGroup()
    {
        return $this->getParameter('AlternateMerchantNameandAddressGroup');
    }

    public function setAlternateMerchantNameandAddressGroup($value)
    {
        if ($value && !$value instanceof AlternateMerchantNameandAddress\Group) {
            $value = new AlternateMerchantNameandAddress\Group($value);
        }

        return $this->setParameter('AlternateMerchantNameandAddressGroup', $value);
    }

    public function getAMEXGroup()
    {
        return $this->getParameter('AMEXGroup');
    }

    public function setAMEXGroup($value)
    {
        if ($value && !$value instanceof AMEX\Group) {
            $value = new AMEX\Group($value);
        }
        return $this->setParameter('AMEXGroup', $value);
    }

    public function getBillPaymentGroup()
    {
        return $this->getParameter('BillPaymentGroup');
    }

    public function setBillPaymentGroup($value)
    {
        if ($value && !$value instanceof BillPayment\Group) {
            $value = new BillPayment\Group($value);
        }
        return $this->setParameter('BillPaymentGroup', $value);
    }

    public function getCardGroup()
    {
        return $this->getParameter('CardGroup');
    }

    public function setCardGroup($value)
    {
        $mergeWithExisting = false;
        if (array_key_exists('MergeWithExisting', $value)) {
            $mergeWithExisting = $value['MergeWithExisting'];
            unset($value['MergeWithExisting']);
        }

        if ($value && !$value instanceof Card\Group) {
            $value = new Card\Group($value);
        }

        if ($mergeWithExisting) {
            $cg = $this->getCardGroup();
            if ($cg) {
                $value = $cg->merge($value);
            }
        }

        return $this->setParameter('CardGroup', $value);
    }

    public function getCommonGroup()
    {
        return $this->getParameter('CommonGroup');
    }

    public function setCommonGroup($value)
    {
        if ($value && !$value instanceof Common\Group) {
            $value = new Common\Group($value);
        }

        return $this->setParameter('CommonGroup', $value);
    }

    public function getCustomerInfoGroup()
    {
        return $this->getParameter('CustomerInfoGroup');
    }

    public function setCustomerInfoGroup($value)
    {
        if ($value && !$value instanceof CustomerInfo\Group) {
            $value = new CustomerInfo\Group($value);
        }
        return $this->setParameter('CustomerInfoGroup', $value);
    }

    public function getDiscoverGroup()
    {
        return $this->getParameter('DiscoverGroup');
    }

    public function setDiscoverGroup($value)
    {
        if ($value && !$value instanceof Discover\Group) {
            $value = new Discover\Group($value);
        }
        return $this->setParameter('DiscoverGroup', $value);
    }

    public function getEcommGroup()
    {
        return $this->getParameter('EcommGroup');
    }

    public function setEcommGroup($value)
    {
        if ($value && !$value instanceof Ecomm\Group) {
            $value = new Ecomm\Group($value);
        }
        return $this->setParameter('EcommGroup', $value);
    }

    public function getMastercardGroup()
    {
        return $this->getParameter('MastercardGroup');
    }

    public function setMastercardGroup($value)
    {
        if ($value && !$value instanceof Mastercard\Group) {
            $value = new Mastercard\Group($value);
        }
        return $this->setParameter('MastercardGroup', $value);
    }

    public function getOrderGroup()
    {
        return $this->getParameter('OrderGroup');
    }

    public function setOrderGroup($value)
    {
        if ($value && !$value instanceof Order\Group) {
            $value = new Order\Group($value);
        }
        return $this->setParameter('OrderGroup', $value);
    }

    public function getOriginalAuthorizationGroup()
    {
        return $this->getParameter('OriginalAuthorizationGroup');
    }

    public function setOriginalAuthorizationGroup($value)
    {
        if ($value && !$value instanceof OriginalAuthorization\Group) {
            $value = new OriginalAuthorization\Group($value);
        }
        return $this->setParameter('OriginalAuthorizationGroup', $value);
    }

    public function getPaymentFacilitatorGroup()
    {
        return $this->getParameter('PaymentFacilitatorGroup');
    }

    public function setPaymentFacilitatorGroup($value)
    {
        if ($value && !$value instanceof PaymentFacilitator\Group) {
            $value = new PaymentFacilitator\Group($value);
        }
        return $this->setParameter('PaymentFacilitatorGroup', $value);
    }

    public function getPINGroup()
    {
        return $this->getParameter('PINGroup');
    }

    public function setPINGroup($value)
    {
        if ($value && !$value instanceof PIN\Group) {
            $value = new PIN\Group($value);
        }
        return $this->setParameter('PINGroup', $value);
    }

    public function getProductCodeGroup()
    {
        return $this->getParameter('ProductCodeGroup');
    }

    public function setProductCodeGroup($value)
    {
        if ($value && !$value instanceof ProductCode\Group) {
            $value = new ProductCode\Group($value);
        }
        return $this->setParameter('ProductCodeGroup', $value);
    }

    public function getSecureTransactionGroup()
    {
        return $this->getParameter('SecureTransactionGroup');
    }

    public function setSecureTransactionGroup($value)
    {
        if ($value && !$value instanceof SecureTransaction\Group) {
            $value = new SecureTransaction\Group($value);
        }
        return $this->setParameter('SecureTransactionGroup', $value);
    }

    public function getVisaGroup()
    {
        return $this->getParameter('VisaGroup');
    }

    public function setVisaGroup($value)
    {
        if ($value && !$value instanceof Visa\Group) {
            $value = new Visa\Group($value);
        }
        return $this->setParameter('VisaGroup', $value);
    }

    /**
     * @return \SimpleXMLElement
     */
    function getBaseData()
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Request
    Version="3"
    ClientTimeout="30"
    xmlns="http://securetransport.dw/rcservice/xml">
    <ReqClientID>
        <DID></DID>
        <App></App>
        <Auth></Auth>
        <ClientRef></ClientRef>
    </ReqClientID>
    <Transaction>
        <ServiceID></ServiceID>
        <Payload Encoding="xml_escape"></Payload>
    </Transaction>
</Request>
XML;
        $data = new \SimpleXMLElement($xml);
        $data->ReqClientID->DID = $this->getDID();
        $data->ReqClientID->APP = $this->getApp();
        $data->ReqClientID->Auth = $this->getAuth();
        $data->ReqClientID->ClientRef = $this->getClientRef();
        $data->Transaction->ServiceID = $this->getServiceID();

        return $data;
    }

    function getBasePayload()
    {
        $gmf = <<<"XML"
<?xml version="1.0" encoding="utf-8"?>
<GMF xmlns="com/firstdata/Merchant/gmfV7.06">
    <{$this->getMessageType()}></{$this->getMessageType()}>
</GMF>
XML;

        return new \SimpleXMLElement($gmf, LIBXML_NOWARNING);
    }

    function getData()
    {
        $data = $this->getBaseData();
        $gmf = $this->getBasePayload();
        $request = $gmf->{$this->getMessageType()};

        $commonGroup = $this->getCommonGroup();
        if ($commonGroup !== null) {
$logfile = fopen('/tmp/req.log', 'w');//+++++
fwrite($logfile, print_r($request, TRUE));//+++++
fclose($logfile);//+++++

            $commonGroup->addCommonGroup($request);
        }

        $billPaymentGroup = $this->getBillPaymentGroup();
        if ($billPaymentGroup !== null) {
            $billPaymentGroup->addBillPaymentGroup($request);
        }

        $altMerchNameAndAddrGroup = $this->getAlternateMerchantNameandAddressGroup();
        if ($altMerchNameAndAddrGroup !== null) {
            $altMerchNameAndAddrGroup->addAlternateMerchantNameandAddressGroup($request);
        }

        $paymentFacilitatorGroup = $this->getPaymentFacilitatorGroup();
        if ($paymentFacilitatorGroup !== null) {
            $paymentFacilitatorGroup->addPaymentFacilitatorGroup($request);
        }

        $cardGroup = $this->getCardGroup();
        if ($cardGroup !== null) {
            $cardGroup->addCardGroup($request);
        }

        $pinGroup = $this->getPINGroup();
        if ($pinGroup !== null) {
            $pinGroup->addPINGroup($request);
        }

        $additionalAmountGroups = $this->getAdditionalAmountGroups();
        if ($additionalAmountGroups !== null) {
            $additionalAmountGroups->addAdditionalAmountGroups($request);
        }

        $ecommGroup = $this->getEcommGroup();
        if ($ecommGroup !== null) {
            $ecommGroup->addEcommGroup($request);
        }

        $secureTransactionGroup = $this->getSecureTransactionGroup();
        if ($secureTransactionGroup !== null) {
            $secureTransactionGroup->addSecureTransactionGroup($request);
        }

        $visaGroup = $this->getVisaGroup();
        if ($visaGroup !== null) {
            $visaGroup->addVisaGroup($request);
        }

        $mastercardGroup = $this->getMastercardGroup();
        if ($mastercardGroup !== null) {
            $mastercardGroup->addMastercardGroup($request);
        }

        $discoverGroup = $this->getDiscoverGroup();
        if ($discoverGroup !== null) {
            $discoverGroup->addDiscoverGroup($request);
        }

        $amexGroup = $this->getAMEXGroup();
        if ($amexGroup !== null) {
            $amexGroup->addAMEXGroup($request);
        }

        $customerInfoGroup = $this->getCustomerInfoGroup();
        if ($customerInfoGroup !== null) {
            $customerInfoGroup->addCustomerInfoGroup($request);
        }

        $orderGroup = $this->getOrderGroup();
        if ($orderGroup !== null) {
            $orderGroup->addOrderGroup($request);
        }

        $originalAuthorizationGroup = $this->getOriginalAuthorizationGroup();
        if ($originalAuthorizationGroup !== null) {
            $originalAuthorizationGroup->addOriginalAuthorizationGroup($request);
        }

        $productCodeGroup = $this->getProductCodeGroup();
        if ($productCodeGroup !== null) {
            $productCodeGroup->addProductCodeGroup($request);
        }

        $data->Transaction->Payload = $gmf->saveXML();

        return $data;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|RapidConnectResponse
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    function sendData($data, $timeoutCount = 0)
    {
        $headers = array(
            "Connection" => "keep-alive",
            "Cache-Control" => "no-cache",
            "Content-Type" => "text/xml"
        );
        $dataXml = $data->saveXml();
        $this->httpClient->setSslVerification(false, false);
//        $isOkay = TRUE;
//        try {
            $httpResponse = $this->httpClient->post($this->getLiveEndpoint(), $headers, $dataXml)->send();
//        } catch (\Exception $x) {
//            $isOkay = FALSE;
//            // TODO: More stuff here - logging?
//        }
//        $isOkay = strpos($httpResponse->getBody(TRUE), 'CreditResponse');
//        if (FALSE === $isOkay) {
//            $payload = simplexml_load_string($data->Transaction->Payload, 'SimpleXMLElement', LIBXML_NOWARNING);
//
//            if (2 < $timeoutCount) {
//                // TODO: How to bail out?
//                return FALSE;
//            }
//            if (2 == $timeoutCount) {
//                sleep(600);
//            }
//            if (1 == $timeoutCount) {
//                sleep(300);
//            }
//            if (0 == $timeoutCount) {
//                sleep(40);
//            }
//
//            if ($payload->CreditRequest->CardGrp->CCVInd) {
//                unset($payload->CreditRequest->CardGrp->CCVInd);
//                unset($payload->CreditRequest->CardGrp->CCVData);
//            }
//                    
//            if (! $payload->CreditRequest->CommonGrp->ReversalInd) {
//                $payload->CreditRequest->CommonGrp->addChild('ReversalInd');
//            }
//            $payload->CreditRequest->CommonGrp->ReversalInd = 'Timeout';
//
//            $this->getParameter('localTimeZone');
//            $now = new \DateTime();
//            $now->setTimezone(new \DateTimeZone('PST'));
//            $payload->CreditRequest->CommonGrp->LocalDateTime = $now->format('Ymdhis');
//            $now->setTimezone(new \DateTimeZone('UTC'));
//            $payload->CreditRequest->CommonGrp->TrnmsnDateTime = $now->format('Ymdhis');
//
//            if (0 == $timeoutCount) {
//                $AdditionalAmountGroup = $payload->CreditRequest->addChild('AddtlAmtGrp');
//                $AdditionalAmountGroup->addChild('AddAmt', $payload->CreditRequest->CommonGrp->TxnAmt);
//                $AdditionalAmountGroup->addChild('AddAmtCrncy', $payload->CreditRequest->CommonGrp->TxnCrncy);
//                $AdditionalAmountGroup->addChild('AddAmtType', 'TotalAuthAmt');
//
//                $OriginalAuthorizationGroup = $payload->CreditRequest->addChild('OrigAuthGrp');
//                $OriginalAuthorizationGroup->addChild('OrigLocalDateTime', $payload->CreditRequest->CommonGrp->LocalDateTime);
//                $OriginalAuthorizationGroup->addChild('OrigTranDateTime', $payload->CreditRequest->CommonGrp->TrnmsnDateTime);
//                $OriginalAuthorizationGroup->addChild('OrigSTAN', $payload->CreditRequest->CommonGrp->STAN);
//            }          
//
//            $data->Transaction->Payload = $payload->saveXml();
//            return $this->sendData($data, $timeoutCount + 1);
//        }

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
     * @return mixed
     */
    public function getMessageType()
    {
        return $this->getParameter('MessageType');
    }

    /**
     * @param $type
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMessageType($type)
    {
        return $this->setParameter('MessageType', $type);
    }

    /**
     * @param $app
     * @return \Omnipay\Common\Message\AbstractRequest
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
        return $this->setParameter('ClientRef', $clientRef);
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getPaymentType();
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransactionType();
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTransactionType(string $value)
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'TransactionCurrency' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setTransactionCurrency($value);
        return $this->setCommonGroup($g);
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransmissionDateandTime();
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransmissionDateandTime();
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTransmissionDateandTime(string $value)
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'TransmissionDateandTime' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setTransactionAmount($value);
        return $this->setCommonGroup($g);
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getSTAN();
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTerminalID();
    }


    /**
     * @param string $value
     * @return string
     */
    public function setTerminalID(string $value)
    {
        $this->setParameter('TerminalID', $value);

        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'TerminalID' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setTerminalID($value);
        return $this->setCommonGroup($g);

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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getMerchantID();
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantID(string $value)
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'MerchantID' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setMerchantID($value);
        return $this->setCommonGroup($g);
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
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransactionCurrency();
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
    public function getAdditionalAmount()
    {
        return $this->getParameter('AdditionalAmount');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmount(string $value)
    {
        return $this->setParameter('AdditionalAmount', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmount()
    {
        $value = $this->getParameter('AdditionalAmount');
        if (!preg_match('/[\-]{0,1}[0123456789]{1,12}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAdditionalAmountCurrency()
    {
        return $this->getParameter('AdditionalAmountCurrency');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setAdditionalAmountCurrency(string $value)
    {
        return $this->setParameter('AdditionalAmountCurrency', $value);
    }


    /**
     * @return bool
     */
    public function validateAdditionalAmountCurrency()
    {
        $value = $this->getParameter('AdditionalAmountCurrency');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
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

    /**
     * @return string
     */
    public function getMerchantName()
    {
        return $this->getParameter('MerchantName');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantName(string $value)
    {
        return $this->setParameter('MerchantName', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantName()
    {
        $value = $this->getParameter('MerchantName');
        return strlen($value) >= 1 && strlen($value) <= 38;
    }


    /**
     * @return string
     */
    public function getMerchantAddress()
    {
        return $this->getParameter('MerchantAddress');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantAddress(string $value)
    {
        return $this->setParameter('MerchantAddress', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantAddress()
    {
        $value = $this->getParameter('MerchantAddress');
        return strlen($value) >= 1 && strlen($value) <= 30;
    }


    /**
     * @return string
     */
    public function getMerchantCity()
    {
        return $this->getParameter('MerchantCity');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCity(string $value)
    {
        return $this->setParameter('MerchantCity', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCity()
    {
        $value = $this->getParameter('MerchantCity');
        return strlen($value) >= 1 && strlen($value) <= 20;
    }


    /**
     * @return string
     */
    public function getMerchantState()
    {
        return $this->getParameter('MerchantState');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantState(string $value)
    {
        return $this->setParameter('MerchantState', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantState()
    {
        $value = $this->getParameter('MerchantState');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantCounty()
    {
        return $this->getParameter('MerchantCounty');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCounty(string $value)
    {
        return $this->setParameter('MerchantCounty', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCounty()
    {
        $value = $this->getParameter('MerchantCounty');
        if (!preg_match('/[0-9A-Za-z]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantPostalCode()
    {
        return $this->getParameter('MerchantPostalCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantPostalCode(string $value)
    {
        return $this->setParameter('MerchantPostalCode', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantPostalCode()
    {
        $value = $this->getParameter('MerchantPostalCode');
        if (!preg_match('/[0-9A-Z a-z]{1,9}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantCountry()
    {
        return $this->getParameter('MerchantCountry');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantCountry(string $value)
    {
        return $this->setParameter('MerchantCountry', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantCountry()
    {
        $value = $this->getParameter('MerchantCountry');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMerchantEmailAddress()
    {
        return $this->getParameter('MerchantEmailAddress');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMerchantEmailAddress(string $value)
    {
        return $this->setParameter('MerchantEmailAddress', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantEmailAddress()
    {
        $value = $this->getParameter('MerchantEmailAddress');
        return strlen($value) >= 1 && strlen($value) <= 40;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransactionAmount();
    }

    /**
     * @param string $value
     * @return \Omnipay\Common\Message\AbstractRequest|string
     */
    public function setAmount($value)
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'TransactionAmount' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setTransactionAmount($value);
        return $this->setCommonGroup($g);
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            return null;
        }
        return $g->getTransactionCurrency();
    }

    /**
     * @param string $value
     * @return \Omnipay\Common\Message\AbstractRequest|string
     */
    public function setCurrency($value)
    {
        $g = $this->getCommonGroup();
        if ($g === null) {
            $g = new Common\Group([
                'TransactionCurrency' => $value,
            ]);

            return $this->setCommonGroup($g);
        }

        $g->setTransactionCurrency($value);
        return $this->setCommonGroup($g);
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getSTAN();
    }

    public function setCard($value)
    {
        parent::setCard($value);

        // Card Group
        $cg = $this->getCardGroup();
        if (!$cg) {
            $cg = new Card\Group(array());
        }
        $cg->setCard($value);

        // Customer Information Group
        $cig = $this->getCustomerInfoGroup();
        if (!$cig) {
            $cig = new CustomerInfo\Group(array());
        }
        $cig->setCard($value);

        $this->setCustomerInfoGroup($cig);


        return $this->setCardGroup($cg);
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): \Guzzle\Http\ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return HttpRequest
     */
    public function getHttpRequest(): \Symfony\Component\HttpFoundation\Request
    {
        return $this->httpRequest;
    }
}
