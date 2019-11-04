<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;

/**
 * Class MultiElementTest
 * @package Nip\Form\Tests\Elements
 */
class MultiElementTest extends AbstractTest
{
    public function testAddElement()
    {
        $form = new \Nip\Form\Form();
        $input = new \Nip_Form_Element_MultiElement($form);

        $subInput = $form->getNewElement('input');
        $input->addElement($input);

        self::assertCount(1, $input->getElements());
    }
}