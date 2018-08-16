<?php

namespace Nip\Form\Traits;

/**
 * Trait MessagesTrait
 * @package Nip\Form\Traits
 */
trait MessagesTrait
{
    protected $_messages = [
        'error' => [],
    ];

    protected $_messageTemplates = [];


    /**
     * @param string $type
     * @return mixed
     */
    public function getMessagesType($type = 'error')
    {
        return $this->_messages[$type];
    }

    /**
     * @param $message
     * @param string $type
     * @return $this
     */
    public function addMessage($message, $type = 'error')
    {
        $this->_messages[$type][] = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $messages = $this->_messages;
        $messages['error'] = $this->getErrors();

        return $messages;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getMessageTemplate($name)
    {
        return isset($this->_messageTemplates[$name]) ? $this->_messageTemplates[$name] : null;
    }
}
