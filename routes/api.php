<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;

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
Route::get('/package',[PackageController::class, 'index'])->name('package.index');
Route::get('/category',[CategoryController::class, 'index'])->name('category.index');

Route::group(['middleware' => 'auth:api'], function () {
    
    
    Route::get('/booking',[BookingController::class, 'index'])->name('booking.index');  
    Route::post('/createbooking',[BookingController::class, 'store'])->name('booking');
    Route::get('/get-blocked-date', 'App\Http\Controllers\BookingController@getBlockedDate');

    
    Route::get('/package',[PackageController::class, 'getallpackage'])->name('package.get');
    Route::post('/package',[PackageController::class, 'store'])->name('package.store');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/userdashboard', [UserController::class, 'userdashboard'])->name('userdashboard');
    Route::get('/ratings', [UserController::class, 'index'])->name('ratings');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});


Route::post('submitdata', [InvoiceController::class, 'submitData']);
Route::get('submitdata', [InvoiceController::class, 'submitData']);
// Route::get('/invoice', [InvoiceController::class, 'initiatePayment'])->name('invoice.initiatePayment');
// Route::post('/invoice', [InvoiceController::class, 'initiatePayment'])->name('invoice.initiatePayment');
// Route::post('/invoice/proceedPayment', [InvoiceController::class, 'proceedPayment'])->name('invoice.proceedPayment');
// Route::get('/invoice/verifyPayment', [InvoiceController::class, 'verifyPayment'])->name('invoice.verifypayment');






