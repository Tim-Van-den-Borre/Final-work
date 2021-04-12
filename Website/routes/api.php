<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/chatbotCreateAppointment', [AppointmentController::class, 'chatbotCreateAppointment'])->name('chatbotCreateAppointment');

Route::get('/chatbotGetData', function (Request $request) {
    session_start();
    $data = array(
        'patient' => $_SESSION["patient"], 
        'doctor' => $_SESSION["doctor"], 
        'reason' => $_SESSION["reason"], 
        'date' => $_SESSION["date"], 
        'hour' => $_SESSION["hour"]);
    return json_encode($data);
});

Route::get('/chatbotGetUserId', function(Request $request){
    session_start();
    return $_SESSION["userID"];
});