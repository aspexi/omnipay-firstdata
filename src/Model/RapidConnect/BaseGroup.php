<?php

namespace Omnipay\FirstData\Model\RapidConnect;

use Omnipay\Common\Helper;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FirstData\Model\RapidConnect\EntryMode;
use Symfony\Component\HttpFoundation\ParameterBag;

class BaseGroup
{
    use \Omnipay\FirstData\Model\RapidConnect\ParametersTrait;

    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    public function merge(BaseGroup $bg)
    {
        $bgParams = $bg->getParameters();
        $params = $this->getParameters();

        foreach ($params as $key => $value) {
            if (array_key_exists($key, $bgParams)) {
                $params[$key] = $bgParams[$key];
                unset($bgParams[$key]);
            }
        }

        foreach ($bgParams as $key => $value) {
            $params[$key] = $value;
        }

        return $this->initialize($params);
    }
}