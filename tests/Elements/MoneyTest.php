<?php

namespace Nip\Form\Tests\Elements;

use ByTIC\Money\Money;
use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;
use Nip_Form_Element_Money;

/**
 * Class DateinputTest
 * @package Nip\Form\Tests\Elements
 */
class MoneyTest extends AbstractTest
{
    public function test_setValue_with_Money()
    {
        $form = new Form();
        $form->setRendererType('Bootstrap4');

        $element = new Nip_Form_Element_Money($form);
        $value = Money::RON(223344);
        $element->setValue($value);
        $html = $form->getRenderer()->renderElement($element);

        self::assertSame(
            '<div class="input-group"><input  type="number" step="0.01" value="2233.44" class="form-control" title="" /><span class="input-group-text">RON</span></div>',
            $html
        );
    }
}
