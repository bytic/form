<?php

namespace Nip\Form\Tests\Traits;

use Mockery;
use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Class CanInitializeTraitTest
 * @package Nip\Form\Tests\Traits
 */
class CanInitializeTraitTest extends AbstractTest
{
    public function test_initialize_fire_once()
    {
        /** @var Mockery\Mock|Form $form */
        $form = Mockery::mock(Form::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $form->shouldReceive('initAction')->once();

        $form->init();
        $form->initialize();
    }
}