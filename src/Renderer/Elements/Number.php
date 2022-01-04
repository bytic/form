<?php

declare(strict_types=1);

class Nip_Form_Renderer_Elements_Number extends Nip_Form_Renderer_Elements_Input
{

    /**
     * @return array
     */
    public function getElementAttribs()
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'step';
        $attribs[] = 'min';
        $attribs[] = 'max';

        return $attribs;
    }
}
