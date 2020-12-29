<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index() {
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
}
