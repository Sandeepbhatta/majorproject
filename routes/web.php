<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\bookingController;
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
Route::get('/',[AdminController::class, 'Index'])->name('login_form');
// 
Route::prefix('admin')->group(function(){
    

    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'Logout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'Register'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'RegisterCreate'])->name('admin.register.create');

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

Route::get('/booking',[BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/create',[BookingController::class, 'create'])->name('booking.create');
Route::post('/booking',[BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/edit',[BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{booking}',[BookingController::class, 'update'])->name('booking.update');
Route::delete('/booking/{booking}',[BookingController::class, 'destroy'])->name('booking.destroy');





require __DIR__.'/auth.php';
