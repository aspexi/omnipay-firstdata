<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectCompletionRequest extends RapidConnectCreditRequest
{
    protected $txnType = 'Completion';

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

        $this->setPaymentType($this->pymtType);
        $this->setTransactionType($this->txnType);
        $now = new \DateTime();
        $this->setTransmissionDateandTime($now->format('Ymdhis'));

        $gmf = new \SimpleXMLElement('<GMF/>');
        $gmf->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $gmf->addAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $gmf->addAttribute('xmlns', 'com/firstdata/Merchant/gmfV1.1');

        $request = $gmf->addChild("{$this->requestType}");

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

        return $data;
    }
}
