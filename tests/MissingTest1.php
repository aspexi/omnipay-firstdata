<?php

namespace Omnipay\FirstData;

use Omnipay\Tests\TestCase;

class RapidConnectGatewayCertificationTest extends TestCase
{
	public $responses;


	public function setUp()
	{
		parent::setUp();

		if (!getenv('RAPIDCONNECT_APP') ||
		   !getenv('RAPIDCONNECT_DID_ECOMM') ||
		   !getenv('RAPIDCONNECT_DID_MOTO') ||
		   !getenv('RAPIDCONNECT_DID_RETAIL') ||
		   !getenv('RAPIDCONNECT_GROUPID') ||
		   !getenv('RAPIDCONNECT_MERCHANTID_ECOMM') ||
		   !getenv('RAPIDCONNECT_MERCHANTID_MOTO') ||
		   !getenv('RAPIDCONNECT_MERCHANTID_RETAIL') ||
		   !getenv('RAPIDCONNECT_MERCHANT_EMAIL') ||
		   !getenv('RAPIDCONNECT_SERVICEID') ||
		   !getenv('RAPIDCONNECT_TERMINALID') ||
		   !getenv('RAPIDCONNECT_TPPID')
		) {
		    $this->markTestSkipped('Missing credentials');
		}
	}


	public function testCaseNumber000001340020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

		$requestData = array('card' => array('number' => '4005571701111111','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '59',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5965',
		'STAN' => '340020',
		'ReferenceNumber' => '000001340020',
		'OrderNumber' => '000001340020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'EcommURL' => 'google.com',
		),'amount' => '30006','currency' => '840','ClientRef' => '000001340020',);

		// Act
		$request = $gateway->refund($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000001710020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '59',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5965',
		'STAN' => '710020',
		'ReferenceNumber' => '000001710020',
		'OrderNumber' => '000001710020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantCountry' => '840',
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'EcommURL' => 'google.com',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '58316','currency' => '840','ClientRef' => '000001710020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000002720020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '5424180000005550','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'mastercard',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '59',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5965',
		'STAN' => '720020',
		'ReferenceNumber' => '000002720020',
		'OrderNumber' => '000002720020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantCountry' => '840',
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'EcommURL' => 'google.com',
		),'MastercardGroup' => array(
		'AuthorizationType' => '0',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '76021','currency' => '840','ClientRef' => '000002720020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000003350020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '1234','number' => '375987654000004','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'amex',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '59',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5965',
		'STAN' => '350020',
		'ReferenceNumber' => '000003350020',
		'OrderNumber' => '000003350020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantCountry' => '840',
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'EcommURL' => 'google.com',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '34015','currency' => '840','ClientRef' => '000003350020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Z', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000003950020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '08',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5967',
		'STAN' => '950020',
		'ReferenceNumber' => '000003950020',
		'OrderNumber' => '000003950020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'AdditionalAmountGroups' => array(
		array(
		'PartialAuthorizationApprovalCapability' => '1',
		),
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'CustomerServicePhoneNumber' => '1234567890',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '64522','currency' => '840','ClientRef' => '000003950020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('002', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000003980020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4264280001234559','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '08',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '01',
		'TerminalLocationIndicator' => '1',
		'CardCaptureCapability' => '0',
		'MerchantCategoryCode' => '5967',
		'STAN' => '980020',
		'ReferenceNumber' => '000003980020',
		'OrderNumber' => '000003980020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'EcommGroup' => array(
		'EcommTransactionIndicator' => '03',
		'CustomerServicePhoneNumber' => '1234567890',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '30144','currency' => '840','ClientRef' => '000003980020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000022420020And000022420021()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4005562231212149','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '420020',
		'ReferenceNumber' => '000022420020',
		'OrderNumber' => '000022420020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '10000','currency' => '840','ClientRef' => '000022420020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}


		 // Arrange
		$requestData = array('card' => array('number' => '4005562231212149','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '420021',
		'ReferenceNumber' => '000022420021',
		'OrderNumber' => '000022420021',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'AdditionalAmountGroups' => array(
		array(
		'AdditionalAmount' => '10000',
		'AdditionalAmountCurrency' => '840',
		'AdditionalAmountType' => 'TotalAuthAmt',
		),
		),'OriginalAuthorizationGroup' => array(
		'OriginalAuthorizationID' => $response->getAuthorizationID(),
		'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
		'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
		'OriginalSTAN' => $response->getSTAN(),
		'OriginalResponseCode' => $response->getResponseCode(),
		),'amount' => '10000','currency' => '840','ClientRef' => '000022420021',);

		// Act
		$requestData['CommonGroup']['TransactionType'] = 'Sale';
		$request = $gateway->void($requestData);
		$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000022440020And000022440021()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '440020',
		'ReferenceNumber' => '000022440020',
		'OrderNumber' => '000022440020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '62008','currency' => '840','ClientRef' => '000022440020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('002', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}


		 // Arrange
		$requestData = array('card' => array('number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '440021',
		'ReferenceNumber' => '000022440021',
		'OrderNumber' => '000022440021',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'AdditionalAmountGroups' => array(
		array(
		'AdditionalAmount' => '32004',
		'AdditionalAmountCurrency' => '840',
		'AdditionalAmountType' => 'TotalAuthAmt',
		),
		array(
		'AdditionalAmount' => '32004',
		'AdditionalAmountCurrency' => '840',
		'AdditionalAmountType' => 'FirstAuthAmt',
		),
		),'OriginalAuthorizationGroup' => array(
		'OriginalAuthorizationID' => $response->getAuthorizationID(),
		'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
		'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
		'OriginalSTAN' => $response->getSTAN(),
		'OriginalResponseCode' => $response->getResponseCode(),
		),'amount' => '32004','currency' => '840','ClientRef' => '000022440021',);

		// Act
		$requestData['CommonGroup']['TransactionType'] = 'Sale';
		$request = $gateway->void($requestData);
		$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000022770020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '770020',
		'ReferenceNumber' => '000022770020',
		'OrderNumber' => '000022770020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '55002','currency' => '840','ClientRef' => '000022770020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000022830020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('number' => '4005571702222222','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'visa',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '830020',
		'ReferenceNumber' => '000022830020',
		'OrderNumber' => '000022830020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantCountry' => '840',
		),'amount' => '55008','currency' => '840','ClientRef' => '000022830020',);

		// Act
		$request = $gateway->refund($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000023230020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '6011208702222228','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'discover',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '01',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '230020',
		'ReferenceNumber' => '000023230020',
		'OrderNumber' => '000023230020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '46957','currency' => '840','ClientRef' => '000023230020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000023840020()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '123','number' => '5424180000005550','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'mastercard',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '840020',
		'ReferenceNumber' => '000023840020',
		'OrderNumber' => '000023840020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'MastercardGroup' => array(
		'AuthorizationType' => '0',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '22400','currency' => '840','ClientRef' => '000023840020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('500', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000024110020And000024110021()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '1234','number' => '375987654111116','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'amex',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '110020',
		'ReferenceNumber' => '000024110020',
		'OrderNumber' => '000024110020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '30000','currency' => '840','ClientRef' => '000024110020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}


		 // Arrange
		$requestData = array('card' => array('number' => '375987654111116','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'amex',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '110021',
		'ReferenceNumber' => '000024110021',
		'OrderNumber' => '000024110021',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'AdditionalAmountGroups' => array(
		array(
		'AdditionalAmount' => '30000',
		'AdditionalAmountCurrency' => '840',
		'AdditionalAmountType' => 'TotalAuthAmt',
		),
		),'OriginalAuthorizationGroup' => array(
		'OriginalAuthorizationID' => $response->getAuthorizationID(),
		'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
		'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
		'OriginalSTAN' => $response->getSTAN(),
		'OriginalResponseCode' => $response->getResponseCode(),
		),'amount' => '30000','currency' => '840','ClientRef' => '000024110021',);

		// Act
		$requestData['CommonGroup']['TransactionType'] = 'Sale';
		$request = $gateway->void($requestData);
		$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}


	public function testCaseNumber000024130020And000024130021()
	{
		// Arrange
		        $expirationDate = new \DateTime();
		        $expirationDate->add(new \DateInterval('P1Y'));
		        $expiryMonth = $expirationDate->format('m');
		        $expiryYear = $expirationDate->format('Y');

		        $now = new \DateTime();
		        $now->setTimezone(new \DateTimeZone('GMT'));

		        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
		        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
		        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
		        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
		        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
		$gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
		$gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

		$requestData = array('card' => array('billingAddress1' => '1307 Broad Hollow Road','billingPostcode' => '11747','cvv' => '1234','number' => '375987654111116','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'amex',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '130020',
		'ReferenceNumber' => '000024130020',
		'OrderNumber' => '000024130020',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'CustomerInformationGroup' => array(
		    'AVSBillingAddress' => '1307 Broad Hollow Road',
		    'AVSBillingPostalCode' => '11747',
		),'amount' => '54436','currency' => '840','ClientRef' => '000024130020',);

		// Act
		$request = $gateway->purchase($requestData);$response = $request->send();

		// Assert
		try {
		$this->assertEquals('Y', $response->getAVSResultCode());
		$this->assertEquals('Match', $response->getCCVResultCode());
		$this->assertEquals('002', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}


		 // Arrange
		$requestData = array('card' => array('number' => '375987654111116','expiryMonth' => $expiryMonth,'expiryYear' => $expiryYear,'type' => 'amex',),'CommonGroup' => array('TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
		'LocalDateandTime' => $now->format('Ymdhis'),
		'TransmissionDateandTime' => $now->format('Ymdhis'),
		'POSEntryMode' => array(
		'entryMode' => '90',
		'pinCapability' => '2',
		),

		'POSConditionCode' => '00',
		'TerminalCategoryCode' => '00',
		'TerminalEntryCapability' => '03',
		'TerminalLocationIndicator' => '0',
		'CardCaptureCapability' => '1',
		'MerchantCategoryCode' => '5399',
		'STAN' => '130021',
		'ReferenceNumber' => '000024130021',
		'OrderNumber' => '000024130021',),'AlternateMerchantNameandAddressGroup' => array(
		'MerchantName' => ' SMITH HARDWARE',
		'MerchantAddress' => '1307 Walt Whitman Road',
		'MerchantCity' => 'Melville',
		'MerchantState' => 'NY',
		'MerchantPostalCode' => '11747',
		'MerchantCountry' => '840',
		),'AdditionalAmountGroups' => array(
		array(
		'AdditionalAmount' => '27218',
		'AdditionalAmountCurrency' => '840',
		'AdditionalAmountType' => 'TotalAuthAmt',
		),
		),'OriginalAuthorizationGroup' => array(
		'OriginalAuthorizationID' => $response->getAuthorizationID(),
		'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
		'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
		'OriginalSTAN' => $response->getSTAN(),
		'OriginalResponseCode' => $response->getResponseCode(),
		),'amount' => '27218','currency' => '840','ClientRef' => '000024130021',);

		// Act
		$requestData['CommonGroup']['TransactionType'] = 'Sale';
		$request = $gateway->void($requestData);
		$response = $request->send();

		// Assert
		try {
		$this->assertEquals('000', $response->getResponseCode());
		} catch(\PHPUnit_Framework_ExpectationFailedException $e) {
		$testCaseNumber = $requestData['ClientRef'];
		$responseCode = $response->getResponseCode();
		if ($responseCode === null) {
		$responseCode = 'null';
		}
		$errorData = $response->getErrorData();
		if ($errorData === null) {
		$errorData = 'null';
		}
		$this->fail("$testCaseNumber,$responseCode,\"$errorData\"");
		}
	}

}
