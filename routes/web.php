<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;
use App\Models\Post;
use App\Models\Comment;

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



##########################
## dashboard routes  #####
##########################

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/notifications', [DashboardController::class, 'listNotifications'])->middleware('auth')->name('notifications.list');
Route::get('/dashboard/notifications/{id}/read', [DashboardController::class, 'readNotification'])->middleware('auth')->name('notification.read');
Route::get('/dashboard/notifications/readAll', [DashboardController::class, 'readAllNotifications'])->middleware('auth')->name('notification.readAll');


Route::get('/dashboard/posts', [PostController::class, 'list'])->middleware(['auth', 'admin'])->name('dashboard.posts');
Route::get('/dashboard/users', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard.users');
Route::delete('dashboard/user/{user}/delete', [UserController::class, 'delete'])->middleware(['auth'])->name('user.delete');


Route::get('/dashboard/edit-profile', [UserController::class, 'edit_profile'])->middleware(['auth'])->name('user.edit-profile');
// Route::get('/dashboard/edit-password', [UserController::class, 'edit_password'])->middleware(['auth'])->name('user.edit-password');


#########################
#### post routes   ######
#########################

Route::get('/{id?}', [PostController::class, 'index'])->name('post.index');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/store', [PostController::class, 'store'])->name('post.store');


});

Route::prefix('/post')->name('post.')->group(function() {



        Route::get('/{post}/show', [PostController::class, 'show'])->name('show');
       
        Route::group(['middleware' => ['auth']], function () {
            
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::put('/{post}/update', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}/destory', [PostController::class, 'destroy'])->name('destory');
            
        });

});

Route::get('/post/search', [PostController::class, 'search'])->name('post.search');

Route::fallback(function (){
    return view("404");
});