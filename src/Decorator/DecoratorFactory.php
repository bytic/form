<?php

namespace Nip\Form\Decorator;

use Nip\Form\Decorator\Elements\AbstractDecorator;
use Nip\Form\Elements\AbstractElement;
use Nip\Form\Elements\Traits\HasDecoratorsTrait;

/**
 * Class DecoratorFactory
 * @package Nip\Form\Decorator
 */
class DecoratorFactory
{
    /**
     * @param AbstractElement|HasDecoratorsTrait $element
     * @param $type
     * @return AbstractDecorator
     */
    public static function createForElement($element, $type)
    {
        $decorator = static::create($type);
        $decorator->setElement($element);
        return $decorator;
    }

    /**
     * @param string $type
     * @return AbstractDecorator
     */
    public static function create($type)
    {
        $name = 'Nip_Form_Decorator_Elements_' . ucfirst($type);
        $decorator = new $name();
        return $decorator;
    }
}
