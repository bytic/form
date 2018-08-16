<?php

namespace Nip\Form\Elements\Traits;

use Nip_Form_Decorator_Elements_Abstract;

/**
 * Trait HasDecoratorsTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasDecoratorsTrait
{
    protected $_decorators;

    /**
     * @param string $type
     * @return mixed
     */
    public function newDecorator($type = '')
    {
        $name = 'Nip_Form_Decorator_Elements_'.ucfirst($type);
        $decorator = new $name();
        $decorator->setElement($this);

        return $decorator;
    }

    /**
     * @param Nip_Form_Decorator_Elements_Abstract $decorator
     * @param string $position
     * @param bool $name
     * @return $this
     */
    public function attachDecorator(
        Nip_Form_Decorator_Elements_Abstract $decorator,
        $position = 'element',
        $name = false
    ) {
        $decorator->setElement($this);
        $name = $name ? $name : $decorator->getName();
        $this->_decorators[$position][$name] = $decorator;

        return $this;
    }

    /**
     * @param boolean $position
     * @return mixed
     */
    public function getDecoratorsByPosition($position)
    {
        return $this->_decorators[$position];
    }

    /**
     * @param $name
     * @param bool $position
     * @return bool
     */
    public function getDecorator($name, $position = false)
    {
        if ($position) {
            return $this->_decorators[$position][$name];
        } else {
            foreach ($this->_decorators as $position => $decorators) {
                if (isset($decorators[$name])) {
                    return $decorators[$name];
                }
            }
        }

        return false;
    }

    /**
     * @param $name
     * @param bool $position
     * @return $this
     */
    public function removeDecorator($name, $position = false)
    {
        if ($position) {
            unset($this->_decorators[$position][$name]);
        } else {
            foreach ($this->_decorators as $position => $decorators) {
                if (isset($decorators[$name])) {
                    unset($decorators[$name]);

                    return $this;
                }
            }
        }

        return $this;
    }
}
