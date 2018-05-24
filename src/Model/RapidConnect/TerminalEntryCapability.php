<?php

namespace Omnipay\FirstData\Model\RapidConnect;

class TerminalEntryCapability
{
    const UNSPECIFIED = '00';
    const TERMINAL_NOT_USED = '01'; // eCommerce
    const MAGNETIC_STRIPE_ONLY = '02';
    const MAGNETIC_STRIPE_KEY_ENTRY = '03';
    const MAGNETIC_STRIPE_KEY_ENTRY_CHIP = '04';
    const BARCODE = '05';
    const PROXIMITY_TERMINAL_RFID = '06';
    const OCR = '07';
    const CHIP_ONLY = '08';
    const CHIP_MAGNETIC_STRIPE = '09';
    const MANUAL_ENTRY_ONLY = '10';
    const PROXIMITY_TERMINAL_MAGNETIC_STRIPE = '11';
    const HYBRID = '12';
}