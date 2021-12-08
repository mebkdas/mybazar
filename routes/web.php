<?php

use App\Http\Controllers\UserController;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/user',[UserController::class,'userDataShow']);
    Route::post('updateaccount',[UserController::class,'updateAccount']);    
});



Route::get('/logout',[UserController::class,'logout']);
Route::middleware(['checkAuth'])->group(function(){
    Route::View('/admin','admin/mainpage');
});