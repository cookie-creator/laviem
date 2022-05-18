<?php

namespace App\Jobs;

use App\Models\AdminNotification;
use App\Models\Notification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteNotifications implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $adminNotification, $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AdminNotification $adminNotification, $users)
    {
        $this->adminNotification = $adminNotification;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            DB::beginTransaction();

            info(implode(',', $this->users));

            foreach ($this->users as $idUser)
            {
                Notification::where('admin_notification_id', $this->adminNotification->id)
                    ->where('user_id', $idUser)
                    ->delete();
            }

            DB::commit();

            info("Notification #". $this->adminNotification->id. "deleting are in progress");

        } catch (\Exception $e) {

            DB::rollBack();

            info("error:" . $this->adminNotification->title);
            info($e);
        }
    }
}
