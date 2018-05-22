<?php

namespace Omnipay\FirstData;

use Omnipay\Common\AbstractGateway;

class RapidConnectGateway extends AbstractGateway
{
    public function getName()
    {
        return 'RapidConnect';
    }

    public function getDefaultParameters()
    {
        return array(
            'App' => '',
            'DID' => '',
            'GroupId' => '',
            'MerchID' => '',
            'ServiceID' => '',
            'TermID' => '',

            'liveEndpoint' => 'https://stg.dw.us.fdcnet.biz/rc',
            'testMode' => false,
        );
    }

    /**
     * @return string
     */
    public function getApp()
    {
        return $this->getParameter('App');
    }

    /**
     * @param string $app
     */
    public function setApp($app)
    {
        return $this->setParameter('App', $app);
    }

    /**
     * @return string
     */
    public function getDID()
    {
        return $this->getParameter('DID');
    }

    /**
     * @param string $dId
     */
    public function setDID($dId)
    {
        return $this->setParameter('DID', $dId);
    }

    /**
     * @return string
     */
    public function getGroupID()
    {
        return $this->getParameter('GroupId');
    }

    /**
     * @param string $groupId
     */
    public function setGroupID($groupId)
    {
        return $this->setParameter('GroupId', $groupId);
    }

    /**
     * @return string
     */
    public function getMerchID()
    {
        return $this->getParameter('MerchID');
    }

    /**
     * @param string $merchantId
     */
    public function setMerchID($merchantId)
    {
        return $this->setParameter('MerchID', $merchantId);
    }

    /**
     * @return mixed
     */
    public function getLiveEndpoint()
    {
        return $this->getParameter('liveEndpoint');
    }

    /**
     * @param string $uri
     */
    public function setLiveEndpoint(string $uri)
    {
        return $this->setParameter('liveEndpoint', $uri);
    }

    /**
     * @return mixed
     */
    public function getServiceID()
    {
        return $this->getParameter('ServiceID');
    }

    /**
     * @param $serviceId
     * @return RapidConnectGateway
     */
    public function setServiceID($serviceId)
    {
        return $this->setParameter('ServiceID', $serviceId);
    }

    /**
     * @return bool|void
     */
    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /**
     * @param bool $value
     * @return AbstractGateway|void
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    /**
     * @return string
     */
    public function getTermID()
    {
        return $this->getParameter('TermID');
    }

    /**
     * @param string $terminalId
     */
    public function setTermID($terminalId)
    {
        return $this->setParameter('TermID', $terminalId);
    }

    public function authorize(array $parameters = array())
    {
        // TODO: Implement authorize() method.
        // MessageType: CreditRequest, TransactionType: Authorize
        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectAuthorizationRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        // TODO: Implement capture() method.
        // MessageType: CreditRequest, TransactionType: Completion
        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectCompletionRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        // TODO: Implement purchase() method.
        // MessageType: CreditRequest, TransactionType: Sale
        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectSaleRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        // TODO: Implement refund() method.
        // MessageType: CreditRequest/ReversalRequest, TransactionType: Refund
        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectRefundRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        // TODO: Implement void() method.
        // MessageType: ReversalRequest, TransactionType: Refund
        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectVoidRequest', $parameters);
    }
}