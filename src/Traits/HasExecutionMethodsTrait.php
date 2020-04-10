<?php

namespace Nip\Form\Traits;

/**
 * Trait HasExecutionMethodsTrait
 * @package Nip\Form\Traits
 */
trait HasExecutionMethodsTrait
{

    /**
     * @return bool
     */
    public function execute()
    {
        if ($this->submited()) {
            return $this->processRequest();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function submited()
    {
        $request = $this->getAttrib('method') == 'post' ? $_POST : $_GET;
        if (count($request)) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function processRequest()
    {
        if ($this->validate()) {
            $this->process();

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $request = $this->getAttrib('method') == 'post' ? $_POST : $_GET;
        $this->getDataFromRequest($request);
        $this->processValidation();

        return $this->isValid();
    }

    public function processValidation()
    {
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                $element->validate();
            }
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return count($this->getErrors()) > 0 ? false : true;
    }

    public function process()
    {
    }
}
