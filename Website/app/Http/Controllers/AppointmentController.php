<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function getAppointments(){

        $patients = DB::table('users')->where('role', 'Patient')->get();

        $appointments = DB::table('appointments')->orderBy('date', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        return view('appointments', ['patients' => $patients, 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions]);
    }

    public function createAppointment(Request $request){

        $this->validate($request, [
            'patient' => 'required',
            'reason' => 'required',
            'date' => 'required'
        ]);

        $appointment = new Appointment();
        $appointment->patientID = $request->input('patient');
        $appointment->doctorID = Auth::user()->id; 
        $appointment->reason = $request->input('reason');
        $appointment->date = $request->input('date');

        $appointment->save();
        return redirect()->route('appointments');
    }
}
