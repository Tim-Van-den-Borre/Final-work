<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Appointment;
use App\Models\MedicalHistory;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentRemoved;
use App\Mail\AppointmentUpdated;


class AppointmentController extends Controller
{
    public function getAppointments(){

        $patients = DB::table('users')->where('role', 'Patient')->get();

        $today = new DateTime();

        $appointments = DB::table('appointments')->where('startDate', '>=', $today)->orderBy('startDate', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $histories = DB::table('medical_histories')->get();

        return view('appointments', ['patients' => $patients, 'appointments' => $appointments, 'doctors' => $doctors, 'histories' => $histories]);
    }

    public function chatbotCreateAppointment(Request $request){

        $data = json_decode($request->getContent());

        $response = DB::table('users')->where('name','LIKE','%'.$data->Data->doctor.'%')->get();

        $doctor = $response[0]->id;

        if (date("Y-m-d",strtotime(trim($data->Data->time))))
        {
            $data->Data->time = substr($data->Data->time, -2);
        }

        $startdate = date("Y-m-d",strtotime(trim($data->Data->date))) . " " . $data->Data->time . ":00:00";

        $enddate = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($startdate)));

        $appointment = new Appointment();
        $appointment->patientID = $data->Data->patient;
        $appointment->doctorID =  $doctor;
        $appointment->reason = $data->Data->reason; 
        $appointment->startDate = $startdate;
        $appointment->endDate = $enddate;

        $appointment->save();

        $user = DB::table('users')->where('id', $appointment->doctorID)->get();

        Mail::to(Auth::user()->email)->send(new AppointmentCreated($appointment, $user));

        return response("ok", 200);
    }

    public function createAppointment(Request $request){        
        if(Auth::user()->role == 'Patient'){
            $this->validate($request, [
                'doctor' => 'required',
                'appointmentsReason' => 'required',
                'startDate' => 'required|date',
                'time' => 'required',                
            ]);

            $starttime = date("Y-m-d",strtotime(trim($request->input('startDate')))) . " " . $request->input('time');
            $endtime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($starttime)));
            
            $appointment = new Appointment();
            $appointment->patientID = Auth::user()->id;
            $appointment->doctorID =  $request->input('doctor');
            $appointment->reason = $request->input('appointmentsReason'); 
            $appointment->startDate = $starttime;
            $appointment->endDate = $endtime;
    
            $user = DB::table('users')->where('id', $appointment->doctorID)->get();
    
            $appointment->save();
            
            Mail::to(Auth::user()->email)->send(new AppointmentCreated($appointment, $user));

            return redirect()->route('appointments')->with('appointmentalert', $user[0]->name);
        }

        if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor'){
            $this->validate($request, [
                'patient' => 'required',
                'appointmentsReason' => 'required',
                'startDate' => 'required|date',
                'time' => 'required',                
            ]);

            $starttime = date("Y-m-d",strtotime(trim($request->input('startDate')))) . " " . $request->input('time');
            $endtime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($starttime)));
            
            $appointment = new Appointment();
            $appointment->patientID = $request->input('patient');
            $appointment->doctorID =  Auth::user()->id;
            $appointment->reason = $request->input('appointmentsReason'); 
            $appointment->startDate = $starttime;
            $appointment->endDate = $endtime;
    
            $patient = DB::table('users')->where('id', $appointment->patientID)->get();
            $user = DB::table('users')->where('id', $appointment->doctorID)->get();
            $appointment->save();

            Mail::to($patient[0]->email)->send(new AppointmentCreated($appointment, $user));
            
            return redirect()->route('appointments')->with('appointmentalert', $patient[0]->name);
        }
    }

    public function createMedicalhistory(Request $request){
        $this->validate($request, [
            'appointmentID' => 'required',
            'appointmentsCondition' => 'required',
        ]);

        $history = new MedicalHistory();
        $history->appointmentID = $request->input('appointmentID');
        $history->condition = $request->input('appointmentsCondition');
        $history->date = date("Y-m-d H:i");

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

        $patient = DB::table('users')->where('id', $request->input('patientID'))->get();

        $histories = DB::table('medical_histories')->where('appointmentID', $request->input('appointmentID'))->delete();

        $appointment = DB::table('appointments')->where('id', $request->input('appointmentID'))->delete();

        $user = DB::table('users')->where('id', Auth::user()->id)->get();

        Mail::to($patient[0]->email)->send(new AppointmentRemoved($user));

        return redirect()->route('appointments')->with('appointmentRemoved', $patient[0]->name);
    }

    public function removeHistory(Request $request){
        $this->validate($request, [
            'historyID' => 'required',
        ]);

        $history = DB::table('medical_histories')->where('id', $request->input('historyID'))->delete();

        return redirect()->route('appointments')->with('historyRemoved', 'removed');
    }

    public function editAppointment(Request $request){
        $this->validate($request, [
            'appointmentID' => 'required',
            'appointmentsReason' => 'required',
            'startDate' => 'required|date',
            'time' => 'required',  
        ]);

        $starttime = date("Y-m-d",strtotime(trim($request->input('startDate')))) . " " . $request->input('time');
        $endtime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($starttime)));

        $appointment = Appointment::find($request->input('appointmentID'));
        $appointment->doctorID = Auth::user()->id; 
        $appointment->reason = $request->input('appointmentsReason');
        $appointment->startDate = $starttime;
        $appointment->endDate = $endtime;

        $patient = DB::table('users')->where('id', $appointment->patientID)->get();

        $user = DB::table('users')->where('id', $appointment->doctorID)->get();

        $appointment->save();

        Mail::to($patient[0]->email)->send(new AppointmentUpdated($appointment, $user));

        return redirect()->route('appointments')->with('editappointmentalert', $patient[0]->name);
    }
}
