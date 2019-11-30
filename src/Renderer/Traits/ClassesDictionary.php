<?php

namespace Nip\Form\Renderer\Traits;

/**
 * Trait ClassesDictionary
 * @package Nip\Form\Renderer\Traits
 */
trait ClassesDictionary
{

    /**
     * @return string
     */
    public function classForElementHasError()
    {
        return 'is-invalid';
    }
}
