<?php

class Nip_Form_Renderer_Elements_Select extends \Nip\Form\Renderer\Elements\AbstractElementRenderer
{
    /**
     * @return string
     */
    public function generateElement()
    {
        $this->getElement()->addClass('form-select');

        $return = '<select ';
        $return .= $this->renderAttributes();
        $return .= ' >' . $this->renderOptions() . '</select>';
        return $return;
    }

    public function renderOptions($options = false)
    {
        $options = $options ? $options : $this->getElement()->getOptions();
        $return = '';

        $selectedValue = $this->getElement()->getValue();

        foreach ($options as $value=>$atribs) {
            if (is_string($value) && !isset($atribs['label'])) {
                $return .= '<optgroup label="' . $value . '">';
                $return .= $this->renderOptions($atribs);
                $return .= '</optgroup>';
            } else {
                $return .= '<option';

                $label = $atribs['label'];
                unset($atribs['label']);

                $atribs['value'] = $value;
                if ($this->isOptionSelected($value, $selectedValue)) {
                    $atribs['selected'] = 'selected';
                }

                foreach ($atribs as $name=>$value) {
                    $return .= ' ' . $name . '="' . $value . '"';
                }
                $return .= '>' . $label . '</option>';
            }
        }
        return $return;
    }

    /**
     * @param $value
     * @param $selectedValue
     * @return bool
     */
    protected function isOptionSelected($value, $selectedValue): bool
    {
        if (is_null($selectedValue)) {
            return false;
        }
        if ($selectedValue === 0 or $value === 0) {
            if ($value === $selectedValue) {
                return true;
            }
        } elseif ($selectedValue == $value) {
            return true;
        }
        return false;
    }
}
