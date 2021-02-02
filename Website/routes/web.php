<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\VerifyRole;

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
    return view('welcome');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/personal-data', [UserController::class, 'getPersonalData'])->name('personal-data')->middleware('auth');

Route::get('/patients', [UserController::class, 'getPatients'])->name('patients')->middleware('auth', VerifyRole::class);

Route::get('/doctors', [UserController::class, 'getDoctors'])->name('doctors')->middleware('auth', VerifyRole::class);

Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('appointments')->middleware('auth', VerifyRole::class);

Route::post('/create-appointment', [AppointmentController::class, 'createAppointment'])->name('create-appointment')->middleware('auth', VerifyRole::class);

Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy-policy');

Route::get('/calender', [CalenderController::class, 'getCalender'])->name('calender')->middleware('auth', VerifyRole::class);


