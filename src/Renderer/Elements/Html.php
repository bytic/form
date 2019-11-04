<?php
class Nip_Form_Renderer_Elements_Html extends AbstractElement
{
    public function generateElement()
    {
        $return = $this->getElement()->getValue();
        return $return;
    }
}
