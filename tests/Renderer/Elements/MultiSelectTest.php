<?php

namespace Nip\Form\Tests\Renderer\Elements;

use Nip\Form\Tests\AbstractTest;
use Nip_Form_Renderer_Elements_MultiSelect as Renderer;

/**
 * Class MultiSelectTest
 * @package Nip\Form\Tests\Renderer\Elements
 */
class MultiSelectTest extends AbstractTest
{
    public function testRenderEmptyElement()
    {
        $renderer = $this->generateTestRenderer();
        $html = $renderer->render();

        self::assertSame('<select  name="multi[]" class="form-select " title="Multi element" multiple ></select>', $html);
    }

    public function testRenderElement()
    {
        $renderer = $this->generateTestRenderer();
        $form = $renderer->getElement()->getForm();

        $renderer->getElement()->addOption('val1', 'Opt 1');
        $renderer->getElement()->addOption('val2', 'Opt 2');
        $renderer->getElement()->addOption('val3', 'Opt 3');

        self::assertSame(
            '<select  name="multi[]" class="form-select " title="Multi element" multiple >'
            . '<option value="val1">Opt 1</option><option value="val2">Opt 2</option><option value="val3">Opt 3</option>'
            . '</select>',
            $renderer->render()
        );

        $renderer->getElement()->setValue(['val2']);

        self::assertSame(
            '<select  name="multi[]" class="form-select form-select " title="Multi element" multiple >'
            . '<option value="val1">Opt 1</option><option value="val2" selected="selected">Opt 2</option><option value="val3">Opt 3</option>'
            . '</select>',
            $renderer->render()
        );
    }

    /**
     * @return Renderer
     */
    protected function generateTestRenderer()
    {
        $form = new \Nip\Form\Form();
        $input = new \Nip_Form_Element_MultiSelect($form);
        $input->setName('multi');
        $input->setLabel('Multi element');

        $render = new Renderer();
        $render->setElement($input);

        return $render;
    }
}
