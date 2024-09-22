@extends('website.layout.layout2')
@section('content')
<style>
      ul li
  {
    font-size:15px;
    }
.inp{
  width: 100%;
  padding: 7px 0 10px 10px;
  border: 2px solid #2b2f7f;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 10px;
  margin-bottom: 40px;
  resize: vertical;
  color: #707070;
}
.dt, .tm
{
  padding: 0 0 0 10px!important;
}
.dt::-webkit-calendar-picker-indicator {
    color: rgba(0, 0, 0, 0);
    opacity: 1;
    display: block;
    background: url(calender-icon.png) no-repeat center;
    width: 30px;
    height: 30px;
    padding: 10px;
    background-size: 35px 35px;
    background-color: #d3d3d3;
}
.am::-webkit-calendar-picker-indicator {
  color: rgba(0, 0, 0, 0);
    opacity: 1;
    display: block;
    background: url(watch-icon.png) no-repeat center;
    width: 30px;
    height: 30px;
    padding: 10px;
    background-size: 35px 35px;
    background-color: #d3d3d3;
    }
.tm
{
  width: 100%;
  padding: 7px 0 10px 10px;
  border: 2px solid #2b2f7f;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 10px;
  resize: vertical;
  color: #707070;
  margin-bottom: 40px;
}

label
{
    float: left;
    color: #fff;
    font-size: 18px;
    font-family: 'Roboto',sans-serif;
    font-weight: 600;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #707070;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #707070;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #707070;
}
.black-label label{color:#2a2a2a;}
.add-new-address
{
    background-color: #2b2f7f;
    border-radius: 5px;
    padding: 40px 10px 40px 10px;
    width: 100%;
}

*:focus {
    outline: none;
}
.heading1{font-size: 25px!important;margin: 0 0 30px -10px!important;font-family: 'Roboto',sans-serif;}
.sel{margin:6px 0 40px 0!important;color: #707070;font-size: 18px;}

i{font-size: 12px!important;margin-left: 5px!important;}
.inp::-webkit-input-placeholder {
    font-size: 18px;
}
.dt::-webkit-datetime-edit-month-field {
  color:#707070;
  font-size: 18px;
}
.dt::-webkit-datetime-edit-day-field {
  color:#707070;
  font-size: 18px;
}
.dt::-webkit-datetime-edit-year-field {
  color: #707070;
  font-size: 18px;
}
#searchSector{margin: 0!important;}

</style>
<?php 
error_reporting(1);
use App\Available_city;
use App\Location;
use App\User;

  $cityCategory=Available_city::find($selectCity);
  $otpemail=session()->get('loginEmail');
  $userdetail=User::where('email',$otpemail)->get();
  $userdetails=$userdetail[0];


if($edit_userdetails->id){
  $userCityId=$edit_userdetails->city; 
  $userlandMarkId=$edit_userdetails->landmarkAddress;

  $userAddress=$edit_userdetails->address;
  $f_name=$edit_userdetails->f_name;
  $l_name=$edit_userdetails->l_name;
  $userMobile_no=$edit_userdetails->mobile_no;
  $userflat_no=$edit_userdetails->flat_no;
  $bokDate=$edit_userdetails->bookingDate;
  $bokTime=$edit_userdetails->bookingTime;

}elseif(session()->get('city')){
  $userCityId=session()->get('city'); 
  $userlandMarkId=session()->get('location'); 

  $userAddress=$userdetails->address;
  $f_name=$userdetails->f_name;
  $l_name=$userdetails->l_name;
  $userMobile_no=$userdetails->mobile_no;
  $userflat_no=$userdetails->flat_no;

}else{
  
  $userCityId=Available_city::find('1')->id;
  
  $userAddress=$userdetails->address;
  $f_name=$userdetails->f_name;
  $l_name=$userdetails->l_name;
  $userMobile_no=$userdetails->mobile_no;
  $userflat_no=$userdetails->flat_no;
}

   $cityName=Available_city::find($userCityId)->name;
   $cateLocation=Location::where(['status'=>'1','cate_id'=>$userCityId])->get()->toArray();
   
?>
  <form action="{{url('store-user-address')}}" method="post" id="userAddress">
    <div class="container" style="margin-top: 210px;">
        <div class="col-lg-10 form-inline black-label">
      
      <div class="col-lg-6 col-md-12">
          <label for="fname">First Name</label>
 <input type="text" name="f_name" placeholder="Enter First Name" class="inp" value="{{$f_name}}" required="">

     </div>
     <div class="col-lg-6 col-md-12">
          <label for="lname">Last Name</label>
          <input type="text" value="{{$l_name}}" id="lname" class="inp" name="l_name" placeholder="Enter Last Name" required="">
     </div>
     
     <div class="col-lg-6 col-md-12">
     <label for="mobile">Email</label>
     <input type="text" name="mobile" id="mobile" class="inp" value="{{$userMobile_no}}"  placeholder="Enter Email Id" required="">
     <input type="text" hidden name="editId" value="{{$edit_userdetails->id}}">     
     </div>

     <div class="col-lg-6 col-md-12">
     <label for="email">Mobile No</label>       
     <input type="text" name="email" class="inp" id="email" value="{{session()->get('inputBokEmail')}}" readonly placeholder="Enter Mobile No" required="">
     </div>         
      
    </div>
    </div> 
   
    <div class="container mt-5">
        
    <div class="col-lg-12"><h1 class="heading1"><strong>Update Delivery Address</strong></h1></div>
    <div class="form-inline add-new-address">
      <div class="col-lg-6 col-md-12">
          <label for="daddress">Enter Delivery Address</label>
    
<input type="text" name="address" class="inp" id="daddress" placeholder="Enter Address" value="{{$userAddress}}" required="">

     </div>
     <div class="col-lg-6 col-md-12">
       <label for="City">City</label>
       <input type="text" name="city" class="inp" value="{{$cityName}}"  readonly placeholder="City" required="">
       <input type="text" name="cityId" value="{{$userCityId}}" hidden>
       
     </div>
     <div class="col-lg-6 col-md-12">
        <label for="flatno">Flat no</label>
        
     <input type="text" name="flatno" class="inp" placeholder="Enter Flat No" value="{{$userflat_no}}" required="">
     </div>
     <div class="col-lg-6 col-md-12">
        <label for="landmark">Landmark <i><span></span></i></label>
        
<!--         <input type="text" id="landmark" name="landmark" placeholder="Landmark">
 -->
<select name="landmark" class="inp sel" required="">
<option value=""> Select Landmark Address</option>  
@foreach($cateLocation as $allLocationData)
<option <?php if($allLocationData['id']==$userlandMarkId){ echo"selected";} ?> value="{{$allLocationData['id']}}">
{{$allLocationData['location_name']}}</option> 
@endforeach
</select>
     </div>

    </div>
      
    
    </div>

    <div class="container mt-5">
        
        
    <div class="col-lg-12"><h1 class="heading1"><strong>Delivery Date-Time</strong></h1></div>
    
    <div class="form-inline add-new-address">
      <div class="col-lg-6 col-md-12">
       
<div class="form-group">
<label style="color:#fff">Date</label>
<div class="input-group">
 <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">
       <i class="fa fa-calendar"></i> 
    </span>
  </div>   
  <input type="text" name="date" class="form-control date dt inp" placeholder="Date" aria-label="date" aria-describedby="basic-addon1" value="{{$bokDate}}" style="margin-top:0px" required="">
</div>
</div>

     </div>

    <div class="col-lg-6">   
      <div class="form-group">
<label style="color:#fff">Time</label>
<div class="input-group">
 <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">
      <i class="fa fa-clock-o"></i> 
    </span>
  </div>   
  <input type="text" name="time" readonly autocomplete="off" id="addressSetTime" class="form-control time tm" placeholder="Time" aria-label="time" value="{{$bokTime}}" aria-describedby="basic-addon1" required="" style="margin-top:0px">
</div>
</div>
@csrf
<!---------- Date Time ------->               
                  <div class="timedrop" style="background:white;width:50%;display:none;border-radius:5px;margin-left:48px">
                         <div class="row">

               <div class="col-md-5" >
                      <select class="form-control" id="addressHr" style="font-size:11px;">
          @if($cityCategory->category=="C")
             <option value="12 PM">12 PM</option>
             <option value="04 AM">04 AM</option>
          @else
                      <option value="09 AM">09 AM</option>
                      <option value="10 AM">10 AM</option>
                      <option value="11 AM">11 AM</option>
                      <option value="12 PM">12 PM</option>
                      <option value="01 PM">01 PM</option>
  <option value="02 PM">02 PM</option>
  <option value="03 PM">03 PM</option>
  <option value="04 PM">04 PM</option>
  <option value="05 PM">05 PM</option>
  <option value="06 PM">06 PM</option>
  <option value="07 PM">07 PM</option>
  <option value="08 PM">08 PM</option>
      @endif 
                       </select>
                 </div> 

                             <div class="col-md-2">
                                  <span>:</span>
                             </div>

       <div class="col-md-5">
                             <select class="form-control" id="addressSecond" style="font-size:11px;">
                              <option value="00">00</option>
                              <option value="05">05</option>
                              <option value="15">15</option>
                              <option value="25">25</option>
                              <option value="35">35</option>
                              <option value="45">45</option>
                              <option value="55">55</option>
                          </select>
        </div>

                         </div> 
                     </div> 
  <!---------- Date Time ------->     
    </div>

    </div>
    </div>


    <div class="col-md-12 mt-20">
                                     <div class="form-group text-center">
        
                                <input type="submit" class="btn addaddress" value="save & proceed">
                           </div>
                  
                            </div>
</form>

@endsection
@section('script')
<script>

$(function(){   
/* if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }*/

  $('#addressSecond').on('change',function(){
    var sec=$('#addressSecond').val();
    var hr=$('#addressHr').val();
    $('#addressSetTime').val(hr+' : '+sec);
  });
  $('#addressHr').on('change',function(){
    var sec=$('#addressSecond').val();
    var hr=$('#addressHr').val();
    $('#addressSetTime').val(hr+' : '+sec);
  });


$('#userAddress').validate({
 rules:{
  address:{
   required:true, 
  },
  flatno:{
  required:true, 
  },
 city:{
  required:true, 
 },
 email:{
  maxlength:10,
  number:true,
  required:true, 
 },
  mobile:{
  email:true,
  required:true,  
 },
 f_name:{
  maxlength:20,
  required:true, 
  minlength:3,
 },
  l_name:{
  maxlength:20,
  required:true, 
  minlength:2,
 },
 },
  messages:{
   date:{ 
   required:'*Please Enter Delivery Date', 
        }, 
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
  email:'Please Enter Valide Email',
  required:'*Please Enter Email',  
 },
 f_name:{
  required:'*Please Enter User First Name',
  maxlength:'User Name Should Be Min 5 Max 20 Letter',
  minlength:'User Name Should Be Min 5 Max 20 Letter', 
 },
  l_name:{
  required:'*Please Enter User Last Name',
  maxlength:'User Name Should Be Min 2 Max 20 Letter',
  minlength:'User Name Should Be Min 2 Max 20 Letter', 
 },
 email:{
  required:'*Please Enter Mobile No',
  maxlength:'Mobile No Should Be 10 No Only', 
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