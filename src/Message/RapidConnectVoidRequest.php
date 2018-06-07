<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RapidConnectVoidRequest extends RapidConnectAbstractRequest
{
	/**
	 * @return \SimpleXMLElement
	 */
	function getData()
	{
        $data = $this->getBaseData();

        $gmf = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<GMF xmlns="com/firstdata/Merchant/gmfV7.06"></GMF>
XML;

        $gmf = new \SimpleXMLElement($gmf, LIBXML_NOWARNING);

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

        $data->Transaction->Payload = htmlspecialchars($gmf->saveXML(), ENT_XML1, 'UTF-8');

        return $data;
	}
}
