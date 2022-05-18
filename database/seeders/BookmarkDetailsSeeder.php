<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\BookmarkDetails;
use Illuminate\Database\Seeder;

class BookmarkDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookmarks = collect(Bookmark::all()->modelKeys());

        if ($bookmarks->count() > 0)
        {
            foreach ($bookmarks as $id)
            {
                $data[] = [
                    'bookmark_id' => $id,
                    'description' => 'description_bookmark_'.$id,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }

            $chunks = array_chunk($data, 5000);
            foreach($chunks as $chunk)
            {
                BookmarkDetails::insert($chunk);
            }
        }
    }
}
