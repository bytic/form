<?php

use Nip\Form\Elements\AbstractElement;
use Nip\Form\Renderer\AbstractRenderer;

class Nip_Form_Renderer_Bootstrap extends AbstractRenderer
{

    /**
     * @return string
     */
    public function renderElements()
    {
        $return = '';

        $renderRows = $this->renderRows();
        if ($renderRows) {
            $return .= $renderRows;
        }

        return $return;
    }

    /**
     * @return string
     */
    public function renderRows()
    {
        $elements = $this->getElements();
        $return = '';
        foreach ($elements as $element) {
            $return .= $this->renderRow($element);
        }

        return $return;
    }

    /**
     * @param Nip\Form\Elements\AbstractElement $element
     * @return string
     */
    public function renderRow($element)
    {
        $return = '';
        if (!$element->isRendered()) {
            if ($element->hasCustomRenderer()) {
                return $element->render();
            }

            $return .= '<div class="form-group row-' . $element->getUniqueId() . ($element->isError() ? ' has-error' : '') . '">';

            if ($element->isRenderLabel()) {
                $return .= $this->renderElementLabel($element);
            }

            $class = '';
            if ($this->getForm()->hasClass('form-horizontal')) {
                $class = $element->getType() == 'checkbox' ? 'col-sm-offset-3 col-sm-9' : 'col-sm-9';
            }

            $return .= $class ? '<div class="' . $class . '">' : '';
            $return .= $this->renderElement($element);

            $helpBlock = $element->getOption('form-help');
            if ($helpBlock) {
                $return .= '<span class="help-block">' . $helpBlock . '</span>';
            }

            $return .= $element->renderErrors();
            $return .= $class ? '</div>' : '';
            $return .= '</div>';
        }

        return $return;
    }

    /**
     * @inheritDoc
     */
    protected function getLabelClassesForElement($element)
    {
        $classes = parent::getLabelClassesForElement($element);
        $classes[] = 'control-label';
        if ($this->getForm()->hasClass('form-horizontal')) {
            $classes[] = 'col-sm-3';
        }
        return $classes;
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    public function renderElement(AbstractElement $element)
    {
        $element->addClass('form-control');

        return parent::renderElement($element);
    }

    /**
     * @return string
     */
    public function renderButtons()
    {
        $return = '';
        $buttons = $this->getForm()->getButtons();

        if ($buttons) {
            $return .= '<div class="form-group">
                            <div class="' . ($this->getForm()->hasClass('form-horizontal') ? 'col-sm-offset-3 col-sm-9' : '') . '">';
            foreach ($buttons as $button) {
                $return .= $button->render() . "\n";
            }
            $return .= '</div>';
            $return .= '</div>';
        }

        return $return;
    }
}
