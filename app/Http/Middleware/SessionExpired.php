<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use Auth;
class SessionExpired
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
        if(Auth::guest()){
            Session::flash('alert-danger',"This account has been disabled. See Registar for info.");
            return redirect('login');
        }
        else{

        
        return $next($request);
        }
    }
}
