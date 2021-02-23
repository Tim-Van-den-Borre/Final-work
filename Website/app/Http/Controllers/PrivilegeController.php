<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PrivilegeController extends Controller
{
    public function getPrivileges(){

        $users = DB::table('users')->orderBy('role', 'asc')->get();

        return view('privileges', ['users' => $users]);
    }

    public function setPrivilege(Request $request){

    }
}
