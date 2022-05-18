<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class BookmarkController extends Controller
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

        $bookmark = $this->bookmarkRepository->getBookmark($request->bookmark_id, $request->user_id);

        $categories = $this->categoryRepository->getCategories($request->user_id);

        return view('bookmark.home', compact(['bookmark', 'categories', 'user']));
    }

    public function create(Request $request)
    {
        $bookmark = new Bookmark();

        $user = $this->userRepository->getUser($request->user_id);

        $categories = $this->categoryRepository->getCategoriesByName($request->user_id);

        return view('bookmark.home', compact(['bookmark', 'categories', 'user']));
    }

    public function store(Request $request)
    {
        $created = $this->bookmarkRepository->store($request, $request->user_id);

        return ($created) ? redirect("/user/$request->user_id") : back();
    }

    public function update(Request $request)
    {
        $this->bookmarkRepository->update($request, $request->bookmark_id, $request->user_id);

        return back();
    }

    public function delete(Request $request)
    {
        $this->bookmarkRepository->delete($request->bookmark_id, $request->user_id);

        return redirect("/user/$request->user_id");
    }
}
