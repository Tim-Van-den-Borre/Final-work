<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\VerifyRoleAdmin;
use App\Http\Middleware\VerifyRoleDoctorOrAdmin;
use App\Http\Middleware\VerifyRolePatient;
use App\Http\Middleware\VerifyRolePatientOrDoctorOrAdmin;

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

// No Auth
Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy-policy');

// Auth
Route::get('/calender', [CalenderController::class, 'getCalender'])->name('calender')->middleware('auth');

Route::get('/personal-data', [UserController::class, 'getPersonalData'])->name('personal-data')->middleware('auth');

// Auth Patient
Route::get('/medical-history', [UserController::class, 'getFile'])->name('medical-history')->middleware('auth', VerifyRolePatient::class);

// Auth Doctor & Admin
Route::get('/patients', [UserController::class, 'getPatients'])->name('patients')->middleware('auth', VerifyRoleDoctorOrAdmin::class);

Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('appointments')->middleware('auth', VerifyRolePatientOrDoctorOrAdmin::class);

Route::post('/create-appointment', [AppointmentController::class, 'createAppointment'])->name('create-appointment')->middleware('auth', VerifyRolePatientOrDoctorOrAdmin::class);

Route::post('/create-medicalhistory', [AppointmentController::class, 'createMedicalhistory'])->name('create-medicalhistory')->middleware('auth', VerifyRolePatientOrDoctorOrAdmin::class);



// Auth Admin
Route::get('/doctors', [UserController::class, 'getDoctors'])->name('doctors')->middleware('auth', VerifyRoleAdmin::class);

Route::get('/privileges', [PrivilegeController::class, 'getPrivileges'])->name('privileges')->middleware('auth', VerifyRoleAdmin::class);

Route::post('/setPrivilege', [PrivilegeController::class, 'setPrivilege'])->name('setPrivilege')->middleware('auth', VerifyRoleAdmin::class);
