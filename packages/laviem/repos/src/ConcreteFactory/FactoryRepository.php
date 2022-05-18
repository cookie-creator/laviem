<?php

namespace LaviemRepos\ConcreteFactory;

use LaviemRepos\AbstractFactory\AdminNotificationsRepositoryInterface;
use LaviemRepos\AbstractFactory\BookmarkRepositoryInterface;
use LaviemRepos\AbstractFactory\CategoryRepositoryInterface;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use LaviemRepos\AbstractFactory\NotificationsRepositoryInterface;
use LaviemRepos\AbstractFactory\UserRepositoryInterface;

class FactoryRepository implements FactoryRepositoryInterface
{
    function __construct()
    {

    }

    public function make($obj)
    {
        switch ($obj) {
            case 'bookmarkRepository':
                return $this->bookmarkRepository();

            case 'categoryRepository':
                return $this->categoryRepository();

            case 'notificationsRepository':
                return $this->notificationsRepository();

            case 'adminNotificationsRepository':
                return $this->adminNotificationsRepository();

            case 'userRepository':
                return $this->userRepository();

            default:
                break;
        }
    }

    function bookmarkRepository()
    {
        return resolve(BookmarkRepositoryInterface::class);
    }

    function categoryRepository()
    {
        return resolve(CategoryRepositoryInterface::class);
    }

    function notificationsRepository()
    {
        return resolve(NotificationsRepositoryInterface::class);
    }

    function userRepository()
    {
        return resolve(UserRepositoryInterface::class);
    }

    function adminNotificationsRepository()
    {
        return resolve(AdminNotificationsRepositoryInterface::class);
    }
}
