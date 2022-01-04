<?php

class Nip_Form_Renderer_Elements_Number extends Nip_Form_Renderer_Elements_Input
{

    /**
     * @return array
     */
    public function getElementAttribs()
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'step';

        return $attribs;
    }
}
