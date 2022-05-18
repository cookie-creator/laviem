<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\ConcreteFactory\NotificationsRepository;
use LaviemRepos\AbstractFactory\NotificationsRepositoryInterface;

class NotificationsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(NotificationsRepositoryInterface::class, NotificationsRepository::class);
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
