<?php

namespace Nip\Form\Traits;

use Nip\Form\Buttons\AbstractButton as ButtonAbstract;
use Nip\Form\Elements\AbstractElement as ElementAbstract;

/**
 * Trait HasButtonsTrait
 * @package Nip\Form\Traits
 */
trait HasButtonsTrait
{
    protected $_buttons;

    /**
     * @param $name
     * @param bool $label
     * @param string $type
     * @return $this
     */
    public function addButton($name, $label = false, $type = 'button')
    {
        $this->_buttons[$name] = $this->newButton($name, $label, $type);

        return $this;
    }

    /**
     * @param $name
     * @param bool $label
     * @param string $type
     * @return ButtonAbstract
     */
    protected function newButton($name, $label = false, $type = 'button')
    {
        $class = 'Nip_Form_Button_' . ucfirst($type);
        /** @var ButtonAbstract $button */
        $button = new $class($this);
        $button->setName($name)
            ->setLabel($label);

        return $button;
    }

    /**
     * @param $name
     * @return ElementAbstract
     */
    public function getButton($name)
    {
        if (array_key_exists($name, $this->_buttons)) {
            return $this->_buttons[$name];
        }

        return null;
    }


    /**
     * @return ButtonAbstract[]
     */
    public function getButtons()
    {
        return $this->_buttons;
    }
}
