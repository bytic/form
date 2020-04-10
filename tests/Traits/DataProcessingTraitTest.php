<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class DataProcessingTraitTest
 * @package Nip\Form\Tests\Traits
 */
class DataProcessingTraitTest extends AbstractTest
{
    public function test_getData()
    {
        $form = new Form();
        $element = $form->getNewElement('input')->setName('simple')->setValue('value');
        $form->addElement($element);

        $element = $form->getNewElement('input')->setName('simpleArray[]')->setValue('value1');
        $form->addElement($element);

        $element = $form->getNewElement('input')->setName('simpleArray[]')->setValue('value2');
        $form->addElement($element);

        $element = $form->getNewElement('input')->setName('person[name]')->setValue('John');
        $form->addElement($element);

        $element = $form->getNewElement('input')->setName('person[age]')->setValue('15');
        $form->addElement($element);

        self::assertSame(
            [
                'simple' => 'value',
                'simpleArray' => ['value1', 'value2'],
                'person' => [
                    'name' => 'John',
                    'age' => '15'
                ]
            ],
            $form->getData()
        );
    }
}
