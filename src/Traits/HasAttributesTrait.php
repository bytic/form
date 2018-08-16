<?php

namespace Nip\Form\Traits;

/**
 * Trait HasAttributesTrait
 * @package Nip\Form\Traits
 */
trait HasAttributesTrait
{
    protected $_attribs = [];


    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setAttrib($key, $value)
    {
        $key = (string)$key;
        $this->_attribs[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getAttrib($key)
    {
        $key = (string)$key;
        if (!isset($this->_attribs[$key])) {
            return null;
        }

        return $this->_attribs[$key];
    }

    /**
     * @return array
     */
    public function getAttribs()
    {
        return $this->_attribs;
    }

    /**
     * @param  array $attribs
     * @return $this
     */
    public function setAttribs(array $attribs)
    {
        $this->clearAttribs();

        return $this->addAttribs($attribs);
    }

    /**
     * @return $this
     */
    public function clearAttribs()
    {
        $this->_attribs = [];

        return $this;
    }

    /**
     * @param  array $attribs
     * @return $this
     */
    public function addAttribs(array $attribs)
    {
        foreach ($attribs as $key => $value) {
            $this->setAttrib($key, $value);
        }

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function removeAttrib($key)
    {
        if (isset($this->_attribs[$key])) {
            unset($this->_attribs[$key]);

            return true;
        }

        return false;
    }
}
