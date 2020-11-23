<?php

namespace Nip\Form\Traits;

use Nip\Records\AbstractModels\Record;

/**
 * Trait HasModelTrait
 * @package Nip\Form\Traits
 */
trait HasModelTrait
{
    /**
     * @var Record
     */
    protected $model;

    public function initialized()
    {
        parent::initialized();
        $this->getDataFromModel();
    }

    /**
     * @param $name
     * @return $this
     */
    public function addModelError($name)
    {
        return $this->addError($this->getModelMessage($name));
    }

    /**
     * @param $name
     * @param array $variables
     * @return mixed
     */
    public function getModelMessage($name, $variables = [])
    {
        return $this->getModelManager()->getMessage('form.' . $name, $variables);
    }

    /**
     * @return Record
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Record $model
     * @return $this
     */
    public function setModel(Record $model)
    {
        $this->model = $model;
        return $this;
    }

    protected function getDataFromModel()
    {
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                if (isset($this->getModel()->{$name})) {
                    $element->getData($this->getModel()->{$name}, 'model');
                }
            }
        }
    }

    /**
     * @param $input
     * @param $name
     * @param array $variables
     * @return $this
     */
    public function addInputModelError($input, $name, $variables = [])
    {
        return $this->getElement($input)->addError($this->getModelMessage($name, $variables));
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getModelLabel($name)
    {
        return $this->getModelManager()->getLabel($name);
    }

    /**
     * @return \Nip\Records\RecordManager
     */
    public function getModelManager()
    {
        return $this->getModel()->getManager();
    }

    public function process()
    {
        $this->saveToModel();
        $this->saveModel();
    }

    public function saveToModel()
    {
        $elements = $this->getElements();
        if (!is_array($elements)) {
            return;
        }
        foreach ($elements as $name => $element) {
            if ($element instanceof \Nip_Form_Element_File) {
                continue;
            }
            $this->getModel()->{$name} = $element->getValue('model');
        }
    }

    public function saveModel()
    {
        $this->getModel()->save();
    }

    protected function _addModelFormMessage($form, $model)
    {
        $this->_messageTemplates[$form] = $this->getModelMessage($model);

        return $this;
    }
}
