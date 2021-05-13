<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\MedicalHistory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Carbon\Carbon;
use Laravel\Fortify\Rules\Password;
use App\Rules\ValidatePasswordExistence;

class UserController extends Controller
{
    public function getPersonalData() {
        $user = DB::table('users')->where('name', Auth::user()->name)->first();
        $jsonData = json_encode($user);

        $file = "userdata.json";
        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, $jsonData);
        fclose($txt);

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 1');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);
        unlink($file);
    }

    public function getPatients(){
        $patients = DB::table('users')->where('role', 'Patient')->get();

        $appointments = DB::table('appointments')->orderBy('startDate', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        return view('patients', ['patients' => $patients, 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions]);
    }

    public function getUsers(){
        $users = DB::table('users')->get();

        return view('users', ['users' => $users]);
    }

    public function removeUser(Request $request){
        $this->validate($request, [
            'userID' => 'required',
            'userRole' => 'required'
        ]);

        $user = DB::table('users')->where('id', $request->input('userID'))->get();

        if($request->input('userRole') == 'Patient'){
            $appointments = Appointment::where('patientID', $request->input('userID'))->get();

            foreach ($appointments as $appointment){
                MedicalHistory::where('appointmentID', $appointment->id)->get()->each->delete();
            }
    
            Appointment::where('patientID', $request->input('userID'))->get()->each->delete();
    
            DB::table('users')->where('id', $request->input('userID'))->delete();
        }

        if($request->input('userRole') == 'Doctor'){
            $appointments = Appointment::where('doctorID', $request->input('userID'))->get();

            foreach ($appointments as $appointment){
                MedicalHistory::where('appointmentID', $appointment->id)->get()->each->delete();
            }
    
            Appointment::where('doctorID', $request->input('userID'))->get()->each->delete();
    
            DB::table('users')->where('id', $request->input('userID'))->delete();
        }

        if($request->input('userRole') == 'Admin'){
    
            DB::table('users')->where('id', $request->input('userID'))->delete();
        }

        return redirect()->route('users')->with('userRemoved', $user[0]->name);
    }

    public function getFile(){
        $patient = DB::table('users')->where('id', Auth::user()->id)->get();

        $appointments = DB::table('appointments')->orderBy('startDate', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        return view('medical-history', ['patient' => $patient[0], 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions]);
    }

    public function setPrivilege(Request $request){
        $this->validate($request, [
            'userID' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($request->input('userID'));

        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('users')->with('privilegealert', $user->name);
    }

    public function registerUser(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed', new ValidatePasswordExistence],
            'role' => ['string'],
            'birthdate' => ['required', 'date'],
            'phonenumber' => ['required'],
            'role' => ['required']
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'birthdate' => $request->input('birthdate'),
            'phonenumber' => $request->input('phonenumber'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('users')->with('userCreated', $user->name);
    }

    public function validateChatbotData(Request $request){

        $data = json_decode($request->getContent());

        if (!empty($data->Data->doctor)){
            $response = DB::table('users')->where('name','LIKE','%'.$data->Data->doctor.'%')->get();
            if(empty($response)){
                $data->Data->doctor = "NOT FOUND";
            }
        }
        if (!empty($data->Data->date)){
            $data->Data->date = date("Y-m-d",strtotime(trim($data->Data->date)));
        }
        if (!empty($data->Data->time)){
            if (str_contains(strtolower($data->Data->time), "am")){
                $data->Data->time = str_replace("am", "", strtolower($data->Data->time));
                $data->Data->time = date('h:i:s', $data->Data->time);
            }
    
            if (str_contains(strtolower($data->Data->time), "pm")){
                $data->Data->time = str_replace("pm", "", strtolower($data->Data->time));
                $data->Data->time = intval($data->Data->time);
                if ($data->Data->time <= 12){
                    $data->Data->time += 12;
                }
            }
        }
        return response()->json($data->Data);
    }
} 
