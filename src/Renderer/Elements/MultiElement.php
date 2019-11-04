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
            $renderLabel = $element->getOption('render_label');
            if ($renderLabel !== false) {
                $return .= $this->renderLabel($element);
            }
            $returnElements[] = $element->render();
        }

        $return .= implode(' ', $returnElements);

        return $return;
    }
}
