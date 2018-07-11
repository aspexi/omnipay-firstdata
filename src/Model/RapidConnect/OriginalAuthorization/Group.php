<?php

namespace Omnipay\FirstData\Model\RapidConnect\OriginalAuthorization;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addOriginalAuthorizationGroup(\SimpleXMLElement $data)
    {
        if ($this->getOriginalAuthorizationID() !== null) {
            if (!$this->validateOriginalAuthorizationID()) {
                throw new InvalidRequestException("Invalid original authorization id");
            }
            $data->OrigAuthGrp->OrigAuthID = $this->getOriginalAuthorizationID();
        }
        if ($this->getOriginalLocalDateandTime() !== null) {
            if (!$this->validateOriginalLocalDateandTime()) {
                throw new InvalidRequestException("Invalid original local date and time");
            }
            $data->OrigAuthGrp->OrigLocalDateTime = $this->getOriginalLocalDateandTime();
        }
        if ($this->getOriginalTransmissionDateandTime() !== null) {
            if (!$this->validateOriginalTransmissionDateandTime()) {
                throw new InvalidRequestException("Invalid original transmission date andtime");
            }
            $data->OrigAuthGrp->OrigTranDateTime = $this->getOriginalTransmissionDateandTime();
        }
        if ($this->getOriginalSTAN() !== null) {
            if (!$this->validateOriginalSTAN()) {
                throw new InvalidRequestException("Invalid original stan");
            }
            $data->OrigAuthGrp->OrigSTAN = $this->getOriginalSTAN();
        }
        if ($this->getOriginalResponseCode() !== null) {
            if (!$this->validateOriginalResponseCode()) {
                throw new InvalidRequestException("Invalid original response code");
            }
            $data->OrigAuthGrp->OrigRespCode = $this->getOriginalResponseCode();
        }
        if ($this->getOriginalAuthorizingNetworkID() !== null) {
            if (!$this->validateOriginalAuthorizingNetworkID()) {
                throw new InvalidRequestException("Invalid original authorizing network id");
            }
            $data->OrigAuthGrp->OrigAthNtwkID = $this->getOriginalAuthorizingNetworkID();
        }
    }

    /**
     * @return string
     */
    public function getOriginalAuthorizationID()
    {
        return $this->getParameter('OriginalAuthorizationID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalAuthorizationID($value)
    {
        return $this->setParameter('OriginalAuthorizationID', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalAuthorizationID()
    {
        $value = $this->getParameter('OriginalAuthorizationID');
        if (!preg_match('/[0-9A-Z a-z]{1,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalLocalDateandTime()
    {
        return $this->getParameter('OriginalLocalDateandTime');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalLocalDateandTime($value)
    {
        return $this->setParameter('OriginalLocalDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalLocalDateandTime()
    {
        $value = $this->getParameter('OriginalLocalDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalTransmissionDateandTime()
    {
        return $this->getParameter('OriginalTransmissionDateandTime');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalTransmissionDateandTime($value)
    {
        return $this->setParameter('OriginalTransmissionDateandTime', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalTransmissionDateandTime()
    {
        $value = $this->getParameter('OriginalTransmissionDateandTime');
        if (!preg_match('/[0-9]{14,14}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalSTAN()
    {
        return $this->getParameter('OriginalSTAN');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalSTAN($value)
    {
        return $this->setParameter('OriginalSTAN', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalSTAN()
    {
        $value = $this->getParameter('OriginalSTAN');
        if (!preg_match('/[0-9]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalResponseCode()
    {
        return $this->getParameter('OriginalResponseCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalResponseCode($value)
    {
        return $this->setParameter('OriginalResponseCode', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalResponseCode()
    {
        $value = $this->getParameter('OriginalResponseCode');
        if (!preg_match('/[0-9]{3,3}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getOriginalAuthorizingNetworkID()
    {
        return $this->getParameter('OriginalAuthorizingNetworkID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOriginalAuthorizingNetworkID($value)
    {
        return $this->setParameter('OriginalAuthorizingNetworkID', $value);
    }


    /**
     * @return bool
     */
    public function validateOriginalAuthorizingNetworkID()
    {
        $value = $this->getParameter('OriginalAuthorizingNetworkID');
        if (!preg_match('/[0-9A-Za-z]{1,3}/', $value)) {
            return false;
        }
        return true;
    }
}