<?php

class Nip_Form_Element_Select extends Nip\Form\Elements\AbstractElement
{
    protected $_type = 'select';
    protected $_optionsElements = [];
    protected $_values = [];

    /**
     * @return Nip_Form_Element_Select
     */
    public function addOptionsArray($options, $valueKey, $labelKey)
    {
        foreach ($options as $key => $option) {
            $option = (object) $option;

            $oValue = $option->$valueKey;
            $oLabel = $option->$labelKey;
            $oDisabled = $option->disabled ?? false;

            $atribs = [
                'label' => $oLabel,
            ];

            if ($oDisabled) {
                $atribs['disabled'] = 'disabled';
            }
            $this->addOption($oValue, $atribs);
        }

        return $this;
    }

    /**
     * @return Nip_Form_Element_Select
     */
    public function addOption($value, $label)
    {
        if (is_array($label)) {
            $option = $label;
        } else {
            $option['label'] = $label;
        }

        $this->_optionsElements[$value] = $option;
        $this->_values[] = $value;

        return $this;
    }

    /**
     * @return Nip_Form_Element_Select
     */
    public function addOptions(array $array)
    {
        foreach ($array as $value => $label) {
            $this->addOption($value, $label);
        }

        return $this;
    }

    /**
     * @return Nip_Form_Element_Select
     */
    public function appendOptgroupOption($optgroup, $value, $label)
    {
        if (is_array($label)) {
            $option = $label;
        } else {
            $option['label'] = $label;
        }

        $this->_optionsElements[$optgroup][$value] = $option;
        $this->_values[] = $value;

        return $this;
    }

    /**
     * @deprecated to stop confusion from select options and element options
     * @return array
     */
    public function getOptions()
    {
        return $this->_optionsElements;
    }

    /**
     * @return array
     */
    public function getOptionsElements()
    {
        return $this->_optionsElements;
    }

    public function setValue($value)
    {
        if ($this->isMultipleSelect()) {
            if (!is_array($value)) {
                $value = [$value];
            }
            $validValues = [];
            foreach ($value as $val) {
                if (in_array($val, $this->_values)) {
                    $validValues[] = $val;
                }
            }
            return parent::setValue($validValues);
        }
        if (in_array($value, $this->_values)) {
            return parent::setValue($value);
        }

        return false;
    }

    protected function sanitizeDataFromRequest($request)
    {
        if ($this->isRequestArray()) {
            $request = is_array($request) ? $request : [$request];
            $sanitized = array_map(function ($item) {
                return parent::sanitizeDataFromRequest($item);
            }, $request);
            return $sanitized;
        }
        return parent::sanitizeDataFromRequest($request);
    }

    public function isGroup()
    {
        return $this->isRequestArray();
    }

    public function isRequestArray(): bool
    {
        if ($this->isMultipleSelect()) {
            return true;
        }
        return parent::isRequestArray();
    }

    public function isMultipleSelect(): bool
    {
        return $this->getAttrib('multiple') !== null;
    }
}
