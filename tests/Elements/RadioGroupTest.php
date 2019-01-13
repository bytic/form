<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;

/**
 * Class RadioGroupTest
 * @package Nip\Form\Tests\Elements
 */
class RadioGroupTest extends AbstractTest
{
    public function testRenderEmptyElement()
    {
        $input = new \Nip_Form_Element_RadioGroup(new \Nip\Form\Form());
        $html = $input->render();

        self::assertSame('', $html);
    }

    public function testAutoSelectFirstDefaultDoesNotChangeValue()
    {
        $input = new \Nip_Form_Element_RadioGroup(new \Nip\Form\Form());
        $input->addOption('123', 'Age');
        $input->addOption('789', 'Height');
        $input->autoSelectFirst(true);

        self::assertSame(null, $input->getValue());

        $input->render();
        self::assertSame(null, $input->getValue());
    }
}
