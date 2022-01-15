<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\DoctorController;
use App\Http\Controllers\WEB\HomeController;
use App\Http\Controllers\WEB\AppointmentController;
use App\Http\Controllers\WEB\UserController;
use App\Http\Controllers\WEB\MediaController;
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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::resources([
            'doctor' => DoctorController::class,
            'appointment' => AppointmentController::class,
            'user' => UserController::class,
        ]);
        Route::get('/Admin', [UserController::class, 'getAdmin'])->name('admin');
        Route::get('/Representative', [UserController::class, 'getRepresentative'])->name('representative');
});
Route::post('upload/file/{folder}', [MediaController::class, 'upload_file'])->name("image.upload");
