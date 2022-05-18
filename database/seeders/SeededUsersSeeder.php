<?php

namespace Database\Seeders;

use App\Models\Seededuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class SeededUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Seededuser();
        $user->count = 0;
        $user->save();
    }
}
