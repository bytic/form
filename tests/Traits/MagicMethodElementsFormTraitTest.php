<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class MagicMethodElementsFormTraitTest
 * @package Nip\Form\Tests\Traits
 */
class MagicMethodElementsFormTraitTest extends AbstractTest
{

    /**
     * @dataProvider data_magic_methods
     */
    public function test_magic_methods($element, $class)
    {
        $method = 'add' . $element;
        $form = new Form();
        $form->$method('test_input');

        self::assertInstanceOf($class, $form->test_input);
        self::assertInstanceOf($class, $form->getElement('test_input'));
    }

    /**
     * @return \string[][]
     */
    public function data_magic_methods()
    {
        return [
            ['Select', \Nip_Form_Element_Select::class],
            ['MultiSelect', \Nip_Form_Element_MultiSelect::class]
        ];
    }
}