<?php

namespace Nip\Form\Tests\Renderer\Buttons;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class ButtonTest
 * @package Nip\Form\Tests\Renderer\Buttons
 */
class ButtonTest extends AbstractTest
{
    public function test_render_attributes()
    {
        $button = new \Nip_Form_Button_Button(new Form());
        $button->setName('test');
        $button->setLabel('Label');
        $button->addAttribs([
            'value' => '5',
            'data-trigger' => 'form',
            'data-vendor' => 'foe',
        ]);
        $button->getRenderer();

        self::assertSame(
            '<button  class="btn btn-primary" type="submit" name="test" data-trigger="form" data-vendor="foe" title="Label">Label</button>',
            $button->getRenderer()->render()
        );
    }
}
