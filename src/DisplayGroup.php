<?php

use Nip\Collections\Collection;
use Nip\Form\AbstractForm;
use Nip\Form\Elements\AbstractElement;

/**
 * Class Nip_Form_DisplayGroup
 */
class Nip_Form_DisplayGroup extends Collection
{
    use \Nip\Form\Utility\HasAttributesTrait;

    /**
     * @var Nip_Form
     */
    protected $_form;

    protected $renderer;

    /**
     * @return Nip_Form|null
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param  AbstractForm $form
     * @return Nip_Form_DisplayGroup
     */
    public function setForm(AbstractForm $form)
    {
        $this->_form = $form;

        return $this;
    }

    /**
     * @param AbstractElement $element
     * @return $this
     */
    public function addElement(AbstractElement $element)
    {
        $this[$element->getUniqueId()] = $element;

        return $this;
    }

    /**
     * @param string $legend
     * @return Nip_Form_DisplayGroup
     */
    public function setLegend($legend)
    {
        return $this->setAttrib('legend', (string)$legend);
    }

    /**
     * @return mixed|null
     */
    public function getLegend()
    {
        return $this->getAttrib('legend');
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->getRenderer()->render();
    }

    /**
     * @return Nip_Form_Renderer_DisplayGroup
     */
    public function getRenderer()
    {
        if (!$this->renderer) {
            $this->renderer = $this->getNewRenderer();
        }

        return $this->renderer;
    }

    /**
     * @param string $type
     * @return Nip_Form_Renderer_DisplayGroup
     */
    public function getNewRenderer($type = 'basic')
    {
        $name = 'Nip_Form_Renderer_DisplayGroup';
        /** @var Nip_Form_Renderer_DisplayGroup $renderer */
        $renderer = new $name();
        $renderer->setGroup($this);

        return $renderer;
    }
}
