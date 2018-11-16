<?php

namespace Omnipay\FirstData\Model\RapidConnect\Card;

use Omnipay\Common\CreditCard;

class CardType
{
    const AMEX = 'Amex';
    const DINERS_CLUB = 'Diners';
    const DISCOVER = 'Discover';
    const JCB = 'JCB';
    const MAESTRO = 'MaestroInt';
    const MASTERCARD = 'MasterCard';
    const VISA = 'Visa';

    final public static function FromOmnipayCardType(string $type)
    {
        $omnipayCardTypeMap = [
            CreditCard::BRAND_AMEX => CardType::AMEX,
            CreditCard::BRAND_DINERS_CLUB => CardType::DINERS_CLUB,
            CreditCard::BRAND_DISCOVER => CardType::DISCOVER,
            CreditCard::BRAND_JCB => CardType::JCB,
            CreditCard::BRAND_MAESTRO => CardType::MAESTRO,
            CreditCard::BRAND_MASTERCARD => CardType::MASTERCARD,
            CreditCard::BRAND_VISA => CardType::VISA,
        ];

        if (array_key_exists($type, $omnipayCardTypeMap)) {
            return $omnipayCardTypeMap[$type];
        }
        return null;
    }
}