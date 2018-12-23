<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class HasClassTraitTest
 * @package Nip\Form\Tests\Traits
 */
class HasClassTraitTest extends AbstractTest
{
    public function testAddClassNullIfNoClass()
    {
        $form = new Form();
        self::assertNull($form->getAttrib('class'));
    }

    public function testAddClassOnce()
    {
        $form = new Form();
        $form->addClass('test');
        self::assertSame('test', $form->getAttrib('class'));
    }

    public function testAddClassMultipleArguments()
    {
        $form = new Form();
        $form->addClass('test1', 'test2');
        self::assertSame('test1 test2', $form->getAttrib('class'));
    }

    public function testAddClassWithSpace()
    {
        $form = new Form();
        $form->addClass('test1 ', 'test2');
        self::assertSame('test1 test2', $form->getAttrib('class'));
    }

    public function testAddClassMultipleTimes()
    {
        $form = new Form();

        $form->addClass('test1 ');
        self::assertSame('test1', $form->getAttrib('class'));

        $form->addClass('test1 ');
        self::assertSame('test1', $form->getAttrib('class'));

        $form->addClass('test1 test2', 'test1 test2');
        self::assertSame('test1 test2', $form->getAttrib('class'));
    }

    public function testRemoveClassOnce()
    {
        $form = new Form();
        $form->addClass('test');
        self::assertSame('test', $form->getAttrib('class'));

        $form->removeClass('test');
        self::assertSame('', $form->getAttrib('class'));
    }
}
