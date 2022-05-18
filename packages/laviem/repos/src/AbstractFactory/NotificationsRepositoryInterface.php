<?php

namespace LaviemRepos\AbstractFactory;

interface NotificationsRepositoryInterface
{
    function getUserNotifications($idUser);

    function getUserNotification($idNotification, $idUser);

    function getPrivateByAdminId($idAdminNotification);
}
