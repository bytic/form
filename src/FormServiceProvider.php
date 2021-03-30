<?php

namespace Nip\Form;

use Nip\Container\ServiceProviders\Providers\AbstractServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;
use Symfony\Component\Form\FormRegistry;

/**
 * Class FilesystemServiceProvider
 * @package Nip\Filesystem
 *
 * @inspiration https://github.com/laravel/framework/blob/5.4/src/Illuminate/Filesystem/FilesystemServiceProvider.php
 *
 */
class FormServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    /**
     * @inheritdoc
     */
    public function provides()
    {
        return ['form.registry','form.extensions'];
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerFormRegistry();
        $this->registerFormExtensions();
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
        $this->getContainer()->share('form.registry', function () {
            return new FormRegistry(
                $this->getContainer()->get('form.extensions'),
                $this->getContainer()->get('form.extensions')
            );
        });
    }

    /**
     * Register the native filesystem implementation.
     *
     * @return void
     */
    protected function registerFormExtensions()
    {
        $this->getContainer()->share('form.extensions', function () {
            return [

            ];
        });
}
}
