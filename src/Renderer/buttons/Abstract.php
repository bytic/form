<?php

use Nip\Form\Renderer\AbstractRenderer;
use Nip\Form\Buttons\AbstractButton;

/**
 * Class Nip_Form_Renderer_Button_Abstract
 */
abstract class Nip_Form_Renderer_Button_Abstract
{
    use \Nip\Form\Renderer\Traits\HasAttribsTrait;

    protected $_renderer;
    protected $_button;

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
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        return $this->_renderer;
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
    public function getItem()
    {
        return $this->_item;
    }

    /**
     * @return AbstractButton
     */
    public function getElement()
    {
        return $this->getItem();
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

<<<<<<< HEAD
=======
    public function renderAttributes($overrides = [])
    {
        $attribs = $this->getItem()->getAttribs();
        if (!isset($attribs['title'])) {
            $attribs['title'] = $this->getItem()->getLabel();
        }
        $itemAttribs = $this->getItemAttribs();
        $return = '';
        foreach ($attribs as $name => $value) {
            if (in_array($name, $itemAttribs)) {
                if (in_array($name, array_keys($overrides))) {
                    $value = $overrides[$name];
                }

                $return .= ' ' . $name . '="' . $value . '"';
            }
        }

        return $return;
    }
>>>>>>> 0.9

}
