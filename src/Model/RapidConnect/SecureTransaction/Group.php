<?php

namespace Omnipay\FirstData\Model\RapidConnect\SecureTransaction;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addSecureTransactionGroup(\SimpleXMLElement $data)
    {
        if ($this->getVisaXID() !== null) {
            if (!$this->validateVisaXID()) {
                throw new InvalidRequestException("Invalid visa xid");
            }
            $data->SecrTxnGrp->VisaXID = $this->getVisaXID();
        }
        if ($this->getVisaSecureTransactionAuthenticationData() !== null) {
            if (!$this->validateVisaSecureTransactionAuthenticationData()) {
                throw new InvalidRequestException("Invalid visa secure transaction authentication data");
            }
            $data->SecrTxnGrp->VisaSecrTxnAD = $this->getVisaSecureTransactionAuthenticationData();
        }
        if ($this->getCAVVResultCode() !== null) {
            if (!$this->validateCAVVResultCode()) {
                throw new InvalidRequestException("Invalid cavv result code");
            }
            $data->SecrTxnGrp->CAVVResultCode = $this->getCAVVResultCode();
        }
        if ($this->getAmexXID() !== null) {
            if (!$this->validateAmexXID()) {
                throw new InvalidRequestException("Invalid amex xid");
            }
            $data->SecrTxnGrp->AmexXID = $this->getAmexXID();
        }
        if ($this->getAmexSecureData() !== null) {
            if (!$this->validateAmexSecureData()) {
                throw new InvalidRequestException("Invalid amex secure data");
            }
            $data->SecrTxnGrp->AmexSecrAD = $this->getAmexSecureData();
        }
        if ($this->getSafekeyResultCode() !== null) {
            if (!$this->validateSafekeyResultCode()) {
                throw new InvalidRequestException("Invalid safekey result code");
            }
            $data->SecrTxnGrp->Safekey = $this->getSafekeyResultCode();
        }
        if ($this->getUCAFCollectionIndicator() !== null) {
            if (!$this->validateUCAFCollectionIndicator()) {
                throw new InvalidRequestException("Invalid ucaf collection indicator");
            }
            $data->SecrTxnGrp->UCAFCollectInd = $this->getUCAFCollectionIndicator();
        }
        if ($this->getMasterCardSecureData() !== null) {
            if (!$this->validateMasterCardSecureData()) {
                throw new InvalidRequestException("Invalid mastercard secure data");
            }
            $data->SecrTxnGrp->MCSecrAD = $this->getMasterCardSecureData();
        }
        if ($this->getDiscoverAuthenticationType() !== null) {
            if (!$this->validateDiscoverAuthenticationType()) {
                throw new InvalidRequestException("Invalid discover authentication type");
            }
            $data->SecrTxnGrp->DiscAuthType = $this->getDiscoverAuthenticationType();
        }
        if ($this->getDiscoverSecureData() !== null) {
            if (!$this->validateDiscoverSecureData()) {
                throw new InvalidRequestException("Invalid discover secure data");
            }
            $data->SecrTxnGrp->DiscSecData = $this->getDiscoverSecureData();
        }
        if ($this->getSecureDataDowngrade() !== null) {
            if (!$this->validateSecureDataDowngrade()) {
                throw new InvalidRequestException("Invalid secure data downgrade");
            }
            $data->SecrTxnGrp->SecDataDowngrade = $this->getSecureDataDowngrade();
        }
    }

    /**
     * @return string
     */
    public function getVisaXID()
    {
        return $this->getParameter('VisaXID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setVisaXID($value)
    {
        return $this->setParameter('VisaXID', $value);
    }


    /**
     * @return bool
     */
    public function validateVisaXID()
    {
        $value = $this->getParameter('VisaXID');
        if (!preg_match('/[a-zA-Z0-9=/\+]{28,28}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getVisaSecureTransactionAuthenticationData()
    {
        return $this->getParameter('VisaSecureTransactionAuthenticationData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setVisaSecureTransactionAuthenticationData($value)
    {
        return $this->setParameter('VisaSecureTransactionAuthenticationData', $value);
    }


    /**
     * @return bool
     */
    public function validateVisaSecureTransactionAuthenticationData()
    {
        $value = $this->getParameter('VisaSecureTransactionAuthenticationData');
        if (!preg_match('/[a-zA-Z0-9=\/\+]{28,28}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCAVVResultCode()
    {
        return $this->getParameter('CAVVResultCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCAVVResultCode($value)
    {
        return $this->setParameter('CAVVResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateCAVVResultCode()
    {
        $value = $this->getParameter('CAVVResultCode');
        $valid = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'I', 'U');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getAmexXID()
    {
        return $this->getParameter('AmexXID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAmexXID($value)
    {
        return $this->setParameter('AmexXID', $value);
    }


    /**
     * @return bool
     */
    public function validateAmexXID()
    {
        $value = $this->getParameter('AmexXID');
        if (!preg_match('/[a-zA-Z0-9=/\+]{28,28}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getAmexSecureData()
    {
        return $this->getParameter('AmexSecureData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAmexSecureData($value)
    {
        return $this->setParameter('AmexSecureData', $value);
    }


    /**
     * @return bool
     */
    public function validateAmexSecureData()
    {
        $value = $this->getParameter('AmexSecureData');
        if (!preg_match('/[a-zA-Z0-9=/\+]{28,28}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSafekeyResultCode()
    {
        return $this->getParameter('SafekeyResultCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSafekeyResultCode($value)
    {
        return $this->setParameter('SafekeyResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateSafekeyResultCode()
    {
        $value = $this->getParameter('SafekeyResultCode');
        $valid = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'I', 'U');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getUCAFCollectionIndicator()
    {
        return $this->getParameter('UCAFCollectionIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setUCAFCollectionIndicator($value)
    {
        return $this->setParameter('UCAFCollectionIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateUCAFCollectionIndicator()
    {
        $value = $this->getParameter('UCAFCollectionIndicator');
        $valid = array('0', '1', '2', '3', '4', '5', '6', '7', '8');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMasterCardSecureData()
    {
        return $this->getParameter('MasterCardSecureData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMasterCardSecureData($value)
    {
        return $this->setParameter('MasterCardSecureData', $value);
    }


    /**
     * @return bool
     */
    public function validateMasterCardSecureData()
    {
        $value = $this->getParameter('MasterCardSecureData');
        return strlen($value) >= 28 && strlen($value) <= 32;
    }


    /**
     * @return string
     */
    public function getDiscoverAuthenticationType()
    {
        return $this->getParameter('DiscoverAuthenticationType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDiscoverAuthenticationType($value)
    {
        return $this->setParameter('DiscoverAuthenticationType', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverAuthenticationType()
    {
        $value = $this->getParameter('DiscoverAuthenticationType');
        $valid = array('1', '2', '3');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getDiscoverSecureData()
    {
        return $this->getParameter('DiscoverSecureData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setDiscoverSecureData($value)
    {
        return $this->setParameter('DiscoverSecureData', $value);
    }


    /**
     * @return bool
     */
    public function validateDiscoverSecureData()
    {
        $value = $this->getParameter('DiscoverSecureData');
        if (!preg_match('/[a-zA-Z0-9=/\+]{28,28}/',$value)) {
            return false;
        }
        if (!preg_match('/[a-zA-Z0-9=/\+]{56,56}/',$value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getSecureDataDowngrade()
    {
        return $this->getParameter('SecureDataDowngrade');
    }


    /**
     * @param $value
     * @return string
     */
    public function setSecureDataDowngrade($value)
    {
        return $this->setParameter('SecureDataDowngrade', $value);
    }


    /**
     * @return bool
     */
    public function validateSecureDataDowngrade()
    {
        $value = $this->getParameter('SecureDataDowngrade');
        $valid = array('SecDataMissing', 'SecDataInvalid');
        return in_array($value, $valid);
    }
}