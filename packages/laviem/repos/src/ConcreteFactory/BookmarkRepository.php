<?php

namespace LaviemRepos\ConcreteFactory;

use App\Models\Bookmark;
use App\Models\BookmarkDetails;
use Illuminate\Support\Facades\DB;
use LaviemRepos\AbstractFactory\BookmarkRepositoryInterface;

class BookmarkRepository implements BookmarkRepositoryInterface
{
    function __construct()
    {

    }

    function getBookmark($idBookmark, $idUser)
    {
        return Bookmark::where('id',$idBookmark)
            ->where('user_id',$idUser)
            ->firstOrFail();
    }

    function getBookmarks($idUser)
    {
        return Bookmark::where('user_id',$idUser)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    function getBookmarksPagination($idUser)
    {
        return Bookmark::where('user_id', $idUser)
            ->orderBy('updated_at', 'desc')
            ->paginate(
                $perPage = config('pagination.num_categories'), $columns = ['*'], $pageName = 'users'
            );
    }

    function store($data, $idUser)
    {
        try {

            DB::beginTransaction();

            $bookmark = new Bookmark();
            $bookmark->name = $data->name;
            $bookmark->url = $data->url;
            $bookmark->user_id = $idUser;
            $bookmark->category_id = $data->category_id;
            $bookmark->save();

            $bookmarkDetails = new BookmarkDetails();
            $bookmarkDetails->description = $data->description;
            $bookmark->details()->save($bookmarkDetails);

            DB::commit();

            return true;

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
        return false;
    }

    function update($data, $idBookmark, $idUser)
    {
        try {

            DB::beginTransaction();

            $bookmark = Bookmark::where('id', $idBookmark)
                ->where('user_id', $idUser)
                ->firstOrFail();

            $bookmark->name = $data->name;
            $bookmark->url = $data->url;
            $bookmark->category_id = $data->category_id;
            $bookmark->save();

            $bookmark->details->description = $data->description;
            $bookmark->details->save();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
    }

    function delete($idBookmark, $idUser)
    {
        try {

            DB::beginTransaction();

            $bookmark = Bookmark::where('id', $idBookmark)
                ->where('user_id', $idUser)
                ->firstOrFail();

            $bookmark->details()->delete();

            $bookmark->delete();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
    }
}
