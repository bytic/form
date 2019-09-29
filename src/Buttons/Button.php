<?php

class Nip_Form_Button_Button extends \Nip\Form\Buttons\AbstractButton
{
    protected $_type = 'button';

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'submit');
    }
}
