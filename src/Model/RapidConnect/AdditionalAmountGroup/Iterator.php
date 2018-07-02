<?php

namespace Omnipay\FirstData\Model\RapidConnect\AdditionalAmountGroup;

class Iterator  implements \Iterator
{
    private $position;
    use Omnipay\Common\ParameterTrait;

    public  function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize(array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::Initialize($this, $parameters);

        return $this;
    }

    public function current()
    {
        $groups = $this->getGroups();
        $position = $this->getPosition();
        return $groups[$position];
    }

    public function next()
    {
        $n = $this->getPosition() + 1;
        $groups = $this->getGroups();
        if (!array_key_exists($n, $groups)) {
            // throw exception
        }
        $this->setPosition($n);
        return $groups[$n];
    }

    public function key()
    {
        return $this->getPosition();
    }

    public function valid()
    {
        $groups = $this->getGroups();
        $position = $this->getPosition();
        return array_key_exists($position, $groups) && isset($groups[$position]);
    }

    public function rewind()
    {
        if (!array_key_exists(0, $this->getGroups())) {
            // throw exception, should never happen
        }
        $this->setPosition(0);
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->getParameter('groups');
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        return $this->setParameter('groups', $groups);
    }

    /**
     * @return mixed
     */
    protected function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    protected function setPosition(int $position)
    {
        $this->position = $position;
    }
}