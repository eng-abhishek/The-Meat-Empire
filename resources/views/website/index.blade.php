@extends('website.layout.layout')
@section('title','Order Meat Online - Buy Fresh & High Quality Meat at Fair Price on Themeatempire')
@section('content')
<?php 
error_reporting(1);
?>
<!-- slider -->
  <section class="slider">
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-interval="3000" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <!--<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>-->
    <!--<li data-target="#carouselExampleIndicators" data-slide-to="6"></li>-->
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('assets/front-end/img/slider8.jpg')}}" alt="Second slide">
      <div class="container carousel-content8">
       <a href="{{url('category-product/70')}}" style="text-decoration:none;color:white"><img src="{{asset('assets/front-end/img/order-now-button7.png')}}" alt=""></a>
      </div>
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/front-end/img/slider4.jpg')}}" alt="Second slide">
      <div class="container carousel-content">
       <a href="{{url('category-product/71')}}" style="text-decoration:none;color:white"><img src="{{asset('assets/front-end/img/order-now-button8.png')}}" alt=""></a>
      </div>
    </div>
      
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/front-end/img/slider7.jpg')}}" alt="Second slide">
      <div class="container carousel-content7">
        <a href="{{url('category-product/70')}}" style="text-decoration:none;color:white"><img src="{{asset('assets/front-end/img/order-now-button7.png')}}" alt=""></a>
      </div>
    </div>
    
  
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/front-end/img/slider6.jpg')}}" alt="Second slide">
      <div class="container carousel-content6">
       <a href="{{url('category-product/73')}}" style="text-decoration:none;color:white"> <img src="{{asset('assets/front-end/img/order-now-button6.png')}}" alt=""></a>
      </div>
    </div>
 
        <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/front-end/img/slider5.jpg')}}" alt="Second slide">
      <div class="container carousel-content1">
         <a href="{{url('category-product/75')}}" style="text-decoration:none;color:white"><img src="{{asset('assets/front-end/img/order-now-button5.png')}}" alt=""></a>
      </div>
    </div>
 

  </div>
  
  

</div>
 <div class="container bottom-banner" style="background:url('{{asset('assets/front-end/img/bottombg.png')}}');background-size:100%;background-repeat:no-repeat;margin-top:-30px;max-width:993px !important">
<div class="row">
      <div class="col-md-12" style="padding:60px 70px">
           <div class="row text-center">
                <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/express.png')}}" width="100%">
                     <p>Express <br>Delivery Option</p>
                </div>
                <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/freehome.png')}}" width="100%">
                     <p>Free Home <br> Delivery</p>
                </div>

                <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/fresh.png')}}" width="100%">
                     <p>Freshness <br> Guranteed</p>
                </div>  

                <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/quality.png')}}" width="100%">
                     <p>Quality <br>Check</p>
                </div>

                   <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/easy.png')}}" width="100%">
                     <p>Easy <br>Payments</p>
                </div>

                   <div class="col-md-2">
                     <img src="{{asset('assets/front-end/img/timing.png')}}" width="100%">
                     <p>Timing: <br> 9AM-8PM</p>
                </div>    
           </div> 

      </div>  
</div>
</div>

<!--  <marquee behavior="alternate" scrollamount="10"><h2 class="slider-head">Accept Order From <b>9AM</b> to <b>9PM</b></h2></marquee> -->
  </section>
<section class="bestseller" id="bestseller">
      <div class="container">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin:0px;padding:0px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
         <div class="row m0">

<?php 
if($productItem[0]->price>0){
$FirstActPrice7=$productItem[0]->price-($productItem[0]->price/100)*($productItem[0]->service_offer);
}else{
$FirstActPrice7=$productItem[0]->price;
}
?>
            <div class="col-md-2 p0" style="margin-top:10px">
                  <div class="row m0">
                       <div class="col-md-12 p0">
                        <h2 class="bestsellerhead"><a class="sellersubhead">Best </a>Sellers</h2>
                       </div>

                       <div class="col-md-12 p0" style="z-index:99">
                        <div class="smallproductCard fish-finger" style="margin-top:60px">
<a href="{{url('product-detail/'.$productItem[0]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItem[0]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItem[0]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItem[0]->service_name,0,25)}}..</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[0]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart('<?php echo $productItem[0]->id;?>','<?php echo $productItem[0]->quantity;?>','<?php echo $productItem[0]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice">  <span class="ssp" style="font-size:10px"><i class="fa fa-inr" aria-hidden="true">{{ceil($FirstActPrice7)}}</i></span><del class="scp" style="font-size:10px"><i class="fa fa-inr" aria-hidden="true"></i>{{$productItem[0]->price}}</del>
<!--<i style="text-align:right;font-size:10px;" class="smallproductDetails">{{$productItem[0]->quantity}} {{$productItem[0]->quantity_type}}</i>--></p>

</div>
                       </div>
                  </div>  
            </div>

<?php 
if($productItem[1]->price>0){
$pric1=$productItem[1]->price-($productItem[1]->price/100)*($productItem[1]->service_offer);
}else{
$pric1=$productItem[1]->price;
}
?>
            <div class="col-md-5 p0">
                 <div class="row m0">
                      <div class="col-md-12 p0" >
<img src="{{url('assets/front-end/img/bestsold.png')}}" class="bestsold" style="">
<div class="item bigcarousel" >
<div class="productCard">
<a href="{{url('product-detail/'.$productItem[1]->id)}}" style="text-decoration:none">  
<img src="{{asset('uploads/foodService/'.$productItem[1]->service_img)}}" style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItem[1]->id)}}" style="text-decoration:none"> <span class="cardhead">{{substr($productItem[1]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[1]->category_name}}</p>-->
<span class="addtocart"><a onclick="addToCart('<?php echo $productItem[1]->id;?>','<?php echo $productItem[1]->quantity;?>','<?php echo $productItem[1]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px;margin-bottom:3px !important;padding-bottom:3px !important" class="smallprice"> <span class="ssp ssp1"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric1)}}</span><del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{$productItem[1]->price}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItem[1]->quantity}} {{$productItem[1]->quantity_type}}</i>
</p>
</div>
</div>
                       </div> 
                 </div> 
            </div>

<?php 
if($productItem[2]->price>0){
$pric2=$productItem[2]->price-($productItem[2]->price/100)*($productItem[2]->service_offer);
}else{
$pric2=$productItem[2]->price;
}
?>
<?php 
if($productItem[3]->price>0){
$pric3=$productItem[3]->price-($productItem[3]->price/100)*($productItem[3]->service_offer);
}else{
$pric3=$productItem[3]->price;
}
?>
<?php 
if($productItem[4]->price>0){
$pric4=$productItem[4]->price-($productItem[4]->price/100)*($productItem[4]->service_offer);
}else{
$pric4=$productItem[4]->price;
}
?>
<?php 
if($productItem[5]->price>0){
$pric5=$productItem[5]->price-($productItem[5]->price/100)*($productItem[5]->service_offer);
}else{
$pric5=$productItem[5]->price;
}
?>
            <div class="col-md-5 p0" style="margin-top:7px">
                  <div class="row m0">
                       <div class="col-md-6 p0" style="z-index:99">
<div class="smallproductCard">
 <a href="{{url('product-detail/'.$productItem[2]->id)}}" style="text-decoration:none"> 
<img src="{{asset('uploads/foodService/'.$productItem[2]->service_img)}}"
style="width:100%"/></a>

 <a href="{{url('product-detail/'.$productItem[2]->id)}}" style="text-decoration:none"> <span class="smallcardhead">{{substr($productItem[2]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[2]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItem[2]->id;?>,'<?php echo $productItem[2]->quantity;?>','<?php echo $productItem[2]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"> <span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric2)}}</span><del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItem[2]->price)}}</del> 
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItem[2]->quantity}} {{$productItem[2]->quantity_type}}</i>
</p>
</div>
                       </div>
                       <div class="col-md-6 p0" style="z-index:99">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItem[3]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItem[3]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItem[3]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItem[3]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[4]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItem[3]->id;?>,'<?php echo $productItem[3]->quantity;?>','<?php echo $productItem[3]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric3)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItem[3]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItem[3]->quantity}} {{$productItem[3]->quantity_type}}</i>
</p>
</div>
                       </div> 
                  </div> 

                    <div class="row m0" >
                       <div class="col-md-6 p0" style="margin-top:4px;z-index:99">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItem[4]->id)}}" style="text-decoration:none">                          
<img src="{{asset('uploads/foodService/'.$productItem[4]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItem[3]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItem[4]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[4]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItem[4]->id;?>,'<?php echo $productItem[4]->quantity;?>','<?php echo $productItem[
4]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric4)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItem[4]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItem[4]->quantity}} {{$productItem[4]->quantity_type}}</i>
</p>

</div>
                       </div>
                       <div class="col-md-6 p0" style="margin-top:4px;z-index:99">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItem[4]->id)}}" style="text-decoration:none"><img src="{{asset('uploads/foodService/'.$productItem[5]->service_img)}}"
style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItem[4]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItem[5]->service_name,0,30)}}..</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItem[5]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItem[5]->id;?>,'<?php echo $productItem[5]->quantity;?>','<?php echo $productItem[5]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"> <span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric5)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItem[5]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItem[5]->quantity}} {{$productItem[5]->quantity_type}}</i>
</p>
</div>
                       </div> 
                  </div>  
            </div> 
       </div>
    </div>

<div class="carousel-item">
         <div class="row m0">
<?php 
if($productItemAfterSix[0]->price>0){
$price6=$productItemAfterSix[0]->price-($productItemAfterSix[0]->price/100)*($productItemAfterSix[0]->service_offer);
}else{
$price6=$productItemAfterSix[0]->price;
}
?>
            <div class="col-md-2 p0" style="margin-top:10px">
                  <div class="row m0">
                       <div class="col-md-12 p0">
                        <h2 class="bestsellerhead"><a class="sellersubhead">Best </a>Sellers</h2>
                       </div>

                       <div class="col-md-12 p0" style="z-index:99">
                        <div class="smallproductCard fish-finger" style="margin-top:60px">
<a href="{{url('product-detail/'.$productItemAfterSix[0]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterSix[0]->service_img)}}"
style="width:100%"/>
</a>
<a href="{{url('product-detail/'.$productItemAfterSix[0]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[0]->service_name,0,25)}}..</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[0]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterSix[0]->id;?>,'<?php echo $productItemAfterSix[0]->quantity;?>','<?php echo $productItemAfterSix[0]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true">{{ceil($price6)}}</i></span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[0]->price)}}</del>
<!--<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[0]->quantity}} {{$productItemAfterSix[0]->quantity_type}}</i>-->
</p>
</div>
                       </div>
                  </div>  
            </div>

<?php 
if($productItemAfterSix[1]->price>0){
$pric7=$productItemAfterSix[1]->price-($productItemAfterSix[1]->price/100)*($productItemAfterSix[1]->service_offer);
}else{
$pric7=$productItemAfterSix[1]->price;
}
?>
            <div class="col-md-5 p0">
                 <div class="row m0">
                      <div class="col-md-12 p0" >
 <img src="{{url('assets/front-end/img/bestsold.png')}}" class="bestsold" style="">                       
<div class="item bigcarousel" >
<div class="productCard">
<a href="{{url('product-detail/'.$productItemAfterSix[1]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterSix[1]->service_img)}}" style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterSix[1]->id)}}" style="text-decoration:none"><span class="cardhead">{{substr($productItemAfterSix[1]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[1]->category_name}}</p>-->
<span class="addtocart"><a onclick="addToCart(<?php echo $productItemAfterSix[1]->id;?>,'<?php echo $productItemAfterSix[1]->quantity;?>','<?php echo $productItemAfterSix[1]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px;margin-bottom:3px !important;padding-bottom:3px !important" class="smallprice"> <span class="ssp ssp1"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric7)}}</span><del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[1]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[1]->quantity}} {{$productItemAfterSix[1]->quantity_type}}</i>
</p>
</div>
</div>
                       </div> 
                 </div> 
            </div>

<?php 
if($productItemAfterSix[2]->price>0){
$pric8=$productItemAfterSix[2]->price-($productItemAfterSix[2]->price/100)*($productItemAfterSix[2]->service_offer);
}else{
$pric8=$productItemAfterSix[2]->price;
}
?>
<?php 
if($productItemAfterSix[3]->price>0){
$pric9=$productItemAfterSix[3]->price-($productItemAfterSix[3]->price/100)*($productItemAfterSix[3]->service_offer);
}else{
$pric9=$productItemAfterSix[3]->price;
}
?>
<?php 
if($productItemAfterSix[4]->price>0){
$pric10=$productItemAfterSix[4]->price-($productItemAfterSix[4]->price/100)*($productItemAfterSix[4]->service_offer);
}else{
$pric10=$productItemAfterSix[4]->price;
}
?>
<?php 
if($productItemAfterSix[5]->price>0){
$pric11=$productItemAfterSix[5]->price-($productItemAfterSix[5]->price/100)*($productItemAfterSix[5]->service_offer);
}else{
$pric11=$productItemAfterSix[5]->price;
}
?>
            <div class="col-md-5 p0" style="margin-top:7px;z-index:99">
                  <div class="row m0">
                       <div class="col-md-6 p0">
<div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterSix[2]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterSix[2]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterSix[2]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[2]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[2]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterSix[2]->id;?>,'<?php echo $productItemAfterSix[2]->quantity;?>','<?php echo $productItemAfterSix[2]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric8)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[2]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[2]->quantity}} {{$productItemAfterSix[2]->quantity_type}}</i>
</p>
</div>
                       </div>

                       <div class="col-md-6 p0">
                        <div class="smallproductCard" >
 <a href="{{url('product-detail/'.$productItemAfterSix[3]->id)}}" style="text-decoration:none"><img src="{{asset('uploads/foodService/'.$productItemAfterSix[3]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterSix[2]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[3]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[3]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterSix[3]->id;?>,'<?php echo $productItemAfterSix[3]->quantity;?>','<?php echo $productItemAfterSix[3]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric9)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[3]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[3]->quantity}} {{$productItemAfterSix[3]->quantity_type}}</i>
</p>
</div>
                       </div> 
                  </div> 

                    <div class="row m0" >
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterSix[4]->id)}}" style="text-decoration:none"> <img src="{{asset('uploads/foodService/'.$productItemAfterSix[4]->service_img)}}"
style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItemAfterSix[4]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[4]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[4]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterSix[4]->id;?>,'<?php echo $productItemAfterSix[4]->quantity;?>','<?php echo $productItemAfterSix[4]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric10)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[4]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[4]->quantity}} {{$productItemAfterSix[4]->quantity_type}}</i>
</p>
</div>
                       </div>
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterSix[5]->id)}}" style="text-decoration:none">                          
<img src="{{asset('uploads/foodService/'.$productItemAfterSix[5]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterSix[5]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[5]->service_name,0,30)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[5]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart('<?php echo $productItemAfterSix[5]->id;?>','<?php echo $productItemAfterSix[5]->quantity;?>','<?php echo $productItemAfterSix[5]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric11)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterSix[5]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[5]->quantity}} {{$productItemAfterSix[5]->quantity_type}}</i>
</p>

</div>
                       </div> 
                  </div>  
            </div> 
       </div>
    </div>

<!---------- Third Slider ----------->
@if($thirdSlider>=5)

  <div class="carousel-item">
         <div class="row m0">
<?php 
if($productItemAfterEightTeen[0]->price>0){
$price6=$productItemAfterEightTeen[0]->price-($productItemAfterEightTeen[0]->price/100)*($productItemAfterEightTeen[0]->service_offer);
}else{
$price6=$productItemAfterEightTeen[0]->price;
}
?>
            <div class="col-md-2 p0" style="margin-top:10px">
                  <div class="row m0">
                       <div class="col-md-12 p0">
                        <h2 class="bestsellerhead"><a class="sellersubhead">Best </a>Sellers</h2>
                       </div>

                       <div class="col-md-12 p0" style="z-index:99">
                        <div class="smallproductCard fish-finger" style="margin-top:60px">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[0]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[0]->service_img)}}"
style="width:100%"/>
</a>
<a href="{{url('product-detail/'.$productItemAfterEightTeen[0]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterEightTeen[0]->service_name,0,25)}}..</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[0]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterEightTeen[0]->id;?>,'<?php echo $productItemAfterEightTeen[0]->quantity;?>','<?php echo $productItemAfterEightTeen[0]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true">{{ceil($price6)}}</i></span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[0]->price)}}</del>
<!--<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterSix[0]->quantity}} {{$productItemAfterSix[0]->quantity_type}}</i>-->
</p>
</div>
                       </div>
                  </div>  
            </div>

<?php 
if($productItemAfterEightTeen[1]->price>0){
$pric7=$productItemAfterEightTeen[1]->price-($productItemAfterEightTeen[1]->price/100)*($productItemAfterEightTeen[1]->service_offer);
}else{
$pric7=$productItemAfterEightTeen[1]->price;
}
?>
            <div class="col-md-5 p0">
                 <div class="row m0">
                      <div class="col-md-12 p0" >
 <img src="{{url('assets/front-end/img/bestsold.png')}}" class="bestsold" style="">                       
<div class="item bigcarousel" >
<div class="productCard">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[1]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[1]->service_img)}}" style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItemAfterEightTeen[1]->id)}}" style="text-decoration:none"><span class="cardhead">{{substr($productItemAfterEightTeen[1]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[1]->category_name}}</p>-->
<span class="addtocart"><a onclick="addToCart(<?php echo $productItemAfterEightTeen[1]->id;?>,'<?php echo $productItemAfterEightTeen[1]->quantity;?>','<?php echo $productItemAfterEightTeen[1]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px;margin-bottom:3px !important;padding-bottom:3px !important" class="smallprice"> <span class="ssp ssp1"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric7)}}</span><del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[1]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterEightTeen[1]->quantity}} {{$productItemAfterEightTeen[1]->quantity_type}}</i>
</p>
</div>
</div>
                       </div> 
                 </div> 
            </div>

<?php 
if($productItemAfterEightTeen[2]->price>0){
$pric8=$productItemAfterEightTeen[2]->price-($productItemAfterEightTeen[2]->price/100)*($productItemAfterEightTeen[2]->service_offer);
}else{
$pric8=$productItemAfterEightTeen[2]->price;
}
?>
<?php 
if($productItemAfterEightTeen[3]->price>0){
$pric9=$productItemAfterEightTeen[3]->price-($productItemAfterEightTeen[3]->price/100)*($productItemAfterEightTeen[3]->service_offer);
}else{
$pric9=$productItemAfterEightTeen[3]->price;
}
?>
<?php 
if($productItemAfterEightTeen[4]->price>0){
$pric10=$productItemAfterEightTeen[4]->price-($productItemAfterEightTeen[4]->price/100)*($productItemAfterEightTeen[4]->service_offer);
}else{
$pric10=$productItemAfterEightTeen[4]->price;
}
?>
<?php 
if($productItemAfterEightTeen[5]->price>0){
$pric11=$productItemAfterEightTeen[5]->price-($productItemAfterEightTeen[5]->price/100)*($productItemAfterEightTeen[5]->service_offer);
}else{
$pric11=$productItemAfterEightTeen[5]->price;
}
?>
            <div class="col-md-5 p0" style="margin-top:7px;z-index:99">
                  <div class="row m0">
                       <div class="col-md-6 p0">
<div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[2]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[2]->service_img)}}"
style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItemAfterEightTeen[2]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterEightTeen[2]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[2]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterEightTeen[2]->id;?>,'<?php echo $productItemAfterEightTeen[2]->quantity;?>','<?php echo $productItemAfterEightTeen[2]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric8)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[2]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterEightTeen[2]->quantity}} {{$productItemAfterEightTeen[2]->quantity_type}}</i>
</p>
</div>
                       </div>

                       <div class="col-md-6 p0">
                        <div class="smallproductCard" >
 <a href="{{url('product-detail/'.$productItemAfterEightTeen[3]->id)}}" style="text-decoration:none"><img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[3]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterEightTeen[3]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterEightTeen[3]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[3]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterEightTeen[3]->id;?>,'<?php echo $productItemAfterEightTeen[3]->quantity;?>','<?php echo $productItemAfterEightTeen[3]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric9)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[3]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterEightTeen[3]->quantity}} {{$productItemAfterEightTeen[3]->quantity_type}}</i>
</p>
</div>
                       </div> 
                  </div> 

                    <div class="row m0" >
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[4]->id)}}" style="text-decoration:none"> <img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[4]->service_img)}}"
style="width:100%"/></a>

<a href="{{url('product-detail/'.$productItemAfterEightTeen[4]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterEightTeen[4]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[4]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAfterEightTeen[4]->id;?>,'<?php echo $productItemAfterEightTeen[4]->quantity;?>','<?php echo $productItemAfterEightTeen[4]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric10)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[4]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterEightTeen[4]->quantity}} {{$productItemAfterEightTeen[4]->quantity_type}}</i>
</p>
</div>
                       </div>
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[5]->id)}}" style="text-decoration:none">                          
<img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[5]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAfterEightTeen[5]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterSix[5]->service_name,0,30)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[5]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart('<?php echo $productItemAfterEightTeen[5]->id;?>','<?php echo $productItemAfterSix[5]->quantity;?>','<?php echo $productItemAfterEightTeen[5]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric11)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAfterEightTeen[5]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAfterEightTeen[5]->quantity}} {{$productItemAfterEightTeen[5]->quantity_type}}</i>
</p>

</div>
                       </div> 
                  </div>  
            </div> 
       </div>
    </div>

@else 

@endif    
<!---------- Third Slider ----------->

<!---------- Forth Slider ------------>

@if($fourthSlider>=5)
  <div class="carousel-item">
         <div class="row m0">
<?php 
if($productItemAftertwentiFour[0]->price>0){
$price6=$productItemAftertwentiFour[0]->price-($productItemAftertwentiFour[0]->price/100)*($productItemAftertwentiFour[0]->service_offer);
}else{
$price6=$productItemAftertwentiFour[0]->price;
}
?>
            <div class="col-md-2 p0" style="margin-top:10px">
                  <div class="row m0">
                       <div class="col-md-12 p0">
                        <h2 class="bestsellerhead"><a class="sellersubhead">Best </a>Sellers</h2>
                       </div>

                       <div class="col-md-12 p0" style="z-index:99">
                        <div class="smallproductCard fish-finger" style="margin-top:60px">
<a href="{{url('product-detail/'.$productItemAfterEightTeen[0]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAfterEightTeen[0]->service_img)}}"
style="width:100%"/>
</a>

<a href="{{url('product-detail/'.$productItemAftertwentiFour[0]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAfterEightTeen[0]->service_name,0,25)}}..</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[0]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAftertwentiFour[0]->id;?>,'<?php echo $productItemAftertwentiFour[0]->quantity;?>','<?php echo $productItemAftertwentiFour[0]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>
<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true">{{ceil($price6)}}</i></span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[0]->price)}}</del>

</p>
</div>
                       </div>
                  </div>  
            </div>

<?php 
if($productItemAftertwentiFour[1]->price>0){
$pric7=$productItemAftertwentiFour[1]->price-($productItemAftertwentiFour[1]->price/100)*($productItemAftertwentiFour[1]->service_offer);
}else{
$pric7=$productItemAftertwentiFour[1]->price;
}
?>
            <div class="col-md-5 p0">
                 <div class="row m0">
                      <div class="col-md-12 p0" >
 <img src="{{url('assets/front-end/img/bestsold.png')}}" class="bestsold" style="">                       
<div class="item bigcarousel" >
<div class="productCard">
<a href="{{url('product-detail/'.$productItemAftertwentiFour[1]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAftertwentiFour[1]->service_img)}}" style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAftertwentiFour[1]->id)}}" style="text-decoration:none"><span class="cardhead">{{substr($productItemAftertwentiFour[1]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[1]->category_name}}</p>-->
<span class="addtocart"><a onclick="addToCart(<?php echo $productItemAftertwentiFour[1]->id;?>,'<?php echo $productItemAftertwentiFour[1]->quantity;?>','<?php echo $productItemAftertwentiFour[1]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px;margin-bottom:3px !important;padding-bottom:3px !important" class="smallprice"> <span class="ssp ssp1"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric7)}}</span><del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[1]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAftertwentiFour[1]->quantity}} {{$productItemAftertwentiFour[1]->quantity_type}}</i>
</p>
</div>
</div>
                       </div> 
                 </div> 
            </div>

<?php 
if($productItemAftertwentiFour[2]->price>0){
$pric8=$productItemAftertwentiFour[2]->price-($productItemAftertwentiFour[2]->price/100)*($productItemAftertwentiFour[2]->service_offer);
}else{
$pric8=$productItemAftertwentiFour[2]->price;
}
?>
<?php 
if($productItemAftertwentiFour[3]->price>0){
$pric9=$productItemAftertwentiFour[3]->price-($productItemAftertwentiFour[3]->price/100)*($productItemAftertwentiFour[3]->service_offer);
}else{
$pric9=$productItemAftertwentiFour[3]->price;
}
?>
<?php 
if($productItemAftertwentiFour[4]->price>0){
$pric10=$productItemAftertwentiFour[4]->price-($productItemAftertwentiFour[4]->price/100)*($productItemAftertwentiFour[4]->service_offer);
}else{
$pric10=$productItemAftertwentiFour[4]->price;
}
?>
<?php 
if($productItemAftertwentiFour[5]->price>0){
$pric11=$productItemAftertwentiFour[5]->price-($productItemAftertwentiFour[5]->price/100)*($productItemAftertwentiFour[5]->service_offer);
}else{
$pric11=$productItemAftertwentiFour[5]->price;
}
?>
            <div class="col-md-5 p0" style="margin-top:7px;z-index:99">
                  <div class="row m0">
                       <div class="col-md-6 p0">
<div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAftertwentiFour[2]->id)}}" style="text-decoration:none">
<img src="{{asset('uploads/foodService/'.$productItemAftertwentiFour[2]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAftertwentiFour[2]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAftertwentiFour[2]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[2]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAftertwentiFour[2]->id;?>,'<?php echo $productItemAftertwentiFour[2]->quantity;?>','<?php echo $productItemAftertwentiFour[2]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric8)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[2]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAftertwentiFour[2]->quantity}} {{$productItemAftertwentiFour[2]->quantity_type}}</i>
</p>
</div>
                       </div>

                       <div class="col-md-6 p0">
                        <div class="smallproductCard" >
 <a href="{{url('product-detail/'.$productItemAftertwentiFour[3]->id)}}" style="text-decoration:none"><img src="{{asset('uploads/foodService/'.$productItemAftertwentiFour[3]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAftertwentiFour[3]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAftertwentiFour[3]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[3]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAftertwentiFour[3]->id;?>,'<?php echo $productItemAftertwentiFour[3]->quantity;?>','<?php echo $productItemAftertwentiFour[3]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric9)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[3]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAftertwentiFour[3]->quantity}} {{$productItemAftertwentiFour[3]->quantity_type}}</i>
</p>
</div>
                       </div> 
                  </div> 

                    <div class="row m0" >
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAftertwentiFour[4]->id)}}" style="text-decoration:none"> <img src="{{asset('uploads/foodService/'.$productItemAftertwentiFour[4]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAftertwentiFour[4]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAftertwentiFour[4]->service_name,0,38)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[4]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart(<?php echo $productItemAftertwentiFour[4]->id;?>,'<?php echo $productItemAftertwentiFour[4]->quantity;?>','<?php echo $productItemAftertwentiFour[4]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric10)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[4]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAftertwentiFour[4]->quantity}} {{$productItemAftertwentiFour[4]->quantity_type}}</i>
</p>
</div>
                       </div>
                       <div class="col-md-6 p0" style="margin-top:4px">
                        <div class="smallproductCard">
<a href="{{url('product-detail/'.$productItemAftertwentiFour[5]->id)}}" style="text-decoration:none">                          
<img src="{{asset('uploads/foodService/'.$productItemAftertwentiFour[5]->service_img)}}"
style="width:100%"/></a>
<a href="{{url('product-detail/'.$productItemAftertwentiFour[5]->id)}}" style="text-decoration:none"><span class="smallcardhead">{{substr($productItemAftertwentiFour[5]->service_name,0,30)}}</span></a>
<!--<p class="smallproductDetails" style="margin:0px">{{$productItemAfterSix[5]->category_name}}</p>-->
<span class="smalladdtocart"><a onclick="addToCart('<?php echo $productItemAftertwentiFour[5]->id;?>','<?php echo $productItemAftertwentiFour[5]->quantity;?>','<?php echo $productItemAftertwentiFour[5]->quantity_type;?>')" href="javascript:void(0)">Add to Cart</a></span>

<p style="margin:0px;padding:0px" class="smallprice"><span class="ssp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($pric11)}}</span> <del class="scp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($productItemAftertwentiFour[5]->price)}}</del>
<i style="text-align:right;font-size:11px" class="smallproductDetails">{{$productItemAftertwentiFour[5]->quantity}} {{$productItemAftertwentiFour[5]->quantity_type}}</i>
</p>

</div>
                       </div> 
                  </div>  
            </div> 
       </div>
    </div>

@else 

@endif
<!---------- End Fourth Slider ------->


  </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon firstcarouselprev" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next " href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon firstcarouselnext" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</section>
<!-- deal of the dat -->
    <section class="dealsection">
      <div class="dealoftheday">
      <div class="container" >       
      <div class="row">
        <div class="col-md-12 " style="visibility: hidden">
         <h1 class="deal-heading">Deal <span class="subtext">Of the</span> Day</h1>
         </div>
          
        <div class="col-sm-12" style="padding:80px;margin-top:-50px;background-repeat: no-repeat;">
          <img src="{{asset('assets/front-end/img/dealoftheday.png')}}" width="80%" style="position:absolute;top:-100px;left:120px">
         <div style=""> 
          <div id="deal-phase" class="owl-carousel">

@foreach($productDealOfDay as $productDealOfDayData)
<?php 
if($productDealOfDayData['price_tbl'][0]['price']>0){
$DealOfDayProduct=$productDealOfDayData['price_tbl'][0]['price']-($productDealOfDayData['price_tbl'][0]['price']/100)*$productDealOfDayData['offer'];
}else{ 
$DealOfDayProduct=$productDealOfDayData['price_tbl'][0]['price'];
}
?>
           
            <!--categories 1 -->
            <div class="item ">
            <img src="{{url('assets/front-end/img/dealribbon.png')}}" class="dealribbon" style=" width:40%;position:absolute;left:0px;top:10px;z-index:99;">
              <div class="shadow-effect dealhover">
                <a href="javascript:void(0)"><img class="img-responsive" src="{{asset('uploads/dealOfDay/'.$productDealOfDayData['productImg'])}}" alt="Deal Of Day">
                <div class="item-details"></a>
                                <a href="javascript:void(0)" class="youmayproductlink"> <h5>{{substr($productDealOfDayData['foodName'],0,32)}}</h5></a>
                   <span class="ntweight">Nett :{{$productDealOfDayData['price_tbl'][0]['quantity']}} {{$productDealOfDayData['price_tbl'][0]['quantity_type']}}</span>
                     <a class="youmayaddcart" onclick="addToCart('<?php echo $productDealOfDayData['id'];?>','<?php echo $productDealOfDayData['price_tbl'][0]['quantity'];?>','<?php echo $productDealOfDayData['price_tbl'][0]['quantity_type'];?>','special')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>

                   <span class="mrp"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($DealOfDayProduct)}}</span>
                   <span class="cutmrp"><del><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($productDealOfDayData['price_tbl'][0]['price'])}}</del></span>
                 
                </div>
              </div>
            </div>
            <!--END OF categories 1 -->
           @endforeach 
   
          </div>
        </div>
      </div>
      </div>
    </div>
</div>
    </section>
<!-- deal of the day -->


<!-- 
<section section category -->
<section class="explorecategories">
  <div class="container">
      <div class="row" >
        <div class="col-md-12 text-center" style="position:relative;top:80px;">
           <h1 class="explore">Explore By</h1><h1 class="catheading"> Categories</h1>
        </div>  
              <!--categories 1 -->
            <div class="col-md-3 col-sm-6" >
             <div class="shadow-effect cathover">
               <a href="{{url('category-product/'.$productCategory[0]['id'].'/ebc')}}" style="text-decoration:none;"> <img class="img-responsive" src="{{asset('uploads/foodCategory/'.$productCategory[0]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                <a href="{{url('category-product/'.$productCategory[0]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[0]['category_name']}}</h5>
                </a>
                </div>
            
            </div>
          </div>
            <!--END OF categories 1 -->
             <!--categories 2 -->
            <div class="col-md-3  col-sm-6" style="margin-top:80px;">
              <div class="shadow-effect cathover">
               <a href="{{url('category-product/'.$productCategory[1]['id'].'/ebc')}}" style="text-decoration:none;"> <img class="img-responsive" src="{{asset('uploads/foodCategory/'.$productCategory[1]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                <a href="{{url('category-product/'.$productCategory[1]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[1]['category_name']}}</h5>
                </a>
                  
                  
                </div>
              </div>
            </div>
            <!--END OF categories 2 -->

            <!--categories 3 -->
            <div class="col-md-3  col-sm-6" style="margin-top:120px;" >
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[2]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[2]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                  <a href="{{url('category-product/'.$productCategory[2]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[2]['category_name']}}</h5>
                </a>
                </div>
              </div>
            </div>
            <!--END OF categories 3 -->
               <!--categories 4 -->
            <div class="col-md-3  col-sm-6" style="margin-top:60px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[3]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[3]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                  <a href="{{url('category-product/'.$productCategory[3]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[3]['category_name']}}</h5>
                </a>
                
                </div>
              </div>
            </div>
            <!--END OF categories 4 -->
               <!--categories 5 -->
            <div class="col-md-3  col-sm-6" style="margin-top:-100px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[4]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[4]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                <a href="{{url('category-product/'.$productCategory[4]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[4]['category_name']}}</h5>
                </a>
                </div>
              </div>
            </div>
            <!--END OF categories 5 -->
              <!--categories 6 -->
            <div class="col-md-3 col-sm-6" style="margin-top:-20px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[5]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[5]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                  <a href="{{url('category-product/'.$productCategory[5]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[5]['category_name']}}</h5>
                </a>
                </div>
              </div>
            </div>
            <!--END OF categories 6 -->

            <!--categories 7 -->
            <div class="col-md-3 col-sm-6" style="margin-top:30px">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[6]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[6]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
              <a href="{{url('category-product/'.$productCategory[6]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[6]['category_name']}}</h5>
                </a>
                </div>
              </div>
            </div>
            <!--END OF categories 7 -->
      
            <!--categories 2 -->
            <div class="col-md-3 col-sm-6"  style="margin-top:-40px;" >
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[7]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[7]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                <a href="{{url('category-product/'.$productCategory[7]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[7]['category_name']}}</h5>
                </a>
                </div>
              </div>
            </div>
            <!--END OF categories 2 -->
           
           <!--categories 2 -->
            <div class="col-md-3" style="margin-top:-110px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[8]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[8]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                   <a href="{{url('category-product/'.$productCategory[8]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[8]['category_name']}}</h5>
                </a>
          
                </div>
              </div>
            </div>
            <!--END OF categories 2 -->


  <!--categories 2 -->
            <div class="col-md-3 col-sm-6" style="margin-top:-30px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[9]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[9]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                 <a href="{{url('category-product/'.$productCategory[9]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[9]['category_name']}}</h5>
                </a>
            
                </div>
              </div>
            </div>

            <!--new 1-->
                <div class="col-md-3" style="margin-top:20px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[10]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[10]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                   <a href="{{url('category-product/'.$productCategory[10]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[10]['category_name']}}</h5>
                </a>
          
                </div>
              </div>
            </div>
            <!--new1-->
            <!--new 2-->
                 <div class="col-md-3" style="margin-top:-50px;">
              <div class="shadow-effect cathover">
                <a href="{{url('category-product/'.$productCategory[11]['id'].'/ebc')}}" style="text-decoration:none;"><img class="img-responsive" class="rounded" src="{{asset('uploads/foodCategory/'.$productCategory[11]['category_img'])}}" alt="Explore Categories"></a>
                <div class="item-details">
                   <a href="{{url('category-product/'.$productCategory[11]['id'].'/ebc')}}" style="text-decoration:none; color:#ec2224;"><h5>{{$productCategory[11]['category_name']}}</h5>
                </a>
          
                </div>
              </div>
            </div>
            <!--new 2-->
            
            <!--END OF categories 2 -->
           
          </div>
        </div>    
      </div>
      </div>
    </section>
    <!-- END OF categories -->
    
    <!-- why meat empire -->
          <section class="whymeatempire">
            <div class="container-fluid p0">
               <div class="row">
               <div class="col-md-12 text-center" style="z-index:99;visibility:hidden">
                     <h1 class="why-heading text-center">Why the Meat Empire?</h1> 
                     <a href="#" class="WHYMORE">TAP TO READ MORE</a>
               </div> 
               
               <div class="col-md-12" style="margin-top:-270px;">
              <a href="{{url('what-we-guarantee')}}" data-eventlabel="What We Guarantee"> <img src="{{asset('assets/front-end/img/whybg.jpg')}}" width="100%"> </a>
               </div> 
                </div>
          </section>
    <!-- why meat empire -->

    <!-- other cobrands -->
          <section class="othercobrands">
                  <div class="container">
                       <div class="row">
                            <div class="col-md-6">
                                 <h1 class="cobrands"><a style="border-top:8px solid #ec2224;padding-bottom:0px;font-family: mainheading;">OTHE</a>R <p>BRANDS</p><p>AVAILABLE</p><p>WITH US</p></h1>
                            </div>
                            <div class="col-md-6" style="margin-top:20px">
                         <img src="{{asset('assets/front-end/img/cobrands.png')}}" width="100%"> 
                             </div> 
                       </div> 
                  </div>  
            </section>
    <!-- other cobrands -->

     <!-- testimonials -->
     <section class="testimonials">
     <div class="container-fluid " style="background:url({{asset('assets/front-end/img/testi.png')}});background-size:contain;background-repeat:no-repeat;z-index:999;padding:0px 130px">
    <div class=" row " style="" >
      <div class="col-lg-12 col-md-12 p0 text-center">
           <h1 class="customerheading">Customer Review</h1>
            <p style="color:#fff"><span class="fa fa-star mr-1"></span><span class="fa fa-star mr-1"></span><span class="fa fa-star mr-1">
            </span><span class="fa fa-star mr-1"></span><span class="fa fa-star-half-o mr-1" style="color:#e11e28;cursor:pointer;"></span>
            <span class="number" style="color:#fff">
                4.5/5</span></p>
        </div>  

         <div class="col-lg-12 col-md-12"> 
          <div id="customers-testimonials2" class="owl-carousel">

               @foreach($testimonial as $testimonialData)  
          <div class="item">
                <div class="row">
                      <div class="col-md-12 text-center" style="z-index:9999999">
                        <div  style="">
                         <img src="{{asset("uploads/testimonial/$testimonialData->clint_img")}}" style="border-radius:50%;height:80px;width:80px;margin-left:35%;z-index:1">
                        </div>
                      </div>
                       <div class="col-md-12 text-center" style="background:#fff;margin-top:-20px;border-radius:20px;z-index:9999;">
                         <div style="padding:10px;">
                      <div class="name" style="padding-bottom:0px;padding-top:15px;z-index:999999">{{$testimonialData->clint_name}}<br> 
                      <p style="margin-bottom:0.6em;color:#6f7275;">{{$testimonialData->clint_designation}}</p></div>
                  
                     <p style="margin:0px">
                           <?php
                           $rate=explode('.',$testimonialData->client_rate);
                           $fullRate=$rate[0];
                           $halfRate=$rate[1];
                           for($k=1;$k<=5;$k++){
                           if(ceil($fullRate)>=$k){
                            ?>
                            <span class="fa fa-star mr-1"></span>
                            <?php
                             }else{
                        if($halfRate==5){
                           ?>
                          <span class="fa fa-star-half-o mr-1" style="color: #e11e28;cursor:pointer"></span>
                          <?php
                          $halfRate=0;
                               }else{
                           echo"<span class='fa fa-star-o mr-1'></span>"; 
                               }
                             }

                            }

                            ?> 
                          </p>
                          
                  <span class="number">{{$testimonialData->client_rate}}/5</span>
                 <p>
                   {!! substr($testimonialData->clint_msg,0,150) !!}..&nbsp;<a href="javascript:void(0)" onclick="showTestimonialData({{$testimonialData->id}})">Read More.</a>
                 </p>
                 <a href="{{$testimonialData->clint_fb_url}}" style="z-index:99999999;cursor:pointer !important"><i class="fa fa-facebook-square"  style="font-size:20px;color:#3a5794"></i></a>
                 <a href="{{$testimonialData->clint_insta_url}}" style="z-index:99999999;cursor:pointer !important"><i class="fa fa-instagram" style="font-size:20px;color:#d62977;padding-left:10px"></i></a>
                </div> 
               </div>  
                </div>  
                             
            </div>
          @endforeach
        
        </div>
    </div>
  </div>
</div>
</section>
<!-- Modal -->
    <div class="modal fade" id="testimonialmodala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content " style="border-radius: 15px;">

                <div class="modal-dialog modal-dialog-centered" style="pointer-events:all">

                    <div class="modal-body text-center" id="clientFB" style="padding:5p 5px;padding-bottom: 0px;">

                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin: auto; color: black; background-color: rgb(235, 235, 235); border: none; font-size: .9em;">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!--modal close -->
@endsection
@section('script')
     <!-- testimonials -->
<script type="text/javascript">
  $(window).scroll(function() {
  if ($(this).scrollTop() > 20) {
      $("#head2").css("display","block");
     
    //   $('.bt3').css('display','none');
       $(".header-new").hide();
       $(".brand").css("top","150px");
       $(".categorycontainer").css("margin-top","-100px !important")
} else {
             $(".header-new").show();
             $("#head2").css("display","none");
             $(".categorycontainer").css("margin-top","250px !important")
        
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
  }else if(data=='10'){
  alert('Item Side & Addons Add After Added Any Product');
  }else if(data=='11'){
$('#alreadyExtCartItemPopUp').show(); 
$('#alreadyExtCartItemPopUp').delay(3000).fadeOut('slow');
   }else{
  getCartCount();
$('#addCartPopUp').show(); 
$('#addCartPopUp').delay(5000).fadeOut('slow');
}
}
});
}

function hideloader(){
 $('.preloader').hide();   
}

function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
}

function showTestimonialData(id){
setTimeout(function(){
showmodalPopup();
},1000)

$.ajax({
url:"{{url('readMoreTestimonial')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id},
success:function(data){
$('#clientFB').html(data); 
}
});
}

function showmodalPopup(){
$('#testimonialmodala').modal('show');
}
</script>
<script>
      $(window).resize(function() {

  if ($(this).width() >= 1197) {
    
  }
  else{

 if($('#checkSector').val()){

 }
 else{
 $(".bt1").trigger("click");


 }
 }

});
</script>
@stop