<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;

/**
 * Class MultiElementTest
 * @package Nip\Form\Tests\Elements
 */
class MultiSelectTest extends AbstractTest
{

    public function test_getValue()
    {
        $form = new \Nip\Form\Form();
        $input = new \Nip_Form_Element_MultiSelect($form);
        $input->addOption('1', 'opt1');
        $input->addOption('2', 'opt2');

        $input->getDataFromRequest(['1', '2', '3']);

        self::assertSame(['1', '2'], $input->getValue());
    }
}
