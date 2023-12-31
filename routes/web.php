<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CustomizePackageController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\ArEventNavigationController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Admin;



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



/*---------------superadmin route--------------*/
Route::get('/',[AdminController::class, 'Index']);
// 
Route::prefix('admin')->group(function(){
    

    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'Logout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'Register'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'RegisterCreate'])->name('admin.register.create');
    
    Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create',[AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin',[AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{admin}/edit',[AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{admin}',[AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{admin}',[AdminController::class, 'destroy'])->name('admin.destroy');

    //category route

});


/*---------------User route--------------*/
Route::get('/users', [UserController::class, 'index'])->name('users.index');


/*---------------User route--------------*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//booking route
Route::get('/booking',[BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/create',[BookingController::class, 'create'])->name('booking.create');
Route::post('/booking',[BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/edit',[BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{booking}',[BookingController::class, 'update'])->name('booking.update');
Route::delete('/booking/{booking}',[BookingController::class, 'destroy'])->name('booking.destroy');
// Route::post('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
Route::post('refund/{booking_id}', 'RefundController@initiateRefund')->name('refund.initiate');




//package route
Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
Route::post('/category',[CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}',[CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}',[CategoryController::class, 'destroy'])->name('category.destroy');
// Route::get('/search/{category}', [CategoryController::class, 'search'])->name('category.search');


// Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
// Route::get('/invoice', [InvoiceController::class, 'initiatePayment'])->name('invoice.initiatePayment');
// Route::post('/invoice/initiate', [InvoiceController::class, 'initiateinvoice']);
// Route::post('/invoice/webhook', [InvoiceController::class, 'khaltiWebhook']);
// Route::get('/invoice', function () {
    // Retrieve the invoice data (if it exists) and pass it to the view
//     $invoiceData = session('invoiceData');
//     return view('invoice.payment', compact('invoiceData',));   
// })->name('invoice.payment');
Route::get('/invoice', [InvoiceController::class, 'payment'])->name('invoice.payment');

Route::post('/submitdata', [InvoiceController::class, 'submitData']);




/*---------------mail route--------------*/


Route::get('/send',[MailController::class,'index']);

/*---------------mail route ends--------------*/


//category route
Route::get('/package',[PackageController::class, 'index'])->name('package.index');
Route::get('/package/create',[PackageController::class, 'create'])->name('package.create');
Route::post('/package',[PackageController::class, 'store'])->name('package.store');
Route::get('/package/{package}/edit',[PackageController::class, 'edit'])->name('package.edit');
Route::put('/package/{package}',[PackageController::class, 'update'])->name('package.update');
Route::delete('/package/{package}',[PackageController::class, 'destroy'])->name('package.destroy');
// Route::get('/search/{package}', [PackageController::class, 'search'])->name('package.search');

//category route ends

/*---------------rating route --------------*/
Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
Route::middleware('admin')->post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::get('/customizepackages', [CustomizePackageController::class, 'index'])->name('customizePackages.index');
Route::post('/customizepackages', [CustomizePackageController::class, 'store']);
Route::delete('/customizepackages',[PackageController::class, 'destroy'])->name('customizePackages.destroy');

Route::get('/refunds', [RefundController::class, 'displayRefunds'])->name('refunds.displayRefunds');



Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('attendance/download', [AttendanceController::class, 'downloadCsv'])->name('attendance.download');

Route::post('attendance/store',[AttendanceController::class, 'store'])->name('attendance.store');



// routes/web.php


Route::get('/ar_event_navigation', [ArEventNavigationController::class, 'index'])->name('ar_event_navigation.index');
Route::get('/ar_event_navigation/create', [ArEventNavigationController::class, 'create'])->name('ar_event_navigation.create');
Route::post('ar_event_navigation/store', [ArEventNavigationController::class, 'store'])->name('ar_event_navigation.store');
Route::post('ar_event_navigation/{areventnavigation}', [ArEventNavigationController::class, 'destory'])->name('ar_event_navigation.destory');

/*---------------rating route ends--------------*/








require __DIR__.'/auth.php';
