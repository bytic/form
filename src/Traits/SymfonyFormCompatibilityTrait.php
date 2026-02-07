<?php

namespace Nip\Form\Traits;

use Nip\Form\Elements\AbstractElement;

/**
 * Trait SymfonyFormCompatibilityTrait
 * 
 * Provides Symfony FormInterface-compatible methods for backward compatibility
 * while maintaining the existing API.
 * 
 * @package Nip\Form\Traits
 */
trait SymfonyFormCompatibilityTrait
{
    protected $submitted = false;
    protected $synchronized = true;
    protected $formData = null;
    protected $formParent = null;

    /**
     * Returns all children in the form.
     *
     * @return array An array of FormInterface instances
     */
    public function all()
    {
        return $this->getElements();
    }

    /**
     * Returns whether the form has a child with the given name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return $this->hasElement($name);
    }

    /**
     * Returns the child with the given name.
     *
     * @param string $name
     *
     * @return FormInterface|AbstractElement
     */
    public function get($name)
    {
        return $this->getElement($name);
    }

    /**
     * Removes the child with the given name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function remove($name)
    {
        return $this->removeElement($name);
    }

    /**
     * Returns whether the form is the root of the form tree.
     *
     * @return bool
     */
    public function isRoot()
    {
        return null === $this->formParent;
    }

    /**
     * Returns the parent form.
     *
     * @return FormInterface|null
     */
    public function getParent()
    {
        return $this->formParent;
    }

    /**
     * Returns the root of the form tree.
     *
     * @return FormInterface The root of the tree
     */
    public function getRoot()
    {
        return $this->formParent ? $this->formParent->getRoot() : $this;
    }

    /**
     * Sets the parent form.
     *
     * @param FormInterface|null $parent
     *
     * @return $this
     */
    public function setParent($parent = null)
    {
        $this->formParent = $parent;

        return $this;
    }

    /**
     * Returns the data in the format needed for the underlying object.
     *
     * @return mixed When the field is not submitted, the default data is returned.
     *               When the field is submitted, the submitted data is returned.
     */
    public function getData()
    {
        if (method_exists($this, 'getFormData')) {
            return $this->getFormData();
        }

        return $this->formData;
    }

    /**
     * Sets the data of the field.
     *
     * @param mixed $modelData
     *
     * @return $this
     */
    public function setData($modelData)
    {
        $this->formData = $modelData;

        // Populate form elements with data if it's an array or object
        if (is_array($modelData) || is_object($modelData)) {
            foreach ($this->getElements() as $name => $element) {
                if (is_array($modelData) && isset($modelData[$name])) {
                    $element->setValue($modelData[$name]);
                } elseif (is_object($modelData)) {
                    $getter = 'get' . ucfirst($name);
                    if (method_exists($modelData, $getter)) {
                        $element->setValue($modelData->$getter());
                    } elseif (property_exists($modelData, $name)) {
                        $element->setValue($modelData->$name);
                    }
                }
            }
        }

        return $this;
    }

    /**
     * Returns the normalized data of the field.
     *
     * @return mixed When the field is not submitted, the default data is returned.
     *               When the field is submitted, the normalized submitted data is returned.
     */
    public function getNormData()
    {
        return $this->getData();
    }

    /**
     * Returns the data transformed by the value transformer.
     *
     * @return mixed
     */
    public function getViewData()
    {
        return $this->getData();
    }

    /**
     * Submits data to the form, transforms and validates it.
     *
     * @param mixed $submittedData The submitted data
     * @param bool $clearMissing Whether to set fields to NULL when they are missing in the submitted data
     *
     * @return $this
     */
    public function submit($submittedData, $clearMissing = true)
    {
        $this->submitted = true;

        if (is_array($submittedData)) {
            foreach ($this->getElements() as $name => $element) {
                if (isset($submittedData[$name])) {
                    $element->setValue($submittedData[$name]);
                } elseif ($clearMissing) {
                    $element->setValue(null);
                }
            }
            $this->formData = $submittedData;
        }

        return $this;
    }

    /**
     * Returns whether the form is submitted.
     *
     * @return bool
     */
    public function isSubmitted()
    {
        return $this->submitted;
    }

    /**
     * Returns whether the data in the property path of the form was modified.
     *
     * @return bool
     */
    public function isSynchronized()
    {
        return $this->synchronized;
    }

    /**
     * Returns whether the form is valid.
     *
     * @return bool
     */
    public function isValid()
    {
        if (!$this->isSubmitted()) {
            return false;
        }

        // Check if there are any errors
        if (method_exists($this, 'hasErrors')) {
            return !$this->hasErrors();
        }

        return true;
    }
}
