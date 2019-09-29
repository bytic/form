<?php

namespace Nip\Form;

use Nip\Form\Renderer\AbstractRenderer;
use Nip\Form\Traits\HasAttributesTrait;
use Nip\Form\Traits\HasClassTrait;
use Nip\Form\Traits\HasDisplayGroupsTrait;
use Nip\Form\Traits\HasElementsTrait;
use Nip\Form\Traits\HasErrorsTrait;
use Nip\Form\Traits\MagicMethodElementsFormTrait;
use Nip\Form\Traits\MessagesTrait;
use Nip\Form\Traits\NewElementsMethods;
use Nip\View;
use Nip_Form_Button_Abstract as ButtonAbstract;
use Nip_Form_Element_Abstract as ElementAbstract;

/**
 * Class AbstractForm
 *
 */
abstract class AbstractForm
{
    use MagicMethodElementsFormTrait;
    use HasElementsTrait;
    use NewElementsMethods;
    use HasDisplayGroupsTrait;
    use MessagesTrait;
    use HasErrorsTrait;
    use HasAttributesTrait;
    use HasClassTrait;

    const ENCTYPE_URLENCODED = 'application/x-www-form-urlencoded';
    const ENCTYPE_MULTIPART = 'multipart/form-data';

    /**
     * @var array
     */
    protected $methods = ['delete', 'get', 'post', 'put'];

    protected $_options = [];
    protected $_buttons;

    protected $_decorators = [];
    protected $_renderer;
    protected $_cache;

    protected $controllerView = false;

    /**
     * AbstractForm constructor.
     */
    public function __construct()
    {
        $this->init();
        $this->postInit();
    }

    public function init()
    {
        $this->initAction();
    }

    protected function initAction()
    {
        if (function_exists('current_url')) {
            $this->setAction(current_url());
        }
    }

    /**
     * @param string $action
     * @return AbstractForm
     */
    public function setAction($action)
    {
        return $this->setAttrib('action', (string)$action);
    }

    public function postInit()
    {
    }

    /**
     * @param $name
     * @return ElementAbstract|null
     */
    public function __get($name)
    {
        $element = $this->getElement($name);
        if ($element) {
            return $element;
        }

        return null;
    }

    /**
     * @param $name
     * @param bool $label
     * @param string $type
     * @return $this
     */
    public function addButton($name, $label = false, $type = 'button')
    {
        $this->_buttons[$name] = $this->newButton($name, $label, $type);

        return $this;
    }

    /**
     * @param $name
     * @param bool $label
     * @param string $type
     * @return ButtonAbstract
     */
    protected function newButton($name, $label = false, $type = 'button')
    {
        $class = 'Nip_Form_Button_'.ucfirst($type);
        /** @var ButtonAbstract $button */
        $button = new $class($this);
        $button->setName($name)
            ->setLabel($label);

        return $button;
    }

    /**
     * @param $name
     * @return ElementAbstract
     */
    public function getButton($name)
    {
        if (array_key_exists($name, $this->_buttons)) {
            return $this->_buttons[$name];
        }

        return null;
    }


    /**
     * @return ButtonAbstract[]
     */
    public function getButtons()
    {
        return $this->_buttons;
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
     * @return mixed|null
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
     * @param $method
     * @return AbstractForm
     */
    public function setMethod($method)
    {
        if (in_array($method, $this->methods)) {
            return $this->setAttrib('method', $method);
        }
        trigger_error('Method is not valid', E_USER_ERROR);

        return null;
    }

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

    /**
     * @param $request
     */
    protected function getDataFromRequest($request)
    {
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                if ($element->isGroup() && $element->isRequestArray()) {
                    $name = str_replace('[]', '', $name);
                    $data = is_array($request[$name]) ? $request[$name] : [$request[$name]];
                    $element->getData($data, 'request');
                } else {
                    $value = $request[$name];
                    if (strpos($name, '[') && strpos($name, ']')) {
                        $arrayPrimary = substr($name, 0, strpos($name, '['));
                        $arrayKeys = str_replace($arrayPrimary, '', $name);

                        preg_match_all('/\[([^\]]*)\]/', $arrayKeys, $arr_matches, PREG_PATTERN_ORDER);
                        $value = $request[$arrayPrimary];
                        foreach ($arr_matches[1] as $dimension) {
                            $value = $value[$dimension];
                        }
                    }
                    $element->getData($value, 'request');
                }
            }
        }
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


    /**
     * @param $type
     * @return $this
     */
    public function setRendererType(string $type)
    {
        $this->setRenderer($this->getNewRenderer($type));

        return $this;
    }

    /**
     * @param string $class
     */
    protected function setRendererClass(string $class)
    {
        /** @var AbstractRenderer $renderer */
        $renderer = new $class();
        $renderer->setForm($this);
        $this->setRenderer($renderer);
    }

    /**
     * @param AbstractRenderer $renderer
     */
    public function setRenderer(AbstractRenderer $renderer)
    {
        $this->_renderer = $renderer;
    }

    /**
     * @param string $type
     * @return AbstractRenderer
     */
    public function getNewRenderer($type = 'basic')
    {
        $name = 'Nip_Form_Renderer_'.ucfirst($type);
        /** @var AbstractRenderer $renderer */
        $renderer = new $name();
        $renderer->setForm($this);

        return $renderer;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getCache($key)
    {
        return $this->_cache[$key];
    }

    /**
     * @param string $key
     * @param $value
     */
    public function setCache($key, $value)
    {
        $this->_cache[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isCache($key)
    {
        return isset($this->_cache[$key]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return get_class($this);
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        $backtrace = debug_backtrace();
        if ($backtrace[1]['class'] == 'Monolog\Formatter\NormalizerFormatter') {
            return null;
        }
        trigger_error('form __toString', E_USER_WARNING);

        return $this->render();
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->getRenderer()->render();
    }

    /**
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        if (!$this->_renderer) {
            $this->_renderer = $this->getNewRenderer();
        }

        return $this->_renderer;
    }

    /**
     * @return View|null
     */
    public function getControllerView()
    {
        if (!$this->controllerView) {
            $this->controllerView = app('kernel')->getDispatcher()->getCurrentController()->getView();
        }

        return $this->controllerView;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $data = [];
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                $data[$name] = $element->getValue();
            }
        }

        return $data;
    }
}
