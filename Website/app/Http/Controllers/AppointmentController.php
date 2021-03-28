<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Appointment;
use App\Models\MedicalHistory;

class AppointmentController extends Controller
{
    public function getAppointments(){

        $patients = DB::table('users')->where('role', 'Patient')->get();

        $appointments = DB::table('appointments')->orderBy('date', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        $histories = DB::table('medical_histories')->get();

        return view('appointments', ['patients' => $patients, 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions, 'histories' => $histories]);
    }

    public function createAppointment(Request $request){
        if(Auth::user()->role == 'Patient'){
            $this->validate($request, [
                'doctor' => 'required',
                'appointmentsReason' => 'required',
                'date' => 'required'
            ]);
            
            $appointment = new Appointment();
            $appointment->patientID = Auth::user()->id;
            $appointment->doctorID =  $request->input('doctor');
            $appointment->reason = $request->input('appointmentsReason');
            $appointment->date = $request->input('date');
    
            $user = DB::table('users')->where('id', $appointment->doctorID)->get();
    
            $appointment->save();
            return redirect()->route('appointments')->with('appointmentalert', $user[0]->name);
        }

        if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor'){
            $this->validate($request, [
                'patient' => 'required',
                'appointmentsReason' => 'required',
                'date' => 'required'
            ]);

            $appointment = new Appointment();
            $appointment->patientID = $request->input('patient');
            $appointment->doctorID = Auth::user()->id; 
            $appointment->reason = $request->input('appointmentsReason');
            $appointment->date = $request->input('date');
    
            $user = DB::table('users')->where('id', $appointment->patientID)->get();
    
            $appointment->save();
            return redirect()->route('appointments')->with('appointmentalert', $user[0]->name);
        }
    }

    public function createMedicalhistory(Request $request){
        $this->validate($request, [
            'appointmentID' => 'required',
            'appointmentsCondition' => 'required',
            'medicalHistoryDate' => 'required'
        ]);

        $history = new MedicalHistory();
        $history->appointmentID = $request->input('appointmentID');
        $history->condition = $request->input('appointmentsCondition');
        $history->date = $request->input('medicalHistoryDate');

        $history->save();

        $appointment = DB::table('appointments')->where('id', $history->appointmentID)->get();

        $user = DB::table('users')->where('id', $appointment[0]->patientID)->get();

        return redirect()->route('appointments')->with('medicalhistoryalert', $user[0]->name);
    }

    public function removeAppointment(Request $request){
        $this->validate($request, [
            'appointmentID' => 'required',
            'patientID' => 'required'
        ]);

        $user = DB::table('users')->where('id', $request->input('patientID'))->get();

        $histories = DB::table('medical_histories')->where('appointmentID', $request->input('appointmentID'))->delete();

        $appointment = DB::table('appointments')->where('id', $request->input('appointmentID'))->delete();

        return redirect()->route('appointments')->with('appointmentRemoved', $user[0]->name);
    }

    public function removeHistory(Request $request){
        $this->validate($request, [
            'historyID' => 'required',
        ]);

        $history = DB::table('medical_histories')->where('id', $request->input('historyID'))->delete();

        return redirect()->route('appointments')->with('historyRemoved', 'removed');
    }
}
