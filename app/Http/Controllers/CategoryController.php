<?php

namespace App\Http\Controllers;

use App\Models\Category;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(FactoryRepositoryInterface $factoryRepo)
    {

        $this->bookmarkRepository = $factoryRepo->make('bookmarkRepository');
        $this->categoryRepository = $factoryRepo->make('categoryRepository');
        $this->notificationsRepository = $factoryRepo->make('notificationsRepository');
        $this->userRepository = $factoryRepo->make('userRepository');
    }

    public function index(Request $request)
    {
        $user = $this->userRepository->getUser($request->user_id);

        $category = $this->categoryRepository->getCategory($request->category_id, $request->user_id);

        return view('category.home', compact(['category','user']));
    }

    /* show form */
    public function create(Request $request)
    {
        $category = new Category();

        $user = $this->userRepository->getUser($request->user_id);

        return view('category.home', compact(['category','user']));
    }

    public function store(Request $request)
    {
        $idCategory = $this->categoryRepository->store($request, $request->user_id);

        return redirect("/user/$request->user_id/category/$idCategory");
    }

    public function update(Request $request)
    {
        $this->categoryRepository->update($request, $request->category_id, $request->user_id);

        return back();
    }

    public function delete(Request $request)
    {
        $this->categoryRepository->delete($request->category_id, $request->user_id);

        return redirect("/user/$request->user_id");
    }
}
