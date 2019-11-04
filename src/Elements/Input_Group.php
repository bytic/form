<?php

use Nip\Form\Elements\AbstractElement;

/**
 * Class Nip_Form_Element_Input_Group
 */
abstract class Nip_Form_Element_Input_Group extends AbstractElement
{
    protected $_type = 'input_group';
    protected $_elements = [];
    protected $_values = [];

    /**
     * @return bool
     */
    public function isGroup()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isRequestArray()
    {
        return false;
    }

    /**
     * @param $options
     * @param $valueKey
     * @param $labelKey
     *
     * @return $this
     */
    public function addOptionsArray($options, $valueKey, $labelKey)
    {
        foreach ($options as $key => $option) {
            $option = (object)$option;


            $oValue    = $option->{$valueKey};
            $oLabel    = $option->{$labelKey};
            $oDisabled = $option->disabled;

            if ($oDisabled) {
                $atribs['disabled'] = 'disabled';
            }
            $this->addOption($oValue, $oLabel, $atribs);
        }

        return $this;
    }

    /**
     * @param $value
     * @param $label
     * @param array $attribs
     *
     * @return Nip_Form_Element_Input_Group
     */
    public function addOption($value, $label, $attribs = [])
    {
        $element = $this->getNewElement();
        $element->setValue($value);
        $element->setLabel($label);
        $element->addAttribs($attribs);

        return $this->addElement($element);
    }

    /**
     * @return AbstractElement
     */
    abstract public function getNewElement();

    /**
     * @param Nip_Form_Element_Input_Abstract $element
     *
     * @return $this
     */
    public function addElement(AbstractElement $element)
    {
        $key                   = $element->getValue();
        $this->_elements[$key] = $element;
        $this->_values[]       = $key;

        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getElement($key)
    {
        return $this->_elements[$key];
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->_elements;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->_values;
    }
}
