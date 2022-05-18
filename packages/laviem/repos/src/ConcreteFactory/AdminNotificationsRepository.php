<?php

namespace LaviemRepos\ConcreteFactory;

use LaviemRepos\AbstractFactory\AdminNotificationsRepositoryInterface;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\DB;

class AdminNotificationsRepository implements AdminNotificationsRepositoryInterface
{
    function __construct()
    {

    }

    function getAllNotifications()
    {
        return AdminNotification::orderBy('created_at', 'desc')
            ->get();
    }

    function getPaginatedNotifications()
    {
        return AdminNotification::orderBy('created_at', 'desc')
            ->cursorPaginate(config('pagination.num_notifications'));
    }

    function getPrivateNotifications()
    {
        return AdminNotification::where('private',1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    function getNotification($idNotification)
    {
        return AdminNotification::find($idNotification);
    }

    function update($data)
    {
        try {

            DB::beginTransaction();

            $notification = AdminNotification::find($data->notification_id);
            $notification->title = $data->title;
            $notification->message = $data->message;
            $notification->type = $data->type;
            $notification->save();

            DB::commit();

            return true;

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
        return false;
    }

    function store($data)
    {
        try {

            DB::beginTransaction();

            $notification = new AdminNotification();
            $notification->title = $data->title;
            $notification->private = $data->private;
            $notification->message = $data->message;
            $notification->type = $data->type;
            $notification->save();

            DB::commit();

            return $notification->id;

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
        return false;
    }

    function delete($idNotification)
    {
        AdminNotification::find($idNotification)->delete();
    }
}
