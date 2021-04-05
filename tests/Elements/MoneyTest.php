<?php

namespace Nip\Form\Tests\Elements;

use ByTIC\Money\Money;
use Nip\Form\Tests\AbstractTest;

/**
 * Class DateinputTest
 * @package Nip\Form\Tests\Elements
 */
class MoneyTest extends AbstractTest
{
    public function test_setValue_with_Money()
    {
        $form = new \Nip\Form\Form();
        $form->setRendererType('Bootstrap4');

        $element = new \Nip_Form_Element_Money($form);
        $value = Money::RON(223344);
        $element->setValue($value);
        $html = $form->getRenderer()->renderElement($element);

        self::assertSame(
            '<div class="input-group"><input  type="number" value="2233.44" class="form-control " title="" /><span class="input-group-text">RON</span></div>',
            $html
        );
    }
}
