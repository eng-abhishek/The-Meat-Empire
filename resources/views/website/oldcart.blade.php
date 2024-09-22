@extends('website.layout.layout')
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

 $firstdiccountLimit=Discount::find('1');
 $seconddiccountLimit=Discount::find('2');
 
 $now = date('Y-m-d');
 $happyHours=HappyHoursDicount::whereDate('from_date','<=',$now)->whereDate('to_date','>=',$now)->where('status','1')->get()->toArray();

$Coupondata=Coupon::where('cartPageStatus','1')->get();
if($Coupondata){
$Coupon=$Coupondata[0];
}
$taxAmount=Tax::find('1');
?>
<section class="cart">
<div class="container">
	<div class="table-responsive">
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:35%">Product</th>
							<th style="width:5%">Price</th>
							<th style="width:15%">Quantity</th>
							<th style="width:15%">Cutting Instructions</th>
							<th style="width:10%" class="text-center">Subtotal</th>
							<th style="width:10%">Action</th>
						</tr>
					</thead>
					<tbody>
        <?php $total = 0 ?> 



        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
<?php 
$pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();
?>

                <?php $total += $details['price'];?>

						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><img src="{{asset('uploads/foodService/'.$details['photo'])}}" alt="..." class="img-responsive" width="100%"/></div>
									<div class="col-md-9 col-sm-10">
										<h4 class="nomargin">{{$details['name']}}</h4>
									<!-- 	<p>{{$details['name']}}</p> -->
									</div>
								</div>
							</td>
							<td data-th="Price">
						    <i class="fa fa-rupee">
						    	 {{ceil($details['price'])}}  
						    </i>		
						                            
							</td>
							<td data-th="Quantity">
							<select class="form-control dropdownQty" product-id="{{$id}}">
							@foreach($pricetbl as $pricetblData)	
						    <option <?php if( ($details['quantity_type']==$pricetblData['quantity_type']) && ($details['quantity']==$pricetblData['quantity'])) { echo"selected"; }else{ } ?> value="{{$pricetblData['id']}}">
						 
						    {{$pricetblData['quantity']}} {{$pricetblData['quantity_type']}}						    
						    </option>
							@endforeach
							</select>	
                            <input type="text" name="productPrice" hidden value="{{$details['price']}}">
							</td>
							<td data-th="Quantity">
							<select class="form-control">
								   <option>Curry Cut</option>
								   <option> Shredded</option>
								   <option>Chinese cuisine</option>
							</select>	
							</td>
							<td data-th="Subtotal" class="text-center">
						    <i class="fa fa-rupee"></i> {{ ceil($details['price'])}}	</td>
							<td class="actions" data-th="">								
								<button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>	
							</td>
						</tr>
@endforeach
@endif

  @if(session('special_cart'))
  @foreach(session('special_cart') as $id => $Specialdetails)
<?php 
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
?>
                <?php $total += $Specialdetails['price'];?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><img src="{{asset('uploads/dealOfDay/'.$Specialdetails['photo'])}}" alt="..." class="img-responsive" width="100%"/></div>
									<div class="col-md-9 col-sm-10">
										<h4 class="nomargin">{{$Specialdetails['name']}}</h4>
								
									</div>
								</div>
							</td>
							<td data-th="Price">
						    <i class="fa fa-rupee">
						     {{ceil($Specialdetails['price'])}}    	
						    </i>		
						                        
							</td>
							<td data-th="Quantity">
							<select class="form-control specialdropdownQty" sproduct-id="{{$id}}">
							@foreach($SpecialPricetbl as $SpricetblData)	
						    <option <?php if( ($Specialdetails['quantity_type']==$SpricetblData['quantity_type']) && ($Specialdetails['quantity']==$SpricetblData['quantity'])) { echo"selected"; }else{ } ?> value="{{$SpricetblData['id']}}">
						 
						    {{$SpricetblData['quantity']}} {{$SpricetblData['quantity_type']}}						    
						    </option>
							@endforeach
							</select>	
                            <input type="text" name="productPrice" hidden value="{{$Specialdetails['price']}}">
							</td>
							<td data-th="Quantity">
							<select class="form-control">
								   <option>Curry Cut</option>
								   <option> Shredded</option>
								   <option>Chinese cuisine</option>
							</select>	
							</td>
							<td data-th="Subtotal" class="text-center">
								<i class="fa fa-rupee"></i> {{ $Specialdetails['price']}}	</td>
							<td class="actions" data-th="">								
								<button class="btn btn-danger btn-sm remove-special-from-cart" spe-data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>	
							</td>
						</tr>
@endforeach
@endif
					</tbody>
					<tfoot>	

<?php 
if($total>$seconddiccountLimit->amount){

$offprice=($total/100)*$seconddiccountLimit->discount;

if($seconddiccountLimit->pack_of_surprise){
	
$sepoffprice=($total/100)*$seconddiccountLimit->discount;

}
}
elseif($total>$firstdiccountLimit->amount){

$offprice=($total/100)*$firstdiccountLimit->discount;
$sepoffprice='0';
}else{
$offprice='0';
$sepoffprice='0';
}
?>

<?php 
// if($happyHours->)
 if($happyHours[0]['offer']>0){
 $happyHoursDiscount=($total/100)*$happyHours[0]['offer'];
 }else{
 $happyHoursDiscount='0';
 }
?>	

<?php 
if($taxAmount->amount>0){
if($actualAmount){
 $total=$actualAmount;
}else{
 $total=$total;
 }	
 $taxAmountData=($total/100)*($taxAmount->amount);
 $taxAbleAmount=$total+($total/100)*($taxAmount->amount);

}else{
  $taxAbleAmount=$total;
}
?>

<?php 
$saveAmountByCustomer=$offprice+$sepoffprice+$happyHoursDiscount;
$ActTotalAmount=$taxAbleAmount-$saveAmountByCustomer;
?>
<tr>
	<td></td>
	<td colspan="3" class="hidden-xs">
    </td>
    <td><strong>Total <i class="fa fa-rupee"></i> 
	{{ceil($total)}}</strong></td>
	<td></td>
</tr>
<tr>

	    <td><strong>Tax:
<?php
if($taxAmount->amount){
$tax=$taxAmount->amount;
}else{
$tax='0';
}
?> {{$tax}} %</strong><br>
<font> &nbsp;<i class="fa fa-rupee"></i> {{ceil($taxAmountData)}}</font>
</td>
	<td colspan="3" class="hidden-xs">
    </td>

  </td>
    <td><strong>Save Amount <i class="fa fa-rupee"></i> 
	 {{ceil($saveAmountByCustomer)}}</strong></td>
</tr>

                        <tr>
							<td><a href="{{url('/')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="3" class="hidden-xs">	
							</td>
							<td class="hidden-xs text-center">
						   <strong>Total 
							<i class="fa fa-rupee"></i> 
						    {{ceil($ActTotalAmount)}}</strong>
						    </td>
							<td><a href="{{url('user-login')}}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>


					</tfoot>
				</table>
			</div>
</div>
</section>

@if($Coupon)							
<section style="padding-bottom:20px">
	<div class="container">
	   <div class="row">
	   	<div class="col-md-12" style="padding-bottom:15px;">
	   	<h5>Apply coupon code and get {{$Coupon->off_price}}% discount</h5>
	   </div>
	   	
	    <div class="col-md-4">
	    <div style="margin-left:50px;font-weight:400;border:2px;font-size:20px;">{{$Coupon->name}}</div>
<form class="form-inline" action="{{url('check-coupon')}}" method="post">
<div class="input-group mb-3">

 <input type="text" class="form-control" name="coupon" placeholder="Enter Coupon Code" aria-label="" aria-describedby="basic-addon1">

<input type="text" name="couponId" hidden value="{{$Coupon->id}}">
<input type="text" name="totalAmount" hidden value="{{$total}}">

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
</section>

@else
@endif 	
<?php session()->put('totalProductAmount',$taxAbleAmount);?>
<!-- you may also like -->

@section('script')
    <script type="text/javascript">

        $(".remove-from-cart").click(function (e) {        
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure to remove cart")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 

        $(".remove-special-from-cart").click(function (e) {        
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure to remove cart")) {
                $.ajax({
                    url: '{{ url('remove-special-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("spe-data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });



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
    </script>
 
@endsection


@endsection
