<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/apitest',[ApiController::class, 'apitest'])->name('apitest');
Route::get('/login',[AdminController::class, 'Index'])->name('login_form');   
Route::get('/register',[AdminController::class, 'Register'])->name('admin.register');




Route::get('/booking',[BookingController::class, 'index'])->name('booking.index');
Route::post('/booking',[BookingController::class, 'store'])->name('booking.store');


Route::get('/package',[PackageController::class, 'index'])->name('package.index');
Route::post('/package',[PackageController::class, 'store'])->name('package.store');



