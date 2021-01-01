<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Illuminate\Http\Response;

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

        return view('doctors', ['doctors' => $doctors]);
    }
}
