<?php

namespace Omnipay\FirstData;

use Omnipay\FirstData\Message\RapidConnectAbstractRequest;
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

    public function testCaseNumber000138430010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '430010',
                'ReferenceNumber' => '000138430010',
                'OrderNumber' => '000138430010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '34206',
            'currency' => '840',
            'ClientRef' => '000138430010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138460010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '460010',
                'ReferenceNumber' => '000138460010',
                'OrderNumber' => '000138460010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '62207',
            'currency' => '840',
            'ClientRef' => '000138460010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138510010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '510010',
                'ReferenceNumber' => '000138510010',
                'OrderNumber' => '000138510010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '83211',
            'currency' => '840',
            'ClientRef' => '000138510010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138540010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '3566000022222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '540010',
                'ReferenceNumber' => '000138540010',
                'OrderNumber' => '000138540010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '117022',
            'currency' => '840',
            'ClientRef' => '000138540010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138550010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '550010',
                'ReferenceNumber' => '000138550010',
                'OrderNumber' => '000138550010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '101209',
            'currency' => '840',
            'ClientRef' => '000138550010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180290010And000180290011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '6221280005638208',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '290010',
                'ReferenceNumber' => '000180290010',
                'OrderNumber' => '000180290010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '2610',
            'currency' => '840',
            'ClientRef' => '000180290010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6221280005638208',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '290011',
                'ReferenceNumber' => '000180290011',
                'OrderNumber' => '000180290011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '2610',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '290011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '2610',
            'currency' => '840',
            'ClientRef' => '000180290011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247080010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
                'POSEntryMode' => array(
                    'entryMode' => '10',
                    'pinCapability' => '2',
                ),

                'POSConditionCode' => '59',
                'TerminalCategoryCode' => '00',
                'TerminalEntryCapability' => '01',
                'TerminalLocationIndicator' => '1',
                'TransactionInitiation' => 'Merchant',
                'CardCaptureCapability' => '0',
                'MerchantCategoryCode' => '5965',
                'STAN' => '080010',
                'ReferenceNumber' => '000247080010',
                'OrderNumber' => '000247080010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'VisaGroup' => array(
                'AuthIndicator' => 'CrdOnFile',
                'StoredCredentialIndicator' => 'Subsequent',
                'CardOnFileScheduleIndicator' => 'Unscheduled',
            ),
            'amount' => '21026',
            'currency' => '840',
            'ClientRef' => '000247080010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247110010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '110010',
                'ReferenceNumber' => '000247110010',
                'OrderNumber' => '000247110010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '21029',
            'currency' => '840',
            'ClientRef' => '000247110010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247120010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '120010',
                'ReferenceNumber' => '000247120010',
                'OrderNumber' => '000247120010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '21030',
            'currency' => '840',
            'ClientRef' => '000247120010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247130010And000247130011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '130010',
                'ReferenceNumber' => '000247130010',
                'OrderNumber' => '000247130010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '21031',
            'currency' => '840',
            'ClientRef' => '000247130010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '130011',
                'ReferenceNumber' => '000247130011',
                'OrderNumber' => '000247130011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '21031',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '130011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '130011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '21031',
            'currency' => '840',
            'ClientRef' => '000247130011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247210010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '210010',
                'ReferenceNumber' => '000247210010',
                'OrderNumber' => '000247210010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '21039',
            'currency' => '840',
            'ClientRef' => '000247210010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247240010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '240010',
                'ReferenceNumber' => '000247240010',
                'OrderNumber' => '000247240010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '21042',
            'currency' => '840',
            'ClientRef' => '000247240010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247250010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '250010',
                'ReferenceNumber' => '000247250010',
                'OrderNumber' => '000247250010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '21043',
            'currency' => '840',
            'ClientRef' => '000247250010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000247260010And000247260011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260010',
                'ReferenceNumber' => '000247260010',
                'OrderNumber' => '000247260010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '21044',
            'currency' => '840',
            'ClientRef' => '000247260010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260011',
                'ReferenceNumber' => '000247260011',
                'OrderNumber' => '000247260011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '21044',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '260011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '260011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '21044',
            'currency' => '840',
            'ClientRef' => '000247260011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000524650010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '650010',
                'ReferenceNumber' => '000524650010',
                'OrderNumber' => '000524650010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '55444',
            'currency' => '840',
            'ClientRef' => '000524650010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000524680010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '680010',
                'ReferenceNumber' => '000524680010',
                'OrderNumber' => '000524680010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '55032',
            'currency' => '840',
            'ClientRef' => '000524680010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000524690010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '690010',
                'ReferenceNumber' => '000524690010',
                'OrderNumber' => '000524690010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '35078',
            'currency' => '840',
            'ClientRef' => '000524690010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000525110010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '110010',
                'ReferenceNumber' => '000525110010',
                'OrderNumber' => '000525110010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '62880',
            'currency' => '840',
            'ClientRef' => '000525110010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000525740010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '740010',
                'ReferenceNumber' => '000525740010',
                'OrderNumber' => '000525740010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '76890',
            'currency' => '840',
            'ClientRef' => '000525740010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000525770010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '770010',
                'ReferenceNumber' => '000525770010',
                'OrderNumber' => '000525770010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '76684',
            'currency' => '840',
            'ClientRef' => '000525770010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000525780010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '780010',
                'ReferenceNumber' => '000525780010',
                'OrderNumber' => '000525780010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '84786',
            'currency' => '840',
            'ClientRef' => '000525780010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000528150010And000528150011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150010',
                'ReferenceNumber' => '000528150010',
                'OrderNumber' => '000528150010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '34153',
            'currency' => '840',
            'ClientRef' => '000528150010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150011',
                'ReferenceNumber' => '000528150011',
                'OrderNumber' => '000528150011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34153',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '34153',
            'currency' => '840',
            'ClientRef' => '000528150011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000528160010And000528160011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '160010',
                'ReferenceNumber' => '000528160010',
                'OrderNumber' => '000528160010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '34689',
            'currency' => '840',
            'ClientRef' => '000528160010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '160011',
                'ReferenceNumber' => '000528160011',
                'OrderNumber' => '000528160011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34689',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '34689',
            'currency' => '840',
            'ClientRef' => '000528160011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000528950010And000528950011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '950010',
                'ReferenceNumber' => '000528950010',
                'OrderNumber' => '000528950010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '57711',
            'currency' => '840',
            'ClientRef' => '000528950010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '950011',
                'ReferenceNumber' => '000528950011',
                'OrderNumber' => '000528950011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '57711',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '950011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '950011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '57711',
            'currency' => '840',
            'ClientRef' => '000528950011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000528960010And000528960011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005571701111111',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '960010',
                'ReferenceNumber' => '000528960010',
                'OrderNumber' => '000528960010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '57208',
            'currency' => '840',
            'ClientRef' => '000528960010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005571701111111',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '960011',
                'ReferenceNumber' => '000528960011',
                'OrderNumber' => '000528960011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '57208',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '960011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '960011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '57208',
            'currency' => '840',
            'ClientRef' => '000528960011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000530100010And000530100011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '100010',
                'ReferenceNumber' => '000530100010',
                'OrderNumber' => '000530100010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '82794',
            'currency' => '840',
            'ClientRef' => '000530100010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '100011',
                'ReferenceNumber' => '000530100011',
                'OrderNumber' => '000530100011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '82794',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '82794',
            'currency' => '840',
            'ClientRef' => '000530100011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000530120010And000530120011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '120010',
                'ReferenceNumber' => '000530120010',
                'OrderNumber' => '000530120010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '76982',
            'currency' => '840',
            'ClientRef' => '000530120010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '120011',
                'ReferenceNumber' => '000530120011',
                'OrderNumber' => '000530120011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '38491',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '38491',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '38491',
            'currency' => '840',
            'ClientRef' => '000530120011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000534520010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '520010',
                'ReferenceNumber' => '000534520010',
                'OrderNumber' => '000534520010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '11124',
            'currency' => '840',
            'ClientRef' => '000534520010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000534530010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '530010',
                'ReferenceNumber' => '000534530010',
                'OrderNumber' => '000534530010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'amount' => '11126',
            'currency' => '840',
            'ClientRef' => '000534530010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000534620010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005571701111111',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '620010',
                'ReferenceNumber' => '000534620010',
                'OrderNumber' => '000534620010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '11750',
            'currency' => '840',
            'ClientRef' => '000534620010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000534770010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '770010',
                'ReferenceNumber' => '000534770010',
                'OrderNumber' => '000534770010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '11956',
            'currency' => '840',
            'ClientRef' => '000534770010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000534780010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_ECOMM'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_ECOMM'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '780010',
                'ReferenceNumber' => '000534780010',
                'OrderNumber' => '000534780010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '11958',
            'currency' => '840',
            'ClientRef' => '000534780010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138120010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '120010',
                'ReferenceNumber' => '000138120010',
                'OrderNumber' => '000138120010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '83256',
            'currency' => '840',
            'ClientRef' => '000138120010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('N', $response->getAVSResultCode());
            $this->assertEquals('NoMtch', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138130010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '130010',
                'ReferenceNumber' => '000138130010',
                'OrderNumber' => '000138130010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '83297',
            'currency' => '840',
            'ClientRef' => '000138130010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138150010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150010',
                'ReferenceNumber' => '000138150010',
                'OrderNumber' => '000138150010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '34281',
            'currency' => '840',
            'ClientRef' => '000138150010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000138170010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '170010',
                'ReferenceNumber' => '000138170010',
                'OrderNumber' => '000138170010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '101283',
            'currency' => '840',
            'ClientRef' => '000138170010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000139140010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005578003333335',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '140010',
                'ReferenceNumber' => '000139140010',
                'OrderNumber' => '000139140010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16300',
            'currency' => '840',
            'ClientRef' => '000139140010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000139160010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '160010',
                'ReferenceNumber' => '000139160010',
                'OrderNumber' => '000139160010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '16298',
            'currency' => '840',
            'ClientRef' => '000139160010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000139180010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '180010',
                'ReferenceNumber' => '000139180010',
                'OrderNumber' => '000139180010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16242',
            'currency' => '840',
            'ClientRef' => '000139180010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000139220010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '3566000022222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '220010',
                'ReferenceNumber' => '000139220010',
                'OrderNumber' => '000139220010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16296',
            'currency' => '840',
            'ClientRef' => '000139220010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180040010And000180040011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '5424180000007770',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '040010',
                'ReferenceNumber' => '000180040010',
                'OrderNumber' => '000180040010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '7678',
            'currency' => '840',
            'ClientRef' => '000180040010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180000007770',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '040011',
                'ReferenceNumber' => '000180040011',
                'OrderNumber' => '000180040011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '7678',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '040011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '7678',
            'currency' => '840',
            'ClientRef' => '000180040011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180200010And000180200011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '200010',
                'ReferenceNumber' => '000180200010',
                'OrderNumber' => '000180200010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '34750',
            'currency' => '840',
            'ClientRef' => '000180200010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '200011',
                'ReferenceNumber' => '000180200011',
                'OrderNumber' => '000180200011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34750',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '200011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '34750',
            'currency' => '840',
            'ClientRef' => '000180200011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180300010And000180300011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '6221280005638208',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '300010',
                'ReferenceNumber' => '000180300010',
                'OrderNumber' => '000180300010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '2612',
            'currency' => '840',
            'ClientRef' => '000180300010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6221280005638208',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '300011',
                'ReferenceNumber' => '000180300011',
                'OrderNumber' => '000180300011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '2612',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
 //               'OriginalAuthorizationID' => '300011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '300011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '2612',
            'currency' => '840',
            'ClientRef' => '000180300011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180930010And000180930011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '930010',
                'ReferenceNumber' => '000180930010',
                'OrderNumber' => '000180930010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '62282',
            'currency' => '840',
            'ClientRef' => '000180930010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '930011',
                'ReferenceNumber' => '000180930011',
                'OrderNumber' => '000180930011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '62282',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '62282',
            'currency' => '840',
            'ClientRef' => '000180930011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246000010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '000010',
                'ReferenceNumber' => '000246000010',
                'OrderNumber' => '000246000010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21001',
            'currency' => '840',
            'ClientRef' => '000246000010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246030010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '030010',
                'ReferenceNumber' => '000246030010',
                'OrderNumber' => '000246030010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '21004',
            'currency' => '840',
            'ClientRef' => '000246030010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246040010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '040010',
                'ReferenceNumber' => '000246040010',
                'OrderNumber' => '000246040010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21005',
            'currency' => '840',
            'ClientRef' => '000246040010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246050010And000246050011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '050010',
                'ReferenceNumber' => '000246050010',
                'OrderNumber' => '000246050010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '21006',
            'currency' => '840',
            'ClientRef' => '000246050010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '050011',
                'ReferenceNumber' => '000246050011',
                'OrderNumber' => '000246050011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '21006',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '21006',
            'currency' => '840',
            'ClientRef' => '000246050011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246130010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '130010',
                'ReferenceNumber' => '000246130010',
                'OrderNumber' => '000246130010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21014',
            'currency' => '840',
            'ClientRef' => '000246130010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246160010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '160010',
                'ReferenceNumber' => '000246160010',
                'OrderNumber' => '000246160010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21017',
            'currency' => '840',
            'ClientRef' => '000246160010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246170010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '170010',
                'ReferenceNumber' => '000246170010',
                'OrderNumber' => '000246170010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21017',
            'currency' => '840',
            'ClientRef' => '000246170010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000246180010And000246180011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '180010',
                'ReferenceNumber' => '000246180010',
                'OrderNumber' => '000246180010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '21018',
            'currency' => '840',
            'ClientRef' => '000246180010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005562231212123',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '180011',
                'ReferenceNumber' => '000246180011',
                'OrderNumber' => '000246180011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '21018',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '21018',
            'currency' => '840',
            'ClientRef' => '000246180011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532240010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '240010',
                'ReferenceNumber' => '000532240010',
                'OrderNumber' => '000532240010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '216092',
            'currency' => '840',
            'ClientRef' => '000532240010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532250010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '250010',
                'ReferenceNumber' => '000532250010',
                'OrderNumber' => '000532250010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '216094',
            'currency' => '840',
            'ClientRef' => '000532250010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532260010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005578003333335',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260010',
                'ReferenceNumber' => '000532260010',
                'OrderNumber' => '000532260010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16252',
            'currency' => '840',
            'ClientRef' => '000532260010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532270010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '4005578003333335',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '270010',
                'ReferenceNumber' => '000532270010',
                'OrderNumber' => '000532270010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16254',
            'currency' => '840',
            'ClientRef' => '000532270010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532350010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '350010',
                'ReferenceNumber' => '000532350010',
                'OrderNumber' => '000532350010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '16248',
            'currency' => '840',
            'ClientRef' => '000532350010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532360010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '123',
                'number' => '5256977001111110',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '360010',
                'ReferenceNumber' => '000532360010',
                'OrderNumber' => '000532360010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '16250',
            'currency' => '840',
            'ClientRef' => '000532360010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000532420010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_MOTO'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_MOTO'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '420010',
                'ReferenceNumber' => '000532420010',
                'OrderNumber' => '000532420010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantEmailAddress' => getenv('RAPIDCONNECT_MERCHANT_EMAIL'),
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '03',
                'CustomerServicePhoneNumber' => '1234567890',
            ),
            'amount' => '16240',
            'currency' => '840',
            'ClientRef' => '000532420010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000136870010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '870010',
                'ReferenceNumber' => '000136870010',
                'OrderNumber' => '000136870010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '54202',
            'currency' => '840',
            'ClientRef' => '000136870010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000136970010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '970010',
                'ReferenceNumber' => '000136970010',
                'OrderNumber' => '000136970010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '62144',
            'currency' => '840',
            'ClientRef' => '000136970010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137020010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '020010',
                'ReferenceNumber' => '000137020010',
                'OrderNumber' => '000137020010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '83136',
            'currency' => '840',
            'ClientRef' => '000137020010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137050010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '050010',
                'ReferenceNumber' => '000137050010',
                'OrderNumber' => '000137050010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34146',
            'currency' => '840',
            'ClientRef' => '000137050010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137070010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '070010',
                'ReferenceNumber' => '000137070010',
                'OrderNumber' => '000137070010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34139',
            'currency' => '840',
            'ClientRef' => '000137070010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137120010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '120010',
                'ReferenceNumber' => '000137120010',
                'OrderNumber' => '000137120010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '101135',
            'currency' => '840',
            'ClientRef' => '000137120010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137140010And000137140011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4005571701111111',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '140010',
                'ReferenceNumber' => '000137140010',
                'OrderNumber' => '000137140010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '57210',
            'currency' => '840',
            'ClientRef' => '000137140010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005571701111111',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '140011',
                'ReferenceNumber' => '000137140011',
                'OrderNumber' => '000137140011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '57210',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '57210',
            'currency' => '840',
            'ClientRef' => '000137140011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137170010And000137170011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '170010',
                'ReferenceNumber' => '000137170010',
                'OrderNumber' => '000137170010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '57311',
            'currency' => '840',
            'ClientRef' => '000137170010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '170011',
                'ReferenceNumber' => '000137170011',
                'OrderNumber' => '000137170011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '57311',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '57311',
            'currency' => '840',
            'ClientRef' => '000137170011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137200010And000137200011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '200010',
                'ReferenceNumber' => '000137200010',
                'OrderNumber' => '000137200010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '76056',
            'currency' => '840',
            'ClientRef' => '000137200010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '200011',
                'ReferenceNumber' => '000137200011',
                'OrderNumber' => '000137200011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '38028',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '38028',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '38028',
            'currency' => '840',
            'ClientRef' => '000137200011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137230010And000137230011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '230010',
                'ReferenceNumber' => '000137230010',
                'OrderNumber' => '000137230010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '76052',
            'currency' => '840',
            'ClientRef' => '000137230010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '230011',
                'ReferenceNumber' => '000137230011',
                'OrderNumber' => '000137230011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '38026',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '38026',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '38026',
            'currency' => '840',
            'ClientRef' => '000137230011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137260010And000137260011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260010',
                'ReferenceNumber' => '000137260010',
                'OrderNumber' => '000137260010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34104',
            'currency' => '840',
            'ClientRef' => '000137260010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260011',
                'ReferenceNumber' => '000137260011',
                'OrderNumber' => '000137260011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34104',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '34104',
            'currency' => '840',
            'ClientRef' => '000137260011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137290010And000137290011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '290010',
                'ReferenceNumber' => '000137290010',
                'OrderNumber' => '000137290010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34451',
            'currency' => '840',
            'ClientRef' => '000137290010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '290011',
                'ReferenceNumber' => '000137290011',
                'OrderNumber' => '000137290011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34451',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '34451',
            'currency' => '840',
            'ClientRef' => '000137290011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000137320010And000137320011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '320010',
                'ReferenceNumber' => '000137320010',
                'OrderNumber' => '000137320010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '101299',
            'currency' => '840',
            'ClientRef' => '000137320010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '320011',
                'ReferenceNumber' => '000137320011',
                'OrderNumber' => '000137320011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '101299',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '101299',
            'currency' => '840',
            'ClientRef' => '000137320011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000141460010And000141460011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '460010',
                'ReferenceNumber' => '000141460010',
                'OrderNumber' => '000141460010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11946',
            'currency' => '840',
            'ClientRef' => '000141460010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '460011',
                'ReferenceNumber' => '000141460011',
                'OrderNumber' => '000141460011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '11946',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '11946',
            'currency' => '840',
            'ClientRef' => '000141460011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000141470010And000141470011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '1234',
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '470010',
                'ReferenceNumber' => '000141470010',
                'OrderNumber' => '000141470010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '11352',
            'currency' => '840',
            'ClientRef' => '000141470010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '371030089111551',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '470011',
                'ReferenceNumber' => '000141470011',
                'OrderNumber' => '000141470011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '5676',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '5676',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '5676',
            'currency' => '840',
            'ClientRef' => '000141470011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000141830010And000141830011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '830010',
                'ReferenceNumber' => '000141830010',
                'OrderNumber' => '000141830010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '12722',
            'currency' => '840',
            'ClientRef' => '000141830010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '830011',
                'ReferenceNumber' => '000141830011',
                'OrderNumber' => '000141830011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '12722',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '830011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '830011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '12722',
            'currency' => '840',
            'ClientRef' => '000141830011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000141840010And000141840011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4005578003333335',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '840010',
                'ReferenceNumber' => '000141840010',
                'OrderNumber' => '000141840010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '12192',
            'currency' => '840',
            'ClientRef' => '000141840010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005578003333335',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '840011',
                'ReferenceNumber' => '000141840011',
                'OrderNumber' => '000141840011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '6096',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '6096',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => '840011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => '840011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '6096',
            'currency' => '840',
            'ClientRef' => '000141840011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000142240010And000142240011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '240010',
                'ReferenceNumber' => '000142240010',
                'OrderNumber' => '000142240010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '13570',
            'currency' => '840',
            'ClientRef' => '000142240010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '240011',
                'ReferenceNumber' => '000142240011',
                'OrderNumber' => '000142240011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '13570',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '13570',
            'currency' => '840',
            'ClientRef' => '000142240011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000142610010And000142610011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '6011208701112222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '610010',
                'ReferenceNumber' => '000142610010',
                'OrderNumber' => '000142610010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14540',
            'currency' => '840',
            'ClientRef' => '000142610010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6011208701112222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '610011',
                'ReferenceNumber' => '000142610011',
                'OrderNumber' => '000142610011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '14540',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '14540',
            'currency' => '840',
            'ClientRef' => '000142610011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000142620010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '3566000022222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '620010',
                'ReferenceNumber' => '000142620010',
                'OrderNumber' => '000142620010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '10912',
            'currency' => '840',
            'ClientRef' => '000142620010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000180140010And000180140011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '140010',
                'ReferenceNumber' => '000180140010',
                'OrderNumber' => '000180140010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34150',
            'currency' => '840',
            'ClientRef' => '000180140010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '140011',
                'ReferenceNumber' => '000180140011',
                'OrderNumber' => '000180140011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '34150',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '140011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '34150',
            'currency' => '840',
            'ClientRef' => '000180140011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000181150010And000181150011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150010',
                'ReferenceNumber' => '000181150010',
                'OrderNumber' => '000181150010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '62151',
            'currency' => '840',
            'ClientRef' => '000181150010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4264281511117771',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150011',
                'ReferenceNumber' => '000181150011',
                'OrderNumber' => '000181150011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '62151',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '62151',
            'currency' => '840',
            'ClientRef' => '000181150011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000181190010And000181190011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '190010',
                'ReferenceNumber' => '000181190010',
                'OrderNumber' => '000181190010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '101142',
            'currency' => '840',
            'ClientRef' => '000181190010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6011208702222228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '190011',
                'ReferenceNumber' => '000181190011',
                'OrderNumber' => '000181190011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '101142',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
                'OriginalSTAN' => '190011',
                'OriginalResponseCode' => '000',
            ),
            'amount' => '101142',
            'currency' => '840',
            'ClientRef' => '000181190011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000181230010And000181230011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '230010',
                'ReferenceNumber' => '000181230010',
                'OrderNumber' => '000181230010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '83143',
            'currency' => '840',
            'ClientRef' => '000181230010',
        );

        // Act
        $request = $gateway->refund($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '230011',
                'ReferenceNumber' => '000181230011',
                'OrderNumber' => '000181230011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '83143',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '83143',
            'currency' => '840',
            'ClientRef' => '000181230011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Refund';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521380010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '380010',
                'ReferenceNumber' => '000521380010',
                'OrderNumber' => '000521380010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '76054',
            'currency' => '840',
            'ClientRef' => '000521380010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521390010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180273333333',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '390010',
                'ReferenceNumber' => '000521390010',
                'OrderNumber' => '000521390010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '84315',
            'currency' => '840',
            'ClientRef' => '000521390010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521420010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180000005550',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '420010',
                'ReferenceNumber' => '000521420010',
                'OrderNumber' => '000521420010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '76050',
            'currency' => '840',
            'ClientRef' => '000521420010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521520010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '371030089111114',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '520010',
                'ReferenceNumber' => '000521520010',
                'OrderNumber' => '000521520010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '34128',
            'currency' => '840',
            'ClientRef' => '000521520010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521900010And000521900011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '900010',
                'ReferenceNumber' => '000521900010',
                'OrderNumber' => '000521900010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '59098',
            'currency' => '840',
            'ClientRef' => '000521900010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '900011',
                'ReferenceNumber' => '000521900011',
                'OrderNumber' => '000521900011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '29549',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '29549',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '29549',
            'currency' => '840',
            'ClientRef' => '000521900011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521930010And000521930011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '930010',
                'ReferenceNumber' => '000521930010',
                'OrderNumber' => '000521930010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '59094',
            'currency' => '840',
            'ClientRef' => '000521930010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '4005571702222222',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '930011',
                'ReferenceNumber' => '000521930011',
                'OrderNumber' => '000521930011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '29547',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '29547',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '29547',
            'currency' => '840',
            'ClientRef' => '000521930011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000521980010And000521980011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '980010',
                'ReferenceNumber' => '000521980010',
                'OrderNumber' => '000521980010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '84794',
            'currency' => '840',
            'ClientRef' => '000521980010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '980011',
                'ReferenceNumber' => '000521980011',
                'OrderNumber' => '000521980011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '84794',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '84794',
            'currency' => '840',
            'ClientRef' => '000521980011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000522000010And000522000011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '000010',
                'ReferenceNumber' => '000522000010',
                'OrderNumber' => '000522000010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '54208',
            'currency' => '840',
            'ClientRef' => '000522000010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '000011',
                'ReferenceNumber' => '000522000011',
                'OrderNumber' => '000522000011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '27104',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '27104',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '27104',
            'currency' => '840',
            'ClientRef' => '000522000011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000522030010And000522030011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '030010',
                'ReferenceNumber' => '000522030010',
                'OrderNumber' => '000522030010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '54204',
            'currency' => '840',
            'ClientRef' => '000522030010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('002', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '030011',
                'ReferenceNumber' => '000522030011',
                'OrderNumber' => '000522030011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '27102',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '27102',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'FirstAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '27102',
            'currency' => '840',
            'ClientRef' => '000522030011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000541820010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '820010',
                'ReferenceNumber' => '000541820010',
                'OrderNumber' => '000541820010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14426',
            'currency' => '840',
            'ClientRef' => '000541820010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000544470010And000544470011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '470010',
                'ReferenceNumber' => '000544470010',
                'OrderNumber' => '000544470010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14168',
            'currency' => '840',
            'ClientRef' => '000544470010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '470011',
                'ReferenceNumber' => '000544470011',
                'OrderNumber' => '000544470011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '14168',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '14168',
            'currency' => '840',
            'ClientRef' => '000544470011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549250010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '4264281500001119',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '250010',
                'ReferenceNumber' => '000549250010',
                'OrderNumber' => '000549250010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '259809',
            'currency' => '840',
            'ClientRef' => '000549250010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('P', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549260010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '4264281555555555',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '260010',
                'ReferenceNumber' => '000549260010',
                'OrderNumber' => '000549260010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '259109',
            'currency' => '840',
            'ClientRef' => '000549260010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('N', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549410010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '5424180000000007',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '410010',
                'ReferenceNumber' => '000549410010',
                'OrderNumber' => '000549410010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '264157',
            'currency' => '840',
            'ClientRef' => '000549410010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('N', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549420010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '5424180000007770',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '420010',
                'ReferenceNumber' => '000549420010',
                'OrderNumber' => '000549420010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '270527',
            'currency' => '840',
            'ClientRef' => '000549420010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Y', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549570010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '379605175555555',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '570010',
                'ReferenceNumber' => '000549570010',
                'OrderNumber' => '000549570010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '247729',
            'currency' => '840',
            'ClientRef' => '000549570010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('U', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549580010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '379605170000003',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '580010',
                'ReferenceNumber' => '000549580010',
                'OrderNumber' => '000549580010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '242957',
            'currency' => '840',
            'ClientRef' => '000549580010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('A', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549730010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '730010',
                'ReferenceNumber' => '000549730010',
                'OrderNumber' => '000549730010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '281908',
            'currency' => '840',
            'ClientRef' => '000549730010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000549750010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'number' => '6011361000000000',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '750010',
                'ReferenceNumber' => '000549750010',
                'OrderNumber' => '000549750010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'CustomerInformationGroup' => array(
                'AVSBillingAddress' => '1307 Broad Hollow Road',
                'AVSBillingPostalCode' => '11747',
            ),
            'amount' => '273409',
            'currency' => '840',
            'ClientRef' => '000549750010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('N', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569010010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '010010',
                'ReferenceNumber' => '000569010010',
                'OrderNumber' => '000569010010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11826',
            'currency' => '840',
            'ClientRef' => '000569010010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569020010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '1234',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '020010',
                'ReferenceNumber' => '000569020010',
                'OrderNumber' => '000569020010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11712',
            'currency' => '840',
            'ClientRef' => '000569020010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569030010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '030010',
                'ReferenceNumber' => '000569030010',
                'OrderNumber' => '000569030010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11720',
            'currency' => '840',
            'ClientRef' => '000569030010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569040010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '040010',
                'ReferenceNumber' => '000569040010',
                'OrderNumber' => '000569040010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11728',
            'currency' => '840',
            'ClientRef' => '000569040010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569050010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '1234',
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '050010',
                'ReferenceNumber' => '000569050010',
                'OrderNumber' => '000569050010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '11736',
            'currency' => '840',
            'ClientRef' => '000569050010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569610010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '610010',
                'ReferenceNumber' => '000569610010',
                'OrderNumber' => '000569610010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '12878',
            'currency' => '840',
            'ClientRef' => '000569610010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569620010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '620010',
                'ReferenceNumber' => '000569620010',
                'OrderNumber' => '000569620010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '12486',
            'currency' => '840',
            'ClientRef' => '000569620010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569640010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '640010',
                'ReferenceNumber' => '000569640010',
                'OrderNumber' => '000569640010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '12504',
            'currency' => '840',
            'ClientRef' => '000569640010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000569650010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '4264281511112228',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'visa',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '650010',
                'ReferenceNumber' => '000569650010',
                'OrderNumber' => '000569650010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '12512',
            'currency' => '840',
            'ClientRef' => '000569650010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570150010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '150010',
                'ReferenceNumber' => '000570150010',
                'OrderNumber' => '000570150010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '13580',
            'currency' => '840',
            'ClientRef' => '000570150010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570160010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '160010',
                'ReferenceNumber' => '000570160010',
                'OrderNumber' => '000570160010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '13392',
            'currency' => '840',
            'ClientRef' => '000570160010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570180010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '180010',
                'ReferenceNumber' => '000570180010',
                'OrderNumber' => '000570180010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '13410',
            'currency' => '840',
            'ClientRef' => '000570180010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570190010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '190010',
                'ReferenceNumber' => '000570190010',
                'OrderNumber' => '000570190010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '0',
            ),
            'amount' => '13418',
            'currency' => '840',
            'ClientRef' => '000570190010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570600010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '600010',
                'ReferenceNumber' => '000570600010',
                'OrderNumber' => '000570600010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14556',
            'currency' => '840',
            'ClientRef' => '000570600010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570610010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '610010',
                'ReferenceNumber' => '000570610010',
                'OrderNumber' => '000570610010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14116',
            'currency' => '840',
            'ClientRef' => '000570610010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570620010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '620010',
                'ReferenceNumber' => '000570620010',
                'OrderNumber' => '000570620010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14124',
            'currency' => '840',
            'ClientRef' => '000570620010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570630010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '630010',
                'ReferenceNumber' => '000570630010',
                'OrderNumber' => '000570630010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14312',
            'currency' => '840',
            'ClientRef' => '000570630010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000570650010()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'billingPostcode' => '11747',
                'number' => '6011361000006668',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '650010',
                'ReferenceNumber' => '000570650010',
                'OrderNumber' => '000570650010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '14328',
            'currency' => '840',
            'ClientRef' => '000570650010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Z', $response->getAVSResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

    public function testCaseNumber000584940010And000584940011()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp(getenv('RAPIDCONNECT_APP'));
        $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
        $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
        $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));

        $requestData = array(
            'card' => array(
                'cvv' => '123',
                'number' => '6240000006438706',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '940010',
                'ReferenceNumber' => '000584940010',
                'OrderNumber' => '000584940010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'amount' => '18012',
            'currency' => '840',
            'ClientRef' => '000584940010',
        );

        // Act
        $request = $gateway->purchase($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('Match', $response->getCCVResultCode());
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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
        $requestData = array(
            'card' => array(
                'number' => '6240000006438706',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '940011',
                'ReferenceNumber' => '000584940011',
                'OrderNumber' => '000584940011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '18012',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '18012',
            'currency' => '840',
            'ClientRef' => '000584940011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Sale';
        $request = $gateway->void($requestData);
        $response = $request->send();

        // Assert
        try {
            $this->assertEquals('000', $response->getResponseCode());
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
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

// Plus discovered these in the new mandatories, that were NOT in the original list of 526

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
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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
        'TerminalCategoryCode' => '01',
        'TerminalEntryCapability' => '03',
        'TerminalLocationIndicator' => '0',
        'CardCaptureCapability' => '1',
        'MerchantCategoryCode' => '5399',
        'STAN' => '420020',
        'ReferenceNumber' => '000022420020',
        'OrderNumber' => '000022420020',),'AlternateMerchantNameandAddressGroup' => array(
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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
        'OriginalAuthorizingNetworkID' => $response->getAuthorizingNetworkID(),
        ),
            'VisaGroup' => array(
                'AuthorizationCharacteristicsIndicator' => $response->getAuthorizationCharacteristicsIndicator(),
                'TransactionIdentifier' => $response->getTransactionIdentifier(),
            ),
            'amount' => '10000','currency' => '840','ClientRef' => '000022420021',);

        $requestData = RapidConnectAbstractRequest::BuildRequestArray($requestData, $request, $response);

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
        'MerchantName' => 'SMITH HARDWARE',
        'MerchantAddress' => '1307 Walt Whitman Road',
        'MerchantCity' => 'Melville',
        'MerchantState' => 'NY',
        'MerchantPostalCode' => '11747',
        'MerchantCountry' => '840',
        ),
        'AdditionalAmountGroups' => array(
            array(
                'PartialAuthorizationApprovalCapability' => '1',
            ),
        ),
        'CustomerInformationGroup' => array(
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
        'MerchantName' => 'SMITH HARDWARE',
        'MerchantAddress' => '1307 Walt Whitman Road',
        'MerchantCity' => 'Melville',
        'MerchantState' => 'NY',
        'MerchantPostalCode' => '11747',
        'MerchantCountry' => '840',
        ),'AdditionalAmountGroups' => array(
        array(
        'AdditionalAmount' => '31004',
        'AdditionalAmountCurrency' => '840',
        'AdditionalAmountType' => 'TotalAuthAmt',
        ),
        array(
        'AdditionalAmount' => '31004',
        'AdditionalAmountCurrency' => '840',
        'AdditionalAmountType' => 'FirstAuthAmt',
        ),
        ),'OriginalAuthorizationGroup' => array(
        'OriginalAuthorizationID' => $response->getAuthorizationID(),
        'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
        'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
        'OriginalSTAN' => $response->getSTAN(),
        'OriginalResponseCode' => $response->getResponseCode(),
        ),'amount' => '31004','currency' => '840','ClientRef' => '000022440021',);

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
        'MerchantName' => 'SMITH HARDWARE',
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
        'TerminalCategoryCode' => '01',
        'TerminalEntryCapability' => '03',
        'TerminalLocationIndicator' => '0',
        'CardCaptureCapability' => '1',
        'MerchantCategoryCode' => '5399',
        'STAN' => '230020',
        'ReferenceNumber' => '000023230020',
        'OrderNumber' => '000023230020',),'AlternateMerchantNameandAddressGroup' => array(
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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
        'MerchantName' => 'SMITH HARDWARE',
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

                $nowPdt = new \DateTime();
                $nowUtc = new \DateTime();
                $utc = new \DateTimeZone('UTC');
                $pdt = new \DateTimeZone('America/Los_Angeles');
                $nowUtc->setTimeZone($utc);
                $nowPdt->setTimeZone($pdt);

                $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
                $gateway->setApp(getenv('RAPIDCONNECT_APP'));
                $gateway->setGroupID(getenv('RAPIDCONNECT_GROUPID'));
                $gateway->setServiceID(getenv('RAPIDCONNECT_SERVICEID'));
                $gateway->setTerminalID(getenv('RAPIDCONNECT_TERMINALID'));
        $gateway->setDID(getenv('RAPIDCONNECT_DID_RETAIL'));
        $gateway->setMerchantID(getenv('RAPIDCONNECT_MERCHANTID_RETAIL'));
        $track2 = "375987654111116=1911101123400000";

        $requestData = array
        (
            'CommonGroup' => array
            (
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
                'LocalDateandTime' => $nowPdt->format('Ymdhis'),
                'TransmissionDateandTime' => $nowUtc->format('Ymdhis'),
                'POSEntryMode' => array(
                'entryMode' => '90',
                'pinCapability' => '2',
            ),
                'CustomerInformationGroup' => array(
                    'AVSBillingAddress' => '1307 Broad Hollow Road',
                    'AVSBillingPostalCode' => '11747',
                ),
            'POSConditionCode' => '00',
            'TerminalCategoryCode' => '00',
            'TerminalEntryCapability' => '03',
            'TerminalLocationIndicator' => '0',
            'CardCaptureCapability' => '1',
            'MerchantCategoryCode' => '5399',
            'STAN' => '130020',
            'ReferenceNumber' => '000024130020',
            'OrderNumber' => '000024130020',),'AlternateMerchantNameandAddressGroup' => array
            (
                'MerchantName' => 'SMITH HARDWARE',
                'MerchantAddress' => '1307 Walt Whitman Road',
                'MerchantCity' => 'Melville',
                'MerchantState' => 'NY',
                 'MerchantPostalCode' => '11747',
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'CardGroup' => array
            (
                'Track2Data' => $track2,
            ),
            'amount' => '54436',
            'currency' => '840',
            'ClientRef' => '000024130020',
        );

        // Act
        $request = $gateway->purchase($requestData);$response = $request->send();

        // Assert
        try {
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
                $nowPdt = new \DateTime();
                $nowUtc = new \DateTime();
                $nowUtc->setTimeZone ($utc);
                $nowPdt->setTimeZone ($pdt);
       $requestData = array(
            'card' => array(
                'number' => '375987654111116',
                'expiryMonth' => '11',
                'expiryYear' => '19',
                'type' => 'amex',
            ),
        'CommonGroup' => array
        (
            'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
            'LocalDateandTime' => $nowPdt->format('Ymdhis'),
            'TransmissionDateandTime' => $nowUtc->format('Ymdhis'),
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
        'MerchantName' => 'SMITH HARDWARE',
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
        ),
        'OriginalAuthorizationGroup' => array(
        'OriginalAuthorizationID' => $response->getAuthorizationID(),
        'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
        'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
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

