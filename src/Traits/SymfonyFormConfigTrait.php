<?php

namespace Nip\Form\Traits;

/**
 * Trait SymfonyFormConfigTrait
 * 
 * Provides Symfony FormConfigInterface-compatible methods
 * 
 * @package Nip\Form\Traits
 */
trait SymfonyFormConfigTrait
{
    protected $formConfig = [];
    protected $formType = null;
    protected $formDataClass = null;

    /**
     * Returns the form's configuration.
     *
     * @return FormConfigInterface|$this The configuration
     */
    public function getConfig()
    {
        return $this;
    }

    /**
     * Returns the form type used to construct the form.
     *
     * @return mixed The form's type
     */
    public function getType()
    {
        return $this->formType;
    }

    /**
     * Sets the form type.
     *
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->formType = $type;

        return $this;
    }

    /**
     * Returns the class of the view data or null if the data is scalar or an array.
     *
     * @return string|null The data class or null
     */
    public function getDataClass()
    {
        return $this->formDataClass;
    }

    /**
     * Sets the data class.
     *
     * @param string|null $dataClass
     * @return $this
     */
    public function setDataClass($dataClass)
    {
        $this->formDataClass = $dataClass;

        return $this;
    }

    /**
     * Returns all options passed during the construction of the form.
     *
     * @return array The passed options
     */
    public function getOptions()
    {
        return $this->_options ?? [];
    }

    /**
     * Returns whether a specific option exists.
     *
     * @param string $name The option name
     *
     * @return bool Whether the option exists
     */
    public function hasOption($name)
    {
        $options = $this->_options ?? [];
        return array_key_exists($name, $options);
    }
}
