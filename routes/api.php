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
use App\Http\Controllers\CustomizePackageController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ArEventNavigationController;

use App\Http\Controllers\RefundController;

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
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
    Route::post('refund/{booking_id}', 'RefundController@initiateRefund')->name('refund.initiate');
    Route::get('/refunds', [RefundController::class, 'displayRefunds'])->name('refunds.displayRefunds');
    
    
    
    
    Route::get('/package',[PackageController::class, 'getallpackage'])->name('package.get');
    Route::post('/package',[PackageController::class, 'store'])->name('package.store');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/userdashboard', [UserController::class, 'userdashboard'])->name('userdashboard');
    Route::get('/ratings', [UserController::class, 'index'])->name('ratings');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::post('submitdata', [InvoiceController::class, 'submitData']);
    Route::get('submitdata', [InvoiceController::class, 'submitData']);
    Route::get('/customizepackages', [CustomizePackageController::class, 'index']);
    Route::post('/customizepackages', [CustomizePackageController::class, 'store']);
    
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/download', [AttendanceController::class, 'downloadCsv'])->name('attendance.download');
    Route::post('attendance/store',[AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('ar_event_navigation', [ArEventNavigationController::class, 'index'])->name('ar_event_navigation.index');
    Route::get('ar_event_navigation/create', [ArEventNavigationController::class, 'create'])->name('ar_event_navigation.create');
    Route::post('ar_event_navigation/store', [ArEventNavigationController::class, 'store'])->name('ar_event_navigation.store');
});

// Route::post('refund/{booking_id}', 'RefundController@initiateRefund')->name('refund.initiate');



// Route::get('/invoice', [InvoiceController::class, 'initiatePayment'])->name('invoice.initiatePayment');
// Route::post('/invoice', [InvoiceController::class, 'initiatePayment'])->name('invoice.initiatePayment');
// Route::post('/invoice/proceedPayment', [InvoiceController::class, 'proceedPayment'])->name('invoice.proceedPayment');
// Route::get('/invoice/verifyPayment', [InvoiceController::class, 'verifyPayment'])->name('invoice.verifypayment');







