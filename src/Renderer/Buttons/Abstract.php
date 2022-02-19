<?php

use Nip\Form\Buttons\AbstractButton;
use Nip\Form\Renderer\AbstractRenderer;
use Nip\Form\Renderer\Traits\HasAttribsTrait;

/**
 * Class Nip_Form_Renderer_Button_Abstract
 */
abstract class Nip_Form_Renderer_Button_Abstract
{
    use HasAttribsTrait;

    protected $_renderer;
    protected $_button;

    /**
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        return $this->_renderer;
    }

    /**
     * @param AbstractRenderer $renderer
     * @return $this
     */
    public function setRenderer(AbstractRenderer $renderer)
    {
        $this->_renderer = $renderer;

        return $this;
    }

    /**
     * @param AbstractButton $item
     * @return $this
     */
    public function setItem(AbstractButton $item)
    {
        $this->_item = $item;

        return $this;
    }

    /**
     * @return AbstractButton
     */
    public function getElement()
    {
        return $this->getItem();
    }

    /**
     * @return AbstractButton
     */
    public function getItem()
    {
        return $this->_item;
    }

    public function render()
    {
        $return = '';
        $return .= $this->renderItem();

        return $return;
    }

    public function renderItem()
    {
        $return = $this->generateItem();

        return $return;
    }

    public function generateItem()
    {
        return;
    }
}
