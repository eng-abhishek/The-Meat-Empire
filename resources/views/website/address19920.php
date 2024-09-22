@extends('website.layout.layout2')
@section('content')
<?php 
error_reporting(1);
use App\Available_city;
use App\User;
             if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
 $setCityInHeader=Available_city::find($selectCity)->name;

// echo"<pre>";
// print_r($userdetails);
// die;
if($userdetails->id){
$editId=$userdetails->id;
}else{
  $otpemail=session()->get('loginEmail');
 // if(session()->get('otp_email')){
 //  $otpemail=session()->get('otp_email');
 // }else{
 //  $otpemail=session()->get('signup_otp_email');
 // }
  $userdetail=User::where('email',$otpemail)->get();
  $userdetails=$userdetail[0]; 
}


?>
  <section class="address">
         <div class="container-fluid"> 
                       <div class="row">
                             <div class="col-md-12">
                                 <h6 style="color:#2b2f7f;font-weight:bold;text-align:center;font-size:20px;">Add New Address</h6>
                             </div>
                            <div class="col-md-4" style="background:#2b2f7f;padding:20px;">
                                   <form action="{{url('store-user-address')}}" method="post" id="userAddress">
                          <div class="form-group">
                            <label style="color:#fff">Enter Delivery Address</label>
<?php 
if(session()->get('location')){
   $userAddress=session()->get('location');  
}elseif($userdetails->id){
  $userAddress=$userdetails->address; 
}else{
  $userAddress=$userdetails->address; 
}

if(session('orderDate')){
$bokDate=session('orderDate');
}else{
$bokDate=$userdetails->bookingDate;
}
if(session('orderTime')){
$bokTime=session('orderTime');
}else{
$bokTime=$userdetails->bookingTime;
}

?>
                           <input type="text" name="address" class="form-control" placeholder="Enter Location" value="{{$userAddress}}" required="">
                           </div>
                           <input type="text" name="editId" value="{{$editId}}" hidden="">
                           <div class="form-group">
                                   <label style="color:#fff">Flat No</label>
                                <input type="text" name="flatno" class="form-control" placeholder="Flat No/Building Name/Street Name" value="{{$userdetails->flat_no}}" required="">
                           </div>
                           @csrf
                           <div class="form-group">
                                 <label style="color:#fff">Landmark</label>
                                <input type="text" name="landmark" value="{{$userdetails->landmarkAddress}}" class="form-control" placeholder="Landmark [optional]">
                           </div>
                            </div>
                            
                            <div class="col-md-4"  style="background:#2b2f7f;padding:20px;">
                                <div class="form-group">
                                 <label style="color:#fff">City</label>
                                <input type="text" name="city" value="{{$setCityInHeader}}" class="form-control" readonly placeholder="City" required="">
                           </div>
                           
                           <div class="form-group">
                               <label style="color:#fff">Mobile number</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile No" value="{{$userdetails->mobile_no}}" required="">
                           </div>
                           
                           <div class="form-group">
                                <label style="color:#fff">Email</label>
                                <input type="email" name="email" value="{{session()->get('inputBokEmail')}}" readonly class="form-control" placeholder="Email" required="">
                           </div>

                            </div>
                            
                            <div class="col-md-4"  style="background:#2b2f7f;padding:20px;">
                                 
                           <div class="form-group">
                                <label style="color:#fff">Date</label>
                           <input type="date" name="date" value="{{$bokDate}}" min="{{date('Y-m-d')}}" class="form-control"> 
                           </div> 
                           
                                 <div class="form-group">
                                     <label style="color:#fff">Time</label>
                            <input type="time" name="time" value="{{$bokTime}}" min="09:00" max="21:00" class="form-control"> 
                           
                           </div> 
                           
                                <div class="form-group">
                                   <label style="color:#fff">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Full name" value="{{$userdetails->name}}" required="">
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                     <div class="form-group text-center">
        
                                <input type="submit" class="btn addaddress" value="save & proceed">
                           </div>
                   </form>
                            </div>
                       </div>
    
                           
                           <!-- <div class="form-group">
                            <select name="productReqTime" class="form-control productReqTime" required="">
                            <option value=""> When you want this service ?</option>  
                            <option <?php if($userdetails->bookingDeliveryType=="now"){echo"selected"; } ?> value="now">Now</option>
                            <option <?php if($userdetails->bookingDeliveryType=="later"){echo"selected"; } ?> value="later">Later</option>
                            </select>
                           </div>  -->


                            

         </div>   
  </section>  
@endsection
@section('script')
<script>
$(function(){   
$('.date').hide();
$('.time').hide();

$('#userAddress').validate({
 rules:{
  time:{
   min:'09:00',
   max:'21:00',
  },
  address:{
   required:true, 
  },
  flatno:{
  required:true, 
  },
 city:{
  required:true, 
 },
 mobile:{
  maxlength:10,
  number:true,
  required:true, 
 },
 name:{
  maxlength:20,
  required:true, 
  minlength:5,
 },
 email:{
  email:true,
  required:true, 
 }
 },
  messages:{
   time:{
   required:'*Please Enter Delivery Time', 
   min:'*Delivery Time Is Only 9AM - 9PM',
   max:'*Delivery Time Is Only 9AM - 9PM',
  },   
  address:{
  required:'*Please Enter Address', 
   },
  flatno:{
  required:'*Please Enter Flat No',  
  },
 city:{
  required:'*Please Enter City',  
 },
 mobile:{
  required:'*Please Enter Mobile No',
  maxlength:'Mobile No Should Be 10 No Only', 
 },
 name:{
  required:'*Please Enter User Name',
  maxlength:'User Name Should Be Min 5 Max 20 Letter',
  minlength:'User Name Should Be Min 5 Max 20 Letter', 
 },
 email:{
  email:'Please Enter Valide Email',
  required:'*Please Enter Email', 
 }    
 }
});
});
$('.productReqTime').on('change',function(){
var time=$(this).val();
if(time=='later'){
$('.date').show();
$('.time').show();
$('input[name="time"]').attr('required',true);
$('input[name="date"]').attr('required',true);

}else{
$('.date').hide();
$('.time').hide();
$('input[name="time"]').attr('required',false);
$('input[name="date"]').attr('required',false);
}
});

function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
}
</script>
@stop
