<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\FuelController;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }

});

Route::group(['middleware' => ['auth', 'verifyOTP']], function(){

Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');


//Driver routes
Route::view('vehicle-driver','driver.driver')->name('vehicle-driver');

Route::get('/driver/list',[DriverController::class, 'getdrivers'])->name('driver.list');

Route::post('addDriver',[DriverController::class, 'addDriver'])->name('addDriver');

Route::post('update-Driver',[DriverController::class, 'updateDriver'])->name('update-Driver');

Route::get('delete-Driver/{email}',[DriverController::class, 'deleteDriver'])->name('delete-Driver');
Route::get('find-user/{id}',[DriverController::class, 'finduser'])->name('find-user');
Route::get('find-driver/{id}',[DriverController::class, 'finddriver'])->name('find-driver');

//end driver routes

//start vehicles routes
Route::view('vehicle','vehicle.vehicle')->name('vehicle');

Route::post('/vehicle/list',[VehicleController::class, 'getvehicles'])->name('vehicle-list');

Route::post('addVehicle',[VehicleController::class, 'addVehicle'])->name('addVehicle');

Route::post('updateVehicle/{id}',[VehicleController::class, 'updateVehicle'])->name('updateVehicle');

Route::get('deleteVehicle/{id}',[VehicleController::class, 'deleteVehicle'])->name('deleteVehicle');

Route::get('assiged-vehicle',[VehicleController::class, 'assigned'])->name('assiged-vehicle');

Route::post('addAssigned',[VehicleController::class, 'addAssigned'])->name('addAssigned');

Route::post('updateAssigned/{id}',[VehicleController::class, 'updateAssigned'])->name('updateAssigned');

Route::get('deleteAssigned/{id}',[VehicleController::class, 'deleteAssigned'])->name('deleteAssigned');

Route::get('assig-history',[VehicleController::class, 'assigedhistory'])->name('assig-history');

//End vehicles routes

Route::get('issue',[IssueController::class, 'issue'])->name('issue');

Route::post('addIssue',[IssueController::class, 'addIssue'])->name('addIssue');

Route::post('updateIssue/{id}',[IssueController::class, 'updateIssue'])->name('updateIssue');

Route::get('deleteIssue/{id}',[IssueController::class, 'deleteIssue'])->name('deleteIssue');

Route::get('fuel-Entry',[FuelController::class, 'fuelEntry'])->name('fuel-Entry');

Route::post('addFuel',[FuelController::class, 'addFuel'])->name('addFuel');

Route::post('updateFuel/{id}',[FuelController::class, 'updateFuel'])->name('updateFuel');

Route::get('deleteFuel/{id}',[FuelController::class, 'deleteFuel'])->name('deleteFuel');

Route::get('councillors',[VehicleController::class, 'councillors'])->name('councillors');

//
Route::post('image/update',[RegisterUserController::class, 'profile_image'])->name('image/update');
Route::post('signature',[RegisterUserController::class, 'signature'])->name('signature');
Route::get('profile',[DashboardController::class, 'profile'])->name('profile');

});

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
