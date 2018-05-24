<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class RapidConnectResponse extends AbstractResponse
{
    const RETURNCODE_SUCCESS = "000";
    const RETURNCODE_INVALIDSESSION = "006";
    const RETURNCODE_HOSTBUSY = "200";
    const RETURNCODE_HOSTUNAVAILABLE = "201";
    const RETURNCODE_HOSTCONNECTERROR = "202";
    const RETURNCODE_HOSTDROP = "203";
    const RETURNCODE_HOSTCOMMERROR = "204";
    const RETURNCODE_NORESPONSE = "205";
    const RETURNCODE_HOSTSENDERROR = "206";
    const RETURNCODE_DATAWIRETIMEOUT = "405";
    const RETURNCODE_NETWORKERROR1 = "505";
    const RETURNCODE_NETWORKERROR2 = "008";

    const STATUSCODE_OK = "OK";
    const STATUSCODE_AUTHENTICATIONERROR = "AuthenticationError";
    const STATUSCODE_UNKNOWNSERVCEID = "UnknownServiceID";
    const STATUSCODE_XMLERROR = "XMLError";
    const STATUSCODE_OTHERERROR = "OtherError";
    const STATUSCODE_INVALIDSESSIONCONTEXT = "InvalidSessionContext";
    const STATUSCODE_TIMEOUT = "Timeout";

    public function __construct(RequestInterface $request, $data)
    {
        libxml_use_internal_errors(true);
        $xml = (string)$data;
        try {
            $xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOWARNING);
        } catch (\Exception $e) {
            throw new InvalidResponseException($e->getMessage());
        }

        if (!$xml) {
            $errors = libxml_get_errors();
            if (count($errors) > 0) {
                throw new InvalidResponseException($errors[0]->message);
            }
            throw new InvalidResponseException();
        }

        parent::__construct($request, $xml);
    }

    /**
     * Check if transaction successfully completed
     *
     * @return bool
     * @throws InvalidResponseException
     */
    public function isSuccessful()
    {
        return $this->getStatusCode() === static::STATUSCODE_OK &&
            $this->getReturnCode() === static::RETURNCODE_SUCCESS &&
            !$this->isRejectResponse();
    }

    /**
     * @return bool
     * @throws InvalidResponseException
     */
    public function isRejectResponse()
    {
        return isset($this->getPayload()->RejectResponse);
    }

    /**
     * @return string|null
     */
    public function getDID()
    {
        if (isset($this->data->RespClientID->DID)) {
            return $this->data->RespClientID->DID->__toString();
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getClientRef()
    {
        if (isset($this->data->RespClientID->ClientRef)) {
            return $this->data->RespClientID->ClientRef->__toString();
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getPayload()
    {
        if (isset($this->data->TransactionResponse->Payload)) {
            try {
                return simplexml_load_string(
                    htmlspecialchars_decode(
                        $this->data->TransactionResponse->Payload->__toString(),
                        ENT_XML1
                    )
                );
            } catch (\Exception $e) {
                throw new InvalidResponseException($e->getMessage());
            }
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getReturnCode()
    {
        if (isset($this->data->TransactionResponse->ReturnCode)) {
            return $this->data->TransactionResponse->ReturnCode->__toString();
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        if (isset($this->data->Status)) {
            return $this->data->Status->__toString();
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getStatusCode()
    {
        if (isset($this->data->Status)) {
            return $this->data->Status->attributes()['StatusCode']->__toString();
        }
        return null;
    }
}