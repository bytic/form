<?php

namespace Nip\Form\Adapter;

use Nip\Form\AbstractForm;
use Nip\Form\Elements\AbstractElement;

/**
 * Class SymfonyFormBuilderAdapter
 * 
 * Provides a Symfony FormBuilderInterface-compatible adapter for AbstractForm
 * This allows using AbstractForm with Symfony's form builder pattern.
 * 
 * @package Nip\Form\Adapter
 */
class SymfonyFormBuilderAdapter
{
    protected $form;

    /**
     * SymfonyFormBuilderAdapter constructor.
     *
     * @param AbstractForm $form
     */
    public function __construct(AbstractForm $form)
    {
        $this->form = $form;
    }

    /**
     * Adds a new field to this group.
     *
     * Uses Symfony-style calling convention: add($name, $type, $options)
     *
     * @param string $child The field name
     * @param string|null $type The field type (defaults to 'input')
     * @param array $options The field options
     *
     * @return $this
     */
    public function add($child, $type = null, array $options = [])
    {
        // Call the form's add method with Symfony-style parameters
        // The form's add() method will detect this is Symfony-style
        // because the 3rd parameter is an array
        $this->form->add($child, $type, $options);

        return $this;
    }

    /**
     * Creates a form builder.
     *
     * @param string $name The name of the form or the name of the property
     * @param string|null $type The type of the form or null if name is a property
     * @param array $options The options
     *
     * @return SymfonyFormBuilderAdapter A form builder
     */
    public function create($name, $type = null, array $options = [])
    {
        // Create a new builder for a nested form
        $nestedForm = new \Nip\Form\Form();
        if (method_exists($this->form, 'add')) {
            $this->form->add($name, $type, $options);
        }
        
        return new self($nestedForm);
    }

    /**
     * Returns a child by name.
     *
     * @param string $name The name of the child
     *
     * @return SymfonyFormBuilderAdapter|AbstractElement The child builder
     */
    public function get($name)
    {
        $element = $this->form->get($name);
        
        if ($element instanceof AbstractForm) {
            return new self($element);
        }
        
        return $element;
    }

    /**
     * Removes the field with the given name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function remove($name)
    {
        $this->form->remove($name);

        return $this;
    }

    /**
     * Returns whether a field with the given name exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return $this->form->has($name);
    }

    /**
     * Returns the children.
     *
     * @return array
     */
    public function all()
    {
        return $this->form->all();
    }

    /**
     * Creates the form.
     *
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Returns the form config.
     *
     * @return AbstractForm
     */
    public function getFormConfig()
    {
        return $this->form->getConfig();
    }
}
