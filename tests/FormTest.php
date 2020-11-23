<?php

namespace Nip\Form\Tests;

use Nip_Form as Form;
use Nip_Form_Element_Select as Select;
use Nip_Form_Renderer_Bootstrap;
use Nip_Form_Renderer_Bootstrap4;
use Nip_Form_Renderer_Table;

/**
 * Class FormTest
 * @package Nip\Tests\Form
 */
class FormTest extends AbstractTest
{
    /**
     * @var Form
     */
    protected $object;

    public function testAddSelect()
    {
        $this->object->addSelect('add_select');

        /** @noinspection PhpUndefinedFieldInspection */
        self::assertInstanceOf(Select::class, $this->object->add_select);

        self::assertInstanceOf(Select::class, $this->object->getElement('add_select'));
    }

    /**
     * @dataProvider rendererTypeProvider
     * @param string $type
     * @param string $class
     */
    public function testSetRendererType($type, $class)
    {
        $this->object->setRendererType($type);

        $renderer = $this->object->getRenderer();
        self::assertInstanceOf($class, $renderer);
    }

    /**
     * @return array
     */
    public function rendererTypeProvider()
    {
        return [
            ['table', Nip_Form_Renderer_Table::class],
            ['bootstrap', Nip_Form_Renderer_Bootstrap::class],
            ['bootstrap4', Nip_Form_Renderer_Bootstrap4::class],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->object = new Form();
    }
}
