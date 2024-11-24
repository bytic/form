<?php

namespace Nip\Form\Elements\Traits;

/**
 * Trait HasErrorsTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasErrorsTrait
{
    protected $_errors = [];

    /**
     * @param $message
     * @return $this
     */
    public function addError($message, $key = null)
    {
        if ($key) {
            $this->_errors[$key] = $message;
        } else {
            $this->_errors[] = $message;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->_errors;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getErrorByKey($key)
    {
        return $this->_errors[$key] ?? null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasErrorByKey($key): bool
    {
        return isset($this->_errors[$key]);
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return count($this->_errors) > 0;
    }

    public function setErrors(array $errors): self
    {
        $this->_errors = $errors;
        return $this;
    }
}
