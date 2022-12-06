<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\HomeController;
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

    // Route phần users
});
