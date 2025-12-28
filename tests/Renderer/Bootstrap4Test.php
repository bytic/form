<?php

namespace Nip\Form\Tests\Renderer;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class Bootstrap4Test
 * @package Nip\Form\Tests\Renderer
 */
class Bootstrap4Test extends AbstractTest
{
    public function testRenderRow()
    {
        $form = new Form();
        $form->setRendererType('Bootstrap4');
        $form->add('test_input');

        self::assertSame(
            '<div class="form-group row-test_input">'
            . '<label class="col-form-label ">Test_input:</label>'
            . '<div class=""><input  type="text" name="test_input" class="form-control" title="Test_input" />'
            . '</div>'
            . '</div>',
            $form->getRenderer()->renderRow($form->getElement('test_input'))
        );
    }
}
