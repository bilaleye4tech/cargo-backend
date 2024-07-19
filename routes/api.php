<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarRequestsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(CarRequestsController::class)->group(function () {
    Route::get('all', 'allRequests');
    Route::post('create', 'createRequest');
    Route::post('update', 'updateRequest');
    Route::post('view', 'viewRequest');
    Route::post('delete', 'deleteRequest');
    Route::post('search', 'searchRequests');
});

Route::controller(BookingController::class)->group(function () {
    Route::post('bookRide', 'bookRide');
    Route::get('my_bookings', 'myBookings');
    Route::get('past_bookings', 'pastBookings');
    Route::post('delete_booking', 'deleteBooking');
    Route::get('view_booking', 'viewBooking');
    Route::post('update_booking', 'updateBooking');
});
