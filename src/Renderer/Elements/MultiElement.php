<?php

/**
 * Class Nip_Form_Renderer_Elements_MultiElement
 *
 * @method Nip_Form_Element_MultiElement getElement
 */
class Nip_Form_Renderer_Elements_MultiElement extends AbstractElement
{
    /**
     * @return string|void
     */
    public function generateElement()
    {
        $elements = $this->getElement()->getElements();
        $return = '';
        $returnElements = [];
        foreach ($elements as $element) {
            $element->addClass('form-control');
            if ($element->isRenderLabel()) {
                $return .= $this->renderLabel($element);
            }
            $returnElements[] = $element->render();
        }

        $return .= implode(' ', $returnElements);

        return $return;
    }
}
