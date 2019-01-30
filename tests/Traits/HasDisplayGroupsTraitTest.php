<?php

namespace Nip\Form\Tests\Traits;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class HasDisplayGroupsTraitTest
 * @package Nip\Form\Tests\Traits
 */
class HasDisplayGroupsTraitTest extends AbstractTest
{
    public function testAddDisplayGroup()
    {
        $form = new Form();

        $form->addInput('name1', 'name1', true);
        $form->addInput('name2', 'name2', true);

        $form->addDisplayGroup(['name1', 'name2'], 'Display Group');

        $displayGroup = $form->getDisplayGroup('Display Group');
        self::assertInstanceOf(\Nip_Form_DisplayGroup::class, $displayGroup);
        self::assertSame(2, $displayGroup->count());
    }
}
