<?php

namespace LaviemRepos\AbstractFactory;

interface FactoryRepositoryInterface
{
    function bookmarkRepository();
    function categoryRepository();
    function userRepository();
    function notificationsRepository();
    function adminNotificationsRepository();
}
