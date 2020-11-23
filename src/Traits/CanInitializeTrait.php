<?php

namespace Nip\Form\Traits;

/**
 * Trait CanInitializeTrait
 * @package Nip\Form\Traits
 */
trait CanInitializeTrait
{
    /**
     * Is the form prepared ?
     *
     * @var bool
     */
    protected $initialized = false;


    public function initializeIfNotInitialized()
    {
        if ($this->initialized !== false) {
            return;
        }

        if (method_exists($this, 'init')) {
            $this->init();
        } else {
            $this->initialize();
        }

        if (method_exists($this, 'postInit')) {
            $this->postInit();
        } else {
            $this->initialized();
        }

        $this->initialized = true;
    }

    /**
     * @deprecated use initialize()
     */
    public function init()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->initAction();
    }

    /**
     * @deprecated use initialize()
     */
    public function postInit()
    {
        $this->initialized();
    }

    protected function initialized()
    {
    }

    protected function initAction()
    {
        if (function_exists('current_url')) {
            $this->setAction(current_url());
        }
    }
}
