<?php

namespace Nip\Form\Elements\Traits;

/**
 * Trait HasTypeTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasTypeTrait
{
    protected $typeName = null;

    /**
     * @return string
     */
    public function getType()
    {
        if ($this->typeName === null) {
            $this->initType();
        }

        return $this->typeName;
    }

    /**
     * @param $type
     */
    protected function setType($type)
    {
        $this->typeName = $type;
    }

    protected function initType()
    {
        $this->setType($this->generateTypeChecks());
    }

    /**
     * @return mixed
     */
    protected function generateTypeChecks()
    {
        if (property_exists($this, '_type')) {
            return $this->_type;
        }
        if (method_exists($this, 'generateType')) {
            return $this->generateType();
        }
        return false;
    }
}
