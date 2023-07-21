<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Tablet\TabletController;
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

            Route::get('/role', [RolesController::class, 'index'])->name('role_list');
            Route::get('/role/create', [RolesController::class, 'create'])->name('role_create');
            Route::post('/role/store', [RolesController::class, 'store'])->name('role_store');
            Route::get('/role/{id}/edit', [RolesController::class, 'edit'])->name('role_edit');
            Route::put('/role/{id}', [RolesController::class, 'update'])->name('role_update');
            Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('role_delete');
            Route::get('/role/user_list', [RolesController::class, 'user_list'])->name('user_list');
            Route::get('/role/{id}/user_role', [RolesController::class, 'user_role'])->name('user_role');
            Route::put('/role/{id}/user_role_add', [RolesController::class, 'user_role_add'])->name('user_role_add');

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
            Route::post('/booking/store', [BookingController::class, 'store'])->name('booking_store');
            Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking_edit');
            Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking_update');
            Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking_delete');

        });

    });


    Route::group(['prefix' => 'tablet', 'namespace' => 'Tablet'], function () {

        Route::group(['prefix' => '{room_id}'], function () {
            Route::get('/', [TabletController::class, 'index'])->name('tablet_index');

            Route::get('room_info', [TabletController::class, 'room_info'])->name('tablet_room_info');
            Route::get('room_booking_info/{selected_date}', [TabletController::class, 'room_booking_info'])->name('tablet_room_booking_info');
            Route::post('store', [TabletController::class, 'store'])->name('tablet_booking');

        });

    });





});

