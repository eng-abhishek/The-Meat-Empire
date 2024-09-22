<?php 
error_reporting(1);
use App\FoodCategory;
use App\Available_city;
use App\FoodService;
use App\User;
use App\Location;
$avaliableCity=Available_city::all();

$userDet=User::where('email',session()->get('loginEmail'))->get()->toArray();
$userDetails=$userDet[0];
?>
<style type="text/css">
  
/* component */
.star-rating {
  display:flex;
  flex-direction: row-reverse;
  font-size:1.5em;
  justify-content:space-around;
  padding:0 .2em;
  text-align:center;
  width:5em;
}

.star-rating input {
  display:none;
}

.star-rating label {
  color:#ccc;
  cursor:pointer;
}

.star-rating :checked ~ label {
  color:#f90;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color:#fc0;
}

</style>
<!-- footer -->
<footer>
<div class="container">
<div class="row">
<div class="col-md-2 logocol">
<img src="{{asset('assets/front-end/img/logo.png')}}" alt="logo">
</div>

<div class="col-md-7 ">
<h4 class="footer-about-head">About The Meat Empire</h4>
<p class="footer-about-para">The Meat Empire is a modern, hygiene and taste-focused Online Meat-delivery platform, whereon we
are committed to bring you the premium quality meat & meat products, with a delightful customer
experience.
No, it isn’t just a random start-up; Infact, we (Rajora-Brothers) have been promoting quality meat
products through our 30 year old established family business - Empire .....&nbsp;<a href="{{url('about-us')}}">Read More.</a></p>
</div>
<div class="col-md-3 text-right">
<ul class="footerlink">
<li class="socialfooter">
<div class="socialfooter-icon text-right">
<a href="#"> <img src="{{asset('assets/front-end/img/fb.png')}}" > </a>
<a href="#">  <img src="{{asset('assets/front-end/img/inst.png')}}" > </a>

</div>
</li>
</ul>

<a href="#">  <img src="{{asset('assets/front-end/img/appstoreblue.png')}}" style="width:60%"> </a><br>
<a href="#">  <img src="{{asset('assets/front-end/img/playstoreblue.png')}}" style="width:60%;margin-top:5px"> </a></li>
</div>  
</div>
</div>
</div>
</div>
<div class="container-fluid" style="background-color:#e7e8ea">
<div class="row" style="padding:15px 120px">
<div class="col-md-4" >
<h5 class="footer-useful-link">Useful Links</h5>
<ul class="us-link">
<li><a href="{{url('terms-condition')}}">Terms & Conditions</a></li>
<li><a href="{{url('faq')}}">FAQ </a></li>
<li><a href="{{url('privacy-policy')}}">Privacy Policy </a></li>
<li><a href="{{url('refund-policy')}}">Refund Policy </a></li>
<li><a href="{{url('instructions')}}">Instructions to Handle Meat At Home  </a></li>
<li><a href="{{url('about-us')}}">About Us</a></li>
<h5 class="footer-useful-link" style="color:#0d1589;margin-top:10px;font-size:14px">FSSAI Approved</h5>
<h5 class="" style="color:#0d1589;margin-top:10px;font-size:11px;font-weight:500;margin-top:0px">LIC. No. 12720055000437</h5>
</ul>
</div>

<div class="col-md-4">
<h5 class="footer-useful-link">Store Address</h5>
<p class="footer-useful-link-p">Unit 107, A 9<br>
Sector 59, Noida - 201309</p>
<h5 class="f16 footer-useful-link">Want to talk to us:</h5>
<p class="footer-useful-link-p"><b>+91 93118 45200 <br>+91 9311845300</b></p>


</div>
<div class="col-md-4">
<h5 class="footer-useful-link">Have a Query/Security Concern?</h5>
<p class="footer-useful-link-p">Mail Us - <a style="color:#0d1589">contact@themeatempire.in</a></p>
<h5 class="f16 footer-useful-link">Payment Options:</h5>
<ul class="payment-link">
<li><a href="#"><img src="{{asset('assets/front-end/img/american.png')}}"></a></li>
<li><a href="#"><img src="{{asset('assets/front-end/img/paypal.png')}}"> </a></li>
</ul>


</div>
</div>
</div>
<div class="container" style="padding-top:10px">
   <div class="row">

<div class="col-md-12 cities">
     <h5 class="footer-useful-link"><a style="color:#ec2224">Location We Serve</a> - 
      <a style="font-size:14px">
@foreach($avaliableCity as $Ckey=>$avaliableCityData)
<?php if($Ckey==0){
  echo $avaliableCityData->name;
}else{
  echo " | ".$avaliableCityData->name; 
}
?>
@endforeach
<?php echo"."; ?>
</a></h5>
<!--<h5 class="shorcutlink" style="padding-top:15px"><a href="#">Add shortcut to homepage
</a></h5>-->
</div>

<div class="col-md-12 cities">
<h5 style="font-size:16px;padding-top:15px" class="footer-useful-link">Popular Searches</h5>

<a style="text-decoration:none;color:;" href="javascript:void(0)"><h5 style="padding-top:10px">CHICKEN</h5></a>
<p>
Fresh n Tender Small Chicken, Chicken Full Leg, Chicken Breast Boneless, Chicken Breast with Bone, Chicken Thigh Boneless, Chicken Drumsticks, Chicken Wings, Fresh Chicken Mince.
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
MUTTON</h5></a>
<p>
Fresh n Tender Goat Mutton – Assorted, Fresh Mutton Back Leg (Raan), Fresh Goat Mutton Shoulder, Chef's Favourite Goat Mutton, Fresh Mutton Chops & Ribs (Seena), Fresh Mutton - Kidney & Liver, Premium Goat Mutton Boneless, Fresh Mutton Mince, Mutton Mince for Lakhnawi Kebab, Goat Mutton Brain, Goat Mutton Paya.    
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
FISH & PRAWNS</h5></a>
<p>
Premium Sole Fish (River) Boneless, Premium Seerfish Surmai Boneless, Fresh Seerfish Surmai Steaks, Premium Pangash Fish Boneless, Fresh whole White Pomfret, Fresh Whole Rohu Fish (With Bones), Basa Fish Fillets Boneless, Frozen Super Jumbo Prawns, Frozen Jumbo Prawns, Frozen Large Prawns, Frozen Medium Prawns, Frozen Shrimps Prawns.
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
HEAT & EAT</h5></a>
<p>
Chicken Khasta Seekh Kebab, Empire's Special Chicken Seekh, Hot & Smokey Chicken Seekh Kebab, Chicken Fiery Seekh Kebab, Chicken Makhmali Seekh, Crunchy Chicken Nuggets, Tandoori Chicken Tikka, Tandoori Afghani Chicken Tikka, Tandoori Chicken Breast, Tandoori Chicken Tangri, Fiery Chilli Chicken Boneless, Crispy Fried Chicken Lollipop, Chicken 65 - Chennai Style, Lukhnawi Chicken Galouti Kebab, Steamy Chicken Kebab, Chicken Herb Breast, Peri Peri Chicken Breast, Chicken Burger Patty, Chicken Hot n Crispy Burger Patty, Chicken Onion Cutlet, Spicy Mutton Seekh Kebab, Empire's Special Mutton Seekh, Lukhnawi Mutton Galouti Kebab, Mutton Burger Patty, Fish Orlay, Fish Finger, Buttery Garlic Fish, Lahori Fish Fry, Vegetable Spring Roll, Cheese Jalapeno Poppers, Paneer Burger Patty.
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
FITNESS FOOD</h5></a>
<p>
Olive & Herb Sole Fish, Roasted Chicken Breast, Chicken Herb Breast, Peri Peri Chicken Breast, Steamy Chicken Kebab, Chicken Salami Plain, Chicken Hot BBQ Smoked Salami, Chicken Ham, Chicken Sausages.
</p>


<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
COLD CUTS</h5></a>
<p>
Chicken Salami Plain, Chicken Paprika Salami, Chicken Hot BBQ Smoked Salami, Chicken Ham, Chicken Sausages, Chicken Cocktail Sausages, Chicken Cheese Sausages, Chicken Franks, Pork Bacon.
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
CURRIES</h5></a>
<p>
Chicken Korma, Butter Chicken (Boneless), Keema Kaleji, Mutton Korma.
</p>

<a style="text-decoration:none;color:" href="javascript:void(0)"><h5>
MARINADES</h5></a>
<p>
Marinated Chicken Masala Tikka, Marinated Chicken Malai Tikka, Marinated Chicken Hariyali Tikka, Marinated Chicken Tangri, Marinated Chicken Achari Tikka, Marinated Chicken Peri Peri, Marinated Chicken Lollypop, Marinated Surmai Fish Tikka (Boneless), Marinated Surmai Fish Amritsari (With Bone), Marinated Sole Fish Tikka (Boneless), Marinated Whole White Pomfret.
</p>

</div>   
</div>  

<div class="row copyright">
<div class="col-md-12">
<p style="font-size:13px;">Copyright © 2020 The Meat Empire . All Rights Reserved.</p>
</div>

</div>  
</div>  
</footer>
<!-- footer -->   
</div>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="addprofilepic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data" action="{{url('add-user-picture')}}">
      <div class="modal-body">
       <input required type="file" name="userImg" class="form-control"/>
      </div>
      @csrf
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- update user profile Modal -->
<div class="modal fade" id="editUserProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="userEditPro" action="{{url('update-user-profile')}}">
      <div class="modal-body">
      <div class="row">
     
      <div class="col-md-12">
      <div class="form-group">  
       <input type="text" name="f_name" placeholder="Enter User First Name" class="form-control" value="{{$userDetails['f_name']}}" required=""/> 
      </div> 
      </div>

      <div class="col-md-12">
      <div class="form-group">  
       <input type="text" name="l_name" placeholder="Enter User Last Name" class="form-control" value="{{$userDetails['l_name']}}" required=""/> 
      </div> 
      </div>

      <div class="col-md-12">
      <div class="form-group"> 
       <input type="text" name="mobile_no" placeholder="Enter Email Id" class="form-control" value="{{$userDetails['mobile_no']}}" required=""/> 
       <input type="text" name="editId" value="{{$userDetails['id']}}" hidden="">
       <!-- <input type="text" name="sessionId" value="{{session()->get('loginEmail')}}" hidden=""> -->
      </div> 
      </div>

    <div class="col-md-12">
      <div class="form-group"> 
           <input type="text" name="address" placeholder="Enter Address" placeholder=" " class="form-control" value="{{$userDetails['address']}}" required=""/> 
      </div> 
    </div>

      <div class="col-md-12">
      <div class="form-group"> 
<select name="city" class="form-control" onclick="getUserLocation(this.value)" required="">
 <option value="">-- Select City--</option> 
@foreach($avaliableCity as $avaliableCityData)
 <option value="{{$avaliableCityData->id}}"
 <?php if($userDetails['city']==$avaliableCityData->id){echo"selected";}else{ } ?> 
 >{{$avaliableCityData->name}}</option> 
@endforeach
</select>

      </div>
      </div>
<?php 
$city=$userDetails['city'];
$location=Location::where('cate_id',$city)->get();
?>

   <div class="col-md-12">
        <div class="form-group">  
<select name="landmarkAddress" id="location" class="form-control" required="">
 <option>-- Select Location--</option> 
 @foreach($location as $locationData)
 <option value="{{$locationData->id}}" 
 <?php if($userDetails['landmarkAddress']==$locationData->id){echo"selected";}else{ } ?> 
  >{{$locationData->location_name}}</option>
 @endforeach
</select>
     </div>
      </div>

       <div class="col-md-12">
       <div class="form-group"> 
       <input type="text" name="flat_no" placeholder="Enter Flat No" class="form-control" value="{{$userDetails['flat_no']}}" required=""/> 
      </div>
      </div> 

   </div>
      </div>
      @csrf
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--- feedback popup --->
<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header" style="border-bottom:none">
        <h5 class="modal-title" id="exampleModalLongTitle">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<form method="post" action="{{url('submit-rating')}}" id="feedbackForm">
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">

  Rate:<div class="star-rating" id="rate">
  <input type="radio" name="rating" id="5-stars" name="rating" value="5" required=""/>
  <label for="5-stars" class="star">&#9733;</label>
  <input type="radio" name="rating" id="4-stars" name="rating" value="4" required=""/>
  <label for="4-stars" class="star">&#9733;</label>
  <input type="radio" name="rating" id="3-stars" name="rating" value="3" required=""/>
  <label for="3-stars" class="star">&#9733;</label>
  <input type="radio" name="rating" id="2-stars" name="rating" value="2" required=""/>
  <label for="2-stars" class="star">&#9733;</label>
  <input type="radio" name="rating" id="1-star" name="rating" value="1" required=""/>
  <label for="1-star" class="star">&#9733;</label>
  </div>
@csrf
<textarea placeholder="Enter your Feedback.." id="feedback" rows="3" cols="3" name="comment" class="form-control" required="">
</textarea>
<input type="text" name="editId" hidden id="editId"> 
</div>
<div class="col-sm-1"></div>
</div>

      <div class="modal-footer" style="border-top:none">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!---- feedback popup --->

<!--<div class="preloader" style="position:fixed;top:0px;height:100%;width:100%;background:rgba(225,225,225,0.7);z-index:999999999;display:none"><img src="{{asset("assets/front-end/img/loader.gif")}}" alt="logo" style="position:relative;left:550px;width:20%;top:200px"></div>-->
<style>
#addCartPopUp:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    transform: rotate(45deg);
    top: -10px;
    left: 20%;
    z-index: -1;
    margin-left: -5px;
    background: #2b2f7f;
}
</style>    

<style>
#removeCartPopUp:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    transform: rotate(45deg);
    top: -10px;
    left: 20%;
    z-index: -1;
    margin-left: -5px;
    background: #2b2f7f;
}
</style>  

<div id="addCartPopUp" style="height: 50px;
    width: 150px;
    background-color:#2b2f7f;
    z-index: 99999;
    position:fixed;
    right: 30px;
    top: 120px;
    border-radius:4px;
    padding:10px;
    display:none !important">
  <p style="color:#fff;
    font-weight: 600;
    text-align:center;font-size:12px;margin-top:5px;padding-top:2px">Item Added To Cart</p>
</div>

<div id="removeCartPopUp" style="height: 50px;
    width: 150px;
    background-color:#2b2f7f;
    z-index: 99999;
    position:fixed;
    right: 30px;
    top: 120px;
    border-radius:4px;
    padding:10px;
    display:none !important">
  <p style="color:#fff;
    font-weight: 600;
    text-align:center;font-size:12px;margin-top:5px;padding-top:2px">Item Remove To Cart</p>
</div>
<style>
#updateCartPopUp:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    transform: rotate(45deg);
    top: -10px;
    left: 20%;
    z-index: -1;
    margin-left: -5px;
    background: #2b2f7f;
}
</style> 


<div id="updateCartPopUp" style="height: 50px;
    width: 150px;
    background-color:#2b2f7f;
    z-index: 99999;
    position:fixed;
    right: 30px;
    top: 120px;
    border-radius:4px;
    padding:10px;
    display:none !important">
  <p style="color:#fff;
    font-weight: 600;
    text-align:center;font-size:12px;margin-top:5px;padding-top:2px">Item Update To Cart</p>
</div>

<style>
#alreadyExtCartItemPopUp:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    transform: rotate(45deg);
    top: -10px;
    left: 20%;
    z-index: -1;
    margin-left: -5px;
    background: #2b2f7f;
}
</style> 


<div id="alreadyExtCartItemPopUp" style="height: 50px;
    width: 150px;
    background-color:#2b2f7f;
    z-index: 99999;
    position:fixed;
    right: 30px;
    top: 120px;
    border-radius:4px;
    padding:10px;
    display:none !important">
  <p style="color:#fff;
    font-weight: 600;
    text-align:center;font-size:12px;margin-top:5px;padding-top:2px">Already Exist In Cart</p>
</div>
<!-- footer -->   
<script src='{{asset("assets/front-end/js/jquery.min.js")}}'></script>
<script src='{{asset("assets/front-end/js/owl.carousel.min.js")}}'></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/webslidemenu.js')}}"></script>
<script src="{{asset('assets/front-end/js/popper.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/bootstrap.min.js')}}"></script>
<!--- js validation --->
 <script src="{{asset('assets/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script> 
 
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!--- End js validation --->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-lQ-u7das4d7DuTcjLii2G89FB2FqO-I&libraries=places"></script>
<script>
  $(document).ready(function(){
$(".youmayaddcart").click(function(){
  $('#addCartPopUp').show(); 
$('#addCartPopUp').delay(5000).fadeOut('slow');
});
});
</script>
<script type="text/javascript">


  $(document).ready(function(){
    $(".tm").click(function(){
      $(".timedrop").slideToggle();
    });

   setTimeout(function(){
   getSelectedSectorData();
   getSelectedSectorDataMobileView();
   },2000)

  $('#placeOrderSec').on('change',function(){
    var sec=$('#placeOrderSec').val();
    var hr=$('#hours').val();
    $('#setTime').val(hr+' : '+sec);
  });

  $('#hours').on('change',function(){
    var sec=$('#placeOrderSec').val();
    var hr=$('#hours').val();
    $('#setTime').val(hr+' : '+sec);
    });
  });

function checkcityCategoryMobile(id){
$.ajax({
url:"{{url('checkcityCategory')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}','id':id},
success:function(data){

console.log(data);

if(data[0]==0){
$('.setHrAcCat').html('<option value="12 PM">12 PM</option><option value="04 PM">04 PM</option>');
}else{
$('.setHrAcCat').html('<option value="09 AM">09 AM</option><option value="10 AM">10 AM</option><option value="11 AM">11 AM</option><option value="12 PM">12 PM</option><option value="01 PM">01 PM</option><option value="02 PM">02 PM</option><option value="03 PM">03 PM</option><option value="04 PM">04 PM</option><option value="05 PM">05 PM</option><option value="06 PM">06 PM</option><option value="07 PM">07 PM</option><option value="08 PM">08 PM</option>');
}
$('#searchSectorMobile').html(data[1]);
}
});    
}

function checkcityCategory(id){

$.ajax({
url:"{{url('checkcityCategory')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}','id':id},
success:function(data){

console.log(data);

if(data[0]==0){
$('.setHrAcCat').html('<option value="12 PM">12 PM</option><option value="04 PM">04 PM</option>');
}else{
$('.setHrAcCat').html('<option value="09 AM">09 AM</option><option value="10 AM">10 AM</option><option value="11 AM">11 AM</option><option value="12 PM">12 PM</option><option value="01 PM">01 PM</option><option value="02 PM">02 PM</option><option value="03 PM">03 PM</option><option value="04 PM">04 PM</option><option value="05 PM">05 PM</option><option value="06 PM">06 PM</option><option value="07 PM">07 PM</option><option value="08 PM">08 PM</option>');
}
$('#searchSector').html(data[1]);
}
});
}


function getSelectedSectorData(){
var selectSector=$('.city-select').val();
var searchSector=$('#searchSector').val();
if(searchSector){

}else{
$.ajax({
url:"{{url('getSelectedSector')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}','id':selectSector},
success:function(data){
// console.log(data);
$('#searchSector').html(data);
$('#searchSectorSec').html(data);
}
});
}
}

function getSelectedSectorDataMobileView(){
 var selectSector=$('.city-select-mobile-view').val();
 var searchSector=$('#searchSectorMobile').val();
if(searchSector){

}else{
$.ajax({
url:"{{url('getSelectedSector')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}','id':selectSector},
success:function(data){
// console.log(data);
$('#searchSectorMobile').html(data);

}
});
}   
}
</script>
<script type="text/javascript">
function getUserLocation(id){
$.ajax({
url:"{{url('getUserLocation')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id},
success:function(data){
$('#location').html(data);
}
});
}

$(document).ready(function () {

$('#placeOrder').submit(function(){
var checkCart=$('.badge').html();
if(checkCart>0){
confirm('Say something like\n\n'+'If you change your location then you current Cart selection will be removed and you need to reselect products available for latest location');
}else{
return true;
}
});

$('#userEditPro').validate({
 rules:{
  address:{
   required:true, 
  },
  flat_no:{
  required:true, 
  },
 city:{
  required:true, 
 },
 mobile_no:{
  email:true,
  required:true, 
 },
 f_name:{
  maxlength:25,
  required:true, 
  minlength:3,
 },
  l_name:{
  maxlength:15,
  required:true, 
  minlength:2,
 },
 landmarkAddress:{
    required:true, 
 }
 },
  messages:{
  address:{
  required:'*Please Enter Address', 
   },
  flatno:{
  required:'*Please Enter Flat No',  
  },
 city:{
  required:'*Please Select User City',
 },
 mobile_no:{
  required:'*Please Enter Email Id',
 },
 f_name:{
  required:'*Please Enter User Name', 
 },
  landmarkAddress:{
  required:'*Please Select User Location', 
 }   
 }
});

    $(".cobrand").hover(function () {
     $(".brand").slideDown('medium');
    });

    $(".brand").mouseleave(function () {
     $(".brand").slideUp('medium');
    });
});

</script>
<script type="text/javascript">



  $(document).ready(function(){
  
  if($('#checkSector').val()){

     }
     else{
/* $(".bt1").trigger("click");*/
    $(".bt3").trigger("click");
   
     }

 });
 
</script>

<!-- javascript -->
<script type="text/javascript">
  $(document).ready(function(){

    $('#customers-testimonials2').owlCarousel( {
    loop: true,
    items: 3,
    margin: 10,
    autoplay: true,
    dots:true,
   nav:true,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 1
      },
      1170: {
        items: 3
      },
        1024: {
        items: 2
      },
    
     
    }
  });
    $('.owl-carousel').find('.owl-nav').removeClass('disabled');
    $('.owl-carousel').on('changed.owl.carousel', function(event) {
  $(this).find('.owl-nav').removeClass('disabled');
});
  });
</script>

<script type="text/javascript">

$(function(){
    getCartCount();
});



function getCartCount(){
$.ajax({
url:"{{url('getCartCount')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
$('.badge').html(data);
}
});
}

</script>

<script>
     $('.date').flatpickr(
      {
      dateFormat: "Y-m-d",
      minDate: "today",
      maxDate: new Date().fp_incr(2) // 14 days from now

     })

</script>
