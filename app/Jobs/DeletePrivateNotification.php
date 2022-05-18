<?php

namespace App\Jobs;

use App\Interface\FactoryRepositoryInterface;
use App\Models\AdminNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeletePrivateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private AdminNotification $adminNotification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
            $notification->delete();

            $this->adminNotification->delete();

            DB::commit();

            info('Private notification for ' . $notification->user->id . 'was updated');

        } catch (\Exception $e) {
            info($this->notification->title);
        }
    }
}
