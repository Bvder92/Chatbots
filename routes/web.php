<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatBotTestController;
use App\Http\Controllers\ChatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Dashboard & Feed
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

// Posts:
Route::group(['prefix' => 'posts/', 'as' => 'posts.'], function () {
    // Accès libre:
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');

    // Nécéssaire d'être connecté:
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/{id}/edit', [PostController::class, 'edit'])
            ->name('edit')
            ->middleware('auth');
        Route::put('/{id}/', [PostController::class, 'update'])
            ->name('update')
            ->middleware('auth');
        Route::delete('/{id}', [PostController::class, 'destroy'])
            ->name('destroy')
            ->middleware('auth');
    });
});

// Comments:
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])
    ->name('posts.comments.store')
    ->middleware('auth');

// User auth:
Route::get('/register', [AuthController::class, 'register'])->name('register'); // register page
Route::post('/register', [AuthController::class, 'store']); // submit form action

Route::get('/login', [AuthController::class, 'login'])->name('login'); // login page
Route::post('/login', [AuthController::class, 'authenticate']); // login form action

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // logout form action

// UserController:
Route::group(['prefix' => 'users/', 'as' => 'users.', 'middleware' => ['auth']], function () {
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
});

// Abonnements:
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

// Chat:
Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index'])->name('chat.index');
Route::get('/chat/{recipient_id}', [App\Http\Controllers\ChatsController::class, 'chatbox'])->name('chat.chatbox');
Route::get('/messages/{recipient_id}', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
Route::post('/messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
