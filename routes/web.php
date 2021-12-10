<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('home');
// })->name('dashboard');

Route::get('/',[UserController::class,'viewDashboard'])->name('dashboard');

Auth::routes();

Route::middleware('auth')->group(function () {
    //customer route
    Route::middleware('role:customer')->group(function () {
    Route::get('/user',[UserController::class,'userDataShow']);
    Route::post('updateaccount',[UserController::class,'updateAccount']);
    });
    
    
    // Admin routes
    Route::prefix('admin/')->name('admin.')->group(function() {
        Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    });


    // Vendor routes
    Route::middleware('role:vendor')->group(function () {
        Route::prefix('vendorUser/')->name('vendorUser.')->group(function() {
        Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    });
    
    });
});





Route::View('/vendorReg','vendorView/vendorReg');
Route::View('/admin','admin/mainpage');

