<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentUserController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\WardsController;
use App\Http\Controllers\Admin\ExamController;
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

//Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/logout', [AuthController::class, 'logout'])->name('logout.index');
//
//Route::get('/register', [HomeController::class, 'register'])->name('register');
//Route::post('/post-register', [HomeController::class, 'postRegister'])->name('post.register');
//Route::post('/login', [AuthController::class, 'login'])->name('login');
//Route::get('/confirm/{email}', [HomeController::class, 'confirm'])->name('confirm');
//
//Route::middleware('auth')->group(function () {
//    Route::group(['prefix' => 'clients'], function () {
//        Route::get('/profile/{hash}', [HomeController::class, 'profileDetail'])->name('profile.detail');
//        Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('update.profile');
//        Route::get('/download/{file}', [HomeController::class, 'download'])->name('profile.download');
//    });
//
//    // Route phần admin
//
//});
// Route admin
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::post('/login', [MainController::class, 'login'])->name('admin.login');
    Route::get('/logout', [MainController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [MainController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/select-address', [UserController::class, 'selectAddress'])->name('select.address');

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
            Route::get('user-trashout', [UserController::class, 'userTrashOut'])->name('users.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [UserController::class, 'deleteCompletely'])->name('users.delete.completely');
        });

        Route::group(['prefix' => 'student'], function () {
            Route::get('/create', [StudentUserController::class, 'create'])->name('student.create');
            Route::post('/store', [StudentUserController::class, 'store'])->name('student.store');
            Route::get('/edit/{id}', [StudentUserController::class, 'edit'])->name('student.edit');
            Route::post('/update/{id}', [StudentUserController::class, 'update'])->name('student.update');
            Route::get('delete/{id}', [StudentUserController::class, 'delete'])->name('student.delete');
            Route::get('user-trashout', [StudentUserController::class, 'studentTrashOut'])->name('student.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [StudentUserController::class, 'deleteCompletely'])->name('student.delete.completely');
        });

        Route::group(['prefix' => 'question'], function () {
            Route::get('/', [QuestionController::class, 'question'])->name('question.question');
            Route::get('/create', [QuestionController::class, 'create'])->name('question.create');
            Route::post('/store', [QuestionController::class, 'store'])->name('question.store');
            Route::get('/edit', [QuestionController::class, 'edit'])->name('question.edit');
            Route::post('/update/{id}', [QuestionController::class, 'update'])->name('question.update');
            Route::get('delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');
            Route::get('user-trashout', [QuestionController::class, 'userTrashOut'])->name('question.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [QuestionController::class, 'deleteCompletely'])->name('question.delete.completely');
        });

        Route::group(['prefix' => 'exam'], function () {
            Route::get('/', [ExamController::class, 'index'])->name('exam.index');
            Route::get('/create', [ExamController::class, 'create'])->name('exam.create');
            Route::post('/get-question', [ExamController::class, 'getQuestion'])->name('exam.get');
            Route::post('/store', [ExamController::class, 'store'])->name('exam.store');
            Route::get('/edit', [ExamController::class, 'edit'])->name('exam.edit');
            Route::post('/update/{id}', [ExamController::class, 'update'])->name('exam.update');
            Route::post('/detail/{id}', [ExamController::class, 'detail'])->name('exam.detail');
//            Route::get('delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');
//            Route::get('user-trashout', [QuestionController::class, 'userTrashOut'])->name('question.trash');
//            // Delete user completely
//            Route::get('delete-completely/{id}', [QuestionController::class, 'deleteCompletely'])->name('question.delete.completely');
        });

        Route::group(['prefix' => 'answers'], function () {
            Route::get('/', [AnswerController::class, 'index'])->name('answers.index');
            Route::get('/create', [AnswerController::class, 'create'])->name('answers.create');
            Route::post('/store', [AnswerController::class, 'store'])->name('answers.store');
            Route::get('/edit', [AnswerController::class, 'edit'])->name('answers.edit');
            Route::post('/update/{id}', [AnswerController::class, 'update'])->name('answers.update');
            Route::get('delete/{id}', [AnswerController::class, 'delete'])->name('answers.delete');
            Route::get('user-trashout', [AnswerController::class, 'answersTrashOut'])->name('answers.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [AnswerController::class, 'deleteCompletely'])->name('answers.delete.completely');
        });

        Route::group(['prefix' => 'province'], function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
            Route::get('/create', [ProvinceController::class, 'create'])->name('province.create');
            Route::post('/store', [ProvinceController::class, 'store'])->name('province.store');
            Route::get('/edit', [ProvinceController::class, 'edit'])->name('province.edit');
            Route::post('/update/{id}', [ProvinceController::class, 'update'])->name('province.update');
            Route::get('delete/{id}', [ProvinceController::class, 'delete'])->name('province.delete');
            Route::get('user-trashout', [ProvinceController::class, 'provinceTrashOut'])->name('province.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [ProvinceController::class, 'deleteCompletely'])->name('province.delete.completely');
        });

        Route::group(['prefix' => 'district'], function () {
            Route::get('/', [DistrictController::class, 'index'])->name('district.index');
            Route::get('/create', [DistrictController::class, 'create'])->name('district.create');
            Route::post('/store', [DistrictController::class, 'store'])->name('district.store');
            Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
            Route::post('/update/{id}', [DistrictController::class, 'update'])->name('district.update');
            Route::get('delete/{id}', [DistrictController::class, 'delete'])->name('district.delete');
            Route::get('district-trashout', [DistrictController::class, 'districtTrashOut'])->name('district.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [DistrictController::class, 'deleteCompletely'])->name('district.delete.completely');
        });

        Route::group(['prefix' => 'wards'], function () {
            Route::get('/', [WardsController::class, 'index'])->name('wards.index');
            Route::get('/create', [WardsController::class, 'create'])->name('wards.create');
            Route::post('/store', [WardsController::class, 'store'])->name('wards.store');
            Route::get('/edit/{id}', [WardsController::class, 'edit'])->name('wards.edit');
            Route::post('/update/{id}', [WardsController::class, 'update'])->name('wards.update');
            Route::get('delete/{id}', [WardsController::class, 'delete'])->name('wards.delete');
            Route::get('wards-trashout', [WardsController::class, 'wardsTrashOut'])->name('wards.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', [WardsController::class, 'deleteCompletely'])->name('wards.delete.completely');
        });
    });
    // Route phần admin
});
