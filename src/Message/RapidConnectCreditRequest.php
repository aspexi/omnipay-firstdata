<?php

namespace Omnipay\FirstData\Message;

abstract class RapidConnectCreditRequest extends RapidConnectAbstractRequest
{
    protected $requestType = 'CreditRequest';

	/**
	 * @return string
	 */
	public function getCustSvcPhoneNumber()
	{
		return $this->getParameter('CustSvcPhoneNumber');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCustSvcPhoneNumber(string $value)
	{
		return $this->setParameter('CustSvcPhoneNumber', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCustSvcPhoneNumber()
	{
		$value = $this->getParameter('CustSvcPhoneNumber');
		if (!preg_match('/[0-9]{1,10}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getEcommURL()
	{
		return $this->getParameter('EcommURL');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setEcommURL(string $value)
	{
		return $this->setParameter('EcommURL', $value);
	}


	/**
	 * @return bool
	 */
	public function validateEcommURL()
	{
		$value = $this->getParameter('EcommURL');
		return strlen($value) >= 1 && strlen($value) <= 32;
	}


	/**
	 * @return string
	 */
	public function getVisaBID()
	{
		return $this->getParameter('VisaBID');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setVisaBID(string $value)
	{
		return $this->setParameter('VisaBID', $value);
	}


	/**
	 * @return bool
	 */
	public function validateVisaBID()
	{
		$value = $this->getParameter('VisaBID');
		return strlen($value) >= 1 && strlen($value) <= 10;
	}


	/**
	 * @return string
	 */
	public function getVisaAUAR()
	{
		return $this->getParameter('VisaAUAR');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setVisaAUAR(string $value)
	{
		return $this->setParameter('VisaAUAR', $value);
	}


	/**
	 * @return bool
	 */
	public function validateVisaAUAR()
	{
		$value = $this->getParameter('VisaAUAR');
		if (!preg_match('/[0-9A-F]{12,12}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getAVSBillingAddr()
	{
		return $this->getParameter('AVSBillingAddr');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAVSBillingAddr(string $value)
	{
		return $this->setParameter('AVSBillingAddr', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAVSBillingAddr()
	{
		$value = $this->getParameter('AVSBillingAddr');
		return strlen($value) >= 1 && strlen($value) <= 30;
	}


	/**
	 * @return string
	 */
	public function getAVSBillingPostalCode()
	{
		return $this->getParameter('AVSBillingPostalCode');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setAVSBillingPostalCode(string $value)
	{
		return $this->setParameter('AVSBillingPostalCode', $value);
	}


	/**
	 * @return bool
	 */
	public function validateAVSBillingPostalCode()
	{
		$value = $this->getParameter('AVSBillingPostalCode');
		if (!preg_match('/[0-9A-Z a-z]{1,10}/',$value)) {
		    return false;
		}
		return true;
	}


	/**
	 * @return string
	 */
	public function getCHFirstNm()
	{
		return $this->getParameter('CHFirstNm');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCHFirstNm(string $value)
	{
		return $this->setParameter('CHFirstNm', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCHFirstNm()
	{
		$value = $this->getParameter('CHFirstNm');
		return strlen($value) >= 1 && strlen($value) <= 35;
	}


	/**
	 * @return string
	 */
	public function getCHLastNm()
	{
		return $this->getParameter('CHLastNm');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setCHLastNm(string $value)
	{
		return $this->setParameter('CHLastNm', $value);
	}


	/**
	 * @return bool
	 */
	public function validateCHLastNm()
	{
		$value = $this->getParameter('CHLastNm');
		return strlen($value) >= 1 && strlen($value) <= 35;
	}


	/**
	 * @return string
	 */
	public function getOrderDate()
	{
		return $this->getParameter('OrderDate');
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function setOrderDate(string $value)
	{
		return $this->setParameter('OrderDate', $value);
	}


	/**
	 * @return bool
	 */
	public function validateOrderDate()
	{
		$value = $this->getParameter('OrderDate');
		if (!preg_match('/[0-9]{6,6}/',$value)) {
		    return false;
		}
		return true;
	}

}
