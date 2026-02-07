<?php

namespace Nip\Form;

use Nip\Container\ServiceProviders\Providers\AbstractServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\ResolvedFormTypeFactory;

/**
 * Class FormServiceProvider
 * @package Nip\Form
 *
 * Provides Symfony Form component integration for the Nip Form library.
 * Registers Symfony FormFactory, FormRegistry, and form extensions.
 *
 * @inspiration https://github.com/symfony/framework-bundle/blob/master/DependencyInjection/FrameworkExtension.php
 */
class FormServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    const FORM_REGISTRY = 'form.registry';
    const FORM_EXTENSIONS = 'form.extensions';
    const FORM_FACTORY = 'form.factory';

    /**
     * @inheritdoc
     */
    public function provides(): array
    {
        return [
            static::FORM_REGISTRY,
            static::FORM_EXTENSIONS,
            static::FORM_FACTORY,
        ];
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerFormRegistry();
        $this->registerFormExtensions();
        $this->registerFormFactory();
    }

    public function boot()
    {
//        $this->mergeDefaultFilesystem();
    }

    /**
     * Register the native filesystem implementation.
     *
     * @return void
     */
    protected function registerFormRegistry()
    {
        $this->getContainer()->share(
            static::FORM_REGISTRY,
            function () {
                return new FormRegistry(
                    $this->getContainer()->get(static::FORM_EXTENSIONS),
                    new ResolvedFormTypeFactory()
                );
            }
        );
    }

    /**
     * Register the form extensions.
     *
     * @return void
     */
    protected function registerFormExtensions()
    {
        $this->getContainer()->share(
            static::FORM_EXTENSIONS,
            function () {
                return [
                    new Extension\Legacy\LegacyExtension(),
                ];
            }
        );
    }

    /**
     * Register the Symfony Form Factory.
     *
     * The FormFactory is responsible for creating form instances
     * from form types and configurations.
     *
     * @return void
     */
    {
        $this->getContainer()->share(
            static::FORM_FACTORY,
            function () {
                return new \Symfony\Component\Form\FormFactory(
                    $this->getContainer()->get(static::FORM_REGISTRY)
                );
            }
        );
    }
}
