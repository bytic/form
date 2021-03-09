<?php

class Nip_Form_Element_MultiSelect extends Nip_Form_Element_Select
{
    protected $_type = 'multiSelect';


    /**
     * @param $request
     * @return string
     */
    protected function sanitizeDataFromRequest($request)
    {
        return $request;
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        if (!is_array($value)) {
            return false;
        }

        $this->setAttrib('value', array_filter($value, function ($value) {
            return in_array($value, $this->_values);
        }));

        return $this;
    }

    /**
     * @return bool
     */
    public function isGroup()
    {
        return true;
    }
}
