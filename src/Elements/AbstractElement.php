<?php

namespace Nip\Form\Elements;

use Nip\Form\AbstractForm;
use Nip\Form\Elements\Traits\HasDecoratorsTrait;

/**
 * Class AbstractElement
 * @package Nip\Form\Elements
 */
abstract class AbstractElement implements ElementInterface
{
    use HasDecoratorsTrait;

    protected $_form;

    protected $_options;

    /**
     * @var null|string
     */
    protected $_uniqueID = null;

    protected $_isRequired;
    protected $_isRendered = false;
    protected $_errors = [];
    protected $_policies;

    protected $_type = 'abstract';

    public function __construct($form)
    {
        $this->setForm($form);
        $this->init();
    }

    public function init()
    {
    }


    /**
     * @return string
     */
    public function getJSID()
    {
        $name = $this->getUniqueId();

        return str_replace(['][', '[', ']'], ['-', '-', ''], $this->getUniqueId());
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

    /**
     * @param boolean $isRendered
     * @return $this
     */
    public function setRendered($isRendered)
    {
        $this->_isRendered = (bool)$isRendered;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRendered()
    {
        return (bool)$this->_isRendered;
    }

    public function validate()
    {
        if ($this->isRequired() && !$this->getValue()) {
            $message = $this->getForm()->getMessageTemplate('no-'.$this->getName());
            if (!$message) {
                $translateSlug = 'general.form.errors.required';
                $message = app('translator')->translate($translateSlug, array('label' => $this->getLabel()));
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

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        $key = (string)$key;
        $this->_options[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return null
     */
    public function getOption($key)
    {
        $key = (string)$key;
        if (!isset($this->_options[$key])) {
            return null;
        }

        return $this->_options[$key];
    }

    /**
     * @return bool
     */
    public function hasCustomRenderer()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->getRenderer()->render($this);
    }

    /**
     * @return mixed
     */
    public function getRenderer()
    {
        return $this->getForm()->getRenderer()->getElementRenderer($this);
    }

    /**
     * @return mixed
     */
    public function renderElement()
    {
        return $this->getRenderer()->renderElement($this);
    }

    /**
     * @return mixed
     */
    public function renderErrors()
    {
        return $this->getRenderer()->renderErrors($this);
    }
}
