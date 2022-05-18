<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('seeding.num_categories') > 0)
        {
            $users = collect(User::all()->modelKeys());

            if ($users->count() > 0)
            {
                foreach ($users as $idUser)
                {
                    $data = [];
                    for ($i = 1; $i <= config('seeding.num_categories'); $i++) {
                        $data[] = [
                            'name' => 'category name u:' . $idUser . '-' . $i,
                            'slug' => 'slug' . $i . 'name',
                            'user_id' => $idUser,
                            'created_at' => now()->toDateTimeString(),
                            'updated_at' => now()->toDateTimeString(),
                        ];
                    }

                    $chunks = array_chunk($data, 5000);
                    foreach ($chunks as $chunk) {
                        Category::insert($chunk);
                    }
                }
            }
        }
    }
}
