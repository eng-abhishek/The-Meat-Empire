<?php
namespace App\Http\Middleware;
use Closure;
use Auth;

class AdminLoginAuth
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
        if (!Auth::check()) {
            
            return redirect('admin-login');

        }else{

            if(Auth::user()->role_id != 1){

                return redirect()->back();
            }

            return $next($request);
        }
    }
}
