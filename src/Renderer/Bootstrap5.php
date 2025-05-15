<?php

/**
 * Class Bootstrap4
 */
class Nip_Form_Renderer_Bootstrap5 extends Nip_Form_Renderer_Bootstrap
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

            $formType = $this->getForm()->hasClass('form-horizontal') ? 'form-horizontal' : '';

            $rowClass = 'row';
            $rowClass .= ' row-' . $element->getUniqueId();
            $rowClass .= $element->isError() ? ' has-error' : '';
            $return .= '<div class="' . $rowClass . '">';

            $renderLabel = $element->getOption('render_label');
            if ($renderLabel !== false) {
                $return .= $this->renderLabel($element);
            }

            $class = '';
            if ($formType == 'form-horizontal') {
                $class = in_array($element->getType(), ['checkbox', 'recaptcha'])
                    ? 'offset-sm-3 col-sm-9'
                    : 'col-sm-9';
            }

            $return .= '<div class="' . $class . '">';
            $return .= $this->renderElement($element);

            $helpBlock = $element->getOption('form-help');
            if ($helpBlock) {
                $return .= '<span class="help-block">' . $helpBlock . '</span>';
            }

            $return .= $element->renderErrors();
            $return .= '</div>';
            $return .= '</div>';
        }

        return $return;
    }

    /**
     * @return string
     */
    public function renderButtons()
    {
        $return = '';
        $buttons = $this->getForm()->getButtons();

        if ($buttons) {
            $return .= '<div class="row">
                            <div class="' . ($this->getForm()->hasClass('form-horizontal') ? 'col-sm-offset-3 col-sm-9' : '') . '">';
            foreach ($buttons as $button) {
                $return .= $button->render() . "\n";
            }
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

        $return = '<label class="col-form-label ' . ($this->getForm()->hasClass('form-horizontal') ? ' col-sm-3' : '') . ($error ? '' : '') . '">';
        $return .= $label . ':';

        if ($required) {
            $return .= '<span class="required">*</span>';
        }

        $return .= "</label>";

        return $return;
    }


    /**
     * @inheritDoc
     */
    protected function getLabelClassesForElement($element)
    {
        $classes = parent::getLabelClassesForElement($element);
        $classes[] = 'col-form-label';
        if ($this->getForm()->hasClass('form-horizontal')) {
            $classes[] = 'col-sm-3';
        }
        return $classes;
    }
}
