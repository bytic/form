<?php

class Nip_Form_Element_Money extends Nip_Form_Element_Input
{
    protected $_type = 'money';

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'number');
        $this->setOption('currency', '');
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        if (is_object($value)) {
            /** @var \ByTIC\Money\Money $value */
            $this->setOption('currency', $value->getCurrency());
            $value = $value->formatByDecimal();
        }
        return parent::setValue($value);
    }

    /**
     * @inheritDoc
     */
    public function getValue($requester = 'abstract')
    {
        return parent::getValue($requester);
    }
}
