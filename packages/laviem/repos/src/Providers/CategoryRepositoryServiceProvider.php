<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\ConcreteFactory\CategoryRepository;
use LaviemRepos\AbstractFactory\CategoryRepositoryInterface;

class CategoryRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
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
