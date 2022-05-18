<?php

namespace LaviemRepos\ConcreteFactory;

use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LaviemRepos\AbstractFactory\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    function __construct()
    {

    }

    function getCategory($idCategory, $idUser)
    {
        return Category::where('id',$idCategory)
            ->where('user_id',$idUser)
            ->firstOrFail();
    }

    function getCategories($idUser)
    {
        return Category::where('user_id',$idUser)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    function getCategoriesByName($idUser)
    {
        return Category::where('user_id',$idUser)
            ->orderBy('name', 'asc')
            ->get();
    }

    function store($data, $idUser)
    {
        try {

            DB::beginTransaction();

            $category = new Category();
            $category->user_id = $idUser;
            $category->name = $data->name;
            $category->slug = Str::slug($data->name);
            $category->save();

            DB::commit();

            return $category->id;

        } catch (\Exception $e) {

            \Log::debug('rollback delete category');

            DB::rollBack();
        }
    }

    function update($data, $idCategory, $idUser)
    {
        try {

            DB::beginTransaction();

            $category = Category::where('id',$idCategory)
                ->where('user_id',$idUser)
                ->firstOrFail();

            $category->name = $data->name;
            $category->slug = Str::slug($data->name);
            $category->save();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback delete category');

            DB::rollBack();
        }
    }

    function delete($idCategory, $idUser)
    {
        try {

            DB::beginTransaction();

            $category = Category::where('id', $idCategory)
                ->where('user_id',$idUser)
                ->firstOrFail();

            Bookmark::where('category_id', $idCategory)
                ->where('user_id',$idUser)
                ->update(['category_id' => 0]);

            $category->delete();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback delete category');

            DB::rollBack();
        }
    }
}
