<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Posts:
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}/', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// Comments:
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('posts.comments.store');

// User auth:
Route::get('/register', [AuthController::class,'register'])->name('register'); // register page
Route::post('/register', [AuthController::class,'store']); // submit form

Route::get('/login', [AuthController::class,'login'])->name('login'); // register page
Route::post('/login', [AuthController::class,'authenticate']); // submit form

Route::post('/logout', [AuthController::class,'logout'])->name('logout'); // submit form
