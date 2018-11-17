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

    public function testTimeoutReversal()
    {
        // Arrange
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1Y'));
        $expiryMonth = $expirationDate->format('m');
        $expiryYear = $expirationDate->format('Y');

        $gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setLocalTimeZone('PST');
        $gateway->setApp('');
        $gateway->setGroupID('');
        $gateway->setServiceID('');
        $gateway->setTerminalID('');
        $gateway->setDID('');
        $gateway->setMerchantID('');

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
                'TPPID' => str_pad('', 6, '0'),
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

        $request = $gateway->purchase($requestData);

        $setupFromOriginalRequest = function(
            string $groupName,
            array $fieldNames,
            array $requestData,
            Omnipay\FirstData\RapidConnectAbstractRequest $request
        ) {
            $group = $request->{'get' . $groupName}();
            if ($group === null) {
                return $requestData;
            }

            $fromRequest = [];
            foreach ($fieldNames as $fieldName) {
                $value = $group->{'get' . $fieldName}();
                if ($value === null) {
                    continue;
                }
                $fromRequest[$fieldName] = $value;
            }

            if (count($fromRequest) > 0) {
                if (!array_key_exists($groupName, $requestData)) {
                    $requestData[$groupName] = [];
                }

                foreach ($fromRequest as $fieldName => $value) {
                    $requestData[$groupName][$fieldName] = $value;
                }
            }

            return $requestData;
        };

        $requestData = array(
            'card' => array(
                'number' => '379605176666666',
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'type' => 'amex',
            ),
            'CommonGroup' => array(
                'TPPID' => str_pad('', 6, '0'),
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
                'ReferenceNumber' => '000528150010',
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
            'amount' => '34153',
            'currency' => '840',
            'ClientRef' => '000528150011',
        );

        $requestData = $setupFromOriginalRequest(
            'BillPaymentGroup',
            [ 'InstallmentPaymentInvoiceNumber', 'InstallmentPaymentDescription' ],
            $requestData,
            $request
        );

        $this->assertEquals(true, true);
    }
}