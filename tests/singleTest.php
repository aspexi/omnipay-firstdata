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
        'AdditionalAmount' => '32004',
        'AdditionalAmountCurrency' => '840',
        'AdditionalAmountType' => 'TotalAuthAmt',
        ),
        // array(
        // 'AdditionalAmount' => '32004',
        // 'AdditionalAmountCurrency' => '840',
        // 'AdditionalAmountType' => 'FirstAuthAmt',
        // ),
        ),'OriginalAuthorizationGroup' => array(
        'OriginalAuthorizationID' => $response->getAuthorizationID(),
        'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
        'OriginalTransmissionDateandTime' => $request->getTransmissionDateandTime(),
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
}