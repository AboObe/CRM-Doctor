<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'signin']);
/**
 * It working but in this project we don't need it
 */
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resources([
        'doctor' => DoctorController::class,
        'appointment' => AppointmentController::class,
        'user' => UserController::class
    ]);
    
    Route::post('doctor/search', [DoctorController::class, 'search']);
    Route::post('user/profile', [UserController::class, 'profile']);

    Route::post('appointments/future', [AppointmentController::class, 'appointmentsFuture']);
    Route::post('appointments/past', [AppointmentController::class, 'appointmentsPast']);
});



