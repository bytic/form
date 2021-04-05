<?php

namespace Nip\Form;

use Nip\Container\ServiceProviders\Providers\AbstractServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\ResolvedFormTypeFactory;

/**
 * Class FilesystemServiceProvider
 * @package Nip\Filesystem
 *
 * @inspiration https://github.com/laravel/framework/blob/5.4/src/Illuminate/Filesystem/FilesystemServiceProvider.php
 *
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
     * Register the native filesystem implementation.
     *
     * @return void
     */
    protected function registerFormExtensions()
    {
        $this->getContainer()->share(
            static::FORM_EXTENSIONS,
            function () {
                return [

                ];
            }
        );
    }

    /**
     * Register the native filesystem implementation.
     *
     * @return void
     */
    protected function registerFormFactory()
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
