<?php

namespace Nip\Form\Decorator\Elements\Traits;

/**
 * Trait HasSeparatorTrait
 * @package Nip\Form\Decorator\Elements\Traits
 */
trait HasSeparatorTrait
{
    /**
     * Separator between new content and old
     * @var string
     */
    protected $separator = PHP_EOL;

    /**
     * @param $separator
     * @return $this
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }
}
