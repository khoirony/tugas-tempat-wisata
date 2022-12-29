<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class WithAuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check Login
        if(Auth::user() == []){
            return redirect('/login')->with('loginError', 'Harap login terlebih dahulu');
        }

        // Check Role
        if(Auth::user()->role != 1){
            return back();
        }

        return $next($request);
    }
}
