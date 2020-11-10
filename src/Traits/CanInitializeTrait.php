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

    /**
     * @deprecated use initialize()
     */
    public function init()
    {
        return $this->initialize();
    }

    /**
     * @return $this
     */
    public function initialize()
    {
        if ($this->initialized()) {
            return $this;
        }

        $this->initAction();
        $this->postInit();
        $this->initialized(true);
        return $this;
    }

    /**
     * @param null $initialized
     * @return bool
     */
    protected function initialized($initialized = null): bool
    {
        if (is_bool($initialized)) {
            $this->initialized = $initialized;
        }
        return $this->initialized;
    }

    protected function initAction()
    {
        if (function_exists('current_url')) {
            $this->setAction(current_url());
        }
    }

    public function postInit()
    {
    }
}