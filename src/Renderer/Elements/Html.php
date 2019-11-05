<?php

class Nip_Form_Renderer_Elements_Html extends \Nip\Form\Renderer\Elements\AbstractElementRenderer
{
    public function generateElement()
    {
        $return = $this->getElement()->getValue();
        return $return;
    }
}
