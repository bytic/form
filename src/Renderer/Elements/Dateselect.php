<?php

class Nip_Form_Renderer_Elements_Dateselect extends Nip_Form_Renderer_Elements_MultiElement
{
    /**
     * @inheritDoc
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function generateElement()
    {
        $return = '<div class="row">';

        $elements = $this->getElement()->getElements();
        $returnElements = [];
        foreach ($elements as $key => $element) {
            $element->addClass('form-control');
            $element->setAttrib('style', 'padding-left:5px; padding-right: 0;');
            $returnElements[] = '<div class="col col-xs-4" style="max-width:' . ($key == 'day' ? 95 : 130) . 'px;">'
                . $element->render()
                . '</div>';
        }

        $return .= implode(' ', $returnElements);
        $return .= '</div>';

        return $return;
    }
}
