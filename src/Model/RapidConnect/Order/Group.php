<?php

namespace Omnipay\FirstData\Model\RapidConnect\Order;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    public function addOrderGroup(\SimpleXMLElement $data)
    {
        if ($this->getOrderDate() !== null) {
            if (!$this->validateOrderDate()) {
                throw new InvalidRequestException("Invalid order date");
            }
            $data->OrderGrp->OrderDate = $this->getOrderDate();
        }
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getParameter('OrderNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setOrderNumber($value)
    {
        return $this->setParameter('OrderNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateOrderNumber()
    {
        $value = $this->getParameter('OrderNumber');
        if (!preg_match('/[0-9A-Z a-z]{1,15}/', $value)) {
            return false;
        }
        return true;
    }
}