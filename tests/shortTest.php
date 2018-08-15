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

    public function testCaseNumber000529890010And000529890011()
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
                'TransactionInitiation' => 'Merchant',
                'STAN' => '890010',
                'ReferenceNumber' => '000529890010',
                'OrderNumber' => '000529890010',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '01',
                'EcommURL' => 'google.com',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '1',
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalSTAN' => '890010',
            ),
            'amount' => '15464',
            'currency' => '840',
            'ClientRef' => '000529890010',
        );

        // Act
        $request = $gateway->authorize($requestData);
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
                'number' => '5424180011113336',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'mastercard',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad(getenv('RAPIDCONNECT_TPPID'), 6, '0'),
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
                'TransactionInitiation' => 'Merchant',
                'STAN' => '890011',
                'ReferenceNumber' => '000529890011',
                'OrderNumber' => '000529890011',
            ),
            'AlternateMerchantNameandAddressGroup' => array(
                'MerchantCountry' => '840',
            ),
            'AdditionalAmountGroups' => array(
                array(
                    'AdditionalAmount' => '15464',
                    'AdditionalAmountCurrency' => '840',
                    'AdditionalAmountType' => 'TotalAuthAmt',
                ),
            ),
            'EcommGroup' => array(
                'EcommTransactionIndicator' => '01',
            ),
            'MastercardGroup' => array(
                'AuthorizationType' => '1',
                'MastercardACI' => 'I',
                'MastercardAdditionalData' => '0000000000000',
                'BankNetData' => $response->getBankNetData(),
                'TransactionIntegrityClass' => $response->getTransactionIntegrityClass(),
            ),
            'OriginalAuthorizationGroup' => array(
                'OriginalAuthorizationID' => $response->getAuthorizationID(),
                'OriginalLocalDateandTime' => $response->getLocalDateandTime(),
                'OriginalTransmissionDateandTime' => $response->getTransmissionDateandTime(),
                'OriginalSTAN' => $response->getSTAN(),
                'OriginalResponseCode' => $response->getResponseCode(),
            ),
            'amount' => '15464',
            'currency' => '840',
            'ClientRef' => '000529890011',
        );

        // Act
        $requestData['CommonGroup']['TransactionType'] = 'Authorization';
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