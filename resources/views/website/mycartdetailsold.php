@extends('website.layout.layout2')
@section('content')
<?php 
error_reporting(1);
use App\Product_price_tbl;
use App\Dealofdayprice_tbl;
use App\Tax;
use App\Coupon;
use App\HappyHoursDicount;
use App\SignupDiscount;
use App\Discount;
use App\CuttingInstruction;
use App\FoodService;
use App\Available_city;
use DB;

     $getGeneralCoupon=Coupon::where(['couponType'=>'generalCoupon','status'=>'1'])->get()->toArray();

    if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }

              $cityCategory=Available_city::find($selectCity);
   
?> 
  <?php $total = 0 ?> 
<section class="cart">
<div class="container">
	   <div class="row">
               <div class="col-md-8">
	   	     	    <p  style="float:left;font-size:18px;color:black;font-weight:bold">Item you have selected</p>
	   	     	    <p style="float:right;font-size:18px;color: #2b2f7f;font-weight:bold">Explore More Options</p>
	   	     	    <div class="clearfix"></div>

                <!-------- cart section -----> 
      
               <div id="cartDetailsProduct"></div>

               <div id="cartDetailsDealOfDay"></div>

      <!-------- cart section ----->

         @if(session()->get('checkExpressDelivery')==1)
        <div class="express-checkbox">
             <input type="checkbox" checked onchange="checkExpressDelivery()" id="express" name="express"><b style="padding-left:15px">Opt for Express Delivery, and get your order within an hour.</b>
                   <p style="padding-left:30px">Charges : INR 45 for all locations, except Greater Noida/Patparganj. </p>
          </div>
          @else
        <div class="express-checkbox">
             <input type="checkbox" onchange="checkExpressDelivery()" id="express" name="express"><b style="padding-left:15px">Opt for Express Delivery, and get your order within an hour. </b>
             <p style="padding-left:30px">Charges : INR 45 for all locations, except Greater Noida/Patparganj. </p>
        </div>  
          @endif
@if($cityCategory->category=="C")
         <p style="color: red;
    font-weight: 600;
    margin-top: 20px;">Note: For Location Greater Noida Parpatganj Delivery Time Start From At 12 AM & 4 PM</p>
@else

@endif


           <div class="requirementcol">
            <h6>Add Instructions for your order</h6>
              <textarea class="form-control" id="getUserInstruction" onkeyup="getUserInstruction()" placeholder="For Kitchen or Delivery"></textarea>
                   <!--   <input type="submit" class="btn text-white" style="background:red;border-radius:0px;margin-top:15px;"> -->
            </div>
	   	     </div>
    
        <div class="col-md-1"></div>
	   	     <div class="col-md-3 ">
                <p  style="font-size:18px;color:black;font-weight:bold;">Price Details</p>
                 
                   <div class="row cart-amount" id="cartBill"> </div>  
                   
           </div>	
	         </div>	

	   <div class="row" style="margin-top:50px;">
	   	    <div class="col-md-8 p0">
	   	    	<p  style="font-size:18px;color:black;font-weight:bold">Addons</p> 
	   	    	<div id="side-addon" class="owl-carousel">
	   	   	   @if($foodData)
             @foreach($foodData as $foodDataVal)
               <div class="item sideaddon-item">
                         <img src="{{asset('uploads/foodService/'.$foodDataVal->service_img)}}" width="100%" style="height:160px">
                         <div class="sideaddon-content">
                         	 <h5>{{substr($foodDataVal->service_name,0,30)}}</h5>
                         	 <p>{{$foodDataVal->quantity}} {{$foodDataVal->quantity_type}}</p>
                           <h6 class="text-center" style="padding:5px;">

                  <a onclick="addToCart(<?php echo $foodDataVal->id;?>,'<?php echo $foodDataVal->quantity;?>','<?php echo $foodDataVal->quantity_type;?>')" href="javascript:void(0)">ADD</a>
                            </h6>
                          </div>	     
                </div>
               @endforeach
               @else 
               @endif
              </div>
	   	    </div>
	   	    <div class="col-md-1">
	   	    </div>	
	   	    <div class="col-md-3">
            
                <p  style="font-size:18px;color:black;font-weight:bold">Offers</p>
                <div class="cart-offer">
                   <img src="{{asset('assets/front-end/img/discount.png')}}" width="10%">&nbsp;
                   <span>Select offer/ Apply coupon</span>
                   <p style="font-size:12px">
                  {{$getGeneralCoupon[0]['name']}}
                  Get 
                  <i class="fa fa-inr"></i> 
                  {{ $getGeneralCoupon[0]['off_price']}}
                       
    @if(session()->get('generalCouponId'))

<a href="javascript:void(0)" style="text-decoration:none;font-style:italic;font-size:12px;">
                  Already Used>
                  </a> 
    @else
    <a href="#" data-toggle="modal" data-target="#exampleModal2" style="text-decoration:none;font-style:italic;font-size:12px;">
              <!--     Click Here> -->
                  </a> 
    @endif

                    </p> 
                </div>  
 @if(session()->get('generalCouponId'))
   @else
 <div class="input-group mb-3">
 <input type="text" autocomplete="off" class="form-control" id="applyCouponCodeInput" name="coupon" placeholder="Enter Coupon Code">

  <div class="input-group-prepend">
    <button type="button" onclick="applyCouponCode()" class="btn btn-outline-success" type="button">Apply</button>
  </div>
</div>
   @endif
            </div>
	   	    </div>	
	   </div>	
</div>
     
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
  <div class="container">
     <div class="row">
      <div class="col-md-12 text-center" style="padding-bottom:10px;">
   <h6>Apply Coupon Code & Get More Discount</h6>
   <div id="coupolCodeStatus"></div>
     </div>
      
      <div class="col-md-12 text-center">
<!--       <div style="font-weight:400;border:2px;font-size:20px;">{{$Coupon->name}}</div> -->
<!-- <form class="form-inline" method="post" style="margin-left:80px;"> -->
<div class="input-group mb-3">
 <input type="text" class="form-control" id="applyCouponCodeInput" name="coupon" placeholder="Enter Coupon Code">

  <div class="input-group-prepend">
    <button type="button" onclick="applyCouponCode()" class="btn btn-outline-success" type="button">Apply</button>
  </div>
</div>        
        <!--   </form> -->
      </div>  

     </div> 
  </div>   
      </div>
    </div>
  </div>
</div>    
</section>
@endsection
@section('script')
<!-- javascript -->
<script type="text/javascript">
$(document).ready(function () {
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
   cartDetails();
   cartBill();

   $('#side-addon').owlCarousel( {
        
    loop: true,
    
    items: 4,
    margin: 20,
    autoplay: true,
  nav:true,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    autoplayTimeout: 8500,
    smartSpeed: 450,
    
      responsive: {
      0: {
        stagePadding: 40,
        items: 1
      },
      768: {
        stagePadding: 40,
        items: 3
      },
      1170: {
        stagePadding: 10,
        items: 4
      }
    }
  });


    $('.owl-carousel').find('.owl-nav').removeClass('disabled');
    $('.owl-carousel').on('changed.owl.carousel', function(event) {
  $(this).find('.owl-nav').removeClass('disabled');
});
  });

function addToCart(productId,qty,qtyType,type){
var cartItem=$('.badge').html();
if(cartItem<=0){
alert('Opp`s your Cart Is Empity');
}else{
$.ajax({
url:"{{url('add-to-cart')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:productId,type:type,qty:qty,qtyType:qtyType},
success:function(data){
if(data=='0'){
  alert('Oop`s Stock Is Empty Please Wait');
  }else{
getCartCount();
cartBill();
cartDetails();
}
}
});
}
}

function showLocationPopUp(){
 $(".bt3").trigger("click");
}

function cartBill(){
$.ajax({
url:"{{url('cartBill')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
$('#cartBill').html(data);
}
});
}

function cartDetails(){
$.ajax({
url:"{{url('cartDetails')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
console.log(data);
$('#cartDetailsProduct').html(data[0]);
$('#cartDetailsDealOfDay').html(data[1]);

}
});
}


function changeProductQty(productId,PriceID){

$.ajax({
url:"{{url('update-product-price-cart')}}",
method:'POST',
data:{productId:productId,PriceTblid:PriceID,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
});
}


function changeSpecialCart(productId,PriceID){

$.ajax({
url:"{{url('update-special-product-price-cart')}}",
method:'POST',
data:{productId:productId,PriceTblid:PriceID,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
}); 
}


function minDeliverPriced(MinDelivAmt,ActTotalAmt){
var cartItem=$('.badge').html();
if(cartItem<=0){
alert('Opp`s your Cart Is Empity');
}else{

if(ActTotalAmt>0){
if(ActTotalAmt>=MinDelivAmt){
  window.location.href="{{url('user-login/checkout')}}";
}else{
    alert('Min Order Amount Should Be '+MinDelivAmt +' Rupee For This Location');
}

}else{
    alert('Opp`s you Cart Is Empity');
}
}
}

function increaseProductCount(id){
$.ajax({
url:"{{url('cart-count')}}",
method:'POST',
data:{id:id,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
});
}

function decriseProductCount(id){
$.ajax({
url:"{{url('decrise-count')}}",
method:'POST',
data:{id:id,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
});
}

function increaseSpeProductCount(id){
$.ajax({
url:"{{url('special-cart-count')}}",
method:'POST',
data:{id:id,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
});
}

function decriseSpeProductCount(id){
$.ajax({
url:"{{url('special-decrise-count')}}",
method:'POST',
data:{id:id,'_token':'{{csrf_token()}}'},
success:function(data){
//console.log(data);
cartDetails();
cartBill();
}
});
}

function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
} 

function removeCartItem(id,type){

$.ajax({
url:"{{url('removeCartItem')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id,type:type},
success:function(data){
console.log(data);
cartDetails();
cartBill();
getCartCount();
}
});
}

function applyCouponCode(){

var code=$('#applyCouponCodeInput').val();

$.ajax({
url:"{{url('applyNormalCoupon')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',code:code},
success:function(data){
console.log(data);
if(data==0){
 alert('Please Enter Valide Coupon'); 
}else{
window.location.href="{{url('cart')}}"; 
}

}
});
}

function getUserInstruction(){
var userReq=$('#getUserInstruction').val();
$.ajax({
url:"{{url('getUserInstruction')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',userReq:userReq},
success:function(data){


}
});
}

function checkExpressDelivery(){
if($('#express').is(":checked")){
var status=1;
}else{
var status=0;
}

$.ajax({
url:"{{url('checkExpressDelivery')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',status:status},
success:function(data){
cartBill();
}
});
}

</script>
@stop