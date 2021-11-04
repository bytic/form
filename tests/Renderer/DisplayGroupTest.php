<?php

namespace Nip\Form\Tests\Renderer;

use Nip\Form\Tests\AbstractTest;

/**
 * Class DisplayGroupTest
 * @package Nip\Form\Tests\Renderer
 */
class DisplayGroupTest extends AbstractTest
{
    public function test_render_dataAtribs()
    {
        $displayGroup = new \Nip_Form_DisplayGroup();
        $displayGroup->setDataAttrib('name', 'test');

        self::assertSame(
            '<fieldset data-name="test"><legend></legend></fieldset>',
            $displayGroup->render()
        );
    }
}
