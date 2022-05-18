<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Services\NotificationSendingService;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class AdminNotificationsController extends Controller
{
    public function __construct(FactoryRepositoryInterface $factoryRepo)
    {
        $this->userRepository = $factoryRepo->make('userRepository');
        $this->notificationsRepository = $factoryRepo->make('notificationsRepository');
        $this->adminNotificationsRepository = $factoryRepo->make('adminNotificationsRepository');
    }

    public function index(Request $request,  DateHelper $helper)
    {
        $notifications = $helper->getProperDate($this->adminNotificationsRepository->getPaginatedNotifications());

        $privateNotifications = $helper->getProperDate($this->adminNotificationsRepository->getPrivateNotifications());

        return view('notifications.home', compact(['notifications', 'privateNotifications']));
    }

    public function show(Request $request)
    {
        $notification = $this->adminNotificationsRepository->getNotification($request->notification_id);

        if ($notification->private)
        {
            $user = $this->notificationsRepository->getPrivateByAdminId($notification->id)->user;

            return view('notifications.show_private', compact(['notification','user']));

        } else {
            return view('notifications.show', compact('notification'));
        }
    }

    public function create(Request $request)
    {
        return view('notifications.create');
    }

    public function update(Request $request)
    {
        $this->adminNotificationsRepository->update($request);

        return back();
    }

    public function send(Request $request, NotificationSendingService $service)
    {
        $notification = $this->adminNotificationsRepository->getNotification($request->notification_id);

        // Start process sending notifications
        $service->sendNotificationToUsers($notification);

        return back();
    }

    public function store(Request $request)
    {
        $idNotification = $this->adminNotificationsRepository->store($request);

        return ($idNotification) ? redirect("/notification/$idNotification") : back();
    }

    public function destroy(Request $request, NotificationSendingService $service)
    {
        $notification = $this->adminNotificationsRepository->getNotification($request->notification_id);

        if ($notification->status == 0)
            $this->adminNotificationsRepository->delete($request->notification_id);
        elseif ($notification->status == 2)
            $service->deleteAdminNotification($notification);
    }
}
