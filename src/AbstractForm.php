<?php

namespace Nip\Form;

use Nip\Form\Elements\AbstractElement as ElementAbstract;
use Nip\View;

/**
 * Class AbstractForm
 *
 */
abstract class AbstractForm
{
    use Traits\DataProcessingTrait;
    use Traits\HasAttributesTrait;
    use Traits\HasButtonsTrait;
    use Traits\HasClassTrait;
    use Traits\HasDisplayGroupsTrait;
    use Traits\HasElementsTrait;
    use Traits\HasErrorsTrait;
    use Traits\HasExecutionMethodsTrait;
    use Traits\HasRendererTrait;
    use Traits\MagicMethodElementsFormTrait;
    use Traits\MessagesTrait;
    use Traits\NewElementsMethods;

    const ENCTYPE_URLENCODED = 'application/x-www-form-urlencoded';
    const ENCTYPE_MULTIPART = 'multipart/form-data';

    /**
     * @var array
     */
    protected $methods = ['delete', 'get', 'post', 'put'];

    protected $_options = [];

    protected $_decorators = [];
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
     * @return View|null
     */
    public function getControllerView()
    {
        if (!$this->controllerView) {
            $this->controllerView = app('kernel')->getDispatcher()->getCurrentController()->getView();
        }

        return $this->controllerView;
    }
}
