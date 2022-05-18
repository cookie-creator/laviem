<?php

namespace App\Http\Controllers;

use LaviemRepos\AbstractFactory\FactoryRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $users = $this->userRepository->getUsers();

        return view('dashboard.home', compact('users'));
    }
}
