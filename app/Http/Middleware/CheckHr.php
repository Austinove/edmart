<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckHr
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if((Auth::user()->userType === "hr") || (Auth::user()->userType === "admin")){
            return $next($request);
        }
        session::flush();
        Auth::logout();
        return redirect("/login")->with('info', 'Account is deactivated');
    }
}
