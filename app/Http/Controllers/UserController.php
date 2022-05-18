<?php

namespace App\Http\Controllers;

use App\Models\User;
use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(FactoryRepositoryInterface $factoryRepo)
    {
        $this->bookmarkRepository = $factoryRepo->make('bookmarkRepository');
        $this->categoryRepository = $factoryRepo->make('categoryRepository');
        $this->notificationsRepository = $factoryRepo->make('notificationsRepository');
        $this->userRepository = $factoryRepo->make('userRepository');
        $this->adminNotificationsRepository = $factoryRepo->make('adminNotificationsRepository');
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getUsersPagination();

        return view('users.index', compact('users'));
    }

    public function show(Request $request)
    {
        $user = $this->userRepository->getUser($request->user_id);

        $categories = $this->categoryRepository->getCategories($request->user_id);

        $bookmarks = $this->bookmarkRepository->getBookmarksPagination($request->user_id);

        $notifications = $this->notificationsRepository->getUserNotifications($request->user_id);

        return view('users.show', compact(['user','categories','bookmarks','notifications']));
    }

    public function create()
    {
        $user = new User();

        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {
        $idUser = $this->userRepository->store($request);

        return ($idUser) ? redirect("/user/$idUser") : back();
    }

    public function update(Request $request)
    {
        $this->userRepository->update($request, $request->user_id);

        return back();
    }

    public function delete(Request $request)
    {
        $this->userRepository->delete($request->user_id);

        return redirect("/users");
    }
}
