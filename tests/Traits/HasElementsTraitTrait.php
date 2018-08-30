<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class HasElementsTraitTrait
 * @package Nip\Form\Tests\Traits
 */
class HasElementsTraitTrait extends AbstractTest
{
    public function testAddElement()
    {
        $form = new Form();
        $element = $form->getNewElement('hidden')
        ->setName('fieldOne');

        self::assertCount(0, $form->getElements());

        $form->addElement($element);

        self::assertCount(1, $form->getElements());
    }
}
