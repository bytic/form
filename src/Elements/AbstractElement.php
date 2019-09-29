<?php

namespace Nip\Form\Elements;

use Nip\Form\AbstractForm;
use Nip\Form\Elements\Traits\HasAttributesTrait;
use Nip\Form\Elements\Traits\HasDecoratorsTrait;
use Nip\Form\Elements\Traits\HasOptionsTrait;
use Nip\Form\Elements\Traits\HasRendererTrait;
use Nip\Form\Elements\Traits\HasTypeTrait;
use Nip\Form\Elements\Traits\HasUniqueIdTrait;

/**
 * Class AbstractElement
 * @package Nip\Form\Elements
 */
abstract class AbstractElement implements ElementInterface
{
    use HasUniqueIdTrait;
    use HasAttributesTrait;
    use HasOptionsTrait;
    use HasDecoratorsTrait;
    use HasRendererTrait;
    use HasTypeTrait;

    protected $_form;

    protected $_isRequired;
    protected $_errors = [];
    protected $_policies;

    /**
     * AbstractElement constructor.
     * @param null $form
     */
    public function __construct($form = null)
    {
        if ($form) {
            $this->setForm($form);
        }
        $this->init();
    }

    public function init()
    {
    }


    /**
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param AbstractForm $form
     * @return $this
     */
    public function setForm(AbstractForm $form)
    {
        $this->_form = $form;

        return $this;
    }

    /**
     * @param $data
     * @param string $source
     * @return Nip_Form_Element_Abstract
     */
    public function getData($data, $source = 'abstract')
    {
        if ($source == 'model') {
            return $this->getDataFromModel($data);
        }

        return $this->getDataFromRequest($data);
    }

    /**
     * @param $data
     * @return $this
     */
    public function getDataFromModel($data)
    {
        $this->setValue($data);

        return $this;
    }

    /**
     * @param $request
     * @return $this
     */
    public function getDataFromRequest($request)
    {
        $request = clean($request);
        $this->setValue($request);

        return $this;
    }

    /**
     * @param boolean $isRequired
     * @return $this
     */
    public function setRequired($isRequired)
    {
        $this->_isRequired = (bool)$isRequired;

        return $this;
    }

    public function validate()
    {
        if ($this->isRequired() && !$this->getValue()) {
            $message = $this->getForm()->getMessageTemplate('no-'.$this->getName());
            if (!$message) {
                $translateSlug = 'general.form.errors.required';
                $message = app('translator')->translate($translateSlug, ['label' => $this->getLabel()]);
                if ($message == $translateSlug) {
                    $message = $message ? $message : 'The field `'.$this->getLabel().'` is mandatory.';
                }
            }
            $this->addError($message);
        }
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return (bool)$this->_isRequired;
    }

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

    /**
     * @return bool
     */
    public function isGroup()
    {
        return false;
    }
}
