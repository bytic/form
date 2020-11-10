<?php

namespace Nip\Form;

use Nip\Form\Elements\AbstractElement as ElementAbstract;
use Nip\View;

/**
 * Class AbstractForm
 *
 */
abstract class AbstractForm implements FormInterface
{
    use Traits\DataProcessingTrait;
    use Traits\CanInitializeTrait;
    use Traits\HasAttributesTrait;
    use Traits\HasButtonsTrait;
    use Traits\HasCacheTrait;
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

    protected $controllerView = false;

    /**
     * AbstractForm constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $action
     * @return AbstractForm
     */
    public function setAction(string $action): AbstractForm
    {
        return $this->setAttrib('action', (string)$action);
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
