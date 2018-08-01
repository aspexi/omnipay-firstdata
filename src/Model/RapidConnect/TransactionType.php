<?php

namespace Omnipay\FirstData\Model\RapidConnect;

class TransactionType
{
    const AUTHORIZATION = "Authorization";
    const COMPLETION = "Completion";
    const REFUND = "Refund";
    const SALE = "Sale";
    const VERIFICATION = "Verification";
    const BALANCE_INQUIRY = "BalanceInquiry";
    const REVERSAL = "Reversal";
}