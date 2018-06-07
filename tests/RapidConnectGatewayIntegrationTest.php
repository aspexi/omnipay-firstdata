<?php

namespace Omnipay\FirstData;

use Omnipay\FirstData\Model\RapidConnect\BillPaymentTransactionIndicator;
use Omnipay\FirstData\Model\RapidConnect\CardCaptureCapability;
use Omnipay\FirstData\Model\RapidConnect\CurrencyCode;
use Omnipay\FirstData\Model\RapidConnect\EcommTransactionIndicator;
use Omnipay\FirstData\Model\RapidConnect\EntryMode;
use Omnipay\FirstData\Model\RapidConnect\MarketSpecificDataIndicator;
use Omnipay\FirstData\Model\RapidConnect\PINAuthenticationCapability;
use Omnipay\FirstData\Model\RapidConnect\POSConditionCode;
use Omnipay\FirstData\Model\RapidConnect\TerminalCategoryCode;
use Omnipay\FirstData\Model\RapidConnect\TerminalEntryCapability;
use Omnipay\FirstData\Model\RapidConnect\TerminalLocationIndicator;
use Omnipay\Tests\TestCase;

class RapidConnectGatewayIntegrationTest extends TestCase
{
    /** @var RapidConnectGateway */
    protected $gateway;
    /** @var string */
    protected $merchEmail;
    /** @var string */
    protected $tppid;

    public function setUp()
    {
        parent::setUp();

        $app = getenv('RAPIDCONNECT_APP');
        $dId = getenv('RAPIDCONNECT_DID');
        $groupId = getenv('RAPIDCONNECT_GROUPID');
        $merchantId = getenv('RAPIDCONNECT_MERCHANTID');
        $serviceId = getenv('RAPIDCONNECT_SERVICEID');
        $terminalId = getenv('RAPIDCONNECT_TERMINALID');

        $this->merchEmail = getenv('RAPIDCONNECT_MERCHEMAIL');
        $this->tppid = getenv('RAPIDCONNECT_TPPID');

        if ($app &&
            $dId &&
            $groupId &&
            $merchantId &&
            $terminalId &&
            $serviceId &&
            $this->merchEmail &&
            $this->tppid
        ) {
            $this->gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
            $this->gateway->setApp($app);
            $this->gateway->setDID($dId);
            $this->gateway->setGroupID($groupId);
            $this->gateway->setMerchantID($merchantId);
            $this->gateway->setServiceID($serviceId);
            $this->gateway->setTerminalID($terminalId);
        } else {
            $this->markTestSkipped('Missing credentials');
        }
    }

    public function testAuthCaptureVoid()
    {
        $now = new \DateTime();

        // Authorize
        $request = $this->gateway->authorize(array(
            'amount' => '30132',
            'card' => array(
                'billingAddress1' => '1307 Broad Hollow Road',
                'billingPostcode' => '11747',
                'cvv' => '123',
                'expiryMonth' => '01',
                'expiryYear' => '2019',
                'number' => '4005571701111111',
                'type' => 'visa',
            ),
            'currency' => CurrencyCode::USD,
            'POSEntryMode' => array(
                'entryMode' => EntryMode::MANUAL,
                'pinCapability' => PINAuthenticationCapability::NOENTRYCAPABILITY,
            ),
            'LocalDateandTime' => $now->format('Ymdhis'),

            'TPPID' => $this->tppid,
            'POSConditionCode' => POSConditionCode::CARDHOLDER_NOT_PRESENT_ECOMMERCE,
            'TerminalCategoryCode' => TerminalCategoryCode::ECOMMERCE,
            'TerminalEntryCapability' => TerminalEntryCapability::TERMINAL_NOT_USED,
            'TerminalLocationIndicator' => TerminalLocationIndicator::OFF_PREMISES,
            'CardCaptureCapability' => CardCaptureCapability::NOT_CAPABLE,
            'MarketSpecificDataIndicator' => MarketSpecificDataIndicator::BILL_PAYMENT,
            'BillPaymentTransactionIndicator' => BillPaymentTransactionIndicator::SINGLE,
            'EcommTransactionIndicator' => EcommTransactionIndicator::CHANNEL_ENCRYPTED,

            'STAN' => '100003',
            'ReferenceNumber' => '15000150150',
            'OrderNumber' => '00000001',

            'MerchantName' => 'SMITH HARDWARE',
            'MerchantAddress' => '1307 Walt Whitman Road',
            'MerchantCity' => 'Melville',
            'MerchantState' => 'NY',
            'MerchantPostalCode' => '11747',
            'MerchantEmailAddress' => 'what@ap.com',

            'EcommURL' => 'google.com',

        ));
        $response = $request->send();
        $this->assertTrue($response->isSuccessful(), 'Authorization should succeed');

        /*
        // Capture
        $request = $this->gateway->capture(array());
        $response = $request->send();

        // Void
        $request = $this->gateway->void(array());
        $response = $request->send();
        */
    }

    public function testPurchaseRefundVoid()
    {

    }
}