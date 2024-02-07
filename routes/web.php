<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
//公式ホームページのルーティング
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/staffs', [App\Http\Controllers\UserController::class, 'index'])->name('staffs');
Route::get('/staffs/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('profile'); //オフィシャルで見れるprofile画面のほう
Route::get('/Reservations.Reserve_create', [App\Http\Controllers\ReservationController::class, 'index'])->name('index');
Route::post('/Reservations.Reserve_create', [App\Http\Controllers\ReservationController::class, 'store'])->name('store');
Route::get('/Reservations/Reserve_edit', [App\Http\Controllers\ReservationController::class, 'edit'])->name('Reservations.edit');
Route::post('/Reservations/Reserve_update', [App\Http\Controllers\ReservationController::class, 'update'])->name('Reservations.update');
Route::post('/Reservations/Reserve_destroy', [App\Http\Controllers\ReservationController::class, 'destroy'])->name('Reservations.destroy');
Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses');//一覧読み込むほう

Auth::routes();
Route::middleware('auth')->group(function () {
    // 以下はユーザー
    Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
        Route::get('/admin', 'admin')->name('admin');
        Route::get('/staffs', 'index')->name('staffs');
        Route::get('/staffs/create', 'create')->name('create');
        Route::patch('/staffs/create', 'create')->name('create');
        Route::get('/staffs/edit/{id}', 'edit')->name('edit');
        Route::get('/staffs/profile/{id}', 'show')->name('profile'); //オフィシャルで見れるprofile画面のほう
        Route::patch('/', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/password/{id}', 'showPasswordChangeForm')->name('password');
        Route::patch('/password/change/{id}', 'changePassword')->name('password.change');
        Route::get('/search', 'search')->name('search');
    });
    Route::controller(CourseController::class)->prefix('courses')->group(function () {
        Route::get('/', 'index')->name('courses'); //一覧読み込むほう
        Route::get('/add', 'add')->name('courses.create'); //ボタン用
        Route::post('/add', 'add')->name('courses.create'); //新規作成のほう
        Route::get('/edit/{id}', 'edit')->name('courses.edit');
        Route::post('/edit/{id}', 'update')->name('courses.update');
        Route::delete('/{id}', 'destroy')->name('courses.destroy');
    });
});






