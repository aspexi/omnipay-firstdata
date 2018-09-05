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

    public function testCaseNumber000756890010And000756890011()
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

        $requestData = array(
            'card' => array(
                'number' => '6011208701118880',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '890010',
                'ReferenceNumber' => '000756890010',
                'OrderNumber' => '000756890010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'PartialAuthorizationApprovalCapability' => '1',
                ),
            ),
            'amount' => '19636',
            'currency' => '840',
            'ClientRef' => '000756890010',
        );

        // Act
        $request = $gateway->authorize($requestData);
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
                'number' => '6011208701118880',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'discover',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'STAN' => '890011',
                'ReferenceNumber' => '000756890011',
                'OrderNumber' => '000756890011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '19636',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
                array(
                    'AdditionalAmount' => '19636',
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
            'amount' => '9718',
            'currency' => '840',
            'ClientRef' => '000756890011',
        );

        // Act
        $request = $gateway->partialReversal($requestData);
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