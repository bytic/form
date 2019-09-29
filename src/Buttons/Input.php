<?php

class Nip_Form_Button_Input extends \Nip\Form\Buttons\AbstractButton
{
    protected $_type = 'input';

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'submit');
    }
}
