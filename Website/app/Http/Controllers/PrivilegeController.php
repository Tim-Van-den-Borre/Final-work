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
        $this->validate($request, [
            'userID' => 'required',
            'role' => 'required'
        ]);

        $user = DB::table('users')->find($request->input('userID'));

        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('privileges')->with('privilegealert', $user[0]->name);
    }
}
