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
	   	     	    <p  style="float:left;font-size:18px;color:black;font-weight:bold">1 item you have selected</p>
	   	     	    <p style="float:right;font-size:18px;color: #2b2f7f;font-weight:bold">Explore Menu</p>
	   	     	    <div class="clearfix"></div>

                <!-------- cart section -----> 
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
<?php 
$pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();
?>
 <?php $total += $details['price']*$details['count'];?>

	   	          <div class="row cartdiv">
	   	     	   	    <div class="col-md-2 p0">
	   	     	   	    	 <img src="{{asset('uploads/foodService/'.$details['photo'])}}" width="100%" style="height:80px">
	   	     	   	    </div>
	   	     	   	    <div class="col-md-10" >
	   	     	   	    	<div class="row" style="border-bottom:1px solid silver;padding-bottom:10px;">
	   	     	   	    <div class="col-md-2 cart-product pt-10" >
	   	     	   	    	  <h5>{{$details['name']}}</h5>
	   	     	   	    	  <span>Net: {{$details['quantity']}} {{$details['quantity_type']}}</span>
	   	     	   	    </div>	
	   	     	   	    <div class="col-md-3 weight-cart pt-30">
	   	     	   	    	  <h5>Weight</h5>
	   	     	   	    	  <select class="form-control dropdownQty" product-id="{{$id}}">
	   	     	   	    	  @foreach($pricetbl as $pricetblData)    
	   	     	   	        <option <?php if( ($details['quantity_type']==$pricetblData['quantity_type']) && ($details['quantity']==$pricetblData['quantity'])) { echo"selected"; }else{ } ?> value="{{$pricetblData['id']}}">
	   	     	   	    	  	  {{$pricetblData['quantity']}} {{$pricetblData['quantity_type']}}
	   	     	   	    	      </option>
                         @endforeach
                        </select>
	   	     	   	    </div>	
	   	     	   	    <input type="text" name="productPrice" hidden value="{{$details['price']}}">
                    	 <div class="col-md-3 weight-cart pt-30">
                        <h5>Cut Instructions</h5>

<?php 
   $foodId=FoodService::find($details['productId']);
  if($foodId->cutting_instruction){
  ?>
  <select class="form-control" data-th="Quantity">
   <?php 
  $CutID=explode(',',$foodId->cutting_instruction);
  for($m=0; $m < count($CutID); $m++) { 

   $CutingData=CuttingInstruction::where('id',$CutID[$m])->get();
   foreach ($CutingData as $cutvalue) {
   ?>
     <option value="{{$cutvalue->id}}">{{$cutvalue->name}}</option>
    <?php
   }
?>                   
<?php
   }
   ?>
   </select>
   <?php }else{ ?> <font style="font-size:12px">N/A</font> <?php } ?>

                    </div>
                        <div class="col-md-1 weight-cart pt-30">
                        <h5>Tax</h5>
                       <p class="pt-10" style="font-size:10px;font-weight:600">10%</p>
                    </div>	

	   	     	   	     <div class="col-md-3 quant-cart pt-10">
	   	     	   	    	  <h5><i class="fa fa-inr" aria-hidden="true"></i>   {{ceil($details['price'])}} </h5>
	   	     	   	    	  <div class="input-group pt-20">
          <span class="input-group-btn">
              <button type="button" class="plus-btn" data-type="minus" data-field="quant[1]">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
          </span>
          <input type="text" name="quant[1]" class="form-control input-number " value="1">
          <span class="input-group-btn">
              <button type="button" class="minus-btn" data-type="plus" data-field="quant[1]">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
          </span>
      </div>
     </div>
   </div>
  </div>
 </div>	
@endforeach
@endif



  @if(session('special_cart'))
  @foreach(session('special_cart') as $id => $Specialdetails)
<?php 
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
?>
                <?php $total += $Specialdetails['price'];?>

     <div class="row cartdiv">
                    <div class="col-md-2 p0">
                       <img src="{{asset('uploads/foodService/'.$details['photo'])}}" width="100%" style="height:80px">
                    </div>
                    <div class="col-md-10" >
                      <div class="row" style="border-bottom:1px solid silver;padding-bottom:10px;">
                    <div class="col-md-3 cart-product pt-10" >
                        <h5>{{$Specialdetails['name']}}</h5>
                        <span>Net: {{$details['quantity']}} {{$details['quantity_type']}}</span>
                    </div>  
                    <div class="col-md-3 weight-cart pt-30" data-th="Quantity">
                        <h5>Weight</h5>
                        <select class="form-control dropdownQty" sproduct-id="{{$id}}">
                        @foreach($SpecialPricetbl as $SpricetblData)
                     <option <?php if( ($Specialdetails['quantity_type']==$SpricetblData['quantity_type']) && ($Specialdetails['quantity']==$SpricetblData['quantity'])) { echo"selected"; }else{ } ?> value="{{$SpricetblData['id']}}">
                     {{$SpricetblData['quantity']}} {{$SpricetblData['quantity_type']}}  
                         @endforeach
                        </select>
                    </div>  
                        <input type="text" name="productPrice" hidden value="{{$Specialdetails['price']}}">

                       <div class="col-md-3 weight-cart pt-30">
                        <h5>Cut Instructions</h5>

                      <font style="font-size:12px">N/A</font>

                      </div>

                     <div class="col-md-3 quant-cart pt-10">
                        <h5><i class="fa fa-inr" aria-hidden="true"></i>      {{ceil($Specialdetails['price'])}}</h5>
                        <div class="input-group pt-20">
          <span class="input-group-btn">
              <button type="button" class="plus-btn" data-type="minus" data-field="quant[1]">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
          </span>
          <input type="text" name="quant[1]" class="form-control input-number " value="1">
          <span class="input-group-btn">
              <button type="button" class="minus-btn" data-type="plus" data-field="quant[1]">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
          </span>
      </div>
     </div>
   </div>
  </div>
 </div> 
@endforeach
@endif




      <!-------- cart section ----->
	   	     </div>
    
           <div class="col-md-1"></div>
	   	     <div class="col-md-3 ">
        <p  style="font-size:18px;color:black;font-weight:bold"><!-- 1 item you have selected --></p>
                <div class="cart-address">
                	 <img src="{{url('assets/front-end/img/cartlocation.png')}}">&nbsp;
                	 <span>Current Address</span> <p> Noida Uttar Pradesh</p>
                	 <a class="change" href="#">Change</a>
                </div>
	   	     </div>	


	   </div>	

	   <div class="row" style="margin-top:50px;">
	   	    <div class="col-md-8 p0">
	   	    	<p  style="font-size:18px;color:black;font-weight:bold">Addons</p> 
	   	    	<div id="side-addon" class="owl-carousel">
	   	    	 
             @if($foodData)

             @foreach($foodData as $foodDataVal)
               <div class="item sideaddon-item" style="height:200px">
                         <img src="{{asset('uploads/foodService/'.$foodDataVal->service_img)}}" width="100%" style="height:130px">
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
                   <span>Select offer/ Apply coupon</span> <a href="{{url('offer')}}" data-toggle="modal" data-target="#exampleModal2">></a> <p> Get Discount with your order</p>
                  
                </div>

                 <p  style="font-size:18px;color:black;font-weight:bold;margin-top:10px;">Price Details</p>
                   <div class="row cart-amount" id="cartBill">
                   




            </div>   



            </div>
	   	    </div>	

	   </div>	
</div>
       
</section>

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
	 <h6>Apply coupon code and get {{$Coupon->off_price}}% discount</h6>
	   </div>
	   	
	    <div class="col-md-12 text-center">
	    <div style="font-weight:400;border:2px;font-size:20px;">{{$Coupon->name}}</div>
<form class="form-inline" action="{{url('check-coupon')}}" method="post" style="margin-left:80px;">
<div class="input-group mb-3">

 <input type="text" class="form-control" name="coupon" placeholder="Enter Coupon Code" aria-label="" aria-describedby="basic-addon1">

<input type="text" class="form-control" name="couponId" hidden value="{{$Coupon->id}}">
<input type="text" class="form-control" name="totalAmount" hidden value="{{$total}}">

  @csrf
  <div class="input-group-prepend">
    <button type="submit" class="btn btn-outline-success" type="button">Apply</button>
  </div>
</div>
                            @if(Session::get('coupon_err'))
							<div>{{Session::get('coupon_err')}}</div>
							@else
							@endif
	   	    </form>
	   	</div>	

	   </div>	
	</div>   

      </div>
   
    </div>
  </div>
</div>
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
     $(".change").click(function(){
         $(".dropdown").dropdown('toggle');
         
     });
     
 });
  $(document).ready(function(){

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
}
}
});
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



$('.dropdownQty').on('change',function(){
var productId=$(this).attr('product-id');
var PriceTblid=$(this).val();
window.location.href="{{url('update-product-price-cart/')}}"+'/'+productId+'/'+PriceTblid;
});


$('.specialdropdownQty').on('change',function(){
var productId=$(this).attr('sproduct-id');
var PriceTblid=$(this).val();
window.location.href="{{url('update-special-product-price-cart')}}"+'/'+productId+'/'+PriceTblid;
});

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
function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
} 
</script>
</script>
@stop