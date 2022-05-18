<?php

namespace App\Jobs;

use App\Models\Seededuser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class SeedingUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $seeded = Seededuser::find(1);

        info("Number of users was seeded:" . $seeded->count);

        if ($seeded->count < 1000000) {

            info("Seeding is started");
            try {
                $time_start = microtime(true);

                for ($i = 1; $i <= 1000; $i++) {
                    $data[] = [
                        'name' => 'test' . \Str::random(10) . 'name',
                        'email' => 'test' . \Str::random(10) . '@gmail.com',
                        'password' => Hash::make('test' . $i),
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }

                $chunks = array_chunk($data, 5000);
                foreach ($chunks as $chunk) {
                    User::insert($chunk);
                }

                $time_end = microtime(true);
                $time = $time_end - $time_start;

                $seeded = Seededuser::find(1);
                $seeded->count = $seeded->count + 1000;
                $seeded->save();

                info("Job seeding time is: $time");
            } catch (\Exception $e) {
                log($e);
            }
        }
    }
}
