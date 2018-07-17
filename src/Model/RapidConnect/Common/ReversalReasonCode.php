<?php

namespace Omnipay\FirstData\Model\RapidConnect\Common;

class ReversalReasonCode
{
    const TIMEOUT = 'Timeout';
    const VOID = 'Void';
    const VOIDFR = 'VoidFr';
    const TORVOID = 'TORVoid';
    const PARTIAL = 'Partial';
    const EDITERR  = 'EditErr';
    const MACVERI = 'MACVeri';
    const MACSYNC = 'MACSync';
    const ENCRERR = 'EncrErr';
    const SYSTERR = 'SystErr';
}