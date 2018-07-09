<?php

namespace Omnipay\FirstData\Model\RapidConnect\Discover;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addDiscoverGroup(\SimpleXMLElement $data)
    {
        if ($this->getDiscoverProcessingCode() !== null) {
            if (!$this->validateDiscoverProcessingCode()) {
                throw new InvalidRequestException("Invalid discover processing code");
            }
            $data->DSGrp->DiscProcCode = $this->getDiscoverProcessingCode();
        }
        if ($this->getDiscoverPOSEntryMode() !== null) {
            if (!$this->validateDiscoverPOSEntryMode()) {
                throw new InvalidRequestException("Invalid discover pos entry mode");
            }
            $data->DSGrp->DiscPOSEntry = $this->getDiscoverPOSEntryMode();
        }
        if ($this->getDiscoverResponseCode() !== null) {
            if (!$this->validateDiscoverResponseCode()) {
                throw new InvalidRequestException("Invalid discover response code");
            }
            $data->DSGrp->DiscRespCode = $this->getDiscoverResponseCode();
        }
        if ($this->getDiscoverPOSData() !== null) {
            if (!$this->validateDiscoverPOSData()) {
                throw new InvalidRequestException("Invalid discover pos data");
            }
            $data->DSGrp->DiscPOSData = $this->getDiscoverPOSData();
        }
        if ($this->getDiscoverTransactionQualifier() !== null) {
            if (!$this->validateDiscoverTransactionQualifier()) {
                throw new InvalidRequestException("Invalid discover transaction qualifier");
            }
            $data->DSGrp->DiscTransQualifier = $this->getDiscoverTransactionQualifier();
        }
        if ($this->getDiscoverNRID() !== null) {
            if (!$this->validateDiscoverNRID()) {
                throw new InvalidRequestException("Invalid discover nrid");
            }
            $data->DSGrp->DiscNRID = $this->getDiscoverNRID();
        }
        if ($this->getMOTOIndicator() !== null) {
            if (!$this->validateMOTOIndicator()) {
                throw new InvalidRequestException("Invalid moto indicator");
            }
            $data->DSGrp->MOTOInd = $this->getMOTOIndicator();
        }
        if ($this->getRegisteredUserIndicator() !== null) {
            if (!$this->validateRegisteredUserIndicator()) {
                throw new InvalidRequestException("Invalid registered user indicator");
            }
            $data->DSGrp->RegUserInd = $this->getRegisteredUserIndicator();
        }
        if ($this->getRegisteredUserProfileChangeDate() !== null) {
            if (!$this->validateRegisteredUserProfileChangeDate()) {
                throw new InvalidRequestException("Invalid registered user profile changedate");
            }
            $data->DSGrp->RegUserDate = $this->getRegisteredUserProfileChangeDate();
        }
        if ($this->getAuthIndicator() !== null) {
            if (!$this->validateAuthIndicator()) {
                throw new InvalidRequestException("Invalid auth indicator");
            }
            $data->DSGrp->DiscAuthInd = $this->getAuthIndicator();
        }
        if ($this->getPartialShipmentIndicator() !== null) {
            if (!$this->validatePartialShipmentIndicator()) {
                throw new InvalidRequestException("Invalid partial shipment indicator");
            }
            $data->DSGrp->PartShipInd = $this->getPartialShipmentIndicator();
        }
    }

    /**
     * @return string
     */
    public function getDiscoverProcessingCode()
    {
        return $this->getParameter('DiscoverProcessingCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverProcessingCode(string $value)
    {
        return $this->setParameter('DiscoverProcessingCode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverProcessingCode()
    {
        $value = $this->getParameter('DiscoverProcessingCode');
        if (!preg_match('/[0-9A-Za-z]{6,6}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverPOSEntryMode()
    {
        return $this->getParameter('DiscoverPOSEntryMode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverPOSEntryMode(string $value)
    {
        return $this->setParameter('DiscoverPOSEntryMode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverPOSEntryMode()
    {
        $value = $this->getParameter('DiscoverPOSEntryMode');
        if (!preg_match('/[0-9]{4,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverResponseCode()
    {
        return $this->getParameter('DiscoverResponseCode');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverResponseCode(string $value)
    {
        return $this->setParameter('DiscoverResponseCode', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverResponseCode()
    {
        $value = $this->getParameter('DiscoverResponseCode');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverPOSData()
    {
        return $this->getParameter('DiscoverPOSData');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverPOSData(string $value)
    {
        return $this->setParameter('DiscoverPOSData', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverPOSData()
    {
        $value = $this->getParameter('DiscoverPOSData');
        if (!preg_match('/[0-9A-Za-z]{13,13}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverTransactionQualifier()
    {
        return $this->getParameter('DiscoverTransactionQualifier');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverTransactionQualifier(string $value)
    {
        return $this->setParameter('DiscoverTransactionQualifier', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverTransactionQualifier()
    {
        $value = $this->getParameter('DiscoverTransactionQualifier');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getDiscoverNRID()
    {
        return $this->getParameter('DiscoverNRID');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setDiscoverNRID(string $value)
    {
        return $this->setParameter('DiscoverNRID', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverNRID()
    {
        $value = $this->getParameter('DiscoverNRID');
        if (!preg_match('/[0-9A-Za-z]{1,15}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getMOTOIndicator()
    {
        return $this->getParameter('MOTOIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setMOTOIndicator(string $value)
    {
        return $this->setParameter('MOTOIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateMOTOIndicator()
    {
        $value = $this->getParameter('MOTOIndicator');
        $valid = array('1', '2');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getRegisteredUserIndicator()
    {
        return $this->getParameter('RegisteredUserIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRegisteredUserIndicator(string $value)
    {
        return $this->setParameter('RegisteredUserIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateRegisteredUserIndicator()
    {
        $value = $this->getParameter('RegisteredUserIndicator');
        $valid = array('Y', 'N');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getRegisteredUserProfileChangeDate()
    {
        return $this->getParameter('RegisteredUserProfileChangeDate');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setRegisteredUserProfileChangeDate(string $value)
    {
        return $this->setParameter('RegisteredUserProfileChangeDate', $value);
    }


    /**
     * @return bool
     */
    public function validateRegisteredUserProfileChangeDate()
    {
        $value = $this->getParameter('RegisteredUserProfileChangeDate');
        if (!preg_match('/[0-9]{8,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getPartialShipmentIndicator()
    {
        return $this->getParameter('PartialShipmentIndicator');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setPartialShipmentIndicator(string $value)
    {
        return $this->setParameter('PartialShipmentIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validatePartialShipmentIndicator()
    {
        $value = $this->getParameter('PartialShipmentIndicator');
        $valid = array('Partial');
        return in_array($value, $valid);
    }
}