<?php

/**
 * Class Nip_Form_Renderer_Elements_RadioGroup
 *
 * @method \Nip_Form_Element_RadioGroup getElement()
 */
class Nip_Form_Renderer_Elements_RadioGroup extends Nip_Form_Renderer_Elements_Input_Group
{
    /**
     * @return string
     */
    public function generateElement()
    {
        $this->checkDefaultValue();

        return parent::generateElement();
    }

    protected function checkDefaultValue()
    {
        if (!$this->getElement()->hasValue() && $this->getElement()->isAutoSelectFirst()) {
            $elements = $this->getElement()->getElements();
            if ($elements) {
                $element = reset($elements);
                $element->setChecked(true);
            }
        }
    }
}
