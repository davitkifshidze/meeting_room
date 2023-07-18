<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoomController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Route::get('/', [AdminAuthController::class, 'show'])->name('login.show');
        Route::get('/login', [AdminAuthController::class, 'show'])->name('login.show');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

        Route::group(['middleware' => 'adminAuth'], function () {

            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');

            Route::get('/room', [RoomController::class, 'index'])->name('room_list');
            Route::get('/room/create', [RoomController::class, 'create'])->name('room_create');
            Route::post('/room/store', [RoomController::class, 'store'])->name('room_store');
            Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('room_edit');
            Route::put('/room/{id}', [RoomController::class, 'update'])->name('room_update');
            Route::delete('/room/{id}', [RoomController::class, 'destroy'])->name('room_delete');

            Route::get('/booking', [BookingController::class, 'index'])->name('booking_list');
            Route::get('/booking/create', [BookingController::class, 'create'])->name('booking_create');
            Route::get('/booking/room_info/{id}', [BookingController::class, 'room_info'])->name('room_info');
            Route::get('/booking/room_booking_info/{id}/{selected_date}', [BookingController::class, 'room_booking_info'])->name('room_booking_info');
            Route::post('/booking/create', [BookingController::class, 'store'])->name('booking_store');
            Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking_update');
            Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking_delete');

        });

    });

});

