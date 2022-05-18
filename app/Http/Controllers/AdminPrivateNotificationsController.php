<?php

namespace App\Http\Controllers;

use App\Jobs\DeletePrivateNotification;
use App\Jobs\UpdatePrivateNotification;
use App\Services\NotificationSendingService;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class AdminPrivateNotificationsController extends Controller
{
    public function __construct(FactoryRepositoryInterface $factoryRepo)
    {
        $this->userRepository = $factoryRepo->make('userRepository');
        $this->notificationsRepository = $factoryRepo->make('notificationsRepository');
        $this->adminNotificationsRepository = $factoryRepo->make('adminNotificationsRepository');
    }

    public function create(Request $request)
    {
        $user = $this->userRepository->getUser($request->user_id);

        return view('notifications.create_private', compact(['user']));
    }

    public function store(Request $request, NotificationSendingService $service)
    {
        $idNotification = $this->adminNotificationsRepository->store($request);

        if ($idNotification) $service->sendPrivateNotification($idNotification, $request->user_id);

        return ($idNotification) ?
            redirect()->route('user.show', ['user_id' => $request->user_id]) : back();
    }

    public function update(Request $request)
    {
        $this->adminNotificationsRepository->update($request);

        $notification = $this->adminNotificationsRepository->getNotification($request->notification_id);

        UpdatePrivateNotification::dispatch($notification);

        return back();
    }

    public function destroy(Request $request)
    {
        $notification = $this->adminNotificationsRepository->getNotification($request->notification_id);

        DeletePrivateNotification::dispatch($notification);

        $user = $this->notificationsRepository->getPrivateByAdminId($notification->id)->user;

        return redirect()->route('user.show', ['user_id' => $user->id]);
    }
}
