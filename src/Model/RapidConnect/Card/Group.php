<?php

namespace Omnipay\FirstData\Model\RapidConnect\Card;

use Omnipay\Common\CreditCard;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addCardGroup(\SimpleXMLElement $data)
    {
        if ($this->getAccountNumber() !== null) {
            if (!$this->validateAccountNumber()) {
                throw new InvalidRequestException("Invalid account number");
            }
            $data->CardGrp->AcctNum = $this->getAccountNumber();
        }
        if ($this->getCardExpirationDate() !== null) {
            if (!$this->validateCardExpirationDate()) {
                throw new InvalidRequestException("Invalid card expiration date");
            }
            $data->CardGrp->CardExpiryDate = $this->getCardExpirationDate();
        }
        if ($this->getTrack1Data() !== null) {
            if (!$this->validateTrack1Data()) {
                throw new InvalidRequestException("Invalid track 1 data");
            }
            $data->CardGrp->Track1Data = $this->getTrack1Data();
        }
        if ($this->getTrack2Data() !== null) {
            if (!$this->validateTrack2Data()) {
                throw new InvalidRequestException("Invalid track 2 data");
            }
            $data->CardGrp->Track2Data = $this->getTrack2Data();
        }
        if ($this->getCardType() !== null) {
            if (!$this->validateCardType()) {
                throw new InvalidRequestException("Invalid card type");
            }
            $data->CardGrp->CardType = $this->getCardType();
        }
        if ($this->getAVSResultCode() !== null) {
            if (!$this->validateAVSResultCode()) {
                throw new InvalidRequestException("Invalid avs result code");
            }
            $data->CardGrp->AVSResultCode = $this->getAVSResultCode();
        }
        if ($this->getCCVIndicator() !== null) {
            if (!$this->validateCCVIndicator()) {
                throw new InvalidRequestException("Invalid ccv indicator");
            }
            $data->CardGrp->CCVInd = $this->getCCVIndicator();
        }
        if ($this->getCCVData() !== null) {
            if (!$this->validateCCVData()) {
                throw new InvalidRequestException("Invalid ccv data");
            }
            $data->CardGrp->CCVData = $this->getCCVData();
        }
        if ($this->getCCVResultCode() !== null) {
            if (!$this->validateCCVResultCode()) {
                throw new InvalidRequestException("Invalid ccv result code");
            }
            $data->CardGrp->CCVResultCode = $this->getCCVResultCode();
        }
        if ($this->getMVVMAID() !== null) {
            if (!$this->validateMVVMAID()) {
                throw new InvalidRequestException("Invalid mvvmaid");
            }
            $data->CardGrp->MVVMAID = $this->getMVVMAID();
        }
        if ($this->getCardInfoRequestIndicator() !== null) {
            if (!$this->validateCardInfoRequestIndicator()) {
                throw new InvalidRequestException("Invalid card info request indicator");
            }
            $data->CardGrp->InfoReqInd = $this->getCardInfoRequestIndicator();
        }
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->getParameter('AccountNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAccountNumber($value)
    {
        return $this->setParameter('AccountNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateAccountNumber()
    {
        $value = $this->getParameter('AccountNumber');
        if (!preg_match('/[0-9]{1,23}/', $value)) {
            return false;
        }
        return true;
    }


    public function getCard()
    {
        return $this->getParameter('card');
    }


    public function setCard($value)
    {
        if ($value && !$value instanceof CreditCard) {
            $value = new CreditCard($value);
        }

        $this->setAccountNumber($value->getNumber());
        $this->setCardExpirationDate($value->getExpiryDate('Ym'));

        $this->setCardType($brand);

        if ($value->getCvv()) {
            $this->setCCVData($value->getCvv());
            $this->setCCVIndicator('Prvded');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCardExpirationDate()
    {
        return $this->getParameter('CardExpirationDate');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardExpirationDate($value)
    {
        return $this->setParameter('CardExpirationDate', $value);
    }


    /**
     * @return bool
     */
    public function validateCardExpirationDate()
    {
        $value = $this->getParameter('CardExpirationDate');
        if (!preg_match('/[0-9]{6,8}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getTrack1Data()
    {
        return $this->getParameter('Track1Data');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTrack1Data($value)
    {
        return $this->setParameter('Track1Data', $value);
    }


    /**
     * @return bool
     */
    public function validateTrack1Data()
    {
        $value = $this->getParameter('Track1Data');
        return strlen($value) >= 1 && strlen($value) <= 76;
    }

    /**
     * @return string
     */
    public function getTrack2Data()
    {
        return $this->getParameter('Track2Data');
    }


    /**
     * @param $value
     * @return string
     */
    public function setTrack2Data($value)
    {
        return $this->setParameter('Track2Data', $value);
    }


    /**
     * @return bool
     */
    public function validateTrack2Data()
    {
        $value = $this->getParameter('Track2Data');
        return strlen($value) >= 1 && strlen($value) <= 37;
    }


    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->getParameter('CardType');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardType($value)
    {
        return $this->setParameter('CardType', $value);
    }


    /**
     * @return bool
     */
    public function validateCardType()
    {
        $value = $this->getParameter('CardType');

        $valid = array(
            'Amex',
            'Diners',
            'Discover',
            'JCB',
            'MaestroInt',
            'MasterCard',
            'Visa',
            'GiftCard',
            'PPayCL',
            'CarCareOne',
            'CostPlus',
            'Dicks',
            'Exxon',
            'GenProp',
            'Gulf',
            'Shell',
            'Sinclair',
            'SpeedPass',
            'Sunoco',
            'ValeroUCC',
            'Mexican',
            'BPBusiness',
            'Buypass',
            'EssoFleet',
            'ExxonFleet',
            'FleetCor',
            'FleetOne',
            'MCFleet',
            'ValeroFlt',
            'VisaFleet',
            'Voyager',
            'Wex',
            'Paypal'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getAVSResultCode()
    {
        return $this->getParameter('AVSResultCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setAVSResultCode($value)
    {
        return $this->setParameter('AVSResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateAVSResultCode()
    {
        $value = $this->getParameter('AVSResultCode');
        $valid = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'I',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'R',
            'S',
            'T',
            'U',
            'W',
            'X',
            'Y',
            'Z'
        );
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCCVIndicator()
    {
        return $this->getParameter('CCVIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCCVIndicator($value)
    {
        return $this->setParameter('CCVIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVIndicator()
    {
        $value = $this->getParameter('CCVIndicator');
        $valid = array('Ntprvd', 'Prvded', 'Illegible', 'NtOnCrd');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getCCVData()
    {
        return $this->getParameter('CCVData');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCCVData($value)
    {
        return $this->setParameter('CCVData', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVData()
    {
        $value = $this->getParameter('CCVData');
        if (!preg_match('/[0-9A-Za-z]{3,4}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCCVResultCode()
    {
        return $this->getParameter('CCVResultCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCCVResultCode($value)
    {
        return $this->setParameter('CCVResultCode', $value);
    }


    /**
     * @return bool
     */
    public function validateCCVResultCode()
    {
        $value = $this->getParameter('CCVResultCode');
        $valid = array('Match', 'NoMtch', 'NotPrc', 'NotPrv', 'NotPrt', 'Unknwn');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMVVMAID()
    {
        return $this->getParameter('MVVMAID');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMVVMAID($value)
    {
        return $this->setParameter('MVVMAID', $value);
    }


    /**
     * @return bool
     */
    public function validateMVVMAID()
    {
        $value = $this->getParameter('MVVMAID');
        if (!preg_match('/[0-9]{1,10}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getCardInfoRequestIndicator()
    {
        return $this->getParameter('CardInfoRequestIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setCardInfoRequestIndicator($value)
    {
        return $this->setParameter('CardInfoRequestIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateCardInfoRequestIndicator()
    {
        $value = $this->getParameter('CardInfoRequestIndicator');
        $valid = array('Y');
        return in_array($value, $valid);
    }

    /**
     * @return mixed
     */
    public function getMergeWithExisting()
    {
        return $this->getParameter('MergeWithExisting');
    }

    /**
     * @param $value
     * @return Group
     */
    public function setMergeWithExisting($value)
    {
        return $this->setParameter('MergeWithExisting', $value);
    }

    public function getAccountNumberFromTrack1Data()
    {
        $track1 = $this->getTrack1Data();
        $pattern = '/\%B(\d{1,19})\^.{2,26}\^\d{4}\d*\?/';
        if (preg_match($pattern, $track1, $matches) == 1) {
            return $matches[1];
        }

        return null;
    }

    public function getAccountNumberFromTrack2Data()
    {
        $track2 = $this->getTrack2Data();
        $pattern = '/;(\d{1,19})=\d{4}\d*\?/';
        if (preg_match($pattern, $track2, $matches) == 1) {
            return $matches[1];
        }

        return null;
    }
}