<?php

namespace App\Http\Middleware;

use Closure;

class UserLoginAuth
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
            
            //return redirect('admin-login');
            return redirect()->back();
        }else{

            if(Auth::user()->role_id != 2){

                return redirect()->back();
            }

            return $next($request);
        }
    }



}
