<?php error_reporting(1); ?>
@extends('admin.layout.layout')
@section('title','Edit Product')
@section('content')
<?php 
use App\CuttingInstruction;
$cutting=CuttingInstruction::all();
?>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Product</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" method="post" id="editServicesForm" action="{{url('product-update')}}" enctype="multipart/form-data">
                  <div class="box-body">

                  <div class="form-group">
                    <label for="service_img">Product Type</label>                      
                    <select name="productType" id="productType" class="form-control" required="">
                    <option value="">-- Select Product Type --</option> 
                    <option <?php if($editData[0][0]['product_type']=='0'){ echo"selected"; }else{ } ?> value="0">General Category</option>
                    <option <?php if($editData[0][0]['product_type']=='1'){ echo"selected"; }else{ } ?>  value="1">Co-Brand Category</option>  
                    </select>
                        @error('foodCategory')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                    <label for="service_img">Product Category</label>                      
                    <select name="foodCategory" class="form-control" id="categoryType" required="">
                    <option value="">-- Select Product Category --</option> 
                  
                    </select>
                        @error('foodCategory')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                    <label for="ebc_category">Explore By Category</label>
                    <select name="ebc_category" class="form-control" id="ebc_category">
                    <option value="">-- Select Explore By Category --</option>
                 
@foreach($ebcCategory as $ebcCategorData)
 <option <?php if($editData[0][0]['ebc_id']==$ebcCategorData->id){ echo"selected";}?> value="{{$ebcCategorData->id}}">{{$ebcCategorData->category_name}}</option>
@endforeach
  </select>
                    *Optional
                    </div>

                    <input type="text" hidden name="catId" id="catId" value="{{$editData[0][0]['service_cate_id']}}">

                    <div class="form-group">
                      <label for="service_name">Product Name</label>
                      <input type="text" class="form-control" name="service_name" id="service_name" value="{{$editData[0][0]['service_name']}}" required>
                      @error('service_name')
                      <div>{{ @message }}</div>
                      @enderror
                    </div>

                    @csrf
                    <div class="form-group">
                      <label for="service_short_description">Product Short Description</label>
                     <textarea cols="12" rows="4" class="form-control" name="service_short_description" required>{{$editData[0][0]['service_short_des']}}
                     </textarea>
                      @error('service_short_description')
                      <div>{{ $message }}</div>
                      @enderror
                    </div>

                   <div class="form-group">
                      <label for="service_img">Product Image</label>
                      <input type="file" id="service_img" class="form-control" name="service_img">
                       @error('service_img')
                      <div>{{ @message }}</div>
                      @enderror
                   @if($editData[0][0]['service_img'])
                  <img src="{{asset('uploads/foodService/'.$editData[0][0]['service_img'])}}" style="width:100px;height:80px"required/>
                  <input type="text" hidden name="oldImg" value="{{$editData[0][0]['service_img']}}"> @endif
                      *Recommended Image Size 485*365
                    </div>
                   <?php if(empty($priceType)){
                     ?>
                     <div class="form-group">
                      <label for="qty_type">Select Quantity Type</label>
                      <select name="qtytype" class="form-control qty_type" data-taye="{{$editData[0][0]['id']}}" required="">
                      <option value="">-- Select Quantity Type --</option>  
                      <option <?php if($productPrice[0]->type=='weigth' || $priceType=='weigth'){echo"selected"; } else{ } ?> value="weigth">Weight wise</option>  
                      <option <?php if($productPrice[0]->type=='piece' || $priceType=='piece'){echo"selected"; } else{ } ?>  value="piece">Piece wise</option> 
                      <option <?php if($productPrice[0]->type=='plate' || $priceType=='plate'){echo"selected"; } else{ } ?> value="plate">Plate wise</option>  
                      </select>
                    </div>
                   <?php
                   }else{
                    ?>
                      <div class="form-group">
                      <label for="qty_type">Select Quantity Type</label>
                      <select name="qtytype" class="form-control qty_type" data-taye="{{$editData[0][0]['id']}}" required="">
                      <option value="">-- Select Quantity Type --</option>  
                      <option <?php if($priceType=='weigth'){echo"selected"; } else{ } ?> value="weigth">Weight wise</option>  
                      <option <?php if($priceType=='piece'){echo"selected"; } else{ } ?>  value="piece">Piece wise</option> 
                      <option <?php if($priceType=='plate'){echo"selected"; } else{ } ?> value="plate">Plate wise</option>  
                      </select>
                    </div>
                  <?php } ?> 
         
<?php 
if(($productPrice[0]->type=='weigth' && empty($priceType)) || ($priceType=='weigth' && $productPrice[0]->type=='weigth')){
foreach ($productPrice as $key1=>$productPriceval) {
  $weightProductId=$productPriceval->id;
?>
        
         <div class="row removeItemRow{{$weightProductId}}">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter Weight</label>
         <input type="number" name="weight[]" min="1" value="{{$productPriceval->quantity}}" class="form-control" required="">
         </div>
         </div> 

         <div class="col-md-2">  
          <div class="form-group">
          <label for="qty_type">Select Quantity</label>
          <select name="meagurementType[]" class="form-control" required="">
          <option value="">Select Quantity</option>  
          <option <?php if($productPriceval->quantity_type=='gram'){ echo"selected"; }else{ } ?> value="gram">Gram</option>
          <option <?php if($productPriceval->quantity_type=='kilo-gram'){ echo"selected"; }else{ } ?> value="kilo-gram">Kilo Gram</option>
          </select>
          </div>
         </div>

         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" name="price[]" min="1" value="{{$productPriceval->price}}" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>
<?php if($key1==0){
?>
<button type="button" onclick="addMoreWeight('DB')" class="btn btn-success"><i class="fa fa-plus"></i></button>
<?php
}else{
?>
<button type="button" class="btn btn-danger" onclick="removeItem({{$weightProductId}})"><i class="fa fa-remove"></i></button>
<?php
}?>
         </div>  
         </div>
         <div class="col-md-2"></div>  
         </div>
       
<?php
}
echo'<div class="addMoreWeightItemDB"></div>';
}elseif(($productPrice[0]->type)!='weigth' && $priceType=='weigth'){
?>


<div class="addMoreWeightItemView">
 <div class="row removeWeightRowView">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter Weight</label>
         <input type="number" name="weight[]" min="1" class="form-control" required="">
         </div>
         </div> 

         <div class="col-md-2">  
          <div class="form-group">
          <label for="qty_type">Select Quantity</label>
          <select name="meagurementType[]" class="form-control" required="">
          <option value="">Select Quantity</option>  
          <option value="gram">Gram</option>
          <option value="kilo-gram">Kilo Gram</option>
          </select>
          </div>
         </div>

         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" name="price[]" min="1" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>

<button type="button" onclick="addMoreWeight('View')" class="btn btn-success">
<i class="fa fa-plus"></i></button>

         </div>  
         </div>  
         <div class="col-md-2"></div>  
         </div> 
</div>

<?php
}
elseif(($productPrice[0]->type=='piece' && empty($priceType)) ||  ($priceType=='piece' && $productPrice[0]->type=='piece')){
foreach ($productPrice as $key2=>$productPriceval) {  
$picesProductId=$productPriceval->id;
?>

         <div class="row removeItemRow{{$picesProductId}}">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter No Of Piece</label>
         <input type="number" name="piece[]" value="{{$productPriceval->quantity}}" class="form-control" required="">
         </div>
         </div> 
          
         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" name="price[]" min="1" value="{{$productPriceval->price}}" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>

<?php if($key2==0){
?>
<button type="button" onclick="addPiceItem('DB')" class="btn btn-success"><i class="fa fa-plus"></i></button>
<?php
}else{
?>
<button type="button" class="btn btn-danger" onclick="removeItem({{$picesProductId}})"><i class="fa fa-remove"></i></button>
<?php
}?>
         </div>  
         </div> 
         </div>   
  
<?php
}
echo'<div class="addMorePiceItemDB"></div>';
}elseif($priceType=='piece' && ($productPrice[0]->type)!='piece'){
?>
        <div class="addMorePiceItemView">
         <div class="row removePicesRow">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter No Of Pices</label>
         <input type="number" name="piece[]" min="1" value="{{$productPriceval->quantity}}" class="form-control" required="">
         </div>
         </div> 
          
         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" name="price[]" min="1" value="{{$productPriceval->price}}" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>
         <button type="button" onclick="addPiceItem('View')" class="btn btn-success">
         <i class="fa fa-plus"></i>
         </button>
         </div>  
         </div> 
         </div> 
       </div>

<?php
}
elseif(($productPrice[0]->type=='plate' && empty($priceType)) || ($priceType=='plate' && $productPrice[0]->type=='plate')){
  foreach ($productPrice as $key3=>$productPriceval) {
  $plateId=$productPriceval->id;
?>

         <div class="row removeItemRow{{$plateId}}">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter No Of Plate</label>
         <input type="number" name="plate[]" min="1" value="{{$productPriceval->quantity}}" class="form-control" required="">
         </div>
         </div> 

         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" name="price[]" min="1" value="{{$productPriceval->price}}" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>
<?php if($key3==0){
?>
<button type="button" onclick="addPlateItem('DB')" class="btn btn-success"><i class="fa fa-plus"></i></button>
<?php
}else{
?>
<button type="button" class="btn btn-danger" onclick="removeItem({{$plateId}})"><i class="fa fa-remove"></i></button>
<?php
}?>
         </div>  
         </div> 
         </div>     
<?php
}
echo'<div class="addMorePlateItemDB"></div>';
}elseif(($productPrice[0]->type)!='plate' && $priceType=='plate'){
?>
         <div class="addMorePlateItemView">
         <div class="row removePlateRow">
         <div class="col-md-3">
         <div class="form-group">
         <label for="weight">Enter No Of Plate</label>
         <input type="number" min="1" name="plate[]" value="{{$productPriceval->quantity}}" class="form-control" required="">
         </div>
         </div> 

         <div class="col-md-3">
          <div class="form-group">
          <label for="price">Enter Price</label>
          <input type="number" min="1" name="price[]" value="{{$productPriceval->price}}" class="form-control" required="">
          </div>
         </div> 

         <div class="col-md-2">
         <div class="form-group">
         <label></label>
<button type="button" onclick="addPlateItem('View')" class="btn btn-success"><i class="fa fa-plus"></i></button>
         </div>  
         </div> 
         </div></div>   
<?php
}
else{
}
?>
                    <div class="form-group">
                      <label for="offer">Offer</label>
                      <input type="number" id="offer" name="offer" min="1" value="{{$editData[0][0]['service_offer']}}" class="form-control" required>
                      *Optional/Offer Used As Precentage
                        @error('offer')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 

                    <div class="form-group">
                      <label for="tax">Tax</label>
                      <input type="number" id="tax" name="tax" min="1" maxlength="5" class="form-control" value="{{$editData[0][0]['tax']}}">
                      *Optional/Tax Used As Precentage
                        @error('tax')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>  

<div class="form-group">
<label for="foodCity">Select Cutting Instructions</label>   
<select class="js-example-basic-multiple form-control" name="cutting[]" multiple="multiple">
<option value="">-- Select Cutting Instructions --</option> 
@foreach($cutting as $cuttingVal)
 <option value="{{$cuttingVal->id}}"   {{in_array(   $cuttingVal->id, explode(',',$editData[0][0]['cutting_instruction'])) ? 'selected' : ''}}>{{$cuttingVal->name}}</option>  
@endforeach 
</select>
*Optional
</div> 

<!-- <div class="form-group">
<label for="foodCity">Select Sides Addons</label>   
<select class="form-control" name="side_addons">
<option value="">-- Select Sides Addons --</option> 
 <option <?php if($editData[0][0]['side_addons']=='sides'){ echo"selected"; }?> value="sides">Sides</option>  
 <option <?php if($editData[0][0]['side_addons']=='addones'){ echo"selected"; }?> value="addones">Addons</option>  
</select>
*Optional
</div>  -->
                   <div class="form-group">
                    <label for="foodCity">Select City</label>   
                    <select class="js-example-basic-multiple form-control" name="foodCity[]" multiple="multiple" required>
                    <option value="">-- Select City --</option> 
                    @foreach($availaleCity as $availaleCityVal)
                   <option value="{{$availaleCityVal->id}}" {{in_array($availaleCityVal->id, $editData['cityId']) ? 'selected' : ''}}>
                    {{$availaleCityVal->name}}</option>  
                    @endforeach 
                    </select>
                    @error('foodCategory')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>


<div class="row">
<div class="col-md-6">  
<div class="form-group">
<label for="stoctQtyType">Select Stock Quantity Type</label>   
<select class="form-control" name="stoctQtyType" required>
<option value="">-- Select Stock Quantity Type --</option> 
<option <?php if($editData[0][0]['stock_qty_type']=='gram'){ echo"selected";} ?> value="gram">Kilo-Gram</option>  
<option <?php if($editData[0][0]['stock_qty_type']=='piece'){ echo"selected";} ?> value="piece">Piece</option>
<option <?php if($editData[0][0]['stock_qty_type']=='plate'){ echo"selected";} ?> value="plate">Plate</option>  
</select>
                     @error('stoctQtyType')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>
<?php 
$actStock='';
if($editData[0][0]['stock_qty_type']=='gram'){
$actStock=$editData[0][0]['stock']/1000;
}else{
$actStock=$editData[0][0]['stock'];
}

?>
<div class="col-md-6">  
<div class="form-group">
<label for="qtyStorage">Enter Quantity </label>   
 <input type="number" value="{{$actStock}}" placeholder="Ex- 5" min="0" maxlength="10" name="qtyStorage" class="form-control">
                     @error('qtyStorage')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>
</div>


                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData[0][0]['id']}}"> 
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary edit-btn-foodCat">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('script')
<script>
      $(function(){
setTimeout(function(){
getProductCate();
},500);
setTimeout(function(){
setSelectedCate();
},800);


$("body").on("click",".removeWeight",function(){ 
        $(this).parents(".removeWeightbtn").remove();
    });

   $("body").on("click",".removePlateItem",function(){ 
        $(this).parents(".removePlateItemRow").remove();
    });

   $("body").on("click",".removePiceItem",function(){ 
        $(this).parents(".removePiceItemRow").remove();
    }); 

$('.topbar-errmsg').hide(); 
$('.js-example-basic-multiple').select2();

$('#editServicesForm').validate({
 rules:{
  productType:{
   required:true,
  },
  foodCategory:{
  required:true,
  },
  offer:{
  required:false,
  number:true,
  },
  service_name:{
  required:true,
  minlength:5,
  maxlength:50,
  },
  service_short_description:{
  required:true,
  minlength:50,  
  },
 no_of_pices:{
 required:false,  
 number:true,
 },
price:{
required:true,
number:true,
},
foodCity:{
required:true,  
}
 },

messages:{
productType:{
   required:"*Please Select Product Type",
  },  
foodCity:{
required:'*Please Select Available City',  
}, 
foodCategory:{
    required:'*Plese Select Product Category',
  },
  service_name:{
  required:'*Plese Enter Product Name',
  },
  offer:{
    number:'*Product Offer Should Be Integer',
  },  
service_short_description:{
  required:'*Plese Enter Product Description',
  minlength:'*Product Description Should Be 30 Charactor',  
},
no_of_pices:{
required:'*Plese Enter Product Pices',
number:'*Product Pices Should Be Integer',
},
price:{
required:'*Plese Enter Food Price',
number:'*Product Price Should Be Integer',
},
actualWeight:{
number:'*Product Weight Should Be Integer',
}
}
});


$('.qty_type').on('change',function(){
var type=$(this).val();

var editIdval=$(this).attr('data-taye');

window.location.href="{{url('product-edit/')}}"+'/'+editIdval+'/'+type;
});


});

function removeItem(id){
$.ajax({
url:'{{url("remove-product-price-item")}}',
method:'POST',
data:{id:id,"_token":'{{csrf_token()}}'},
success:function(data){

}
});
$('.removeItemRow'+id).remove();
}

function addMoreWeight(type){
$('.addMoreWeightItem'+type).append('<div class="row removeWeightbtn"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removeWeight"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>');
}

function addPlateItem(type){

$('.addMorePlateItem'+type).append('<div class="row removePlateItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePlateItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPiceItem(type){
$('.addMorePiceItem'+type).append('<div class="row removePiceItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" name="piece[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePiceItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}


function getProductCate(){
var productType =$('#productType').val();  

$.ajax({
url:"{{url('getProductCateType')}}",
method:'POST',
data:{productType:productType,"_token":'{{csrf_token()}}'},
success:function(data){

$('#categoryType').html(data);
console.log(data);

}
});
}

function setSelectedCate(){
var catId=$('#catId').val();
var productType =$('#productType').val();  

$.ajax({
url:"{{url('setSetectedProductCate')}}",
method:'POST',
data:{catId:catId,productType:productType,"_token":'{{csrf_token()}}'},
success:function(data){
 $('#categoryType option[value='+catId+']').attr('selected','selected');
}
//console.log(data);
});
//}

}


</script>
@stop


