<?php

namespace Nip\Form\Elements\Traits;

use Nip\Form\Decorator\DecoratorFactory;
use Nip\Form\Decorator\Elements\AbstractDecorator;

/**
 * Trait HasDecoratorsTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasDecoratorsTrait
{
    protected $decorators;

    /**
     * @param string $type
     * @return mixed
     */
    public function newDecorator($type = '')
    {
        return DecoratorFactory::createForElement($this, $type);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function addDecorator($type = '', $position = 'element', $name = false)
    {
        $decorator = $this->newDecorator($type);
        $this->attachDecorator($decorator, $position, $name);
        return $decorator;
    }

    /**
     * @param AbstractDecorator $decorator
     * @param string $position
     * @param bool $name
     * @return $this
     */
    public function attachDecorator(
        AbstractDecorator $decorator,
        $position = 'element',
        $name = false
    ) {
        $decorator->setElement($this);
        $name = $name ? $name : $decorator->getName();
        $this->decorators[$position][$name] = $decorator;

        return $this;
    }

    /**
     * @param boolean $position
     * @return mixed
     */
    public function getDecoratorsByPosition($position)
    {
        return $this->decorators[$position];
    }

    /**
     * @param $name
     * @param bool $position
     * @return bool
     */
    public function getDecorator($name, $position = false)
    {
        if ($position) {
            return $this->decorators[$position][$name];
        } else {
            foreach ($this->decorators as $position => $decorators) {
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
            unset($this->decorators[$position][$name]);
        } else {
            foreach ($this->decorators as $position => $decorators) {
                if (isset($decorators[$name])) {
                    unset($decorators[$name]);

                    return $this;
                }
            }
        }

        return $this;
    }
}
