<?php

class Nip_Form_Element_Number extends Nip_Form_Element_Input
{
    protected $_type = 'number';

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'number');
        $this->setAttrib('step', '1');
    }

}
