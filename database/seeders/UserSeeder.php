<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Profile;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('seeding.num_users') > 0)
        {
            for ($i=1; $i<=config('seeding.num_users'); $i++)
            {
                $data[] = [
                    'name' => 'test'.$i.'name',
                    'email' => 'test'.$i.'@gmail.com',
                    'password' => Hash::make('test'.$i),
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];

                /*
                $user = new User();
                $user->name = 'test'.$i.'name';
                $user->email = 'test'.$i.'@gmail.com';
                $user->password = Hash::make('test'.$i);
                $user->save();


                $profile = new Profile();
                $profile->description = 'description'.$i;
                $profile->user_id = $user->id;
                $profile->save();
                */

                /*
                DB::table('users')->insert([
                    'name' => 'test'.$i.'name',
                    'email' => 'test'.$i.'@gmail.com',
                    'password' => Hash::make('test'.$i),
                ]);
                */
            }

            $chunks = array_chunk($data, 5000);
            foreach($chunks as $chunk)
            {
                User::insert($chunk);
            }
        }
    }
}
