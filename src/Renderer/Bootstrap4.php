<?php

/**
 * Class Bootstrap4
 */
class Nip_Form_Renderer_Bootstrap4 extends Nip_Form_Renderer_Bootstrap
{
    /**
     * @param Nip_Form_Element_Abstract $element
     * @return string
     */
    public function renderRow($element)
    {
        $return = '';
        if (!$element->isRendered()) {
            if ($element->hasCustomRenderer()) {
                return $element->render();
            }

            $return .= '<div class="form-group row row-'.$element->getUniqueId().($element->isError() ? ' has-error' : '').'">';

            $renderLabel = $element->getOption('render_label');
            if ($renderLabel !== false) {
                $return .= $this->renderLabel($element);
            }

            $class = '';
            if ($this->getForm()->hasClass('form-horizontal')) {
                $class = $element->getType() == 'checkbox' ? 'col-sm-offset-3 col-sm-9' : 'col-sm-9';
            }

            $return .= '<div class="'.$class.'">';
            $return .= $this->renderElement($element);

            $helpBlock = $element->getOption('form-help');
            if ($helpBlock) {
                $return .= '<span class="help-block">'.$helpBlock.'</span>';
            }

            $return .= $element->renderErrors();
            $return .= '</div>';
            $return .= '</div>';
        }

        return $return;
    }

    /**
     * @param $label
     * @param bool $required
     * @param bool $error
     * @return string
     */
    public function renderLabel($label, $required = false, $error = false)
    {
        if (is_object($label)) {
            $element = $label;
            $label = $element->getLabel();
            $required = $element->isRequired();
            $error = $element->isError();
        }

        $return = '<label class="col-form-label '.($this->getForm()->hasClass('form-horizontal') ? ' col-sm-3' : '').($error ? '' : '').'">';
        $return .= $label.':';

        if ($required) {
            $return .= '<span class="required">*</span>';
        }

        $return .= "</label>";

        return $return;
    }
}
