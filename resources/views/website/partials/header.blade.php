<?php 
error_reporting(1);
use App\FoodCategory;
use App\Available_city;
use App\CoBrond;
$productCate=FoodCategory::where(array('top_bar_cateStatus'=>'1'))->get()->toArray();
$avaliableCity=Available_city::orderBy('id','ASC')->get();
 $CoBrond=CoBrond::where('status','1')->get();
              if(session()->get('city') || session()->get('city')=='0'){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
 //$setCityInHeader=Available_city::find($selectCity)->name;
  $cityCategory=Available_city::find($selectCity);
 $setCityInHeader=$cityCategory->name;
 ?>
<header class="header-new desktop-header">
<div class="header-wrapper">
<div class="top-nav" style="">
<div class="container">
<div class="header-menu-new">
<ul style="list-style-type: none;margin-top:5px !important">
<li class="why-meatempire">
<a href="{{url('what-we-guarantee')}}" target=_blank data-eventlabel="What We Guarantee">
What We Guarantee
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
@if(session()->get('loginEmail'))
<li class="about-us" style="border-left:1px solid #fff">
<a href="{{url('user-profile')}}">
My Account  /</a> <a href="{{url('user-logout')}}">Logout</a>
</li>
@else
<li class="about-us" style="border-left:1px solid #fff">
<a href="{{url('user-login')}}">
Signup /</a> <a href="{{url('user-login')}}">Login</a>
</li>
@endif

<li class="certification">
 
 
<a href="https://wa.me/919311845200"  data-toggle="tooltip" data-placement="bottom" title="Order On Whatsapp" target="_blank">
<img src="{{asset('assets/front-end/img/whatsappicon.png')}}" width="40px" style="position:absolute;right:30px;top:2px">
</a>
<!-- <div style="position: absolute;right: 71px;top: 7px;" class="sharethis-inline-share-buttons"></div>ShareThis END -->

</li>
</ul>
</div>
</div>
</div>
<div class="sub-header" data-spy="affix" data-offset-top="18" style="">
<div class="container">
<div class="header-logo">
<a href="{{url('/')}}" data-eventlabel="Logo">
<img src="{{asset('assets/front-end/img/logo2.png')}}" alt="meant empire logo">
</a>
</div>
<a style="text-decoration:none;" href="{{url('search')}}">
<div class="search-bar disabled">
<input class="search-input" placeholder="Search for any delicious product">
<span class="search-placeholder">Search</span>
<i class="fa fa-search search-logo" aria-hidden="true" style="color:#fff"></i>
<span class="clear-button">CLEAR</span>
</div></a>
<div class="location">
<img src="{{asset('assets/front-end/img/location.png')}}"> <span class=""><b>Area Location</b></span>

<div class="dropdown">
<a class="dropdown-toggle bt3" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
{{$setCityInHeader}}
</a>

<div class="dropdown-menu desktop-dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="container">
<div class="row">
<div class="col-md-12 text-left">
<h4 class="location-pop-heading">SELECT  YOUR LOCATION</h4>
</div>

<form method="post" id="placeOrder" action="{{url('product-by-city')}}">
<div class="col-md-12 text-center">
<div class="location-search-pop">
  @csrf
<select class="form-control city-select" onchange="checkcityCategory(this.value)" name="id" style="border-radius:0px">
 @foreach($avaliableCity as $avaliableCityData)
<option <?php if($selectCity==$avaliableCityData->id){ echo"selected"; } ?> value="{{$avaliableCityData->id}}">
  {{$avaliableCityData->name}}
</option>
@endforeach
</select> 
<!-- <div class="loc-pop-close">×</div> -->

<input type="text" name="chksector" hidden id="checkSector" value="{{session()->get('location')}}">
<div class="search-field">
<select id="searchSector" name="location" class="form-control location-input pac-target-input" autocomplete="off" style="border-radius:0px !important">
<option value="">Select Location</option>  
</select>
</div>

<!-- <div id="searchsector" style="background:#fff;height:80px;width:100%;display:none"></div>
  -->
<!--    <div class="dateandtime" style="border-radius:32px;background:transparent;margin-top:10px;border:1px solid #fff;">
                  <div class="row">
                    <div class="col-md-6" style="border-right:1px solid #fff;">

                         <input type="text" name="date" class="form-control date plright" placeholder="Select Date" style="position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px">
                         <i class="fa fa-calendar" style="position:absolute;top:8px;left:30px;color:#fff;font-size:13px;"></i>
                    </div>
                <div class="col-md-6" style="">
                         <input type="text" 
name="time" class="form-control tm plright" id="setTime" autocomplete="off" placeholder="Select Time" style="cursor:pointer;position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px" readonly>
                         <i class="fa fa-clock-o" style="position:absolute;top:8px;left:30px;color:#fff;"></i>
                    </div>

                  </div>
                </div>
                 -->
                        
 <!---------- Date Time ------->   


                  <!-- <div class="timedrop" style="background:white;width:100%;display:none;border-radius:10px;">
                         <div class="row">

               <div class="col-md-5" >
                      <select class="form-control setHrAcCat" id="hours" style="font-size:11px;">
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
                             <select class="form-control" id="placeOrderSec" style="font-size:11px;">
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
                     </div>  -->
  <!---------- Date Time ------->   

<input type="submit" class="btn place-order" value="Submit">
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

<li ><a href="{{url('cart')}}"><img src="{{asset('assets/front-end/img/cart2.png')}}" height="25px"> <span class="badge"></span></a></li>
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
@foreach($productCate as $showProductCateData)
<li class="chickencat">
<a href="{{url('category-product/'.$showProductCateData['id'])}}" class="enabled" data-id="1" data-text="Chicken" data-index="1" data-slug="chicken">
<img class="cat-icon" src="<?php echo asset('uploads/foodCategoryLogo/').'/'.$showProductCateData['category_logo']; ?>">
{{$showProductCateData['category_name']}}
</a>
</li>
@endforeach
<li class="cobrand">
<a href="#cobrand" class="enabled" data-id="19" data-text="8" data-index="8" data-slug="breakfast">
<img class="cat-icon" src="{{asset('assets/front-end/img/cobrand.png')}}">
Co-brands
</a>
</li>
</ul>
</div>
</div>
<div style="width:100%;height:60px;background:#2b2f7f"></div>
<!-- cobrands -->
<!-- <div class="brand" >
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
 --><!-- cobrands -->
<!-- category dropdowns -->

</header>

<!-- header two -->

<header class="header-two desktop-header " id="head2">

<div class="header-wrapper">
<div class="top-nav" style="">
<div class="container">
<div class="header-menu-new">
<ul style="list-style-type: none;">
<li class="why-meatempire">
<a href="{{url('what-we-guarantee')}}" target=_blank data-eventlabel="What We Guarantee">
What We Guarantee
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
@if(session()->get('loginEmail'))
<li class="about-us" style="border-left:1px solid #fff">
<a href="{{url('user-profile')}}">
My Account  /</a> <a href="{{url('user-logout')}}">Logout</a>
</li>
@else
<li class="about-us" style="border-left:1px solid #fff">
<a href="{{url('user-login')}}">
Signup /</a> <a href="{{url('user-login')}}">Login</a>
</li>
<li class="certification">
<a href="https://wa.me/919311845200"  data-toggle="tooltip" data-placement="bottom" title="Order On Whatsapp" target="_blank">
<img src="{{asset('assets/front-end/img/whatsappicon.png')}}" width="40px" style="position:absolute;right:30px;top:2px">
</a>
</li>
@endif
</ul>
</div>
</div>
</div>
<div class="sub-header" data-spy="affix" data-offset-top="18">
<div class="container">
<div class="header-logo">
<a href="{{url('/')}}" data-eventlabel="Logo">
<img src="{{asset('assets/front-end/img/logo2.png')}}" alt="meant empire logo">
</a>
</div>
<!-- <div class="search-bar disabled">
<input class="search-input" placeholder="Search for any delicious product">
<span class="search-placeholder">Search</span>
<i class="fa fa-search search-logo" aria-hidden="true"></i>
<span class="clear-button">CLEAR</span>
</div> -->
<a style="text-decoration:none;" href="{{url('search')}}">
<div class="search-bar disabled">
<input class="search-input" placeholder="Search for any delicious product">
<span class="search-placeholder">Search</span>
<i class="fa fa-search search-logo" aria-hidden="true"></i>
<span class="clear-button">CLEAR</span>
</div></a>

<div class="location">
<img src="{{asset('assets/front-end/img/location.png')}}" > <span class=""><b>Area Location</b></span>

<div class="dropdown">
<a class="dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
{{$setCityInHeader}}
</a>

<div class="dropdown-menu desktop-dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="container">
<div class="row">
<div class="col-md-12 text-left">
<h4 class="location-pop-heading" style="font-size:14px;">SELECT &nbsp; YOUR &nbsp; LOCATION</h4>
</div>
<div class="col-md-12 text-center">
<div class="location-search-pop">
<form method="post" action="{{url('product-by-city')}}">
@csrf
<select class="form-control city-select" onchange="checkcityCategorySec(this.value)" name="id" style="border-radius:0px">
 @foreach($avaliableCity as $avaliableCityData)
<option <?php if($selectCity==$avaliableCityData->id){ echo"selected"; } ?> value="{{$avaliableCityData->id}}">
  {{$avaliableCityData->name}}
</option>
@endforeach
</select>
    
<!-- <div class="loc-pop-close">×</div> -->
<div class="search-field">
<select id="searchSectorSec" name="location" class="form-control location-input pac-target-input" autocomplete="off" style="border-radius:0px !important">
<option value="">Select Location</option>  
</select>
</div>


<!--<div id="searchsector" style="background:#fff;height:80px;width:100%;display:none"></div>-->

       <!--   <div class="dateandtime" style="border-radius:32px;background:transparent;margin-top:10px;border:1px solid #fff;">
                  <div class="row">
                    <div class="col-md-6" style="border-right:1px solid #fff;">

                         <input type="text" name="date" class="form-control date plright" placeholder="Select Date" style="position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px">
                         <i class="fa fa-calendar" style="position:absolute;top:8px;left:30px;color:#fff;font-size:13px;"></i>
                    </div>
                <div class="col-md-6" style="">
                         <input type="text" 
name="time" class="form-control tm plright" id="SecsetTime" autocomplete="off" placeholder="Select Time" style="cursor:pointer;position:relative;background:transparent;border:none;color:#fff;outline:none;border:none;font-size:13px" readonly>
                         <i class="fa fa-clock-o" style="position:absolute;top:8px;left:30px;color:#fff;"></i>
                    </div>

                  </div>
                </div> -->
                
                 <!---------- Date Time ------->               
                
                <!--   <div class="timedrop" style="background:white;width:100%;display:none;border-radius:10px;">
                         <div class="row">

               <div class="col-md-5" >
                      <select class="form-control" id="Sechours" style="font-size:11px;">
          @if($cityCategory->category=="C")
             <option value="12 PM">12 PM</option>
             <option value="04 AM">04 AM</option>
          @else
                      <option value="09 PM">09 PM</option>
                      <option value="10 PM">10 PM</option>
                      <option value="11 PM">11 PM</option>
                      <option value="12 AM">12 PM</option>
                      <option value="09 AM">01 AM</option>
  <option value="02 AM">02 AM</option>
  <option value="03 AM">03 AM</option>
  <option value="04 AM">04 AM</option>
  <option value="05 AM">05 AM</option>
  <option value="06 AM">06 AM</option>
  <option value="07 AM">07 AM</option>
  <option value="08 AM">08 AM</option>
      @endif 
                       </select>
                 </div> 

                             <div class="col-md-2">
                                  <span>:</span>
                             </div>

       <div class="col-md-5">
                             <select class="form-control" id="SecplaceOrderSec" style="font-size:11px;">
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
                     </div>  -->
  <!---------- Date Time ------->      
                
<input type="submit" class="btn place-order" value="Submit">
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
<li ><a href="{{url('cart')}}"><img src="{{asset('assets/front-end/img/cart2.png')}}" height="25px"> <span class="badge"></span></a></li>
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


@foreach($productCate as $showProductCateData)
<li class="chickencat">
<a href="{{url('category-product/'.$showProductCateData['id'])}}" class="enabled" data-id="1" data-text="Chicken" data-index="1" data-slug="chicken">
<!-- <img class="cat-icon" src="img/chicken.png"> -->
{{$showProductCateData['category_name']}}
</a>
</li>
@endforeach

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


<div class="brand" >
<div class="cat-list">
<div class="container">
<ul class="categories">
  @foreach($CoBrond as $CoBrondData)
<li>
<a href="{{url('category-product/'.$CoBrondData->id.'/cobrand')}}" class="enabled" data-id="1" data-text="Chicken" data-index="1" data-slug="chicken">
<img class="cat-icon" src="{{asset("uploads/cobrands/$CoBrondData->img")}}">
{{$CoBrondData->name}} 
</a>
</li>
@endforeach
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

<a href="{{url('/')}}">
<span class="smlllogo" >
  <img src="{{asset('assets/front-end/img/logo.png')}}" alt="logomobile" width="10%">
</span>
</a>
<a href="{{url('cart')}}" class="callusbtn" style="right:90px !important"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span class="badge" style="background:#e11e28;color:white;font-size:10px;border-radius:20px;    top: -5px;
    left: 2px;
    position: relative;"></span></a>
<a href="#" data-toggle="modal" class="bt1" data-target="#exampleModal" style="text-decoration: none;color: #e11e28"><i class="fa fa-map-marker" aria-hidden="true"></i> <i class="fa fa-angle-down dow" aria-hidden="true"></i></a>



<div class="dropdown">

      <a href="#" class="userbtn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
 @if(session()->get('loginEmail'))
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{url('user-profile')}}">My Account</a>
    <a class="dropdown-item" href="{{url('user-logout')}}">Logout</a>
  </div>
@else  
  <div class="dropdown-menu">
      <a class="dropdown-item" href="{{url('user-login')}}">Login/Signup</a>
  </div>
@endif  
</div>
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
<a href="#"><img src="{{asset('assets/front-end/img/logo.png')}}" alt="logomobile" width="50%"></a>
</li>
<li aria-haspopup="true" class="rightmenu">
<form class="topmenusearch">
<a href="#"><input placeholder="Search..." readonly style="top:-20px">
<button class="btnstyle"><i class="fa fa-search" aria-hidden="true"></i></button></a>
</form>
</li>

<li aria-haspopup="true"><a href="{{url('/')}}" class="active menuhomeicon"><i class="fas fa-home"></i><span class="hometext">&nbsp;&nbsp;Home</span></a></li>
<li aria-haspopup="true"><a href="#"><i class="fa fa-align-justify" aria-hidden="true"></i>Product Categories <span class="wsarrow"></span></a>
<ul class="sub-menu">
@foreach($productCate as $showProductCateData)

<li aria-haspopup="true"><a href="{{url('category-product/'.$showProductCateData['id'])}}"><img src="<?php echo asset('uploads/foodCategoryLogo/').'/'.$showProductCateData['category_logo']; ?>" width="15%"> 
{{$showProductCateData['category_name']}}
 </a>
</li>

@endforeach

<li aria-haspopup="true"><a href="#">
<img src="{{asset('assets/front-end/img/cobrand.png')}}" width="15%"> </i>Co-brands</a>

   <ul class="sub-menu">
                @foreach($CoBrond as $CoBrondData)
                  <li aria-haspopup="true">
                  <a href="{{url('category-product/'.$CoBrondData->id.'/cobrand')}}"><i class="fas fa-angle-right"></i><img src="{{asset('uploads/cobrands/'.$CoBrondData->img)}}" width="15%">
                  {{$CoBrondData->name}} 
                  </a></li>
@endforeach
                </ul>
</li>
<!--<li aria-haspopup="true"><a href="#"><img src="{{asset('assets/front-end/img/sides.png')}}" width="15%"> </i>Sides & Addons</a></li>-->
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

<div class="col-md-12 text-center">
<h4 class="location-pop-heading" style="color:black">SELECT YOUR LOCATION</h4>
</div>
</div>

<div class="col-md-12 text-center">
<div class="location-search-pop" style="background:#e6e6e6">

  <form method="post" id="placeOrder" name="placeOrder" action="{{url('product-by-city')}}">
  @csrf  
<select class="form-control city-select-mobile-view" onchange="checkcityCategoryMobile(this.value)"  name="id" style="border-radius:0px">
 @foreach($avaliableCity as $avaliableCityData)
<option <?php if($selectCity==$avaliableCityData->id){ echo"selected"; } ?> value="{{$avaliableCityData->id}}">
  {{$avaliableCityData->name}}
</option>
@endforeach
</select>
    
<!-- <div class="loc-pop-close">×</div> -->
<div class="search-field" style="margin-top:10px;border:none">
<select id="searchSectorMobile" name="location" class="form-control location-input pac-target-input" autocomplete="off" style="border-radius:0px !important;border:none">
<option value="">Select Location</option>  
</select>
</div>
    
                    
<input type="submit" class="btn place-order" value="Submit">
</form>


</div>

</div>  
</div>

</div>
</div>
</div>


