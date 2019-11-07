<?php

namespace Nip\Form\Tests\Renderer\Elements;

use Nip\Form\Tests\AbstractTest;
use Nip_Form_Renderer_Elements_MultiElement as MultiElementRenderer;

/**
 * Class MultiElementTest
 * @package Nip\Form\Tests\Renderer\Elements
 */
class MultiElementTest extends AbstractTest
{
    public function testRenderEmptyElement()
    {
        $renderer = $this->generateTestRenderer();
        $html = $renderer->render();

        self::assertSame('', $html);
    }

    public function testRenderSimpleElement()
    {
        $renderer = $this->generateTestRenderer();
        $form = $renderer->getElement()->getForm();

        $subInput = $form->getNewElement('input');
        $subInput->setName('sub-input');
        $renderer->getElement()->addElement($subInput);

        $html = $renderer->render();

        self::assertSame(
            '<div style="display: flex;flex-direction: row;"><div style="display: flex;flex-direction: column;flex-basis: 100%;flex: 1;padding-right: 20px;">'
            .'<label class="">:</label>'
            . '<input  type="text" name="sub-input" class="form-control " title="" />'
            . '</div></div>',
            $html
        );
    }

    /**
     * @return MultiElementRenderer
     */
    protected function generateTestRenderer()
    {
        $form = new \Nip\Form\Form();
        $input = new \Nip_Form_Element_MultiElement($form);
        $input->setName('multi');
        $input->setLabel('Multi element');

        $render = new MultiElementRenderer();
        $render->setElement($input);

        return $render;
    }
}
