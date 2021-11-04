<?php

class Nip_Form_Element_Tel extends Nip_Form_Element_Input
{
    protected $_type = 'tel';

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'tel');
    }
}
