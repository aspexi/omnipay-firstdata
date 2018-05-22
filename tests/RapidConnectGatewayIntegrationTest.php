<?php

namespace Omnipay\FirstData;

use Omnipay\Tests\TestCase;

class RapidConnectGatewayIntegrationTest extends TestCase
{
    /** @var RapidConnectGateway */
    protected $gateway;

    public function setUp()
    {
        parent::setUp();

        $app = getenv('RAPIDCONNECT_APP');
        $dId = getenv('RAPIDCONNECT_DID');
        $groupId = getenv('RAPIDCONNECT_GROUPID');
        $merchantId = getenv('RAPIDCONNECT_MERCHANTID');
        $terminalId = getenv('RAPIDCONNECT_TERMINALID');

        if ($app && $dId && $groupId && $merchantId && $terminalId) {
            $this->gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
            $this->gateway->setApp($app);
            $this->gateway->setDID($dId);
            $this->gateway->setGroupID($groupId);
            $this->gateway->setMerchID($merchantId);
            $this->gateway->setTermID($terminalId);
        } else {
            $this->markTestSkipped('Missing credentials');
        }
    }

    public function testAuthCaptureVoid()
    {
        // Authorize
        $request = $this->gateway->authorize(array(
            'PymtType' => 'Credit',
            'LocalDateTime' => '20180521174243',
            'TrnmsnDateTime' => '20180521174243',
            'STAN' => '142114',
            'RefNum' => '5221952458',
            'OrderNum' => '69137870',
            'TPPID' => 'RAR006',
            'MerchCatCode' => '5399',
            'POSEntryMode' => '901',
            'POSCondCode' => '00',
            'TermCatCode' => '01',
            'TermEntryCapablt' => '01',
            'TxnAmt' => '000000000100',
            'TxnCrncy' => '840',
            'TermLocInd' => '0',
            'CardCaptCap' => '1',
            'MerchEmail' => 'samlitowitz+test@arts-people.com',
            'Track2Data' => '4264281511117771=18121011000012345678',
            'CardType' => 'Visa',
            'PartAuthrztnApprvlCapablt' => '1',
            'ACI' => 'Y',
            'VisaBID' => '56412',
            'VisaAUAR' => '000000000000',
            'TaxAmtCapabit' => '1',
        ));
        $response = $request->send();

        // Capture
        $request = $this->gateway->capture(array());
        $response = $request->send();

        // Void
        $request = $this->gateway->void(array());
        $response = $request->send();
    }

    public function testPurchaseRefundVoid()
    {

    }
}