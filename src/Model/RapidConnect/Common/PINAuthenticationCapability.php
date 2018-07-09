<?php

namespace Omnipay\FirstData\Model\RapidConnect\Common;

class PINAuthenticationCapability
{
    const UNSPECIFIED = '0';
    const ENTRYCAPABILITY = '1';
    const NOENTRYCAPABILITY = '2';
    const PADINOPERATIVE = '3';
    const VERIFIEDBYTERM = '4';

    private static $validPACs;

    /**
     * @return array
     */
    public static function GetValidPACs()
    {
        if (self::$validPACs === null)
        {
            self::$validPACs= array(
                self::ENTRYCAPABILITY,
                self::NOENTRYCAPABILITY,
                self::PADINOPERATIVE,
                self::UNSPECIFIED,
                self::VERIFIEDBYTERM,
            );
        }

        return self::$validPACs;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function IsValidPAC(string $value)
    {
        return in_array($value, self::GetValidPACs());
    }
}