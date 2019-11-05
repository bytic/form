<?php

use Nip\Form\Renderer\Elements\AbstractElementRenderer;

/**
 * Class Nip_Form_Renderer_Elements_MultiElement
 *
 * @method Nip_Form_Element_MultiElement getElement
 */
class Nip_Form_Renderer_Elements_MultiElement extends AbstractElementRenderer
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
                $return .= $element->renderLabel();
            }
            $returnElements[] = $element->render();
        }

        $return .= implode(' ', $returnElements);

        return $return;
    }
}
