<?php
<?php
<?php
<?php

namespace Omnipay\FirstData;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\AbstractGateway;
use Omnipay\FirstData\Model\RapidConnect\Common\ReversalReasonCode;
use Omnipay\FirstData\Model\RapidConnect\MessageType;
use Omnipay\FirstData\Model\RapidConnect\PaymentType;
use Omnipay\FirstData\Model\RapidConnect\TransactionType;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

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
            'TPPID' => '',
            'GroupId' => '',
            'MerchantID' => '',
            'ServiceID' => '',
            'TerminalID' => '',

            'localTimeZone' => 'UTC',
            'transmissionTimeZone' => 'UTC',

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
     * @return mixed
     */
    public function getTPPID()
    {
        return $this->getParameter('TPPID');
    }

    /**
     * @param $tPPID
     * @return RapidConnectGateway
     */
    public function setTPPID($tPPID)
    {
        return $this->setParameter('TPPID', $tPPID);
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
    public function getLocalTimeZone()
    {
        return $this->getParameter('localTimeZone');
    }

    /**
     * @param $value
     * @return RapidConnectGateway
     */
    public function setLocalTimeZone($value)
    {
        return $this->setParameter('localTimeZone', $value);
    }

    /**
     * @return mixed
     */
    public function getTransmissionTimeZone()
    {
        return $this->getParameter('transmissionTimeZone');
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

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
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

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::BALANCE_INQUIRY;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        $request = $this->createRequest('\Omnipay\FirstData\Message\RapidConnectBalanceInquiryRequest', $parameters);

//        $cardGroup = $request->getParameters()['CardGroup'];
//        if ('MasterCard' == $cardGroup->getCardType()) {
//            $cardGroup->setCardInfoRequestIndicator('Y');
//        }

        return $request;
    }

    public function capture(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Completion
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::COMPLETION;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectCompletionRequest', $parameters);
    }

    public function partialReversal(array $parameters = array()) {
        // MessageType: ReversalRequest, TransactionType: Authorization
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::REVERSAL_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        if (!array_key_exists('ReversalReasonCode', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['ReversalReasonCode'] = 'Partial';
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectPartialReversalRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Sale
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::SALE;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectSaleRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        // MessageType: CreditRequest/ReversalRequest, TransactionType: Refund
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::REFUND;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectRefundRequest', $parameters);
    }

    public function timeoutReversal(array $parameters = array())
    {
        // MessageType: CreditRequest/ReversalRequest, TransactionType: provided
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('ReversalReasonCode', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['ReversalReasonCode'] = ReversalReasonCode::TIMEOUT;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (array_key_exists('PaymentType', $parameters)) {
            $parameters['CommonGroup']['PaymentType'] = $parameters['PaymentType'];
            unset($parameters['PaymentType']);
        }

        if (array_key_exists('TransactionType', $parameters)) {
            $parameters['CommonGroup']['TransactionType'] = $parameters['TransactionType'];
            unset($parameters['TransactionType']);
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectTimeoutReversalRequest', $parameters);
    }

    public function verification(array $parameters = array())
    {
        // MessageType: CreditRequest, TransactionType: Verification
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::CREDIT_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::VERIFICATION;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }
        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
        $parameters['CommonGroup']['LocalDateandTime'] = $now->format('Ymdhis');
    }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getTransmissionTimeZone()));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('Ymdhis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectVerificationRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        // MessageType: ReversalRequest, TransactionType: Refund
        if (!array_key_exists('MessageType', $parameters)) {
            $parameters['MessageType'] = MessageType::REVERSAL_REQUEST;
        }

        if (!array_key_exists('CommonGroup', $parameters)) {
            $parameters['CommonGroup'] = array();
        }

        if (!array_key_exists('PaymentType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['PaymentType'] = PaymentType::CREDIT;
        }

        if (!array_key_exists('TransactionType', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TransactionType'] = TransactionType::AUTHORIZATION;
        }

        if (!array_key_exists('ReversalReasonCode', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['ReversalReasonCode'] = ReversalReasonCode::VOID;
        }

        if (!array_key_exists('LocalDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone($this->getLocalTimeZone()));
            $parameters['CommonGroup']['LocalDateandTime'] = $now->format('YmdHis');
        }

        if (!array_key_exists('TransmissionDateandTime', $parameters['CommonGroup'])) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('UTC'));
            $parameters['CommonGroup']['TransmissionDateandTime'] = $now->format('YmdHis');
        }

        $tPPID = $this->getTPPID();
        if ($tPPID !== null && !array_key_exists('TPPID', $parameters['CommonGroup'])) {
            $parameters['CommonGroup']['TPPID'] = $tPPID;
        }

        $groupId = $this->getGroupID();
        if ($groupId !== null) {
            $parameters['CommonGroup']['GroupID'] = $groupId;
        }

        $terminalId = $this->getTerminalID();
        if ($terminalId !== null) {
            $parameters['CommonGroup']['TerminalID'] = $terminalId;
        }

        $merchantId = $this->getMerchantID();
        if ($merchantId !== null) {
            $parameters['CommonGroup']['MerchantID'] = $merchantId;
        }

        return $this->createRequest('\Omnipay\FirstData\Message\RapidConnectVoidRequest', $parameters);
    }
}