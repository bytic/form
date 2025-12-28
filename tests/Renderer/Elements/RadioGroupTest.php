<?php

namespace Nip\Form\Tests\Renderer\Elements;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;
use Nip_Form_Element_RadioGroup;
use Nip_Form_Renderer_Elements_RadioGroup;

/**
 * Class RadioGroupTest
 * @package Nip\Form\Tests\Renderer\Elements
 */
class RadioGroupTest extends AbstractTest
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
        $renderer->getElement()->addOption('123', 'Age');
        $renderer->getElement()->addOption('789', 'Height');
        $html = $renderer->render();

        self::assertSame(
            '<div class="form-check">'
            . '<label class="form-check-label">'
            . '<input  type="radio" name="" value="123" checked="checked" class="form-check-input" title="Age" />'
            . 'Age'
            . '</label>'
            . '</div><br />'
            . '<div class="form-check">'
            . '<label class="form-check-label">'
            . '<input  type="radio" name="" value="789" class="form-check-input" title="Height" />'
            . 'Height'
            . '</label>'
            . '</div>',
            $html
        );
    }

    public function testRenderAutoSelectFirstFalse()
    {
        $renderer = $this->generateTestRenderer();
        $renderer->getElement()->autoSelectFirst(false);
        $renderer->getElement()->addOption('123', 'Age');
        $renderer->getElement()->addOption('789', 'Height');
        $html = $renderer->render();

        self::assertSame(
            '<div class="form-check">'
            . '<label class="form-check-label">'
            . '<input  type="radio" name="" value="123" class="form-check-input" title="Age" />'
            . 'Age'
            . '</label>'
            . '</div><br />'
            . '<div class="form-check">'
            . '<label class="form-check-label">'
            . '<input  type="radio" name="" value="789" class="form-check-input" title="Height" />'
            . 'Height'
            . '</label>'
            . '</div>',
            $html
        );
        self::assertSame(null, $renderer->getElement()->getValue());
    }

    /**
     * @return Nip_Form_Renderer_Elements_RadioGroup
     */
    protected function generateTestRenderer()
    {
        $input = new Nip_Form_Element_RadioGroup(new Form());
        $render = new Nip_Form_Renderer_Elements_RadioGroup();
        $render->setElement($input);

        return $render;
    }
}
