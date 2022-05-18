<?php

namespace LaviemRepos;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\AbstractFactory\AdminNotificationsRepositoryInterface;
use LaviemRepos\AbstractFactory\BookmarkRepositoryInterface;
use LaviemRepos\AbstractFactory\CategoryRepositoryInterface;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use LaviemRepos\AbstractFactory\NotificationsRepositoryInterface;
use LaviemRepos\AbstractFactory\UserRepositoryInterface;
use LaviemRepos\ConcreteFactory\AdminNotificationsRepository;
use LaviemRepos\ConcreteFactory\BookmarkRepository;
use LaviemRepos\ConcreteFactory\CategoryRepository;
use LaviemRepos\ConcreteFactory\FactoryRepository;
use LaviemRepos\ConcreteFactory\NotificationsRepository;
use LaviemRepos\ConcreteFactory\UserRepository;

class LaviemReposServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(FactoryRepositoryInterface::class, FactoryRepository::class);
        $this->app->bind(AdminNotificationsRepositoryInterface::class, AdminNotificationsRepository::class);
        //$this->app->bind(BookmarkRepositoryInterface::class, BookmarkRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(NotificationsRepositoryInterface::class, NotificationsRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
