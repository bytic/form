<?php

declare(strict_types=1);

namespace Nip\Form\Utility;

/**
 * Trait HasAttributesTrait
 * @package Nip\Form\Utility
 */
trait HasAttributesTrait
{
    protected $_attribs;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttrib('id');
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setAttrib('id', $id);

        return $this;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->getAttrib('name');
    }


    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setAttrib('name', $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->getAttrib('label');
    }

    /**
     * @param $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->setAttrib('label', $label);

        return $this;
    }

    /**
     * @param string $requester
     * @return null|mixed
     */
    public function getValue($requester = 'abstract')
    {
        return $this->getAttrib('value');
    }

    /**
     * @return bool
     */
    public function hasValue()
    {
        return !empty($this->getAttrib('value'));
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setValue($value)
    {
        $this->setAttrib('value', $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function addClass()
    {
        $classes = func_get_args();
        if (is_array($classes)) {
            $oldClasses = explode(' ', $this->getAttrib('class'));
            $classes = array_merge($classes, $oldClasses);
            $this->setAttrib('class', implode(' ', $classes));
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function removeClass()
    {
        $removeClasses = func_get_args();
        if (is_array($removeClasses)) {
            $classes = explode(' ', $this->getAttrib('class'));
            foreach ($removeClasses as $class) {
                $key = array_search($class, $classes);
                if ($key !== false) {
                    unset($classes[$key]);
                }
            }
            $this->setAttrib('class', implode(' ', $classes));
        }

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return static
     */
    public function setDataAttrib($key, $value)
    {
        $key = 'data-' . (string)$key;
        $this->_attribs[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return static
     */
    public function setAttrib($key, $value)
    {
        $key = (string)$key;
        $this->_attribs[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return null|mixed
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
     * @param string $key
     * @return bool
     */
    public function delAttrib($key)
    {
        $key = (string)$key;
        unset($this->_attribs[$key]);

        return true;
    }

    /**
     * @return mixed
     */
    public function getAttribs()
    {
        return $this->_attribs;
    }

    /**
     * @param array $attribs
     * @return static
     */
    public function setAttribs(array $attribs)
    {
        $this->clearAttribs();

        return $this->addAttribs($attribs);
    }

    /**
     * @return static
     */
    public function clearAttribs()
    {
        $this->_attribs = [];

        return $this;
    }

    /**
     * @param array $attribs
     * @return static
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
