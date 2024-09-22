<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Validator;
use App\User;
use Hash;
use Auth;
use Session;

class AdminLoginController extends Controller
{       
        public function index(){
        return view('admin.login');
	    }

        public function checklogin(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:60|min:3',
            'password' => 'required|min:8|max:16'
        ]);

   $credentials = $request->only('email','password');

  if(Auth::attempt($credentials)){

            if(Auth::user()->role_id == 1)
            {

             // print_r(Auth::user()->id);
             // die;

                if($request->has('remember'))
                {
                    $hour = time() + 3600 * 24 * 30;
                    Cookie::queue('email',$request->email, $hour);
                    Cookie::queue('password',$request->password, $hour);
                    Cookie::queue('remember',1, $hour);
                }
               //echo"Login Success"; 
                return redirect('admin-dashboard');
                //return view('admin.index');

            }else{
                Session::flush();
                Auth::logout();
                return redirect()->route('admin-login')->withError('You are not authorised to access this page.');
                }                
    }else{
                 return redirect()->route('admin-login')->withError('You have entered invalid credentials');
                }
}

        public function adminLogout(){
                Session::flush();
                Auth::logout();
                return redirect('admin-login');
        }

}
