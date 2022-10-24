<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->route('dashboard');
});

Route::group(['middleware' => ['auth', 'verifyOTP']], function(){
    // Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
});
Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('passwordCreate/{id}/{token}',[RegisterUserController::class, 'passwordCreate'])->name('passwordCreate');
Route::post('password/{id}',[RegisterUserController::class, 'password'])->name('password');
// Route::get('register',[RegisterUserController::class, 'create'])->name('register');
// Route::post('register/store',[RegisterUserController::class, 'store'])->name('register/store');
Route::get('login',[LoginController::class, 'create'])->name('login');
Route::get('verify',[LoginController::class, 'verify'])->name('verify');
Route::get('reverify',[LoginController::class, 'resendOTP'])->name('reverify');
Route::post('verification',[LoginController::class, 'verifyOTP'])->name('verification');
Route::post('loginStore',[LoginController::class, 'authenticate'])->name('loginStore');
Route::get('Logout',[LoginController::class, 'logout'])->name('Logout');

Route::get('/forgetPassword',[ForgotPasswordController::class,'getEmail'])->name('forgetPassword');
Route::get('/forget-password',[ForgotPasswordController::class,'postEmail'])->name('forget-password');

Route::get('/resetPassword/{id}/{token}', [ResetPasswordController::class,'getPassword'])->name('resetPassword');
Route::post('/reset-password',  [ResetPasswordController::class,'updatePassword'])->name('reset-Password');

Route::post('/reset-PasswordByUser',  [ResetPasswordController::class,'updatePasswordbyUser'])->name('reset-PasswordByUser');
