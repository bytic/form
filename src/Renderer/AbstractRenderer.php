<?php

namespace Nip\Form\Renderer;

use Nip\Form\Elements\AbstractElement;
use Nip\Form\Renderer\Elements\AbstractElementRenderer as AbstractElementRenderer;
use Nip\Form\Renderer\Traits\ClassesDictionary;
use Nip\Form\Renderer\Traits\HasButtonRendererTrait;
use Nip\Form\Renderer\Traits\HasElementsTrait;
use Nip\Form\Renderer\Traits\HasFormTrait;
use Nip\Helpers\View\Errors as ErrorsHelper;
use Nip\Helpers\View\Messages as MessagesHelper;

/**
 * Class AbstractRenderer
 * @package Nip\Form\Renderer
 */
abstract class AbstractRenderer
{
    use HasButtonRendererTrait;
    use ClassesDictionary;
    use HasElementsTrait;
    use HasFormTrait;

    protected $elementsRenderer;

    /**
     * AbstractRenderer constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function render()
    {
        $return = $this->openTag();
        $return .= $this->renderHidden();

        $renderErrors = $this->getForm()->getOption('render_messages');
        if ($renderErrors !== false) {
            $return .= $this->renderMessages();
        }
        $return .= $this->renderGroups();
        $return .= $this->renderElements();
        $return .= $this->renderButtons();

        $return .= $this->closeTag();

        return $return;
    }

    /**
     * @return string
     */
    public function openTag()
    {
        $return = '<form ';
        $atributes = $this->getForm()->getAttribs();
        foreach ($atributes as $name => $value) {
            $return .= $name . '="' . $value . '" ';
        }
        $return .= '>';

        return $return;
    }

    /**
     * @return string
     */
    public function renderHidden()
    {
        $hiddenElements = $this->getForm()->findElements(['type' => 'hidden']);
        $return = '';
        if ($hiddenElements) {
            foreach ($hiddenElements as $element) {
                $return .= $this->renderElement($element);
            }
        }

        return $return;
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    public function renderElement(AbstractElement $element)
    {
        return $element->renderElement();
    }

    /**
     * The errors are rendered using the Errors View Helper
     * @return string
     */
    public function renderMessages()
    {
        $return = '';
        $messages = $this->getForm()->getMessages();
        foreach ($messages as $type => $lines) {
            if ($type == "error") {
                $return .= ErrorsHelper::render($lines);
            } else {
                $return .= MessagesHelper::render($lines, $type);
            }
        }

        return $return;
    }

    /**
     * @return string
     */
    public function renderGroups()
    {
        $groups = $this->getForm()->getDisplayGroups();
        $return = '';
        foreach ($groups as $group) {
            $return .= $group->render();
        }

        return $return;
    }

    /**
     * @return string
     */
    abstract public function renderElements();

    /**
     * @return string
     */
    public function closeTag()
    {
        return '</form>';
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    public function renderElementLabel(AbstractElement $element)
    {
        $extraClasses = $this->getLabelClassesForElement($element);
        return $element->renderLabel($extraClasses);
    }

    /**
     * @param string|AbstractElement $label
     * @param bool $required
     * @param bool $error
     * @return string
     * @deprecated Use renderElementLabel()
     */
    public function renderLabel($label, $required = false, $error = false)
    {
        if (is_object($label)) {
            return $this->renderElementLabel($label);
        }

        $return = '<label class="col-sm-3 ' . ($error ? ' error' : '') . '">';
        $return .= $label . ':';

        if ($required) {
            $return .= '<span class="required">*</span>';
        }

        $return .= "</label>";

        return $return;
    }

    /**
     * @param string|AbstractElement $element
     * @return array
     */
    protected function getLabelClassesForElement($element)
    {
        $classes = [];
        if (is_object($element) && $element->isError()) {
            $classes[] = 'error';
        }
        return $classes;
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    public function getElementRenderer(AbstractElement $element)
    {
        $name = $element->getUniqueId();
        if (!isset($this->elementsRenderer[$name])) {
            $this->elementsRenderer[$name] = $this->getNewElementRenderer($element);
        }

        return $this->elementsRenderer[$name];
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    protected function getNewElementRenderer(AbstractElement $element)
    {
        $type = $element->getType();
        $name = 'Nip_Form_Renderer_Elements_' . ucfirst($type);
        /** @var AbstractElementRenderer $renderer */
        $renderer = new $name();
        $renderer->setRenderer($this);
        $renderer->setElement($element);

        return $renderer;
    }
}
