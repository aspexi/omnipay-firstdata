<?php

namespace Omnipay\FirstData\Message;

abstract class RapidConnectCreditRequest extends RapidConnectAbstractRequest
{
    protected $requestType = 'CreditRequest';
    protected $pymtType = 'Credit';
}
