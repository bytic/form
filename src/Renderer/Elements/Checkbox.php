<?php

use Nip\Form\Renderer\Elements\AbstractCheckElementRenderer;

class Nip_Form_Renderer_Elements_Checkbox extends AbstractCheckElementRenderer
{
    public function generateElement(): string
    {
        if (!$this->getElement()->getValue()) {
            $this->getElement()->setValue('on');
        }

        return parent::generateElement();
    }

}
