<?php

namespace Nip\Form\Tests;

use Nip\Filesystem\FilesystemManager;
use Nip\Form\FormServiceProvider;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Class FormServiceProviderTest
 * @package Nip\Form\Tests
 */
class FormServiceProviderTest extends AbstractTest
{
    public function testRegister()
    {
        $provider = new FormServiceProvider();
        $provider->initContainer();
        $provider->register();

        $factory = $provider->getContainer()->get(FormServiceProvider::FORM_FACTORY);
        self::assertInstanceOf(FormFactoryInterface::class, $factory);
    }
}
