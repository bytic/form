<?php

namespace Nip\Form\Elements\Traits;

use Nip\Form\Elements\AbstractElement;

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
    public function addError($message)
    {
        $this->_errors[] = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return count($this->_errors) > 0;
    }
}
