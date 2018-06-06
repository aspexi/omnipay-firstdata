<?php

namespace Omnipay\FirstData\Model\RapidConnect;

class ResponseCode
{
    const APPROVE = '000';
    const SCHEMA_VALIDATION_ERROR = '001';
    const APPROVE_PARTIAL = '002';
    const EXPIRED_CARD = '101';
    const SUSPECTED_FRAUD = '102';
    const INVALID_AMOUNT = '110';
    const INVALID_ACCOUNT_TYPE = '114';
}