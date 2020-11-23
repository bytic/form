<?php

namespace Nip\Form;

/**
 * Interface FormInterface
 * @package Nip\Form
 */
interface FormInterface
{
    /**
     * Initializes the form tree.
     *
     * Should be called on the root form after constructing the tree.
     *
     * @return $this
     */
    public function initialize();
}
