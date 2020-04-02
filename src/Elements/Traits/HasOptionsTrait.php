<?php

namespace Nip\Form\Elements\Traits;

/**
 * Trait HasOptionsTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasOptionsTrait
{
    protected $_options;

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->_options = $options;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        $key = (string)$key;
        $this->_options[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasOption($key)
    {
        $key = (string)$key;

        return isset($this->_options[$key]);
    }

    /**
     * @param string $key
     * @param null $default
     * @return null
     */
    public function getOption($key, $default = null)
    {
        $key = (string)$key;
        if (!$this->hasOption($key)) {
            return $default;
        }

        return $this->_options[$key];
    }
}
