<?php

namespace Nip\Form\Renderer\Elements;

use Nip\Form\Elements\AbstractElement;
use Nip\Form\Renderer\AbstractRenderer;
use Nip\Form\Renderer\Elements\Traits\CanRenderErrors;

/**
 * Class AbstractElementRenderer
 * @package Nip\Form\Renderer\Elements
 */
abstract class AbstractElementRenderer
{
    use CanRenderErrors;

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
        $this->renderElementBefore();
        $return = $this->renderDecorators($this->generateElement(), 'element');
        $this->getElement()->setRendered(true);

        return $return;
    }

    protected function renderElementBefore()
    {
        if ($this->getElement()->isError()) {
            $formRenderer = $this->getElement()->getForm()->getRenderer();
            $this->getElement()->addClass($formRenderer->classForElementHasError());
        }
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
            if (strpos($name, 'data-') === 0 || in_array($name, $elementAttribs)) {
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
