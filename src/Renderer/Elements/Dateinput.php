<?php

class Nip_Form_Renderer_Elements_Dateinput extends Nip_Form_Renderer_Elements_Input
{
    public function generateElement()
    {
        if (!$this->getElement()->getAttrib('id')) {
            $this->getElement()->setAttrib('id', $this->getElement()->getJSID());
        }
        $return = parent::generateElement();
        return $return;
    }

    /**
     * @return array
     */
    public function getElementAttribs(): array
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'min';
        $attribs[] = 'max';

        return $attribs;
    }
}
