<?php

namespace Omnipay\FirstData\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\FirstData\Model\RapidConnect\ResponseCode;
use Omnipay\FirstData\Model\RapidConnect\ReturnCode;
use Omnipay\FirstData\Model\RapidConnect\StatusCode;

class RapidConnectResponse extends AbstractResponse
{
    /**
     * RapidConnectResponse constructor.
     * @param RequestInterface $request
     * @param $data
     * @throws InvalidResponseException
     */
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
        return $this->getStatusCode() === StatusCode::STATUSCODE_OK &&
            $this->getReturnCode() === ReturnCode::RETURNCODE_SUCCESS &&
            $this->getResponseCode() == ResponseCode::APPROVE;
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
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getAVSResultCode()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }

        $response = $payload->children()[0];
        if (isset($response->CardGrp->AVSResultCode)) {
            return $response->CardGrp->AVSResultCode;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getCCVResultCode()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->CardGrp->CCVResultCode)) {
            return $response->CardGrp->CCVResultCode;
        }
        return null;
    }

    /**
     * @return null
     * @throws InvalidResponseException
     */
    public function getResponseCode()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->RespGrp->RespCode)) {
            return $response->RespGrp->RespCode;
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