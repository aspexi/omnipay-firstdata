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
     * @return string|null
     */
    public function getStatusCode()
    {
        if (isset($this->data->Status)) {
            return $this->data->Status->attributes()['StatusCode']->__toString();
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
     * @return null
     * @throws InvalidResponseException
     */
    public function getResponseCode()
    {
        $responseGroup = $this->getResponseGroup();
        if ($responseGroup !== null && isset($responseGroup->RespCode)) {
            return $responseGroup->RespCode->__toString();
        }
        return null;
    }

    /**
     * @return null
     * @throws InvalidResponseException
     */
    public function getResponseGroup()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->RespGrp)) {
            return $response->RespGrp;
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
    public function getAVSResultCode()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }

        $response = $payload->children()[0];
        if (isset($response->CardGrp->AVSResultCode)) {
            return $response->CardGrp->AVSResultCode->__toString();
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
            return $response->CardGrp->CCVResultCode->__toString();
        }
        return null;
    }

    /**
     * @return null
     * @throws InvalidResponseException
     */
    public function getAuthorizationID()
    {
        $responseGroup = $this->getResponseGroup();
        if ($responseGroup !== null && isset ($responseGroup->AuthID)) {
            return $responseGroup->AuthID;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getLocalDateandTime()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->CommonGrp->LocalDateTime)) {
            return $response->CommonGrp->LocalDateTime;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getTransmissionDateandTime()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->CommonGrp->TrnmsnDateTime)) {
            return $response->CommonGrp->TrnmsnDateTime;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getSTAN()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $response = $payload->children()[0];
        if (isset($response->CommonGrp->STAN)) {
            return $response->CommonGrp->STAN;
        }
        return null;
    }

    /**
     * @return null
     * @throws InvalidResponseException
     */
    public function getErrorData()
    {
        $responseGroup = $this->getResponseGroup();
        if ($responseGroup !== null && isset($responseGroup->RespCode)) {
            return $responseGroup->ErrorData;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getMastercardAdditionalData()
    {
        $mastercardGroup = $this->getMastercardGroup();
        if ($mastercardGroup !== null && isset($mastercardGroup->MCAddData)) {
            return $mastercardGroup->MCAddData;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getMastercardGroup()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $responseGroup = $payload->children()[0];
        if (isset($responseGroup->MCGrp)) {
            return $responseGroup->MCGrp;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getBankNetData()
    {
        $mastercardGroup = $this->getMastercardGroup();
        if ($mastercardGroup !== null && isset($mastercardGroup->BanknetData)) {
            return $mastercardGroup->BanknetData;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getTransactionAmount()
    {
        $commonGroup = $this->getCommonGroup();
        if ($commonGroup !== null && isset($commonGroup->TxnAmt)) {
            return $commonGroup->TxnAmt->__toString();
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getCommonGroup()
    {
        $payload = $this->getPayload();
        if ($payload === false || $payload === null) {
            return null;
        }
        $responseGroup = $payload->children()[0];
        if (isset($responseGroup->CommonGrp)) {
            return $responseGroup->CommonGrp;
        }
        return null;
    }

    public function getMerchantID()
    {
        $commonGroup = $this->getCommonGroup();
        if ($commonGroup !== null && isset($commonGroup->MerchID)) {
            return $commonGroup->MerchID;
        }
        return null;
    }

    /**
     * @return null|\SimpleXMLElement
     * @throws InvalidResponseException
     */
    public function getTransactionIntegrityClass()
    {
        $mastercardGroup = $this->getMastercardGroup();
        if ($mastercardGroup !== null && isset($mastercardGroup->TranIntgClass)) {
            return $mastercardGroup->TranIntgClass;
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
}