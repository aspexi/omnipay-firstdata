<?php

namespace Omnipay\FirstData\Model\RapidConnect\BillPayment;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\BaseGroup;

class Group extends BaseGroup
{
    function addBillPaymentGroup(\SimpleXMLElement $data)
    {
        if ($this->getBillPaymentTransactionIndicator() !== null) {
            if (!$this->validateBillPaymentTransactionIndicator()) {
                throw new InvalidRequestException("Invalid bill payment transactionindicator");
            }
            $data->BillPayGrp->BillPymtTxnInd = $this->getBillPaymentTransactionIndicator();
        }
        if ($this->getMerchantAdviceCode() !== null) {
            if (!$this->validateMerchantAdviceCode()) {
                throw new InvalidRequestException("Invalid merchant advice code");
            }
            $data->BillPayGrp->MerchAdviceCode = $this->getMerchantAdviceCode();
        }
        if ($this->getInstallmentPaymentInvoiceNumber() !== null) {
            if (!$this->validateInstallmentPaymentInvoiceNumber()) {
                throw new InvalidRequestException("Invalid installment payment invoicenumber");
            }
            $data->BillPayGrp->InstallInvNum = $this->getInstallmentPaymentInvoiceNumber();
        }
        if ($this->getInstallmentPaymentDescription() !== null) {
            if (!$this->validateInstallmentPaymentDescription()) {
                throw new InvalidRequestException("Invalid installment payment description");
            }
            $data->BillPayGrp->InstallPymntDesc = $this->getInstallmentPaymentDescription();
        }
    }

    /**
     * @return string
     */
    public function getBillPaymentTransactionIndicator()
    {
        return $this->getParameter('BillPaymentTransactionIndicator');
    }


    /**
     * @param $value
     * @return string
     */
    public function setBillPaymentTransactionIndicator($value)
    {
        return $this->setParameter('BillPaymentTransactionIndicator', $value);
    }


    /**
     * @return bool
     */
    public function validateBillPaymentTransactionIndicator()
    {
        $value = $this->getParameter('BillPaymentTransactionIndicator');
        $valid = array('Single', 'Recurring', 'Installment', 'Deferred');
        return in_array($value, $valid);
    }


    /**
     * @return string
     */
    public function getMerchantAdviceCode()
    {
        return $this->getParameter('MerchantAdviceCode');
    }


    /**
     * @param $value
     * @return string
     */
    public function setMerchantAdviceCode($value)
    {
        return $this->setParameter('MerchantAdviceCode', $value);
    }


    /**
     * @return bool
     */
    public function validateMerchantAdviceCode()
    {
        $value = $this->getParameter('MerchantAdviceCode');
        if (!preg_match('/[0-9A-Za-z]{2,2}/', $value)) {
            return false;
        }
        return true;
    }


    /**
     * @return string
     */
    public function getInstallmentPaymentInvoiceNumber()
    {
        return $this->getParameter('InstallmentPaymentInvoiceNumber');
    }


    /**
     * @param $value
     * @return string
     */
    public function setInstallmentPaymentInvoiceNumber($value)
    {
        return $this->setParameter('InstallmentPaymentInvoiceNumber', $value);
    }


    /**
     * @return bool
     */
    public function validateInstallmentPaymentInvoiceNumber()
    {
        $value = $this->getParameter('InstallmentPaymentInvoiceNumber');
        return strlen($value) >= 1 && strlen($value) <= 12;
    }


    /**
     * @return string
     */
    public function getInstallmentPaymentDescription()
    {
        return $this->getParameter('InstallmentPaymentDescription');
    }


    /**
     * @param $value
     * @return string
     */
    public function setInstallmentPaymentDescription($value)
    {
        return $this->setParameter('InstallmentPaymentDescription', $value);
    }


    /**
     * @return bool
     */
    public function validateInstallmentPaymentDescription()
    {
        $value = $this->getParameter('InstallmentPaymentDescription');
        return strlen($value) >= 1 && strlen($value) <= 15;
    }
}