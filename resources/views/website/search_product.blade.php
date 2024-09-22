@extends('website.layout.layout3')
@section('title','Order Meat Online - Buy Fresh & High Quality Meat at Fair Price on Themeatempire')
@section('content')
<section class="search_product" style="margin-top:280px">
	<div class="container">

<div class="showDefaultProductCategoryA1"></div>


    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">

$(function(){
getDefaultProductCate();
     if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }   
});
</script>

<script type="text/javascript">
function getDefaultProductCate(){
$.ajax({
url:"{{url('get-product-category')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
$('.showDefaultProductCategoryA1').html(data);
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
$('.showDefaultProductCategoryA1').html(data);
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
</script>
@stop