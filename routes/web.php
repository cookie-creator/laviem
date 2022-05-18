<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\AdminNotificationsController;
use App\Http\Controllers\AdminPrivateNotificationsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index']);

Route::middleware(['auth'])->group(function ()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

    Route::get('/user/{user_id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/{user_id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{user_id}/delete', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/user/{user_id}/category/{category_id}', [CategoryController::class, 'index'])->name('category.show');
    Route::get('/user/{user_id}/category-add', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/user/{user_id}/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/user/{user_id}/category/{category_id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/user/{user_id}/category/{category_id}/delete', [CategoryController::class, 'delete'])->name('category.delete');

    Route::post('/user/{user_id}/bookmark/{bookmark_id}/update', [BookmarkController::class, 'update'])->name('bookmark.update');
    Route::get('/user/{user_id}/bookmark/{bookmark_id}', [BookmarkController::class, 'index'])->name('bookmark.show');
    Route::get('/user/{user_id}/bookmark/{bookmark_id}/delete', [BookmarkController::class, 'delete'])->name('bookmark.delete');

    Route::get('/notifications', [AdminNotificationsController::class, 'index'])->name('notifications');
    Route::get('/notification/create', [AdminNotificationsController::class, 'create'])->name('notification.create');
    Route::post('/notification/store', [AdminNotificationsController::class, 'store'])->name('notification.store');
    Route::get('/notification/{notification_id}', [AdminNotificationsController::class, 'show'])->name('notification.show');
    Route::post('/notification/{notification_id}/send', [AdminNotificationsController::class, 'send'])->name('notification.send');
    Route::post('/notification/{notification_id}/update', [AdminNotificationsController::class, 'update'])->name('notification.update');
    Route::post('/notification/{notification_id}/delete', [AdminNotificationsController::class, 'destroy'])->name('notifications.destroy');

    Route::post('/user/{user_id}/notification/create', [AdminPrivateNotificationsController::class, 'create'])->name('notification.private.create');
    Route::post('/user/{user_id}/notification/store', [AdminPrivateNotificationsController::class, 'store'])->name('notification.private.store');
    Route::post('/notification/{notification_id}/private/update', [AdminPrivateNotificationsController::class, 'update'])->name('notification.private.update');
    Route::post('/notification/{notification_id}/private/delete', [AdminPrivateNotificationsController::class, 'destroy'])->name('notification.private.destroy');

    Route::get('/user/{user_id}/bookmark-create', [BookmarkController::class, 'create'])->name('bookmark.create');
    Route::post('/user/{user_id}/bookmark-store', [BookmarkController::class, 'store'])->name('bookmark.store');

});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';
