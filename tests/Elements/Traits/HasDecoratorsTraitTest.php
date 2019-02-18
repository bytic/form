<?php

namespace Nip\Form\Tests\Elements\Traits;

use Nip\Form\Decorator\Elements\Text;
use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class HasDecoratorsTraitTest
 * @package Nip\Form\Tests\Elements\Traits
 */
class HasDecoratorsTraitTest extends AbstractTest
{
    public function testAddDecorator()
    {
        $element = new \Nip_Form_Element_Input(new Form());
        $decorator = $element->addDecorator('text', 'element', 'currency');

        self::assertSame($decorator, $element->getDecorator('currency'), 'element');

        $getDecorator = $element->getDecorator('currency');
        self::assertInstanceOf(Text::class, $getDecorator);
    }
}
