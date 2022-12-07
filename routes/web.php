<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.index');

Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/post-register', [HomeController::class, 'postRegister'])->name('post.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/confirm/{email}', [HomeController::class, 'confirm'])->name('confirm');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/profile/{hash}', [HomeController::class, 'profileDetail'])->name('profile.detail');
        Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('update.profile');
        Route::get('/download/{file}', [HomeController::class, 'download'])->name('profile.download');
    });

    // Route phần admin

});
// Route admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::post('/login', [MainController::class, 'login'])->name('admin.login');
    Route::get('/logout', [MainController::class, 'logout'])->name('admin.logout');

});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [MainController::class, 'dashboard'])->name('admin.dashboard');

        Route::group(['prefix' => 'users'], function () {
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
            Route::get('user-trashout', [UserController::class, 'userTrashOut'])->name('users.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [UserController::class, 'deleteCompletely'])->name('users.delete.completely');
        });

        Route::group(['prefix' => 'exam'], function () {
            Route::get('/', [QuestionController::class, 'question'])->name('exam.question');
            Route::get('/create', [QuestionController::class, 'create'])->name('question.create');
            Route::post('/store', [QuestionController::class, 'store'])->name('question.store');
            Route::get('/edit', [QuestionController::class, 'edit'])->name('question.edit');
            Route::post('/update/{id}', [QuestionController::class, 'update'])->name('question.update');
            Route::get('delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');
            Route::get('user-trashout', [QuestionController::class, 'userTrashOut'])->name('question.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [QuestionController::class, 'deleteCompletely'])->name('question.delete.completely');
        });
    });

    // Route phần admin

});
