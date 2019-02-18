<?php

namespace Nip\Form\Decorator\Elements;

/**
 * Class Text
 * @package Nip\Form\Decorator\Elements
 */
class Text extends AbstractDecorator
{
    protected $_content;

    public function setText($text)
    {
        $this->_content = $text;

        return $this;
    }

    public function generate()
    {
        return $this->_content;
    }
}
