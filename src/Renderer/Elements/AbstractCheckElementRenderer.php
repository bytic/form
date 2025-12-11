<?php

namespace Nip\Form\Renderer\Elements;

use Nip_Form_Renderer_Bootstrap;
use Nip_Form_Renderer_Elements_Input_Abstract;

/**
 *
 */
abstract class AbstractCheckElementRenderer extends Nip_Form_Renderer_Elements_Input_Abstract
{
    /**
     * @return string
     */
    public function generateElement(): string
    {
        $this->getElement()->removeClass('form-control');
        $this->getElement()->addClass('form-check-input');

        $class = get_class($this->getRenderer()) == Nip_Form_Renderer_Bootstrap::class ? 'radio' : 'form-check';
        if ($this->getElement()->hasOption('inline')) {
            $class .= ' form-check-inline';
        }

        $return = '<div class="' . $class . '">';
        $return .= '<label class="form-check-label">';
        $return .= parent::generateElement();
        $return .= $this->getElement()->getLabel();
        $return .= '</label>';
        $return .= '</div>';

        return $return;
    }

    /**
     * @return string
     */
    public function renderInput()
    {
        return parent::generateElement();
    }

    public function getElementAttribs(): array
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'checked';

        return $attribs;
    }
}