<?php

namespace Nip\Form\Elements\Traits;

/**
 * Trait HasUniqueIdTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasUniqueIdTrait
{
    /**
     * @var null|string
     */
    protected $_uniqueID = null;

    /**
     * @return string
     */
    public function getJSID()
    {
        $name = $this->getUniqueId();

        return str_replace(['][', '[', ']'], ['-', '-', ''], $name);
    }

    /**
     * @return null|string
     */
    public function getUniqueId()
    {
        if (!$this->_uniqueID) {
            $this->initUniqueId();
        }

        return $this->_uniqueID;
    }

    /**
     * @param null|string $uniqueID
     */
    public function setUniqueID($uniqueID)
    {
        $this->_uniqueID = $uniqueID;
    }

    protected function initUniqueId()
    {
        $this->setUniqueID($this->generateUniqueId());
    }

    /**
     * @return null|string
     */
    protected function generateUniqueId()
    {
        $name = $this->getName();
        $registeredNames = (array)$this->getForm()->getCache('elements_names');
        if (in_array($name, $registeredNames)) {
            $name = uniqid($name);
        }
        $registeredNames[] = $name;
        $this->getForm()->setCache('elements_names', $registeredNames);

        return $name;
    }
}
