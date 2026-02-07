<?php

namespace Nip\Form\Traits;

use Nip\Form\Elements\AbstractElement as ElementAbstract;

/**
 * Class NewElementsMethods
 * @package Nip\Form\Traits
 */
trait NewElementsMethods
{
    /**
     * @return ElementAbstract|\Nip_Form_Element_Select
     */
    public function getNewSelectElement()
    {
        return $this->getNewElement('select');
    }

    /**
     * Add a new element to the form.
     *
     * Supports both legacy and Symfony-style calling conventions:
     * - Legacy: add($name, $label, $type, $isRequired, $options)
     * - Symfony-compatible: add($name, $type, $options) where $type can be null
     *
     * @param string $name Element name
     * @param bool|string $label Label text or element type (if 3rd param is array)
     * @param string|array $type Element type or options array
     * @param bool|array $isRequired Required flag or options array
     * @param array $options Additional options
     * @return $this
     */
    public function add($name, $label = false, $type = 'input', $isRequired = false, $options = [])
    {
        // Detect Symfony-style call: add(name, type, options)
        // where $label is actually the type and $type is the options array
        if (is_array($type)) {
            // Symfony-style: add($name, $type, $options)
            $options = $type; // $type parameter is actually options
            $elementType = is_string($label) ? $label : 'input'; // $label parameter is actually type
            $label = $options['label'] ?? ucfirst($name);
            $isRequired = $options['required'] ?? false;
        } else {
            // Legacy-style: add($name, $label, $type, $isRequired, $options)
            $label = ($label) ? $label : ucfirst($name);
            $elementType = $type;
        }

        $element = $this->getNewElement($elementType);
        $element->setName($name);
        $element->setLabel($label);
        $element->setRequired($isRequired);
        $element->setOptions($options);

        $this->addElement($element);

        return $this;
    }

    /**
     * @param $className
     * @param $name
     * @param bool $label
     * @param bool $isRequired
     * @param array $options
     * @return $this
     */
    public function addCustom($className, $name, $label = false, $isRequired = false, $options = [])
    {
        $label = ($label) ? $label : ucfirst($name);
        $element = $this->getNewElementByClass($className);
        $element->setName($name);
        $element->setLabel($label);
        $element->setRequired($isRequired);
        $element->setOptions($options);

        $this->addElement($element);

        return $this;
    }

    /**
     * @param string $type
     * @return ElementAbstract
     */
    public function getNewElement($type)
    {
        $className = $this->getElementClassName($type);

        return $this->getNewElementByClass($className);
    }

    /**
     * @param $type
     * @return string
     */
    public function getElementClassName($type)
    {
        return 'Nip_Form_Element_' . ucfirst($type);
    }

    /**
     * @param $className
     * @return ElementAbstract
     */
    public function getNewElementByClass($className)
    {
        $element = new $className($this);

        return $this->initNewElement($element);
    }

    /**
     * @param ElementAbstract $element
     * @return ElementAbstract
     */
    public function initNewElement($element)
    {
        $element->setForm($this);

        return $element;
    }
}
