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

    if(session()->get('city')){
             echo $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
     $cityDetails=DB::table('available_cities')
     ->select('available_cities.name','available_cities.id','min_order_amounts.amount','min_order_amounts.category')
     ->join('min_order_amounts','available_cities.category','=','min_order_amounts.category')
     ->where('available_cities.id',$selectCity)
     ->get();
     $cityMinDelivPrice=$cityDetails[0]->amount;


$avaliableCity=Available_city::orderBy('id','ASC')->get();

 $firstdiccountLimit=Discount::find('1');
 $seconddiccountLimit=Discount::find('2');
 
 $now = date('Y-m-d');
 $happyHours=HappyHoursDicount::whereDate('from_date','<=',$now)->whereDate('to_date','>=',$now)->where('status','1')->get()->toArray();

$Coupondata=Coupon::where('cartPageStatus','1')->get();
if($Coupondata){
$Coupon=$Coupondata[0];
}
$taxAmount=Tax::find('1');
// echo"<pre>";
// print_r(session()->get('cart'));
?> 
  <?php $total = 0 ?> 
<section class="cart">
<div class="container">
	   <div class="row">
               <div class="col-md-8">
	   	     	    <p  style="float:left;font-size:18px;color:black;font-weight:bold">Item you have selected</p>
	   	     	    <p style="float:right;font-size:18px;color: #2b2f7f;font-weight:bold">Explore Menu</p>
	   	     	    <div class="clearfix"></div>

                <!-------- cart section -----> 
      
                 <div id="cartDetailsProduct"></div>

               <div id="cartDetailsDealOfDay"></div>

      <!-------- cart section ----->
	   	     </div>
    
           <div class="col-md-1"></div>
	   	     <div class="col-md-3 ">
        <p  style="font-size:18px;color:black;font-weight:bold"><!-- 1 item you have selected --></p>
                <div class="cart-address">
                	 <img src="{{url('assets/front-end/img/cartlocation.png')}}">&nbsp;
                	 <span>Current Address</span> <p> Noida Uttar Pradesh</p>
                	 <a onclick="showLocationPopUp()" href="javascript:void(0)">Change</a>
                </div>
	   	     </div>	


	   </div>	

	   <div class="row" style="margin-top:50px;">
	   	    <div class="col-md-8 p0">
	   	    	<p  style="font-size:18px;color:black;font-weight:bold">Addons</p> 
	   	    	<div id="side-addon" class="owl-carousel">
	   	    	 
             @if($foodData)

             @foreach($foodData as $foodDataVal)
               <div class="item sideaddon-item">
                         <img src="{{asset('uploads/foodService/'.$foodDataVal->service_img)}}" width="100%" style="height:80px">
                         <div class="sideaddon-content">
                         	 <h5>{{$foodDataVal->service_name}}</h5>
                         	 <p>{{$foodDataVal->quantity}} {{$foodDataVal->quantity_type}}</p>
                            <h6 class="text-center" style="padding:5px;">

                  <a onclick="addToCart(<?php echo $foodDataVal->id;?>,'<?php echo $foodDataVal->quantity;?>','<?php echo $foodDataVal->quantity_type;?>')" href="javascript:void(0)">ADD</a></h6>

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
                   <img src="{{url('assets/front-end/img/discount.png')}}" width="10%">&nbsp;
                   <span>Select offer/ Apply coupon</span> <a href="{{url('offer')}}">></a> <p> Get Discount with your order</p>
                  
                </div>

                 <p  style="font-size:18px;color:black;font-weight:bold;margin-top:10px;">Price Details</p>
                   <div class="row cart-amount" id="cartBill">
                   




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

</script>
</script>
@stop