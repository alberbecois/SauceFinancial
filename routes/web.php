<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;

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

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Login/Logout
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::middleware(['throttle:login'])->group(function(){
    Route::post('/login', [LoginController::class, 'authenticate']);
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [RegistrationController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegistrationController::class, 'store']);

// Users
Route::put('/user', [UserController::class, 'update'])->name('update');

// Transfers
Route::post('/transfer', [TransferController::class, 'create'])->name('transfer');
Route::put('/transfer', [TransferController::class, 'update']);

Route::get('/', function () {
    return view('home');
})->name('home');
