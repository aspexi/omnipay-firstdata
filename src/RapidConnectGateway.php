<?php

namespace Omnipay\FirstData;

use Omnipay\Common\AbstractGateway;
use Omnipay\FirstData\Model\RapidConnect\MessageType;
use Omnipay\FirstData\Model\RapidConnect\PaymentType;
use Omnipay\FirstData\Model\RapidConnect\TransactionType;

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
            'MerchantID' => '',
            'ServiceID' => '',
            'TerminalID' => '',

            'industry' => '',
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
     * @return mixed
     */
    public function getIndustry()
    {
        return $this->getParameter('industry');
    }

    /**
     * @param $value
     * @return RapidConnectGateway
     */
    public function setIndustry($value)
    {
        return $this->setParameter('industry', $value);
    }

    /**
     * @return string
     */
    public function getMerchantID()
    {
        return $this->getParameter('MerchantID');
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantID($merchantId)
    {
        return $this->setParameter('MerchantID', $merchantId);
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
    public function getTerminalID()
    {
        return $this->getParameter('TerminalID');
    }

    /**
     * @param string $terminalId
     */
    public function setTerminalID($terminalId)
    {
        return $this->setParameter('TerminalID', $terminalId);
    }

    public function authorize(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Authorize
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectAuthorizationRequest', $parameters);
    }

    public function balanceInquiry(array $parameters = array())
    {
            // MessageType: CreditRequest, TransactionType: BalanceInquiry
        // MessageType: CreditRequest, TransactionType: Authorize
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::BALANCE_INQUIRY;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectBalanceInquiryRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Completion
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::COMPLETION;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectCompletionRequest', $parameters);
    }

    public function partialReversal(array $parameters = array()) {
        // MessageType: ReversalRequest, TransactionType: Authorization
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::REVERSAL_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectPartialReversalRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Sale
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::SALE;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectSaleRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        // MessageType: CreditRequest/ReversalRequest, TransactionType: Refund
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::REFUND;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectRefundRequest', $parameters);
    }

    public function verification(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Verification
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::VERIFICATION;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectVerificationRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        // MessageType: ReversalRequest, TransactionType: Refund
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::REVERSAL_REQUEST;
        }

        if (!array_key_exists('PaymentType', $parameters)) {
            $parameters['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters)) {
            $parameters['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectVoidRequest', $parameters);
    }
}