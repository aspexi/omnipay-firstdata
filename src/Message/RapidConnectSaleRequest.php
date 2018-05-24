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
}
