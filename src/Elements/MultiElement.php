<?php

use Nip\Form\Elements\AbstractElement;

/**
 * Class Nip_Form_Element_MultiElement
 */
class Nip_Form_Element_MultiElement extends AbstractElement
{
    protected $_type = 'multiElement';

    /**
     * @var AbstractElement[]
     */
    protected $elements = [];

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $return = parent::setName($name);
        $this->updateElementNames();
        return $return;
    }

    /**
     * @param AbstractElement $element
     * @return $this
     */
    public function addElement(AbstractElement $element)
    {
        $key = $element->getName();
        $this->elements[$key] = $element;

        $inputName = $this->getName();
        $element->setName($inputName . '[' . $key . ']');
        return $this;
    }

    protected function updateElementNames()
    {
        $inputName = $this->getName();
        $elements = $this->getElements();
        foreach ($elements as $key => $element) {
            $element->setName($inputName . '[' . $key . ']');
        }
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @param $request
     * @return $this
     */
    public function getDataFromRequest($request)
    {
        if (is_array($request)) {
            $elements = $this->getElements();
            foreach ($elements as $key => $element) {
                $value = isset($request[$key]) ? $request[$key] : null;
                if ($value !== null) {
                    $element->setValue($value);
                }
            }
        }
        return $this;
    }

    /**
     * @return Nip\Form\Elements\AbstractElement[]
     */
    public function getElements()
    {
        reset($this->elements);
        return $this->elements;
    }

    /**
     * @param $name
     * @return Nip\Form\Elements\AbstractElement
     * @throws \Nip\Logger\Exception
     */
    public function getElement($name)
    {
        if ($this->hasElement($name)) {
            return $this->elements[$name];
        }
        throw new \Nip\Logger\Exception("Invalid child element");
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasElement($name)
    {
        return isset($this->elements[$name]);
    }
}
