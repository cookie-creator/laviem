<?php

namespace LaviemRepos\Providers;

use Illuminate\Support\ServiceProvider;
use LaviemRepos\ConcreteFactory\BookmarkRepository;
use LaviemRepos\AbstractFactory\BookmarkRepositoryInterface;

class BookmarkRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookmarkRepositoryInterface::class, BookmarkRepository::class);
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
