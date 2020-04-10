<?php

namespace Nip\Form\Renderer\Traits;

use Nip\Form\AbstractForm;
use Nip\Form\Traits\HasRendererTrait;

/**
 * Trait HasFormTrait
 * @package Nip\Form\Renderer\Traits
 */
trait HasFormTrait
{
    protected $form;

    /**
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param AbstractForm|HasRendererTrait $form
     * @return $this
     */
    public function setForm(AbstractForm $form)
    {
        $this->form = $form;

        return $this;
    }
}
