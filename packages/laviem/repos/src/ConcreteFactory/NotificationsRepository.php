<?php

namespace LaviemRepos\ConcreteFactory;

use App\Models\Notification;
use LaviemRepos\AbstractFactory\NotificationsRepositoryInterface;

class NotificationsRepository implements NotificationsRepositoryInterface
{
    function __construct()
    {

    }

    function getUserNotifications($idUser)
    {
        return Notification::where('user_id',$idUser)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    function getUserNotification($idNotification, $idUser)
    {
        return Notification::where('id',$idNotification)
            ->where('user_id',$idUser)
            ->firstOrFail();
    }

    function getPrivateByAdminId($idAdminNotification)
    {
        return Notification::where('admin_notification_id',$idAdminNotification)
            ->firstOrFail();
    }
}
