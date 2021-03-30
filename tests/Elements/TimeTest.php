<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;

/**
 * Class DateinputTest
 * @package Nip\Form\Tests\Elements
 */
class TimeTest extends AbstractTest
{
    public function testGetDataFromRequest()
    {
        $element = new \Nip_Form_Element_Time(new \Nip\Form\Form());
        $element->setName('mydate');
        $html = $element->render();

        self::assertSame(
            '<input  type="time" name="mydate" title="" />',
            $html
        );
    }
}
