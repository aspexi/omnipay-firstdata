<?php

namespace Omnipay\FirstData\Message;

abstract class RapidConnectReversalRequest extends RapidConnectAbstractRequest
{
    protected $requestType = 'ReversalRequest';
    protected $pymtType = 'Credit';
}