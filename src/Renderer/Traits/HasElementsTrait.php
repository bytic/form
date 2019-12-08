<?php

namespace Nip\Form\Renderer\Traits;

/**
 * Trait HasElementsTrait
 * @package Nip\Form\Renderer\Traits
 */
trait HasElementsTrait
{
    protected $elements = null;

    /**
     * @return array
     */
    public function getElements()
    {
        if ($this->elements === null) {
            $this->elements = $this->getForm()->getElements();
        }

        return $this->elements;
    }

    /**
     * @param $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }
}
