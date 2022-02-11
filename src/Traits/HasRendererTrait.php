<?php

declare(strict_types=1);

namespace Nip\Form\Traits;

use Nip\Form\Renderer\AbstractRenderer;

/**
 * Trait HasRendererTrait
 * @package Nip\Form\Traits
 */
trait HasRendererTrait
{
    protected $_renderer;

    /**
     * @param $type
     * @return $this
     */
    public function setRendererType(string $type)
    {
        $this->setRenderer($this->getNewRenderer($type));

        return $this;
    }

    /**
     * @param string $class
     */
    protected function setRendererClass(string $class)
    {
        /** @var AbstractRenderer $renderer */
        $renderer = new $class();
        $renderer->setForm($this);
        $this->setRenderer($renderer);
    }

    /**
     * @param AbstractRenderer $renderer
     */
    public function setRenderer(AbstractRenderer $renderer)
    {
        $this->_renderer = $renderer;
    }

    /**
     * @param string $type
     * @return AbstractRenderer
     */
    public function getNewRenderer($type = 'basic')
    {
        $name = 'Nip_Form_Renderer_' . ucfirst($type);
        /** @var AbstractRenderer $renderer */
        $renderer = new $name();
        $renderer->setForm($this);

        return $renderer;
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        $backtrace = debug_backtrace();
        if ($backtrace[1]['class'] == 'Monolog\Formatter\NormalizerFormatter') {
            return null;
        }
        trigger_error('form __toString', E_USER_WARNING);

        return $this->render();
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->initializeIfNotInitialized();
        return $this->getRenderer()->render();
    }

    /**
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        if (!$this->_renderer) {
            $this->initializeIfNotInitialized();
            $this->_renderer = $this->getNewRenderer();
        }

        return $this->_renderer;
    }
}
