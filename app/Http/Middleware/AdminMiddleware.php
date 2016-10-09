<?php 
namespace App\Http\Middleware;




 use Auth;
 use Closure;
 class AdminMiddleware
{
     /* Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest()){
            return redirect('home');
        }
        else if(!Auth::user()->isAdmin)
        {
            return redirect('unauthorized');
        }
        else
        {
        return $next($request);
        }    
    }

}
