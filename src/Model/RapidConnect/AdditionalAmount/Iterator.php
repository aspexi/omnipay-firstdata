<?php

namespace Omnipay\FirstData\Model\RapidConnect\AdditionalAmount;

class Iterator implements \Iterator
{
    private $groups;
    private $position;

    public function __construct(array $groups = null)
    {
        $this->initialize($groups);
    }

    public function initialize(array $groups = null)
    {
        $this->groups = array();
        $this->position = 0;

        if (is_array($groups)) {
            foreach ($groups as $group) {
                if ($group && !$group instanceof Group) {
                    $group = new Group($group);
                }
                $this->groups[] = $group;
            }
        }

        return $this;
    }

    public function addAdditionalAmountGroups(\SimpleXMLElement $data)
    {
        for ($group = $this->current(); $this->valid(); $group = $this->next()) {
            $aag = $data->addChild('AddtlAmtGrp');
            $group->addAdditionalAmountGroup($aag);
        }
    }

    public function current()
    {
        return $this->getGroups()[$this->getPosition()];
    }

    public function next()
    {
        $this->setPosition($this->getPosition() + 1);
        if ($this->valid()) {
            return $this->getGroups()[$this->getPosition()];
        }
        return null;
    }

    public function key()
    {
        return $this->getPosition();
    }

    public function valid()
    {
        $groups = $this->getGroups();
        $position = $this->getPosition();

        return $position >= 0 &&
            $position < count($groups);
    }

    public function rewind()
    {
        $this->setPosition(0);
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        return $this->groups = $groups;
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