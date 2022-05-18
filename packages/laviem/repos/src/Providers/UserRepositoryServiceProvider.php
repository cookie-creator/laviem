<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\ConcreteFactory\UserRepository;
use LaviemRepos\AbstractFactory\UserRepositoryInterface;

class UserRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
