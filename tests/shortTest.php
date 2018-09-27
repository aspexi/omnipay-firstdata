<?php

namespace Omnipay\FirstData;

use Omnipay\Tests\TestCase;

class shortTest extends TestCase
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
                'OriginalAuthorizationID' => '300011',
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
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
}