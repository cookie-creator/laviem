<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\AbstractFactory\AdminNotificationsRepositoryInterface;
use LaviemRepos\ConcreteFactory\AdminNotificationsRepository;

class AdminNotificationsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(AdminNotificationsRepositoryInterface::class, AdminNotificationsRepository::class);
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
