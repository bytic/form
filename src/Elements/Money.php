<?php

use ByTIC\Money\Money;

class Nip_Form_Element_Money extends Nip_Form_Element_Number
{
    protected $_type = 'money';

    public function init()
    {
        parent::init();
        $this->setOption('currency', '');
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        if ($value instanceof Money) {
            /** @var Money $value */
            $scale = $value::getCurrencies()->subunitFor($value->getCurrency());

            $step = pow(1 / 10, $scale);
            $this->setAttrib('step', $step);
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
        $return = parent::getValue($requester);
        if ($requester == 'model') {
            return Money::parseByDecimal($return, $this->getOption('currency'));
        }
        return $return;
    }
}
