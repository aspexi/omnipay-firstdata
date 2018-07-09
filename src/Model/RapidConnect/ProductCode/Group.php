<?php

namespace Omnipay\FirstData\Model\RapidConnect\ProductCode;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addProductCodeGroup()
    {
        if ($this->getServiceLevel() !== null) {
            if (!$this->validateServiceLevel()) {
                throw new InvalidRequestException("Invalid service level");
            }
            $data->ProdCodeGrp->ServLvl = $this->getServiceLevel();
        }
        if ($this->getNumberofProducts() !== null) {
            if (!$this->validateNumberofProducts()) {
                throw new InvalidRequestException("Invalid number of products");
            }
            $data->ProdCodeGrp->NumOfProds = $this->getNumberofProducts();
        }
    }

    /**
     * @return string
     */
    public function getServiceLevel()
    {
        return $this->getParameter('ServiceLevel');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setServiceLevel(string $value)
    {
        return $this->setParameter('ServiceLevel', $value);
    }


    /**
     * @return bool
     */
    public function validateServiceLevel()
    {
        $value = $this->getParameter('ServiceLevel');
        $valid = array('F', 'S', 'N', 'X', 'O', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getNumberofProducts()
    {
        return $this->getParameter('NumberofProducts');
    }


    /**
     * @param string $value
     * @return string
     */
    public function setNumberofProducts(string $value)
    {
        return $this->setParameter('NumberofProducts', $value);
    }


    /**
     * @return bool
     */
    public function validateNumberofProducts()
    {
        $value = $this->getParameter('NumberofProducts');
        $valid = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10');
        return in_array($value, $valid);
    }
}