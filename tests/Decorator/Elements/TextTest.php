<?php

namespace Nip\Form\Tests\Decorator\Elements;

use Nip\Form\Decorator\Elements\Text;
use Nip\Form\Tests\AbstractTest;

/**
 * Class TextTest
 * @package Nip\Form\Tests\Decorator\Elements
 */
class TextTest extends AbstractTest
{
    public function testGenerate()
    {
        $decorator = new Text();
        $decorator->setText('john');
        $decorator->setSeparator(' ');
        self::assertSame('hello john', $decorator->render('hello'));
    }
}
