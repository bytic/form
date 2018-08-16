<?php

namespace Nip\Form\Traits;

/**
 * Trait HasErorsTrait
 * @package Nip\Form\Traits
 */
trait HasErrorsTrait
{
    protected $errorsByField = null;

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = array_merge((array)$this->getMessagesType('error'), $this->getElementsErrors());

        return $errors;
    }

    /**
     * @return array
     */
    public function getElementsErrors()
    {
        $elementsErrors = $this->getErrorsByField();
        $errors = [];
        foreach ($elementsErrors as $name => $elementErrors) {
            $errors = array_merge($errors, $elementErrors);
        }

        return $errors;
    }

    /**
     * @param $message
     * @return $this
     */
    public function addError($message)
    {
        $this->addMessage($message, 'error');

        return $this;
    }

    /**
     * @return array
     */
    public function getErrorsByField(): array
    {
        if ($this->errorsByField === null) {
            $this->generateElementsErrors();
        }

        return $this->errorsByField;
    }

    protected function generateElementsErrors()
    {
        $elements = $this->getElements();
        $this->errorsByField = [];
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                $elementErrors = $element->getErrors();
                if (count($elementErrors)) {
                    $this->errorsByField[$name] = $elementErrors;
                }
            }
        }
    }
}
