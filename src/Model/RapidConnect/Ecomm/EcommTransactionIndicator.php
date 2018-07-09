<?php

namespace Omnipay\FirstData\Model\RapidConnect\Ecomm;

class EcommTransactionIndicator
{
    const SECURE = '01';
    const NON_AUTHENTICATED_SECURE = '02';
    const CHANNEL_ENCRYPTED = '03';
    const NON_SECURE = '04';
    const DIGITAL_WALLET = '05';
    const MASTER_PASS = '06';
    const MASTER_CARD_DIGITAL_ENABLEMENT_SERVICE = '07';
}