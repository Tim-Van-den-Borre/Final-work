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

        $appointments = DB::table('appointments')->orderBy('date', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        return view('patients', ['patients' => $patients, 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions]);
    }

    public function getDoctors(){
        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $patients = DB::table('users')->where('role', 'Patient')->get();

        return view('doctors', ['doctors' => $doctors, 'patients' => $patients]);
    }

    public function removeDoctor(Request $request){
        $this->validate($request, [
            'doctorID' => 'required',
        ]);

        $appointments = Appointment::where('doctorID', $request->input('doctorID'))->get();

        foreach ($appointments as $appointment){
            MedicalHistory::where('appointmentID', $appointment->id)->get()->each->delete();
        }

        Appointment::where('doctorID', $request->input('doctorID'))->get()->each->delete();

        $user = DB::table('users')->where('id', $request->input('doctorID'))->get();

        DB::table('users')->where('id', $request->input('doctorID'))->delete();

        return redirect()->route('doctors')->with('doctorRemoved', $user[0]->name);
    }

    public function getFile(){
        $patient = DB::table('users')->where('id', Auth::user()->id)->get();

        $appointments = DB::table('appointments')->orderBy('date', 'desc')->get();

        $doctors = DB::table('users')->where('role', 'Doctor')->get();

        $conditions = DB::table('medical_histories')->get();

        return view('medical-history', ['patient' => $patient[0], 'appointments' => $appointments, 'doctors' => $doctors, 'conditions' => $conditions]);
    }

    public function setPrivilege(Request $request){
        $this->validate($request, [
            'userID' => 'required',
            'role' => 'required'
        ]);

        error_log("hello");

        $user = DB::table('users')->where('id', $request->input('userID'))->get();

        error_log($user);

        error_log("sssssssssssssssssssssssssssssssssssssss"+$request->input('userID'));

        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('privileges')->with('privilegealert', $user[0]->name);
    }

    public function registerDoctor(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed', new ValidatePasswordExistence],
            'role' => ['string'],
            'birthdate' => ['required', 'date'],
            'phonenumber' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'Doctor',
            'birthdate' => $request->input('birthdate'),
            'phonenumber' => $request->input('phonenumber'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('doctors')->with('doctorCreated', $user->name);
    }
}
