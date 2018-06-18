<?php

namespace Nip\Form\Tests\Elements;

use Nip\Form\Tests\AbstractTest;
use Nip_Form_Element_Timeselect;

/**
 * Class TimeselectTest
 * @package Nip\Form\Tests\Elements
 */
class TimeselectTest extends AbstractTest
{
    public function testGetDataFromRequest()
    {
        $element = new Nip_Form_Element_Timeselect(new \Nip_Form());

        $request = [
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0,
        ];

        $element->getDataFromRequest($request);
        self::assertSame(null, $element->getValue());

        $request['seconds'] = 9;
        $element->getDataFromRequest($request);
        self::assertSame('00:00:09', $element->getValue());

        $request['hours'] = 2;
        $element->getDataFromRequest($request);
        self::assertSame('02:00:09', $element->getValue());

        $request['hours'] = 0;
        $element->getDataFromRequest($request);
        self::assertSame('00:00:09', $element->getValue());
    }
}
