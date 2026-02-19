<?php

use App\Http\Controllers\admin\BookingController as AdminBookingController;
use App\Http\Controllers\admin\RoomTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\front\BookingController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\front\DashboardController as FrontDashboardController;
use App\Http\Controllers\front\RoomController as FrontRoomController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });

// user
Route::get('/room-details/{id}', [FrontRoomController::class, 'roomDetails'])->name('room.details');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.view');
Route::get('/room-page', [FrontRoomController::class, 'roomPage'])->name('rooms.view');
Route::get('/search-rooms', [FrontRoomController::class, 'searchRooms'])->name('search.rooms');
Route::post('send-message', [ContactController::class, 'message'])->name('send.message');
Route::post('/store-booking/{id}', [BookingController::class, 'confirmBook'])->name('store.booking');

Route::group(['prefix' => 'account'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [LoginController::class, 'login'])->name('account.login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->middleware('rate.limit')
        ->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function() {
        //user
        Route::get('dashboard', [FrontDashboardController::class, 'userDashboard'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

Route::group(['prefix' => 'manager'], function() {
    Route::group(['middleware' => 'admin.guest'], function() {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function() {
        //admin
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.view');
        Route::get('bookings', [AdminBookingController::class, 'bookings'])->name('bookings.view');
        Route::get('messages', [MessageController::class, 'index'])->name('message.view');
        Route::get('create-email/{id}', [MessageController::class, 'email'])->name('email.view');
        Route::post('send-email/{id}', [MessageController::class, 'send'])->name('send.email');
        Route::get('delete-booking/{id}', [AdminBookingController::class, 'destroy'])->name('booking.delete');
        Route::get('admin-logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('rooms', [RoomTypeController::class, 'index'])->name('rooms.types');
        Route::post('store-room', [RoomTypeController::class, 'store'])->name('room-type.store');
        Route::get('get-room', [RoomTypeController::class, 'show'])->name('room-type.get');
        Route::get('edit-room', [RoomTypeController::class, 'edit'])->name('room-type.edit');
        Route::post('update-room', [RoomTypeController::class, 'update'])->name('room-type.update');
        Route::post('delete-room', [RoomTypeController::class, 'delete'])->name('room-type.delete');
        Route::get('trashed-room', [RoomTypeController::class, 'trash'])->name('room-type.trash');
        Route::post('restore-room', [RoomTypeController::class, 'restore'])->name('room-type.restore');
        Route::post('force-delete-room', [RoomTypeController::class, 'forceDelete'])->name('room-type.forceDelete');
        Route::get('room-trash-count', [RoomTypeController::class, 'trashCount'])->name('room-type.trash.count');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home.view');



