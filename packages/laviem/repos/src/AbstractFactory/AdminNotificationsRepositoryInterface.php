<?php

namespace LaviemRepos\AbstractFactory;

interface AdminNotificationsRepositoryInterface
{
    function getAllNotifications();

    function getPaginatedNotifications();

    function getPrivateNotifications();

    function update($data);

    function store($data);

    function delete($idNotification);
}
