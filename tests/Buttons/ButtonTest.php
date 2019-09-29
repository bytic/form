<?php

namespace Nip\Form\Tests\Buttons;

use Nip\Form\Tests\AbstractTest;
use Nip_Form_Element_Timeselect;

/**
 * Class ButtonTest
 * @package Nip\Form\Tests\Buttons
 */
class ButtonTest extends AbstractTest
{
    public function testInitInConstruct()
    {
        $button = new \Nip_Form_Button_Button(new \Nip\Form\Form());
        self::assertSame('button', $button->getType());
    }
}
