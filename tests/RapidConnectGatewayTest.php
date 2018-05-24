<?php

namespace Omnipay\FirstData;

use Omnipay\Tests\GatewayTestCase;

class RapidConnectGatewayTest extends GatewayTestCase
{
    /** @var RapidConnectGateway */
    protected $gateway;

    /** @var string */
    protected $options;

    public function setup()
    {
        parent::setUp();

        $this->gateway = new RapidConnectGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setApp('123456789ABCDEF');
        $this->gateway->setDID('123456789ABCDEF');
        $this->gateway->setGroupID('10001');
        $this->gateway->setMerchantID('1054217');
        $this->gateway->setTerminalID('12345');

        $this->options = array();
    }

    public function testProperties()
    {
        $this->assertEquals('123456789ABCDEF', $this->gateway->getApp());
        $this->assertEquals('123456789ABCDEF', $this->gateway->getDID());
        $this->assertEquals('10001', $this->gateway->getGroupID());
        $this->assertEquals('1054217', $this->gateway->getMerchantID());
        $this->assertEquals('12345', $this->gateway->getTerminalID());
    }

    public function testPurchaseSuccess()
    {
        $this->markTestSkipped();
        $this->setMockHttpResponse('RapidConnectPurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();
    }

    public function testAuthorizeSuccess()
    {
        $this->markTestSkipped();
        $this->setMockHttpResponse('RapidConnectPurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();
    }
}