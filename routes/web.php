<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RatingsController;
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


//package route
Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
Route::post('/category',[CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}',[CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}',[CategoryController::class, 'destroy'])->name('category.destroy');
// Route::get('/search/{category}', [CategoryController::class, 'search'])->name('category.search');


Route::get('/invoice',[InvoiceController::class, 'Index'])->name('invoice.payment');
Route::post('/khalti/payment/verify',[InvoiceController::class, 'verifyPayment'])->name('khalti.verifyPayment');
Route::post('/khalti/payment/store',[InvoiceController::class, 'storePayment'])->name('khalti.storePayment');



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

Route::get('/ratings/create', [RatingsController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingsController::class, 'store'])->name('ratings.store');
Route::match(['GET','POST'],'/addRating', [RatingsController::class, 'add'])->name('ratings.add');

Route::delete('/ratings/{rating}',[PackageController::class, 'destroy'])->name('ratings.destroy');



/*---------------rating route ends--------------*/




require __DIR__.'/auth.php';
