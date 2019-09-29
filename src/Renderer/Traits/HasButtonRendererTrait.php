<?php

namespace Nip\Form\Renderer\Traits;

use Nip\Form\Buttons\AbstractButton;
use Nip_Form_Renderer_Button_Abstract as AbstractButtonRenderer;

/**
 * Trait HasButtonRendererTrait
 * @package Nip\Form\Renderer\Traits
 */
trait HasButtonRendererTrait
{
    protected $buttonsRenderer = [];

    /**
     * @return string
     */
    public function renderButtons()
    {
        $return = '';
        $buttons = $this->getForm()->getButtons();
        if ($buttons) {
            $return .= '<div class="form-actions">';
            foreach ($buttons as $button) {
                $return .= $button->render() . "\n";
            }
            $return .= '    <div class="clear"></div>';
            $return .= '</div>';
        }

        return $return;
    }

    /**
     * @param AbstractButton $button
     * @return mixed
     */
    public function getButtonRenderer(AbstractButton $button)
    {
        $name = $button->getName();
        if (!isset($this->buttonsRenderer[$name])) {
            $this->buttonsRenderer[$name] = $this->getNewButtonRenderer($button);
        }

        return $this->buttonsRenderer[$name];
    }

    /**
     * @param AbstractButton $button
     * @return mixed
     */
    protected function getNewButtonRenderer(AbstractButton $button)
    {
        $type = $button->getType();
        $name = 'Nip_Form_Renderer_Button_' . ucfirst($type);
        /** @var AbstractButtonRenderer $renderer */
        $renderer = new $name();
        $renderer->setRenderer($this);
        $renderer->setItem($button);

        return $renderer;
    }
}
