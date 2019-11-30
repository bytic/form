<?php

namespace Nip\Form\Renderer\Elements\Traits;

/**
 * Trait HasErrorsTrait
 * @package Nip\Form\Renderer\Elements\Traits
 */
trait CanRenderErrors
{

    /**
     * @return string
     */
    public function renderErrors()
    {
        $return = '';
        if ($this->getElement()->isError() && $this->getElement()->getForm()->getOption('renderElementErrors') !== false) {
            $errors = $this->getElement()->getErrors();
            $errors_string = implode('<br />', $errors);
            $return .= '<div class="help-inline invalid-feedback">' . $errors_string . '</div>';
        }

        return $return;
    }
}
