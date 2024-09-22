<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\password;
use App\User;

class AdminController extends Controller
{
  public function adminDashboard(){
   return view('admin.index');
  }

  public function forgetPassword(){
     $newPass="Met#@".mt_rand(1000000, 9999999);
     echo $newPass;
     $hashPassword=password_hash($newPass, PASSWORD_DEFAULT);
     Mail::to(['manishrajora16@gmail.com'])->send(new password($newPass));

     $adminDetails=User::find('1');
     $adminDetails->password=$hashPassword;
     $adminDetails->update();
     return redirect('admin-login');   
  }
}
