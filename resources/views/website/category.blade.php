@extends('website.layout.layout2')
@section('title','Order Meat Online - Buy Fresh & High Quality Meat at Fair Price on Themeatempire')
@section('content')
<?php 
// echo"<pre>";
// print_r($CobrandFoodData);
?>
<section class="catstrip">
	      <div class="container" style="background:url('{{asset('assets/front-end/img/bottombg.png')}}');background-size:100%;background-repeat:no-repeat;padding:150px 70px">
	      	    	  <div class="row" >
		  	<div class="col-md-12 col-sm-12" style="">
	              <div class="row">
	              	   <div class="col-md-5 col-sm-12 catcol" style="margin-top:-30px;">
	              	   	     <div class="row">
	              	   	     	    <div class="col-md-4 text-right">

<?php
if($cobrand=='1'){
$img=asset('assets/front-end/img/categoryPageCobrands.png');
}else{
 if($foodData[0]->pageLogo=='NULL' || $foodData[0]->pageLogo==''){
$img=asset('assets/front-end/img/quality.png');
}else{ 
$img=asset('uploads/categoryPageLogo/'.$foodData[0]->pageLogo);
}
}
 ?>

	              	   	     	    	<img src="{{$img}}" width="70%">

	              	   	     	    </div>
	              	   	     	    <div class="col-md-8" style="margin-left:-30px;margin-top:-30px;">
                                    <span>{{$foodData[0]->category_name}}</span>
	              	   	     	    </div>	
	              	   	     </div>	
	              	   </div>
	              	  <!-------- Change Able --------> 

@if($foodData[0]->page_type=='1')	              	  
	              	   <div class="col-md-7 col-sm-12" style="border-left:1px solid white;margin-top:-60px;">
	              	       <div class="row">
	              	       	    <div class="col-md-4">
	              	       	    	  <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/catfresh.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Freshness </p><p class="m0">Guranteed</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>	
	              	       	    </div>

	              	       	    <div class="col-md-4">
	              	       	    	 <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/cathyegine.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Hygienically  </p><p class="m0">Processed</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>
	              	       	    </div>
	              	       	    <div class="col-md-4">
	              	       	    	 <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/catweight.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Pay For Nett. </p><p class="m0">Weight Only</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>
	              	       	    </div>	
	              	       </div>	   
	              	   </div>	
@else
  <div class="col-md-7 col-sm-12" style="border-left:1px solid white;margin-top:-60px;">
	              	       <div class="row">
	              	       	  <div class="col-md-4">
	              	       	    	  <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/catfresh.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Freshness </p><p class="m0">Guranteed</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>		
	              	       	    </div>
	              	       	    <div class="col-md-4">
	              	       	    	 <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/tastecat.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Delicious  </p><p class="m0">Taste</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>
	              	       	    </div>
	              	       	    <div class="col-md-4">
	              	       	    	 <div class="row">
	              	       	    	  	   <div class="col-md-5 text-right image">
	              	       	    	  	   	 <img src="{{asset('assets/front-end/img/anitbioticcat.png')}}" width="100%">
	              	       	    	  	   </div>
	              	       	    	  	   <div class="col-md-7 written">
                                           <p class="m0" style="margin-top:8px;">Antibiotic </p><p class="m0">Free</p>
	              	       	    	  	   </div>	
	              	       	    	  </div>
	              	       	    </div>	
	              	       </div>	   
	              	   
	              	   </div>	

@endif	              	   
<!--------End Change Able --------> 
	              </div>	
				
              </div>	
		  	</div>
	      </div>	
</section>

<section class="categorycontainer">
	<div class="container" >
	
		 <?php	 
if($checkAveliableCatData>0 || $CobrandFoodDataCount>0){
?>
<div class="row">
@foreach($foodData as $key=>$foodDataval)
<?php 
     $foodDataval->price;
if(ceil($foodDataval->price)>0){

 $offprice=($foodDataval->price/100)*$foodDataval->service_offer;
 $ActPrice=ceil($foodDataval->price)-ceil($offprice);
}else{


}
if($key<=2){
if($cobrand=='1'){
?>
<div class="col-md-4 col-sm-6">
<div class="productcardcat">
<a class="categoryimglink" href="{{url('product-detail/'.$foodDataval->id.'/cobrand')}}"><img src="{{asset('uploads/foodService/'.$foodDataval->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDataval->id.'/cobrand')}}"><h5>{{substr($foodDataval->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDataval->quantity}} {{$foodDataval->quantity_type}}</span>	
<a class="addcart" onclick="addToCart('<?php echo $foodDataval->id;?>','<?php echo $foodDataval->quantity;?>','<?php echo $foodDataval->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>
<span class="mrp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPrice)}}</span><del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDataval->price)}}</del>

</div>
</div>
</div>


<?php
}else{
?>

<div class="col-md-4 col-sm-6">
<div class="productcardcat">
<a class="categoryimglink" href="{{url('product-detail/'.$foodDataval->id)}}"><img src="{{asset('uploads/foodService/'.$foodDataval->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDataval->id)}}"><h5>{{substr($foodDataval->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDataval->quantity}} {{$foodDataval->quantity_type}}</span>	
<a class="addcart" onclick="addToCart('<?php echo $foodDataval->id;?>','<?php echo $foodDataval->quantity;?>','<?php echo $foodDataval->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>
<span class="mrp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPrice)}}</span><del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDataval->price)}}</del>

</div>
</div>
</div>

<?php
}
?>	
<?php } else { } ?>
@endforeach
<?php
if($other=='1'){
?>
@foreach($CobrandFoodOneData as $key=>$foodDatavalSec)
<?php 
 $offpricet=($foodDatavalSec->price/100)*$foodDatavalSec->service_offer;
 $ActPriceTwo=ceil($foodDatavalSec->price)-ceil($offpricet);
?>

<div class="col-md-4 col-sm-6">
<div class="productcardcat">
<a class="categoryimglink" href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><img src="{{asset('uploads/foodService/'.$foodDatavalSec->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDataval->id.'/cobrand')}}"><h5>{{substr($foodDatavalSec->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDatavalSec->quantity}} {{$foodDatavalSec->quantity_type}}</span>	
<a class="addcart" onclick="addToCart('<?php echo $foodDatavalSec->id;?>','<?php echo $foodDatavalSec->quantity;?>','<?php echo $foodDatavalSec->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>
<span class="mrp"><i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPriceTwo)}}</span><del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDatavalSec->price)}}</del>

</div>
</div>
</div>

@endforeach
<?php
}
?>
</div>

<div class="row">
@foreach($foodData as $key=>$foodDatavalSec)
<?php 
 $foodDatavalSec->price;
if(ceil($foodDatavalSec->price)>0){
 $offpricet=($foodDatavalSec->price/100)*$foodDatavalSec->service_offer;
 $ActPriceTwo=ceil($foodDatavalSec->price)-ceil($offpricet);
}else{

}
if($key>=3){
if($cobrand=='1'){
?>
<div class="col-md-4 col-sm-6 mt-20">
<div class="productcardcat">
<a href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><img src="{{asset('uploads/foodService/'.$foodDatavalSec->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><h5>{{substr($foodDatavalSec->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDatavalSec->quantity}} {{$foodDatavalSec->quantity_type}}</span>
<a class="addcart" onclick="addToCart('<?php echo $foodDatavalSec->id;?>','<?php echo $foodDatavalSec->quantity;?>','<?php echo $foodDatavalSec->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>

<span class="mrp"> <i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPriceTwo)}}</span>

<del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDatavalSec->price)}}</del>
</div>
</div>
</div>

<?php
}else{
?>

<div class="col-md-4 col-sm-6 mt-20">
<div class="productcardcat">
<a href="{{url('product-detail/'.$foodDatavalSec->id)}}"><img src="{{asset('uploads/foodService/'.$foodDatavalSec->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDatavalSec->id)}}"><h5>{{substr($foodDatavalSec->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDatavalSec->quantity}} {{$foodDatavalSec->quantity_type}}</span>
<a class="addcart" onclick="addToCart('<?php echo $foodDatavalSec->id;?>','<?php echo $foodDatavalSec->quantity;?>','<?php echo $foodDatavalSec->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>

<span class="mrp"> <i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPriceTwo)}}</span>

<del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDatavalSec->price)}}</del>
</div>
</div>
</div>

<?php
}
?>

<?php } else{ } ?>
@endforeach
</div>

<!--------- ! ------>

<div class="row">
@foreach($CobrandFoodData as $key=>$foodDatavalSec)
<?php 
 $foodDatavalSec->price;
if(ceil($foodDatavalSec->price)>0){
 $offpricet=($foodDatavalSec->price/100)*$foodDatavalSec->service_offer;
 $ActPriceTwo=ceil($foodDatavalSec->price)-ceil($offpricet);
}else{

}
if($key<=2){
?>
<div class="col-md-4 col-sm-6 mt-20">
<div class="productcardcat">
<a href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><img src="{{asset('uploads/foodService/'.$foodDatavalSec->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><h5>{{substr($foodDatavalSec->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDatavalSec->quantity}} {{$foodDatavalSec->quantity_type}}</span>
<a class="addcart" onclick="addToCart('<?php echo $foodDatavalSec->id;?>','<?php echo $foodDatavalSec->quantity;?>','<?php echo $foodDatavalSec->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>

<span class="mrp"> <i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPriceTwo)}}</span>

<del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDatavalSec->price)}}</del>
</div>
</div>
</div>

<?php } else{ 
?>

<div class="col-md-4 col-sm-6 mt-20">
<div class="productcardcat">
<a href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><img src="{{asset('uploads/foodService/'.$foodDatavalSec->service_img)}}"
style="width:100%"/></a>
<div class="item-details">
<a class="productlink" href="{{url('product-detail/'.$foodDatavalSec->id.'/cobrand')}}"><h5>{{substr($foodDatavalSec->service_name,0,45)}}</h5></a>
<span class="ntweight">Nett wt :{{$foodDatavalSec->quantity}} {{$foodDatavalSec->quantity_type}}</span>
<a class="addcart" onclick="addToCart('<?php echo $foodDatavalSec->id;?>','<?php echo $foodDatavalSec->quantity;?>','<?php echo $foodDatavalSec->quantity_type;?>')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>

<span class="mrp"> <i class="fa fa-inr" aria-hidden="true"></i>{{ceil($ActPriceTwo)}}</span>

<del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($foodDatavalSec->price)}}</del>
</div>
</div>
</div>

<?php
} ?>
@endforeach

</div>


<!--------  ! ------>
<?php
}else{
?>
<section class="bestseller" style="height:400px;background-color:#f6f8f2">
<div class="row">
<div class="col-md-4"></div>  
<div class="col-md-4" align="center" style="height:380px;background-repeat:no-repeat;background-image: url('{{url('assets/front-end/img/nodata-found.jpeg')}}')">
</div>
<div class="col-md-4"></div> 
</div> 
<!--  background-color: #cccccc;   --> 
</section>
<?php
}
?>

    </div>
</section>

@endsection
@section('script')
<script type="text/javascript">

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
$('#alreadyExtCartItemPopUp').delay(6000).fadeOut('slow');
   }
  else{
getCartCount();
$('#addCartPopUp').show(); 
$('#addCartPopUp').delay(6000).fadeOut('slow');

}
}
});
}

function hideloader(){
 $('.preloader').hide();   
}

    $('[data-toggle="popover"]').popover({
        placement : 'bottom',
        trigger : 'hover'
    });
    function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
}

/*$(document).ready(function(){			
  if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }
	});*/

</script>
@endsection