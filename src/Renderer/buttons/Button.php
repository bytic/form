<?php

class Nip_Form_Renderer_Button_Button extends Nip_Form_Renderer_Button_Abstract
{
    /**
     * @noinspection PhpMissingParentCallCommonInspection
     * @inheritDoc
     */
    public function generateItem()
    {
        return '<button ' . $this->renderAttributes() . '>'
            . $this->getItem()->getLabel()
            . '</button>';
    }

    /**
     * @inheritDoc
     */
    public function getAllowedAttributes()
    {
        $attribs = parent::getAllowedAttributes();
        $attribs[] = 'type';

        return $attribs;
    }
}
