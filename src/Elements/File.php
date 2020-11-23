<?php

class Nip_Form_Element_File extends Nip_Form_Element_Input_Abstract
{
    protected $_value = null;

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'file');
        $this->getForm()->setAttrib('enctype', 'multipart/form-data');
    }

    public function getValue($requester = 'abstract')
    {
        if ($this->_value == null) {
            $this->_value = $this->generateValueFromRequest();
        }

        return $this->_value;
    }

    /**
     * @return array|false|mixed
     */
    protected function generateValueFromRequest()
    {
        $name = $this->getName();
        $name = str_replace(']', '', $name);
        $parts = explode('[', $name);

        if (count($parts) <= 1) {
            return isset($_FILES[$name]) ? $_FILES[$name] : false;
        }

        if (!isset($_FILES[$parts[0]])) {
            return false;
        }
        $fileData = [];
        foreach ($_FILES[$parts[0]] as $key=>$data) {
            $fileData[$key] = $data[$parts[1]];
        }
        return $fileData;
    }
}
