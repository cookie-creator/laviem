<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use App\Models\Bookmark;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('seeding.num_marks'))
        {
            $users = collect(User::all()->modelKeys());

            if ($users->count() > 0)
            {
                foreach ($users as $idUser)
                {
                    $categories = collect(User::find($idUser)->categories->modelKeys());

                    if ($categories->count() > 0) {

                        $data = [];
                        for ($i=1; $i<=config('seeding.num_marks'); $i++)
                        {
                            $data[] = [
                                'name' => 'bookmark name u:' . $idUser . ' i:'.$i,
                                'user_id' => $idUser,
                                'url' => 'https://www.google.com/search?q=how+to+google',
                                'category_id' => $categories->random(),
                                'created_at' => now()->toDateTimeString(),
                                'updated_at' => now()->toDateTimeString(),
                            ];
                        }

                        $chunks = array_chunk($data, 5000);
                        foreach($chunks as $chunk)
                        {
                            Bookmark::insert($chunk);
                        }
                    }
                }
            }
        }
    }
}
