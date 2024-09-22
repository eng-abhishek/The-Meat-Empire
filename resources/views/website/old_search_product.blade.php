<?php 
error_reporting(1);
use App\FoodCategory;
use App\Available_city;
use App\CoBrond;
use App\FoodService;
$productCate=FoodCategory::where(array('top_bar_cateStatus'=>'1'))->get()->toArray();
$avaliableCity=Available_city::orderBy('id','ASC')->get();

 $CoBrond=CoBrond::where('status','1')->get();
             if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
 $setCityInHeader=Available_city::find($selectCity)->name;

$productCateWithPro=array();
$foodCategory=FoodCategory::all()->take('3')->toArray();
foreach ($foodCategory as $FCkey => $foodCategoryvalue) {
$productCateWithPro[]=$foodCategoryvalue;
$foProduct=FoodService::select('service_name','id')->where('service_cate_id',$foodCategoryvalue['id'])->get()->toArray();
foreach ($foProduct as $FKey => $foProductvalue) {
$productCateWithPro[$FCkey]['product'][]=$foProductvalue;
}
}

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
	<link rel="stylesheet" href="{{asset('assets/front-end/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front-end/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/header.css')}}">
 <link rel="stylesheet" href="{{asset('assets/front-end/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/normalize.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/webslidemenu.css')}}">
<link rel='stylesheet' href="{{asset('assets/front-end/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<!--- js validation --->
<link href="{{asset('assets/jquery-validation/css/screen.css')}}" rel="stylesheet" type="text/css" />
<!--- End js validation --->
<style type="text/css">
.cnext{
   
    background:#c0c0c0; 
    margin-right:100px;
    height:100px;
    width:100px;
    border-radius:50px;
    opacity:1 !important;
    margin-top:150px;

}

.cprev
{
  background:#c0c0c0; 
   margin-left:-20px;
    height:100px;
    width:100px;
      border-radius:50px;
    opacity:1 !important;
    margin-top:150px;

}

.cnexticon
{
	
	border-radius:20px;
}

.cprevicon
{
	
	border-radius:20px;
}


</style>
	<!-- css -->
</head>
<header class="header-two desktop-header " >

<div class="header-wrapper">
<div class="top-nav" style="">
<div class="container">
<div class="header-menu-new">
<ul style="list-style-type: none;">
<li class="why-meatempire">
<a href="#" data-eventlabel="Why Meat Empire?">
Why The Meat Empire?
</a>
</li>

</ul>
</div>
<div class="header-login-new">
<ul style="list-style-type: none !important">
<li class="certification">
<a href="#" >
<i class="fa fa-phone-square" aria-hidden="true"></i>  93118 45200
</a>
</li>
<li class="careers">
<a href="#"> <i class="fa fa-phone-square" aria-hidden="true"></i> 93118 45300</a>
</li>

<li class="careers">
<a href="#"> <i class="fa fa-envelope" aria-hidden="true"></i></a>
</li>
<li class="about-us" style="border-left:1px solid #fff">
<a href="login.php">
Signup  / Login</a>
</li>
</ul>
</div>
</div>
</div>
<div class="sub-header" data-spy="affix" data-offset-top="18">
<div class="container">
<div class="header-logo">
<a href="#" data-eventlabel="Logo">
<img src="{{asset('assets/front-end/img/logo2.png')}}" alt="meant empire logo">
</a>
</div>

<div class="search-bar disabled">
<input class="search-input" placeholder="Search for any delicious product">
<span class="search-placeholder">Search</span>
<i class="fa fa-search search-logo" aria-hidden="true"></i>
<span class="clear-button">CLEAR</span>
</div>
<div class="location">
<img src="img/location.png" >	<span class=""><b>Area Location</b></span>

<div class="dropdown">
<a class="dropdown-toggle bt3" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
Noida
</a>

<div class="dropdown-menu desktop-dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="container">
<div class="row">
<div class="col-md-12 text-left">
<h4 class="location-pop-heading">Delivery</h4>
</div>
<div class="col-md-12 text-center">
<div class="location-search-pop">
	  <form>
	  
	  	 	  <select class="form-control city-select">
	  	 	  	
<option class="">Noida </option>
<option class="">Noida Extension</option>
<option class="">Greater Noida</option>
<option class="">Indirapuram</option>
<option class="">Vaishali</option>
<option class="">Vasundhra(Delhi)</option>
<option class="">Vasundhara(Ghaziabad)</option>
<option class="">Patparganj</option>
<option class="">Mayur Vihar Phase 1</option>
	  	 	  </select>
	  	 
	  
<!-- <div class="loc-pop-close">×</div> -->
<div class="search-field">
<input type="text" class="form-control location-input pac-target-input" id="location_pop" placeholder="Enter your location" autocomplete="off">
</div>
<div class="dateandtime" style="border-radius:32px;background:transparent;margin-top:10px;border:1px solid #fff;">
                  <div class="row">
                    <div class="col-md-6" style="border-right:1px solid #fff;">

                         <input type="text" class="form-control date plright" placeholder="Select Date" style="position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px">
                         <i class="fa fa-calendar" style="position:absolute;top:8px;left:30px;color:#fff;font-size:13px;"></i>
                    </div>

                    <div class="col-md-6" style="">

                         <input type="text" class="form-control time plright" placeholder="Select Time" style="position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px">
                         <i class="fa fa-clock-o" style="position:absolute;top:8px;left:30px;color:#fff;"></i>
                    </div>

                  </div>
                </div>
<input type="submit" class="btn place-order" value="Place Order">
</form>
</div>
</div>	
</div>	
</div>	
</div>
</div>
</div>
<div class="menus">
<ul style="border-left:2px solid #9c9b9b">

<li ><a href="cart.php"><img src="img/cart2.png" height="25px"> <span class="badge">6</span></a></li>
</ul>
</div>
</a>
</div>
</div>
</div>

<!-- icon header -->
<div class="cat-list">
<div class="container">
<ul class="categories">
<!-- <li>
<a href="#" title="Todays Deal">Todays Deal</a>
</li>-->
<li class="chickencat">
<a href="category.php" class="enabled" data-id="1" data-text="Chicken" data-index="1" data-slug="chicken">
<!-- <img class="cat-icon" src="img/chicken.png"> -->
Chicken
</a>
</li>
<li class="muttoncat">
<a href="#red-meat" class="enabled" data-id="2" data-text="Mutton" data-index="2" data-slug="red-meat">
<!-- <img class="cat-icon" src="img/mutton.png"> -->
Mutton
</a>
</li>
<li class="fishcat">
<a href="#seafood" class="enabled" data-id="3" data-text="Fish &amp; Seafood" data-index="3" data-slug="seafood">
<!-- <img class="cat-icon" src="img/fish.png"> -->
Fish &amp; Prawns
</a>
</li>
<li class="haecat">
<a href="#marinades" class="enabled" data-id="4" data-text="Ready to Cook" data-index="4" data-slug="marinades">
<!-- <img class="cat-icon" src="img/readytoeat.png"> -->
Heat &amp; Eat
</a>
</li>
<li class="fitnesscat">
<a href="#spreads" class="enabled" data-id="20" data-text="Spreads" data-index="5" data-slug="spreads">
<!-- <img class="cat-icon" src="img/fitnessfood.png"> -->
Fitness Food
</a>
</li>
<li class="coldcutcat">
<a href="#breakfast" class="enabled" data-id="19" data-text="Cold Cuts" data-index="8" data-slug="breakfast">
<!-- <img class="cat-icon" src="img/coldcut.png"> -->
Cold Cuts
</a>
</li>
<li class="curriescat">
<a href="#kebabs" class="enabled" data-id="39" data-text="Kebabs" data-index="6" data-slug="kebabs">
<!-- <img class="cat-icon" src="img/curries.png"> -->
Curries
</a>
</li><li class="marinadescat">
<a href="#eggs" class="enabled" data-id="30" data-text="Eggs" data-index="7" data-slug="arinades">
<!-- <img class="cat-icon" src="img/marinades.png"> -->
Marinades
</a>
</li>
<li class="sidescat">
<a href="#breakfast" class="enabled" data-id="19" data-text="Cold Cuts" data-index="8" data-slug="breakfast">
<!-- <img class="cat-icon" src="img/sideandaddons.png"> -->
Sides & Addons
</a>
</li>
<li class="cobrand" >
<a href="#cobrand" class="enabled" data-id="19" data-text="8" data-index="8" data-slug="breakfast">
<!-- <img class="cat-icon" src="img/cobrand.png"> -->
Co-brands
</a>
</li>


</ul>
</div>
</div>

<!-- cobrands -->
<div class="brand " style="top:150px;">
<div class="cat-list">
<div class="container">
<ul class="categories">
<li>
<a href="category.php" class="enabled" data-id="1" data-text="Chicken" data-index="1" data-slug="chicken">
<img class="cat-icon" src="img/venky.png">
Venky's
</a>
</li><li>
<a href="#red-meat" class="enabled" data-id="2" data-text="fish" data-index="2" data-slug="red-meat">
<img class="cat-icon" src="img/yummies.jpeg">
Yummies
</a>
</li><li>
<a href="#seafood" class="enabled" data-id="3" data-text="Fish &amp; Seafood" data-index="3" data-slug="seafood">
<img class="cat-icon" src="img/handi.png">
handi
</a>
</li><li>
<a href="#marinades" class="enabled" data-id="4" data-text="Ready to Cook" data-index="4" data-slug="marinades">
<img class="cat-icon" src="img/mccain.png">
Mccain
</a>
</li><li>
<a href="#spreads" class="enabled" data-id="20" data-text="Spreads" data-index="5" data-slug="spreads">
<img class="cat-icon" src="img/persuma.png">
 Prasuma
</a>
</li>
</ul>
</div>
</div>
</div>
<!-- cobrands -->
<!-- category dropdowns -->

</header>
<!-- header two -->
	
<!-- desktop header -->
<!-- mobile header -->
<header class="mobile-header">
<div class="mobile-nav">
<div class="wsmobileheader clearfix ">
<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>


<span class="smlllogo" >
	<img src="img/logo.png" alt="logomobile" width="10%">
</span>

<a href="#" data-toggle="modal" class="bt1" data-target="#exampleModal" style="text-decoration: none;color: #e11e28"><i class="fa fa-map-marker" aria-hidden="true"></i> <i class="fa fa-angle-down dow" aria-hidden="true"></i></a>

<a href="cart.php" class="callusbtn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
<a href="login.php" class="userbtn"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
</div>
<!-- Mobile Header -->
<div class="headtoppart clearfix">
<div class="headerwp clearfix">
<div class="headertopleft">
<div class="headertopright">
</div>
</div>
</div>
<div class="wsmainfull clearfix">
<div class="wsmainwp clearfix">
<!--Main Menu HTML Code-->
<nav class="wsmenu clearfix">
<ul class="wsmenu-list">
<li aria-haspopup="true" class="rightmenu text-center">
<a href="#"><img src="img/logo.png" alt="logomobile" width="50%"></a>
</li>
<li aria-haspopup="true" class="rightmenu">
<form class="topmenusearch">
<input placeholder="Search...">
<button class="btnstyle"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
</li>

<li aria-haspopup="true"><a href="#" class="active menuhomeicon"><i class="fas fa-home"></i><span class="hometext">&nbsp;&nbsp;Home</span></a></li>
<li aria-haspopup="true"><a href="#"><i class="fa fa-align-justify" aria-hidden="true"></i>Product Categories <span class="wsarrow"></span></a>
<ul class="sub-menu">
<li aria-haspopup="true"><a href="category.php"><img src="img/chicken.png" width="15%"> Chicken </a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/mutton.png" width="15%"> </i>Mutton</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/seafood.png" width="15%"> </i>Fish & Prawns</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/readytoeat.png" width="15%"> </i>Heat & Eat</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/fitness.png" width="15%"> </i>Fitness Food</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/coldcut.png" width="15%"> </i>Cold Cuts</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/curry.png" width="15%"> </i>Curries</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/marinades.png" width="15%"> </i>Marinades</a>
   
</li>
<li aria-haspopup="true"><a href="#"><img src="img/brands.png" width="15%"> </i>Co-brands</a>

   <ul class="sub-menu">
                  <li aria-haspopup="true"><a href="#"><i class="fas fa-angle-right"></i><img src="img/venky.png" width="15%"> Venky's</a></li>
                  <li aria-haspopup="true"><a href="#"><i class="fas fa-angle-right"></i><img src="img/yummies.jpeg" width="15%"> Yummies</a></li>
                   <li aria-haspopup="true"><a href="#"><i class="fas fa-angle-right"></i><img src="img/Handi.png" width="15%"> Handi</a></li>
                  <li aria-haspopup="true"><a href="#"><i class="fas fa-angle-right"></i><img src="img/mccain.png" width="15%"> Mccain</a></li>
                  <li aria-haspopup="true"><a href="#"><i class="fas fa-angle-right"></i><img src="img/persuma.png" width="15%"> Prasuma</a></li>
                </ul>

</li>
<li aria-haspopup="true"><a href="#"><img src="img/sides.png" width="15%"> </i>Sides & Addons</a></li>
</ul>
</nav>
<!--Menu HTML Code-->
</div>
</div>


</div>
<!-- mobile header -->
<!-- sidebar-wrapper  -->
</header>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade hidden-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:90px;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="col-md-12 text-center">
<h4 class="location-pop-heading">Choose Delivery Location</h4>
</div>
</div>

<div class="col-md-12">
<div class="location-search-pop">
<p class="city-select">
<span class="city_blr active">Bengaluru</span>
<span class="city_dlh">NCR</span>
<span class="city_hyd">Hyderabad</span>
<span class="city_chandi">Chandigarh</span>
<span class="city_panchkula">Panchkula</span>
<span class="city_mohali">Mohali</span>
<span class="city_mumbai">Mumbai</span>
<span class="city_pune">Pune</span>
<span class="city_chennai">Chennai</span>
</p>


<form action="/action_page.php">
<input type="text" class="form-control" placeholder="Search.." name="search">

</form>



</div>
</div>
</div>  
</div>
<div class="modal-footer text-center">
<a href="#">Use My Location</a>
</div>
</div>
</div>
</div>



<div class="modal-footer text-center">
<!-- <a href="#">Use My Location</a>
 --></div>
</div>
</div>
</div>


<section class="search_product" style="padding-top:50px">
	<div class="container">

<div class="showDefaultProductCategory"></div>


    </div>
</section>


<!-- footer -->
<footer>
<div class="container">
<div class="row">
<div class="col-md-2 logocol">
<img src="{{asset('assets/front-end/img/logo.png')}}" alt="logo">
</div>

<div class="col-md-7 ">
<h4 class="footer-about-head">About The Meat Empire</h4>
<p class="footer-about-para">The Meat Empire is an Indian online aggregator and food delivery start-up founded by ********* in *******. The Meat Empire provides information, menus and user-reviews of Non vegetarian food  as well as food delivery options from partner  in select cities.</p>
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
<li><a href="#">Terms & Conditions</a></li>
<li><a href="#">FAQ </a></li>
<li><a href="#">Privacy Policy </a></li>
<li><a href="#">Refund Policy </a></li>
<li><a href="#">Instructions to Handle Meat At Home  </a></li>

<h5 class="footer-useful-link" style="color:#0d1589;margin-top:10px;font-size:14px">FSSAI Approved</h5>
<h5 class="" style="color:#0d1589;margin-top:10px;font-size:11px;font-weight:500;margin-top:0px">LIC. No. XXXXXXXXXXX</h5>
</ul>
</div>

<div class="col-md-4">
<h5 class="footer-useful-link">Store Address</h5>
<p class="footer-useful-link-p">Unit 107, A 9<br>
Sector 59, Noida - 201309</p>
<h5 class="f16 footer-useful-link">Want to talk to us:</h5>
<p class="footer-useful-link-p"><b>93118 45200 <br>93118 45300</b></p>


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
      <a style="font-size:13px">
@foreach($avaliableCity as $Ckey=>$avaliableCityData)
<?php if($Ckey==0){
  echo $avaliableCityData->name;
}else{
  echo " | ".$avaliableCityData->name; 
}
?>
@endforeach
</a></h5>
<p>
</p>

  <h5 class="shorcutlink"><a href="#">Add shortcut to homepage
</a></h5>

<h5 class="footer-useful-link">Cities We Serve</h5>
<p style="font-size:13px">
@foreach($avaliableCity as $Ckey=>$avaliableCityData)
<?php if($Ckey==0){
  echo $avaliableCityData->name;
}else{
  echo " | ".$avaliableCityData->name; 
}
?>
@endforeach
</p>
</div>

<div class="col-md-12 cities">
<h5 class="footer-useful-link">Popular Searches</h5>
<br>
@foreach($productCateWithPro as $productCateWithProval)
<a style="text-decoration:none;color:" href="{{url('category-product/'.$productCateWithProval['id'])}}"><h5>{{$productCateWithProval['category_name']}}</h5></a>
<p>
@foreach($productCateWithProval['product'] as $productKey=>$productCateWithProvalData)  
<?php 
if($productKey==0){
  echo $productCateWithProvalData['service_name'];
}else{
  echo " | ".$productCateWithProvalData['service_name'];
     }
  ?>
@endforeach
</p>
@endforeach
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
       <input type="file" name="userImg" class="form-control"/>
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

<!-- footer -->   
<script src='{{asset("assets/front-end/js/jquery.min.js")}}'></script>
<script src='{{asset("assets/front-end/js/owl.carousel.min.js")}}'></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/webslidemenu.js')}}"></script>
<script src="{{asset('assets/front-end/js/popper.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/bootstrap.min.js')}}"></script>
<!--- js validation --->
 <script src="{{asset('assets/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script> 
<!--- End js validation --->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-lQ-u7das4d7DuTcjLii2G89FB2FqO-I&libraries=places"></script>
<script type="text/javascript">

$(function(){
getDefaultProductCate();
});

  $(".cobrands").mouseenter(function(){
  $(".brand").css("display", "block");
  });

  $(".brand").mouseleave(function(){
  $(".brand").css("display", "none");
  });
</script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location_pop'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
</script>

<script type="text/javascript">
function getLocation(){
setTimeout(function(){
console.log($('#location_pop').val());
var location=$('#location_pop').val();
$.ajax({
url:"{{url('get-user-location')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',location:location},
success:function(data){

}
});
},500);  
}  

function getDefaultProductCate(){
$.ajax({
url:"{{url('get-product-category')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
$('.showDefaultProductCategory').html(data);
}
});
}

$('#serachProduct').keyup(function(){
var searchItem=$('#serachProduct').val();
if(searchItem){
$.ajax({
url:"{{url('get-search-product')}}",
method:'POST',
data:{searchItem:searchItem,'_token':'{{csrf_token()}}'},
success:function(data){
$('.showDefaultProductCategory').html(data);
}
});
}else{ 
getDefaultProductCate();
}

});


function addToCart(productId,qty,qtyType,type){
$.ajax({
url:"{{url('add-to-cart')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:productId,type:type,qty:qty,qtyType:qtyType},
success:function(data){
if(data=='0'){
  alert('Oop`s Stock Is Empty Please Wait');
  }else{
getCartCount();
}
}
});
}

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
function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
}
</script>