<?php

namespace Nip\Form\Decorator\Elements\Traits;

use Nip\Form\Elements\AbstractElement;
use Nip\Form\Elements\Traits\HasDecoratorsTrait;

/**
 * Trait HasElementTrait
 * @package Nip\Form\Decorator\Elements
 */
trait HasElementTrait
{
    /**
     * @var AbstractElement
     */
    protected $element;

    /**
     * @param AbstractElement|HasDecoratorsTrait $element
     * @return $this
     */
    public function setElement(AbstractElement $element)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * @return AbstractElement
     */
    public function getElement()
    {
        return $this->element;
    }
}
