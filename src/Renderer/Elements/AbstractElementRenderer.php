<?php

namespace Nip\Form\Renderer\Elements;

use Nip\Form\Elements\AbstractElement;
use Nip\Form\Renderer\AbstractRenderer;

/**
 * Class AbstractElementRenderer
 * @package Nip\Form\Renderer\Elements
 */
abstract class AbstractElementRenderer
{
    protected $_renderer;
    protected $_element;

    /**
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        return $this->_renderer;
    }

    /**
     * @param AbstractRenderer $renderer
     *
     * @return $this
     */
    public function setRenderer(AbstractRenderer $renderer)
    {
        $this->_renderer = $renderer;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $return = '';
        $return .= $this->renderElement();
        $return .= $this->renderErrors();

        return $return;
    }

    /**
     * @return mixed
     */
    public function renderElement()
    {
        $return = $this->renderDecorators($this->generateElement(), 'element');
        $this->getElement()->setRendered(true);

        return $return;
    }

    /**
     * @param string|array $classes
     * @return string
     */
    public function renderLabel($classes = null)
    {
        $label = $this->getElement()->getLabel();
        $required = $this->getElement()->isRequired();
        $classes = is_array($classes) ? implode(' ', $classes) : $classes;

        $return = '<label class="' . $classes . '">';
        $return .= $label . ':';

        if ($required) {
            $return .= '<span class="required">*</span>';
        }

        $return .= "</label>";

        return $return;
    }

    /**
     * @param $return
     * @param bool $position
     *
     * @return mixed
     */
    public function renderDecorators($return, $position = false)
    {
        if ($position) {
            $decorators = $this->getElement()->getDecoratorsByPosition($position);
            if (is_array($decorators)) {
                foreach ($decorators as $decorator) {
                    $return = $decorator->render($return);
                }
            }
        }

        return $return;
    }

    /**
     * @return AbstractElement
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * @param AbstractElement $element
     *
     * @return $this
     */
    public function setElement(AbstractElement $element)
    {
        $this->_element = $element;

        return $this;
    }

    abstract public function generateElement();

    /**
     * @return string
     */
    public function renderErrors()
    {
        $return = '';
        if ($this->getElement()->isError() && $this->getElement()->getForm()->getOption('renderElementErrors') !== false) {
            $errors = $this->getElement()->getErrors();
            $errors_string = implode('<br />', $errors);
            $return .= '<span class="help-inline">' . $errors_string . '</span>';
        }

        return $return;
    }

    /**
     * @param array $overrides
     *
     * @return string
     */
    public function renderAttributes($overrides = [])
    {
        $attribs = $this->getElement()->getAttribs();
        if (!isset($attribs['title'])) {
            $attribs['title'] = strip_tags($this->getElement()->getLabel());
        }
        $elementAttribs = $this->getElementAttribs();
        $return = '';
        foreach ($attribs as $name => $value) {
            if (in_array($name, $elementAttribs)) {
                if (in_array($name, array_keys($overrides))) {
                    $value = $overrides[$name];
                }
                if ($name == "name" && $this->getElement()->isGroup()) {
                    $value = $value . "[]";
                }
                $return .= ' ' . $name . '="' . $value . '"';
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getElementAttribs()
    {
        return ['id', 'name', 'style', 'class', 'title', 'readonly', 'disabled'];
    }
}
