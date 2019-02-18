<?php

namespace Nip\Form\Decorator\Elements;

use Nip\Form\Decorator\Elements\Traits\HasElementTrait;
use Nip\Form\Decorator\Elements\Traits\HasSeparatorTrait;

/**
 * Class AbstractDecorator
 * @package Nip\Form\Decorator\Elements
 */
abstract class AbstractDecorator
{
    use HasElementTrait;
    use HasSeparatorTrait;

    const APPEND = 'APPEND';
    const PREPEND = 'PREPEND';

    protected $_name;

    protected $_placement = 'APPEND';

    public function getName()
    {
        if (!$this->_name) {
            $class = get_class($this);
            $class = str_replace('Nip_Form_Decorator_Elements_', '', $class);
            $this->_name = $class;
        }

        return $this->_name;
    }


    /**
     * @param $content
     * @return string
     */
    public function render($content)
    {
        $decorator = $this->generate();
        switch ($this->_placement) {
            case self::PREPEND:
                return $decorator.$this->getSeparator().$content;
            case self::APPEND:
            default:
                return $content.$this->getSeparator().$decorator;
        }
    }

    abstract public function generate();
}
