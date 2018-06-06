<?php

namespace Omnipay\FirstData\Model\RapidConnect;

class StatusCode
{
    const STATUSCODE_OK = "OK";
    const STATUSCODE_AUTHENTICATIONERROR = "AuthenticationError";
    const STATUSCODE_UNKNOWNSERVCEID = "UnknownServiceID";
    const STATUSCODE_XMLERROR = "XMLError";
    const STATUSCODE_OTHERERROR = "OtherError";
    const STATUSCODE_INVALIDSESSIONCONTEXT = "InvalidSessionContext";
    const STATUSCODE_TIMEOUT = "Timeout";
}