<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect(User::all()->modelKeys());

        if ($users->count() > 0)
        {
            foreach ($users as $id)
            {
                $data[] = [
                    'user_id' => $id,
                    'description' => 'description_user_'.$id,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }

            $chunks = array_chunk($data, 5000);
            foreach($chunks as $chunk)
            {
                Profile::insert($chunk);
            }
        }
    }
}
