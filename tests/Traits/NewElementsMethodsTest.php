<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class NewElementsMethodsTest
 * @package Nip\Form\Tests\Traits
 */
class NewElementsMethodsTest extends AbstractTest
{
    public function test_add_with_options()
    {
        $form = new Form();
        $form->add('test', 'label', 'input', true, ['value' => 5]);

        $element = $form->getElement('test');
        self::assertSame(['value' => 5], $element->getOptions());
    }
}
