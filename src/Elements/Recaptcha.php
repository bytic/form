<?php

declare(strict_types=1);

use ByTIC\GoogleRecaptcha\Utility\GoogleRecaptcha;

class Nip_Form_Element_Recaptcha extends Nip_Form_Element_Input_Abstract
{
    protected $manager;
    protected $_type = 'recaptcha';
    public const FORM_NAME = 'g-recaptcha-response';

    public function __construct($form = null)
    {
        parent::__construct($form);

        $this->manager = GoogleRecaptcha::getManager();
        if ($this->manager->isEnabled()) {
            $this->setAttrib('data-sitekey', $this->manager->getSiteKey());
        }
    }

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'hidden');

        $this->setName(self::FORM_NAME);
        $this->setLabel('Recaptcha');
        $this->setRequired(false);
        $this->setId('recaptchaResponse');
    }

    public function getSiteKey()
    {
        return $this->getAttrib('data-sitekey');
    }

    public function validate()
    {
        parent::validate();
        $value = $this->getValue();
        $resp = $this->manager->verify($value);
        if (!$resp->isSuccess()) {
            $errors = $resp->getErrorCodes();
            $this->addError("Error validating recaptcha. Please try again!");
        }
    }

    public function getOption($key, $default = null)
    {
        if ($key === 'render_label') {
            return false;
        }
        return parent::getOption($key, $default = null);
    }
}
