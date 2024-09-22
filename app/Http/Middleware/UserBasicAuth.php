<?php

namespace App\Http\Middleware;

use Closure;

class UserBasicAuth
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
      

        if(Auth::check()){

            if(auth::user()->role_id == 2){

                
            }else{

                Auth::logout();
                return redirect('/');
            }
        }

        return $next($request);
    }
}
