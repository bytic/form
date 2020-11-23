<?php

class Nip_Form_Element_Textarea extends Nip\Form\Elements\AbstractElement
{
    protected $_type = 'textarea';

    public function init()
    {
        $this->setAttrib('rows', 10);
        $this->setAttrib('cols', 35);
        $this->addClass('text', 'cr');
    }
}
