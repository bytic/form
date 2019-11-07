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
            $elementHtml = '<div style="display: flex;flex-direction: column;flex-basis: 100%;flex: 1;padding-right: 20px;">';
            if ($element->isRenderLabel()) {
                $elementHtml .= $element->renderLabel();
            }
            $elementHtml .= $element->render();
            $elementHtml .= '</div>';
            $returnElements[] = $elementHtml;
        }

        $return .= count($returnElements) ? '<div style="display: flex;flex-direction: row;">' : '';
        $return .= implode('', $returnElements);
        $return .= count($returnElements) ? '</div>' : '';

        return $return;
    }
}
