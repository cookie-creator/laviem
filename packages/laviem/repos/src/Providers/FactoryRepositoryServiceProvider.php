<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\ConcreteFactory\FactoryRepository;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;

class FactoryRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(FactoryRepositoryInterface::class, FactoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
