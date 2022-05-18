<?php

namespace App\Jobs;

use App\Interface\FactoryRepositoryInterface;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdatePrivateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private AdminNotification $adminNotification;

    public function __construct(AdminNotification $adminNotification)
    {
        $this->adminNotification = $adminNotification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FactoryRepositoryInterface $factoryRepo)
    {
        $this->notificationsRepository = $factoryRepo->make('notificationsRepository');

        try
        {
            DB::beginTransaction();

            $notification = $this->notificationsRepository->getPrivateByAdminId($this->adminNotification->id);

            $notification->title = $this->adminNotification->title;
            $notification->message = $this->adminNotification->message;
            $notification->type = $this->adminNotification->type;
            $notification->save();

            DB::commit();

            info('Private notification for ' . $notification->user->id . 'was updated');

        } catch (\Exception $e) {
            info($this->notification->title);
        }
    }
}
