<?php

namespace Nip\Form\Tests\Renderer\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class HasElementsTraitTest
 * @package Nip\Form\Tests\Renderer\Traits
 */
class HasElementsTraitTest extends AbstractTest
{
    public function test_getElements_initFromForm()
    {
        $form = new Form();
        $form->addInput('test1');
        $form->addInput('test2');

        $rendered = new \Nip_Form_Renderer_Basic();
        $rendered->setForm($form);

        $elements = $rendered->getElements();
        self::assertIsArray($elements);
        self::assertCount(2, $elements);
    }
}
