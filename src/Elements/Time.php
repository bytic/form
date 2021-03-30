<?php

class Nip_Form_Element_Time extends Nip_Form_Element_Input
{
    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'time');
    }

    public function getData($data, $source = 'abstract')
    {
        if ($source != 'model') {
            return parent::getData($data, $source);
        }

        if ($data instanceof DateTime) {
            $this->setValue($data->format('H:i:s'));
            return $this;
        }

        $this->setValue($data);

        return $this;
    }
}
