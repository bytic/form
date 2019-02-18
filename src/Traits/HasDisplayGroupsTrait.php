<?php

namespace Nip\Form\Traits;

use Nip_Form_DisplayGroup;

/**
 * Trait HasDisplayGroupsTrait
 * @package Nip\Form\Traits
 */
trait HasDisplayGroupsTrait
{
    protected $_displayGroups = [];

    /**
     * Add a display group
     * Groups named elements for display purposes.
     * @param array $elements
     * @param $name
     * @return $this
     */
    public function addDisplayGroup(array $elements, $name)
    {
        $group = $this->newDisplayGroup();
        foreach ($elements as $element) {
            if (isset($this->_elements[$element])) {
                $add = $this->getElement($element);
                if (null !== $add) {
                    $group->addElement($add);
                }
            }
        }
        if (empty($group)) {
            trigger_error('No valid elements specified for display group');
        }

        $name = (string)$name;
        $group->setLegend($name);

        $this->_displayGroups[$name] = $group;

        return $this;
    }

    /**
     * @return Nip_Form_DisplayGroup
     */
    public function newDisplayGroup()
    {
        $group = new Nip_Form_DisplayGroup();
        $group->setForm($this);

        return $group;
    }

    /**
     * @param string $name
     * @return Nip_Form_DisplayGroup
     */
    public function getDisplayGroup($name)
    {
        if (array_key_exists($name, $this->_displayGroups)) {
            return $this->_displayGroups[$name];
        }

        return null;
    }

    /**
     * @return Nip_Form_DisplayGroup[]
     */
    public function getDisplayGroups()
    {
        return $this->_displayGroups;
    }
}
