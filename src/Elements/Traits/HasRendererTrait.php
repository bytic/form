<?php

namespace Nip\Form\Elements\Traits;

/**
 * Trait HasRendererTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasRendererTrait
{
    protected $_isRendered = false;

    /**
     * @param boolean $isRendered
     * @return $this
     */
    public function setRendered($isRendered)
    {
        $this->_isRendered = (bool)$isRendered;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRendered()
    {
        return (bool)$this->_isRendered;
    }

    /**
     * @return bool
     */
    public function hasCustomRenderer()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->getRenderer()->render($this);
    }

    /**
     * @return mixed
     */
    public function getRenderer()
    {
        return $this->getForm()->getRenderer()->getElementRenderer($this);
    }

    /**
     * @return mixed
     */
    public function renderElement()
    {
        return $this->getRenderer()->renderElement($this);
    }

    /**
     * @return mixed
     */
    public function renderErrors()
    {
        return $this->getRenderer()->renderErrors($this);
    }
}
