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

class SendNotification implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    private $adminNotification, $users;
    /**
     * Create a new job instance.
     * @param $users
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
                $notification = New Notification();
                $notification->title = $this->adminNotification->title;
                $notification->message = $this->adminNotification->message;
                $notification->type = $this->adminNotification->type;
                $notification->user_id = $idUser;
                $notification->admin_notification_id = $this->adminNotification->id;

                $notification->save();
            }

            DB::commit();

            info("Notification #". $this->adminNotification->id);

        } catch (\Exception $e) {

            DB::rollBack();

            info("error:" . $this->adminNotification->title);
            info($e);
        }
    }
}
