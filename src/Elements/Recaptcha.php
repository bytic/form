<?php

declare(strict_types=1);

use ByTIC\GoogleRecaptcha\Utility\GoogleRecaptcha;

class Nip_Form_Element_Recaptcha extends Nip_Form_Element_Hidden
{
    protected $manager;

    public function __construct($form = null)
    {
        parent::__construct($form);
        $this->manager = GoogleRecaptcha::getManager();
        if ($this->manager->isEnabled()) {
            $this->setAttrib('data-sitekey', $this->manager->getSiteKey());
        }
    }

    public function getSiteKey()
    {
        return $this->getAttrib('data-sitekey');
    }

    public function init()
    {
        parent::init();
        $this->setName('g-recaptcha-response');
        $this->setLabel('Recaptcha');
        $this->setRequired(false);
        $this->setId('recaptchaResponse');
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
}
