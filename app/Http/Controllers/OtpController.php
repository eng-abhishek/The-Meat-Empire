<?php
namespace App\Http\Controllers;
error_reporting(1);
use Illuminate\Http\Request;
use App\Mail\otp;
use App\User;
use Mail;
use Session;

class OtpController extends Controller
{
   public function sendotp(Request $req){

  if($req->chkExistEmail=='1' || session()->get('signup_otp_email')){
     session()->forget('otp_email');
     $existEmail=user::where(['email'=>$req->email,'role_id'=>'2'])->get();
     if($existEmail[0]['id']){
     Session()->flash('signup_err','This Mobile No Already Exist Try Other');
     return redirect('user-login');
     }else{

if($req->email){
 $otpemail=$req->email;
 session()->put('signup_otp_email',$req->email);
}else{
 $otpemail=session()->get('signup_otp_email');   
 }

   session()->put('inputBokEmail',$otpemail);
   $otp = mt_rand(1000, 9999);
   session()->put('otp',$otp);
   
      $otp = mt_rand(1000, 9999);
   session()->put('otp',$otp);

  $number=$otpemail;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://2factor.in/API/V1/704c1621-07a2-11eb-9fa5-0200cd936042/SMS/".$number."/".$otp."/Otp+For+Placing+The+Order",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

   //Mail::to(['quantumitinnovation2020@gmail.com'])->cc($otpemail)->send(new otp($otp));

   return redirect('otp');
  }
  }else{

if($req->email){
$reqemail=$req->email;
}else{
$reqemail=session()->get('otp_email');
}

 $chkEmail=User::where(['email'=>$reqemail,'role_id'=>'2'])->get();
  
if($chkEmail[0]->id){
  session()->forget('signup_otp_email');
  if($req->email){
   // session()->put('loginEmail',$otpemail);

  session()->put('otp_email',$req->email);
  $otpemail=session()->get('otp_email');
  }else{
  $otpemail=session()->get('otp_email');
  }

   session()->put('inputBokEmail',$otpemail);

   $otp = mt_rand(1000, 9999);
   session()->put('otp',$otp);

  $number=$otpemail;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://2factor.in/API/V1/704c1621-07a2-11eb-9fa5-0200cd936042/SMS/".$number."/".$otp."/Otp+For+Placing+The+Order",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
   //Mail::to(['quantumitinnovation2020@gmail.com'])->cc($otpemail)->send(new otp($otp));  
   return redirect('otp');
   }else{
   session()->flash('signin_err','This Mobile No Is Not Registered');
   return redirect('user-login');
   }
  }
  }

  public function otpview(){
  //session()->get('otp');
    // echo "Si".session()->get('signup_otp_email');
    // echo "Log".session()->get('otp_email');
  return view('website.otp');
  }

  public function matchotp(Request $req){
    // echo "Si".session()->get('signup_otp_email'); 
    // echo "Log".session()->get('otp_email');
    // die;
  if(session()->get('otp')==implode('',$req->otp)){
    if(session()->get('otp_email')){
  $otpemail=session()->get('otp_email');
    }else{
  $otpemail=session()->get('signup_otp_email');
   $db=new User;
   $db->email=session()->get('signup_otp_email');
   $db->role_id=2;
   // echo"<pre>";
   // print_r($db);
   // die;
   $db->save();
    }
  session()->put('loginEmail',$otpemail);

if(session('cart') || session('special_cart')){
    return redirect('user-address'); 
  }else{
    return redirect('/'); 
  }
  }else{   	    	
   Session::flash('otp_err','Please Enter Valide OTP');     
   return redirect('otp');
  	    }
      }

}
