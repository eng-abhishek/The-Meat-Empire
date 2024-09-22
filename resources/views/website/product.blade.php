@extends('website.layout.layout2')
@section('title','Order Meat Online - Buy Fresh & High Quality Meat at Fair Price on Themeatempire')
@section('content')
<?php 
use App\CuttingInstruction;
use App\FoodService;
use App\Product_price_tbl;
$cutting=CuttingInstruction::all();

?>
<section class="product-details">
<div class="container">
    <div class="row">
      <div class="col-md-12">
          
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">{{$productItem->category_name}}</a></li>
            <li class="breadcrumb-item active"><a href="#">{{$productItem->service_name}}</a></li>
        </ol>
       </nav>

        </div>  
       <div class="col-md-6">
         <img src="{{asset("uploads/foodService/$productItem->service_img")}}" class="prodimg" width="100%"/>
       </div>
      
       <div class="col-md-6 product-desc">
              <div class="title">
        <h1 class="heading">{{$productItem->service_name}}</h1>
        
        </div>

           <div class="sub-title">
            <span class="sub-title-list">{{$productItem->category_name}}</span><span class="sub-title-list">|</span><span class="sub-title-list">{{$productItem->service_name}}</span>
          </div>

          <div class="prod-desc">
              <p><span style="color: rgb(38, 50, 56); font-family: Lato, sans-serif;font-size:15px">{!! $productItem->service_short_des !!}&nbsp;</span></p>
            </div>
                   <div class="row mt-30">
                        <div class="col-md-6">
                             <div class="row stripe">
                                  <div class="col-md-5">
                                    <a>
                                    Cutting Instructions
                                    </a>
                                  </div>
                                  <div class="col-md-7">
                            

<?php 
   $foodId=FoodService::find($productItem->id);
  if($foodId->cutting_instruction){
  ?>
  <select style="display: inline;
    font-size: 12px;
    width: 100%;
    height: 29px;
    border:none;outline:none;border-color: #9fa496a8" class="form-cont" id="cuttingInstructionsData" name="cuttingInstructions">
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
   <?php }else{ 
?>
 <select style="display: inline;
    font-size: 12px;
    width: 100%;
    height: 29px;
    border:none;outline:none;
    border-color: #9fa496a8;">
   <option value="N/A">N/A</option>
  </select>
<?php
   } ?>
                          </div>  

                             </div>
                           
                        </div>

                        <div class="col-md-6 text-center">
                               <div class="row stripe" style="padding-bottom:34px;">

                                <div class="col-md-5">
                                    <a>
<!--    <span style="display:inline">{{$productItem->quantity}} {{$productItem->quantity_type}}</span>  -->
                                    Quantity
                                    </a>
                                  </div>

  <div class="col-md-7">
  <select style="display: inline;
    font-size: 12px;
    width: 100%;
    height: 29px;
    
    border:none;outline:none;
    border-color: #9fa496a8" id="priceId" onchange="showqtyPriceProductPage(<?php echo $productItem->id;?>,this.value)">
     @foreach($priceQty as $priceQtyval)
       <option value="{{$priceQtyval['id']}}">{{$priceQtyval['quantity']}} {{$priceQtyval['quantity_type']}}</option>
     @endforeach
  </select>
  </div>

                               
                            </div>
                        </div>
                   </div> 
<?php
if($productItem->price>=1){
$offerprice=$productItem->price-($productItem->price/100)*($productItem->service_offer);
}else{
$offerprice=$productItem->price;  
}
?>
                    

                      <div class="row mt-20">
                        <div class="col-md-6 ">
                           
                           <div class="row stripe">
                                <div class="col-md-5 text-right">
                                  <i class="fa fa-inr productpric" id="productActPrice" aria-hidden="true" style="font-size:22px;text-align: right;color:#e11e28;font-weight:500">{{ceil($offerprice)}} </i>
                                  </div> 
                                  <div class="col-md-7">
                                   
                                    <del><i class="fa fa-inr prodprice" id="productRawPrice" aria-hidden="true" style="font-size:22px">{{ceil($productItem->price)}} </del></i>
                                  </div>
                                  
                             </div>   
                             </div>
              
                          <div class="col-md-6 text-center">
                               <div class="stripe cartstripe">
                                <a product-id="{{$productItem->id}}" onclick="productCart('<?php echo $productItem->id;?>')" href="javascript:void(0)" class="addcartbigbutton">ADD TO CART</a> 
                            </div>
                        </div>
                   </div>
          </div>  
       </div> 
    </div>  
</section>


<section class="ourprocess">
  <div class="container">
     <div class="row">
        <div class="col-md-12">
          <h2 style="color:#242c97;font-family:newhead">What We Guarantee </h2>
        </div>
        <div class="col-md-1">
        </div>

        <div class="col-md-2 col-sm-6 ">
           <div class="imgbox">
          <img src="{{url('assets/front-end/img/process1.png')}}" atl="process" width="100%">
        </div>
          <p>Procure Premium Quality Meat Everyday</p>

        </div>

          <div class="col-md-2 col-sm-6">
             <div class="imgbox">
          <img src="{{url('assets/front-end/img/process2.png')}}" atl="process" width="100%">
        </div>
          <p>
              
              
              Offers Widest Variety at Right Price
          </p>

        </div>  

          <div class="col-md-2 col-sm-6">
             <div class="imgbox">
          <img src="{{url('assets/front-end/img/process3.png')}}" atl="process" width="100%">
        </div>
          <p>Hygienically Processed and Packaged</p>

        </div>

          <div class="col-md-2 col-sm-6">
             <div class="imgbox">
          <img src="{{url('assets/front-end/img/process4.png')}}" atl="process" width="100%">
        </div>
          <p>Delicious Delicacies Guaranteed</p>

        </div>

          <div class="col-md-2 col-sm-6">
          <div class="imgbox">  
          <img src="{{url('assets/front-end/img/process5.png')}}" atl="process" width="100%">
        </div>
          <p>Free From Chemicals and Preservations</p>
                </div>
       
        <div class="col-md-1">
        </div>  
     </div>
  </div>  
</section>


<!-- you may also like -->

   <section class="youmaysection">
      <div class="youmaylike">
      <div class="container" >       
      <div class="row">
        <div class="col-md-12 " style="visibility: hidden">
         <h1 class="deal-heading">Deal <span class="subtext">Of the</span> Day</h1>
         </div>
          
        <div class="col-sm-12" style="padding:80px;margin-top:-50px;background-repeat: no-repeat;">
          <img src="{{url('assets/front-end/img/youmaylike.png')}}" width="80%" style="position:absolute;top:-100px;left:120px">
         <div style=""> 
          <div id="deal-phase" class="owl-carousel" style="margin-top:-40px;">
<?php
if($cobrand=='1'){
$coUrl="cobrand";
}else{
$coUrl="";
}

?>

@if($arrayDealOfDayData)
@foreach($arrayDealOfDayData as $productDealOfDayData)
<?php
// echo"<pre>"; 
// print_r($productDealOfDayData);
// die;
if($productDealOfDayData->price>0){
$DealOfDayProduct=$productDealOfDayData->price-($productDealOfDayData->price/100)*$productDealOfDayData->service_offer;
}else{
$DealOfDayProduct=$productDealOfDayData->price;
}
?>
            <!--categories 1 -->
            <div class="item ">
           <!--   <img src="{{url('assets/front-end/img/dealribbon.png')}}" class="dealribbon" style=" width:40%;position:absolute;left:0px;top:10px;z-index:99;"> -->
              <div class="shadow-effect youmay">
                <a  href="{{url('product-detail/'.$productDealOfDayData->id.'/'.$coUrl)}}"><img class="img-responsive" src="{{asset('uploads/foodService/'.$productDealOfDayData->service_img)}}"></a>
                <div class="item-details">
                            <a class="youmayproductlink" href="{{url('product-detail/'.$productDealOfDayData->id.'/'.$coUrl)}}"> <h5>{{substr($productDealOfDayData->service_name,0,30)}}..</h5></a>
                   <span class="ntweight">Nett wt :{{$productDealOfDayData->quantity}} {{$productDealOfDayData->quantity_type}}</span>
                      <a href="javascript:void(0)" class="youmayaddcart" onclick="addToCart('<?php echo $productDealOfDayData->id;?>','<?php echo $productDealOfDayData->quantity?>','<?php echo $productDealOfDayData->quantity_type;?>')" class="dealaddtocard">Add To Cart</a>
                    <span class="mrp"><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($DealOfDayProduct)}}</span>
                    <span class="cutmrp"><del><i class="fa fa-inr" aria-hidden="true"></i> {{ceil($productDealOfDayData->price)}}</del></span>
                 
                </div>
              </div>
            </div>
            <!--END OF categories 1 -->
@endforeach
@endif            
         
          </div>
        </div>
      </div>
      </div>
    </div>
</div>
    </section>
    <!-- deal of the dat -->
@endsection

@section('script')

<script type="text/javascript">
$(document).ready(function () {
    $(".cobrands").hover(function () {
     $(".brand").slideToggle('medium');
    });
});

</script>
<script type="text/javascript">
  $('#deal-phase').owlCarousel({
        
    loop: true,
    
    items: 4,
    margin: 20,
    autoplay: true,
  nav:true,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    navText: ['<img src=" <?php echo url('assets/front-end/img/arrowprev.png');?>">','<img src="<?php echo url('assets/front-end/img/arrownext.png');?>">'],
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

function productCart(id){

var priceId=$('#priceId').val();

var cuttingInst=$('#cuttingInstructionsData').val();

$.ajax({
url:"{{url('add-to-cart-product')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id,priceId:priceId,cuttingInst:cuttingInst},
success:function(data){

if(data=='0'){
  alert('Oop`s Stock Is Empty Please Wait');
  }else if(data=='10'){
  alert('Item Side & Addons Add After Added Any Product');
  }else if(data=='11'){
$('#alreadyExtCartItemPopUp').show(); 
$('#alreadyExtCartItemPopUp').delay(6000).fadeOut('slow');
  }else{

getCartCount();
// $('.countQty'+productId).show();
$('#addCartPopUp').show(); 
$('#addCartPopUp').delay(6000).fadeOut('slow');

}
}
});

}


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
   }else{
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


function showqtyPriceProductPage(productId,id){
$.ajax({
url:"{{url('showqtyPriceProductPage')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',productId:productId,id:id},
success:function(data){
// console.log(data); 

$('#productRawPrice').html(data[0]);
$('#productActPrice').html(data[1]);
}
});
}
</script>
<!--<script type="text/javascript">
  $(window).resize(function() {

  if ($(this).width() >= 1197) {
 
  

  } else {

    $('.bt1').trigger('click');

    }

});

$(function(){
 if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }   
});
</script>-->
<!-- javascript -->
@stop