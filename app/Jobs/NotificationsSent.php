<?php

namespace App\Jobs;

use App\Models\AdminNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationsSent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $adminNotification;
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
    public function handle()
    {
        $this->adminNotification->status = 2;
        $this->adminNotification->save();
        info("NotificationsSent finally");
    }
}
