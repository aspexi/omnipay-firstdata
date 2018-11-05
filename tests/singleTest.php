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