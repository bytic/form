<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;

/**
 * Class DateinputTest
 * @package Nip\Form\Tests\Elements
 */
class DateinputTest extends AbstractTest
{
    public function testGetDataFromRequest()
    {
        $element = new \Nip_Form_Element_Dateinput(new \Nip\Form\Form());
        $element->setName('mydate');
        $html = $element->render();

        self::assertSame(
            '<input  type="date" name="mydate" id="mydate" class="datepicker " title="" />',
            $html
        );
    }
}
