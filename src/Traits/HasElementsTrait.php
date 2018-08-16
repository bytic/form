<?php

namespace Nip\Form\Traits;

use Nip_Form_Element_Abstract as ElementAbstract;

/**
 * Trait HasElementsTrait
 * @package Nip\Form\Traits
 */
trait HasElementsTrait
{
    protected $_elements = [];
    protected $_elementsLabel;
    protected $_elementsOrder = [];


    /**
     * @param ElementAbstract $element
     * @return $this
     */
    public function addElement(ElementAbstract $element)
    {
        $name = $element->getUniqueId();
        $this->_elements[$name] = $element;
        $this->_elementsLabel[$element->getLabel()] = $name;
        $this->_elementsOrder[] = $name;

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function removeElement($name)
    {
        unset($this->_elements[$name]);

        $key = array_search($name, $this->_elementsOrder);
        if ($key) {
            unset($this->_elementsOrder[$key]);
        }

        return $this;
    }

    /**
     * @param $name
     * @return ElementAbstract
     */
    public function getElement($name)
    {
        if (array_key_exists($name, $this->_elements)) {
            return $this->_elements[$name];
        }

        return null;
    }

    /**
     * @return \Nip_Form_Element_Abstract[]
     */
    public function getElements()
    {
        $return = [];
        foreach ($this->_elementsOrder as $current) {
            $return[$current] = $this->_elements[$current];
        }

        return $return;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasElement($name)
    {
        return array_key_exists($name, $this->_elements);
    }

    /**
     * @param $label
     * @return ElementAbstract
     */
    public function getElementByLabel($label)
    {
        if (array_key_exists($label, $this->_elementsLabel)) {
            return $this->_elements[$this->_elementsLabel[$label]];
        }

        return null;
    }
    /**
     * @param $element
     * @param $neighbour
     * @param string $type
     * @return $this
     */
    public function setElementOrder($element, $neighbour, $type = 'bellow')
    {
        if (in_array($element, $this->_elementsOrder) && in_array($neighbour, $this->_elementsOrder)) {
            $newOrder = [];
            foreach ($this->_elementsOrder as $current) {
                if ($current == $element) {
                } elseif ($current == $neighbour) {
                    if ($type == 'above') {
                        $newOrder[] = $element;
                        $newOrder[] = $neighbour;
                    } else {
                        $newOrder[] = $neighbour;
                        $newOrder[] = $element;
                    }
                } else {
                    $newOrder[] = $current;
                }
            }
            $this->_elementsOrder = $newOrder;
        }

        return $this;
    }
    /**
     * @param bool $params
     * @return array
     */
    public function findElements($params = false)
    {
        $elements = [];
        foreach ($this->getElements() as $element) {
            if (isset($params['type'])) {
                if ($element->getType() != $params['type']) {
                    continue;
                }
            }
            if (isset($params['attribs']) && is_array($params['attribs'])) {
                foreach ($params['attribs'] as $name => $value) {
                    if ($element->getAttrib($name) != $value) {
                        continue(2);
                    }
                }
            }
            $elements[$element->getUniqueId()] = $element;
        }

        return $elements;
    }
}
