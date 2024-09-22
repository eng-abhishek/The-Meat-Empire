<?php
namespace App\Http\Controllers;
error_reporting(1);
use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\Payment_tbl;
use App\Outgoing_product;
use App\UsedPromoCode;
use App\Coupon;
use App\Available_city;
use App\Location;
use DB;

class UserController extends Controller
{

    public function index(){
    $allUser=User::where('role_id','2')->orderBy('id','desc')->get();
    return view('admin.user.index',['allUser'=>$allUser]);
    }  

    public function store_user_address(Request $request){
    if($request->editId){
     $updateBok=Booking::find($request->editId);
    $updateBok->city=$request->cityId;
    $updateBok->landmarkAddress=$request->landmark;
    $updateBok->flat_no=$request->flatno;
    $updateBok->address=$request->address; 
    $updateBok->mobile_no=$request->mobile;
    $updateBok->bookingDate=$request->date; 
    $updateBok->bookingTime=$request->time;

    $updateBok->update();
    return redirect('user-profile');
    }else{

    $email=User::where(['email'=>$request->email,'role_id'=>'2'])->get();
    //  echo"<pre>";
    //   print_r($email);
    //   die;

    if($email[0]->email && $email[0]->userType=='0'){
    
     // $lastUserId=$email[0]->id;

    $userData=User::find($email[0]->id);
    $lastUserId=$userData->id;
    $userData->f_name=$request->f_name;
    $userData->l_name=$request->l_name;
    $userData->email=$request->email;
    $userData->mobile_no=$request->mobile;
    $userData->role_id='2';
    $userData->flat_no=$request->flatno;
    $userData->address=$request->address;
    $userData->landmarkAddress=$request->landmark;
    $userData->city=$request->cityId;
    $userData->userType=1;
    $userData->update();
   
    if(session()->get('generalCouponId')){

     $addCoupon=new UsedPromoCode;
     $addCoupon->user_id=$lastUserId; 
     $addCoupon->coupon_id=session()->get('generalCouponId');
     $addCoupon->save();

    }else{

    }  

    $bokreq=new Booking;
    $bokreq->user_id=$lastUserId;
    session()->put('orderId','#'.mt_rand(1000, 9999));
    $bokreq->order_id=session()->get('orderId');
    $bokreq->order_status='requested';

    $bokreq->city=$request->cityId;
    $bokreq->landmarkAddress=$request->landmark;
    $bokreq->flat_no=$request->flatno;
    $bokreq->address=$request->address;

    $bokreq->bookingDeliveryType=$request->productReqTime;
    $bokreq->bookingDate=$request->date;
    $bokreq->bookingTime=$request->time;
    $bokreq->mobile_no=$request->mobile;
    $bokreq->bookingSummary=session()->get('bokInfo');


    if(session()->get('checkExpressDelivery')==1){
    $bokreq->expressDelivery=session()->get('expDelCharge');
     }else{

      }

    session()->put('deliveryDate',$request->date);
    session()->put('deliveryTime',$request->time);
    session()->put('bookingDate',date('Y-m-d a h:iA'));

    $bokreq->save();

    $orderId=$bokreq->id;
    session()->put('orderIdValue',$orderId);

    }else{

  $userData=User::find($email[0]->id);
    
    $lastUserId=$email[0]->id;

    $userData->f_name=$request->f_name;
    $userData->l_name=$request->l_name;
    $userData->update();

    session()->get('generalCouponId');

    $checkPromocode=UsedPromoCode::where(['coupon_id'=>session()->get('generalCouponId'),'user_id'=>$lastUserId])->get()->toArray();

  // return $checkPromocode;


    if($checkPromocode[0]['id']){
     session()->forget('generalCouponId');
     session()->put('alreadyUsedPromoCode','N/A');
    }else{
     $addCoupon=new UsedPromoCode;
     $addCoupon->user_id=$lastUserId; 
     $addCoupon->coupon_id=session()->get('generalCouponId');
     $addCoupon->save();
    }
    
    $bokreq=new Booking;
    $bokreq->user_id=$lastUserId;
    session()->put('orderId','#'.mt_rand(1000000, 9999999));
    $bokreq->order_id=session()->get('orderId');
    $bokreq->order_status='requested';

    $bokreq->city=$request->cityId;
    $bokreq->landmarkAddress=$request->landmark;
    $bokreq->flat_no=$request->flatno;
    $bokreq->address=$request->address;

    $bokreq->bookingDeliveryType=$request->productReqTime;
    $bokreq->bookingDate=$request->date;
    $bokreq->bookingTime=$request->time;
    $bokreq->mobile_no=$request->mobile;
    $bokreq->bookingSummary=session()->get('bokInfo');

    if(session()->get('checkExpressDelivery')==1){
    $bokreq->expressDelivery=session()->get('expDelCharge');
     }else{

      }

    session()->put('deliveryDate',$request->date);
    session()->put('deliveryTime',$request->time);
    session()->put('bookingDate',date('Y-m-d a h:iA'));
    
    $bokreq->save();
    $orderId=$bokreq->id;
    session()->put('orderIdValue',$orderId);

    }
//redirect('order-success')->with('amount',session()->get('tatalPayAMT'));

return redirect('order-success');

    }  
    }

    public function user_address($id=''){
    // $userbokAddress= Booking::find($id);
    // $userbokAddress->user_id;
    $bokAddress=DB::table('bookings')
        ->select('bookings.id','bookings.bookingDate','bookings.bookingTime','bookings.bookingDeliveryType','bookings.address','bookings.landmarkAddress','bookings.city','bookings.flat_no','users.f_name','users.l_name','users.email','users.mobile_no')
        ->join('users','users.id','=','bookings.user_id')
        ->where('bookings.id',$id)
        ->get();  
       $cityName=Available_city::find($bokAddress[0]->city)->name;

    return view('website.address',['edit_userdetails'=>$bokAddress[0],'edit_cityName'=>$cityName]);
    }

public function userLogout(){
session()->forget('signup_otp_email');
session()->forget('otp_email');    
session()->forget('loginEmail');
session()->forget('checkExpressDelivery');
session()->forget('expDelCharge');
session()->forget('new_apply_coupon_process');
return redirect('/');
}

public function userProfile(){
session()->get('loginEmail');
$userdata= User::where('email',session()->get('loginEmail'))->get();
$userdata[0]->id;
$totalOrder=count(Booking::where('user_id',$userdata[0]->id)->get());
$bookingDetails=Booking::where('user_id',$userdata[0]->id)->orderBy('id','desc')->get();
        $cityName=Available_city::find($userdata[0]->city)->name;
        $locationName=Location::find($userdata[0]->landmarkAddress)->location_name;

return view('website.myaccount',['userdata'=>$userdata[0],'totalOrder'=>$totalOrder,'bookingDetails'=>$bookingDetails,'cityName'=>$cityName,'locationName'=>$locationName]);
}

public function addProfilePicrure(Request $request){
        $userId=User::where('email',session()->get('loginEmail'))->get();
        //return $request->file('userImg');
        $ureq=user::find($userId[0]->id);
        $imageName = time().'.'.$request->userImg->extension();  
        $sreq->userImg=$imageName;
        $request->userImg->move(public_path('uploads/user'), $imageName);
        $ureq->img=$imageName;
        $ureq->update();
        return redirect('user-profile');  
}

  public function orderSuccess(){
   return view('website.summary');
  }

   public function updateUserProfile(Request $request){
     if($request->editId){
     $id=$request->editId;
     $dbreqs=User::find($id);
    
     $dbreqs->f_name=$request->f_name;
     $dbreqs->l_name=$request->l_name;
     $dbreqs->mobile_no=$request->mobile_no;
     $dbreqs->address=$request->address;
     $dbreqs->city=$request->city;
     $dbreqs->landmarkAddress=$request->landmarkAddress;
     $dbreqs->flat_no=$request->flat_no;
     $dbreqs->update();
    
     return redirect('user-profile');
   }
}
  public function details($id){
        $userDetails=User::find($id);
        $cityName=Available_city::find($userDetails->city)->name;
        $locationName=Location::find($userDetails->landmarkAddress)->location_name;
        
        return view('admin.user.detail',['testDetails'=>$userDetails,'cityName'=>$cityName,'locationName'=>$locationName]);
   }


   public function edit($id){
   $userDetails=User::find($id);  
   $cityId=$userDetails->city;
   $allCity=Available_city::all();
   $setLocation=Location::where('cate_id',$cityId)->get();
   return view('admin.user.edit',['editData'=>$userDetails,'allCity'=>$allCity,'setLocation'=>$setLocation]);
   }

   public function update(Request $req){

      $userDetails=User::find($req->editId);
      $userDetails->f_name=$req->f_name;
      $userDetails->l_name=$req->l_name;
      // $userDetails->email=$req->email;
      $userDetails->mobile_no=$req->email;
      $userDetails->city=$req->city;
      $userDetails->address=$req->address;
      $userDetails->flat_no=$req->flat_no;
      $userDetails->landmarkAddress=$req->landmarkAddress;

     if($req->file('img')){
       $req->validate([
       'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
       
        $imageName = time().'.'.$req->img->extension();  
        $userDetails->img=$imageName;
        $req->img->move(public_path('uploads/user'), $imageName);
       }else{
       $userDetails->img=$req->input('oldImg');
       }
       \Session::put('success','Data Update Successfully.');
        $userDetails->update();
        return redirect('user');
    }

    public function getUserLocation(Request $req){
    $userlocation=Location::where('cate_id',$req->id)->get();
    $output='';
    $output.='<select name="landmarkAddress" class="form-control">
    <option value="">-- Select Location --</option>';
    foreach ($userlocation as $value) {
    $output.='<option value="'.$value->id.'">'.$value->location_name.'</option>';
    }
    $output.='<select>';
    return $output;
     }
}
