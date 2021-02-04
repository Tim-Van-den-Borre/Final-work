<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if($request->user()->role == 'Doctor')
        {
            return redirect()->route('login');
        }

        if($request->user()->role == 'Patient')
        {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
