<?php

namespace App\Jobs;

use App\Models\AdminNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendPrivateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $idNotification, $idUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idNotification, $idUser)
    {
        $this->idNotification = $idNotification;
        $this->idUser = $idUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $adminNotification = AdminNotification::find($this->idNotification);
        $user = User::find($this->idUser);

        try
        {
            DB::beginTransaction();

            $notification = New Notification();
            $notification->title = $adminNotification->title;
            $notification->message = $adminNotification->message;
            $notification->type = $adminNotification->type;
            $notification->user_id = $user->id;
            $notification->admin_notification_id = $adminNotification->id;

            $notification->save();

            $adminNotification->status = 2;
            $adminNotification->count = 1;

            $adminNotification->save();

            DB::commit();

            info('Private notification to ' . $user->id . 'was sent');

        } catch (\Exception $e) {

            DB::rollBack();

            info('Notification not sent to user: '. $user->id);
            info($e);
        }
    }
}
