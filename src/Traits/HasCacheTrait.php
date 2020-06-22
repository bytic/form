<?php

namespace Nip\Form\Traits;

/**
 * Trait HasCacheTrait
 * @package Nip\Form\Traits
 */
trait HasCacheTrait
{
    protected $_cache;

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getCache($key, $default = null)
    {
        if (!isset($this->_cache[$key])) {
            return $default;
        }
        return $this->_cache[$key];
    }

    /**
     * @param string $key
     * @param $value
     */
    public function setCache($key, $value)
    {
        $this->_cache[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isCache($key)
    {
        return isset($this->_cache[$key]);
    }
}
