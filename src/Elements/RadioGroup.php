<?php

class Nip_Form_Element_RadioGroup extends Nip_Form_Element_Input_Group
{
    protected $_type = 'radioGroup';

    /**
     * @return Nip_Form_Element_Abstract
     */
    public function getNewElement()
    {
        $element = $this->getForm()->getNewElement('radio');
        $element->setName($this->getName());

        return $element;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $elements = $this->getElements();
        foreach ($elements as $element) {
            if ($element->getValue() == $value) {
                $element->setChecked(true);
                break;
            }
        }

        return parent::setValue($value);
    }

    /**
     * @param $boolean
     * @return Nip_Form_Element_RadioGroup
     */
    public function autoSelectFirst($boolean = true)
    {
        return $this->setOption('autoSelectFirst', $boolean === true);
    }

    /**
     * @return bool
     */
    public function isAutoSelectFirst()
    {
        if ($this->hasOption('autoSelectFirst') && $this->getOption('autoSelectFirst') == false) {
            return false;
        }

        return true;
    }
}
