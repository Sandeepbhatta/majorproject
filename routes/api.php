<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/register', [UserController::class, 'NewClient'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    

    Route::get('/booking',[BookingController::class, 'index'])->name('booking.index');
    Route::post('/createbooking',[BookingController::class, 'store'])->name('booking');
    
    
    Route::get('/package',[PackageController::class, 'index'])->name('package.index');
    Route::post('/package',[PackageController::class, 'store'])->name('package.store');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/userdashboard', [UserController::class, 'userdashboard'])->name('userdashboard');
});





