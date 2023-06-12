<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NadminController;

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
Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'Logout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'Register'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'RegisterCreate'])->name('admin.register.create');


});



/*---------------endadmin route--------------*/


/*--------------Nadmin route--------------*/
Route::prefix('nadmin')->group(function(){

    Route::get('/login',[NadminController::class, 'NadminIndex'])->name('nadmin_login_form');
    Route::get('/dashboard',[NadminController::class, 'NadminDashboard'])->name('nadmin.dashboard');

    Route::post('/login/owner',[NadminController::class, 'NadminLogin'])->name('nadmin.login');
    // Route::get('/dashboard',[NadminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[NadminController::class, 'NadminLogout'])->name('nadmin.logout')->middleware('Nadmin');
    Route::get('/register',[NadminController::class, 'Register'])->name('admin.register');
    Route::post('/register/create',[NadminController::class, 'RegisterCreate'])->name('admin.register.create');


});





/*---------------endNadmin route--------------*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
