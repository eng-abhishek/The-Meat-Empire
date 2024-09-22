@extends('admin.layout.layout')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small></small>
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
                  <h3 class="box-title">Edit Deal Of Day</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" method="post" id="editServicesForm" action="{{url('deal-of-day-update')}}" enctype="multipart/form-data">
                  <div class="box-body">

                  <div class="form-group">
                    <label for="foodName">Product Name</label>                      
                    <input type="text" id="foodName" class="form-control" value="{{$DealOfDay->foodName}}" name="foodName" required>
                        @error('foodName')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="foodName">Product Image</label>                      
                  <input type="file" id="productImg" class="form-control" name="productImg">
                  @if($DealOfDay->productImg)
                  <img src="{{asset("uploads/dealOfDay/$DealOfDay->productImg")}}" width="100px" required/>
                   <input type="text" hidden name="OldImg" value="{{$DealOfDay->productImg}}"> @endif
                  @error('productImg')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    *Recommended Image Size 400*371
                    </div>
                    @csrf

                    <div class="form-group">
                      <label for="qty_type">Select Quantity Type</label>
                      <select name="qtytype" class="form-control qty_type" required="">
                      <option value="">-- Select Quantity Type --</option>  
                      <option value="weigth">Weight wise</option>  
                      <option value="piece">Piece wise</option> 
                      <option value="plate">Plate wise</option>  
                      </select>
                    </div>

<input type="hidden" name="CheckQTYtype" id="CheckQTYtype">

                    <div class="weighttypeDataDB"></div>
                    <div class="platetypeDataDB"></div>
                    <div class="picetypeDataDB"></div>

                    <div class="weighttypeData"></div>
                    <div class="platetypeData"></div>
                    <div class="picetypeData"></div>
                
           
                    <div class="form-group">
                    <label for="foodName">Offer</label>                      
                    <input type="text" id="offer" value="7" readonly class="form-control" name="offer" required>
                    @error('productImg')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

<div class="row">
<div class="col-md-6">  
<div class="form-group">
<label for="stoctQtyType">Select Stock Quantity Type</label>   
<select class="form-control" name="stoctQtyType" required>
<option value="">-- Select Stock Quantity Type --</option> 
<option <?php if($DealOfDay->stoctQtyType=='gram'){ echo"selected";} ?> value="gram">Kilo-Gram</option>  
<option <?php if($DealOfDay->stoctQtyType=='piece'){ echo"selected";} ?> value="piece">Piece</option>
<option <?php if($DealOfDay->stoctQtyType=='plate'){ echo"selected";} ?> value="plate">Plate</option>  
</select>
                     @error('stoctQtyType')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>
<?php 
$actStock='';
if($DealOfDay->stoctQtyType=='gram'){
$actStock=$DealOfDay->stock/1000;
}else{
$actStock=$DealOfDay->stock;
}
?>

<div class="col-md-6">  
<div class="form-group">
<label for="qtyStorage">Enter Quantity </label>   
 <input type="number" placeholder="Ex- 5" value="{{$actStock}}" min="0" maxlength="10" name="qtyStorage" class="form-control">
                     @error('qtyStorage')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>
</div>


                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$DealOfDay->id}}"> 
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
$('#editServicesForm').validate({
 rules:{
  foodName:{
  required:true,
  maxlength:30,
  minlength:5,
  },
  offer:{
  required:false,
  number:true,
  },
 qtyStorage:{
 required:true, 
},
stoctQtyType:{
 required:true,
 mumber:true,
}
 },
messages:{
foodName:{
    required:'*Plese Enter Product Name',
},
  offer:{
    number:'*Food Offer Should Be Integer',
  },  
 qtyStorage:{
 required:'* Please Select Quantity Type', 
},
stoctQtyType:{
 required:'*Please Enter Quantity',
 mumber:'*Quantity Should Be Number', 
} 
 }

});

setTimeout(function(){
getquantityType();
getPriceTable();
},500)

});     

   $("body").on("click",".removeWeight",function(){ 
        $(this).parents(".removeWeightbtn").remove();
    });

   $("body").on("click",".removePlateItem",function(){ 
        $(this).parents(".removePlateItemRow").remove();
    });

   $("body").on("click",".removePiceItem",function(){ 
        $(this).parents(".removePiceItemRow").remove();
    }); 

function getquantityType(){
var editId=$('input[name="editId"]').val();
$.ajax({
url:"{{url('get-deal-of-day-qty-type')}}",
method:'POST',
data:{editId:editId,'_token':'{{csrf_token()}}'},
dataType:'JSON',
success:function(data){
  console.log(data);
$('#CheckQTYtype').val(data);
$('.qty_type option[value='+data+']').attr('selected','selected'); 
}
});
}  

function getPriceTable(){
var editId=$('input[name="editId"]').val();
$.ajax({
url:"{{url('get-deal-of-day-price-table')}}",
method:'POST',
data:{editId:editId,'_token':'{{csrf_token()}}'},
dataType:'JSON',
success:function(data){
  console.log(data[0]);
if(data[0]=='weigth'){
$('.weighttypeDataDB').html(data[1]);
}else if(data[0]=='plate'){
$('.platetypeDataDB').html(data[1]);
}else if(data[0]=='piece'){
$('.picetypeDataDB').html(data[1]);
}else{

}
}
});
}
function addMoreWeightDB(){
$('.weighttypeDataDB').append('<div class="row removeWeightbtn"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removeWeight"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>');
}

function addMoreWeight(){
$('.weighttypeData').append('<div class="row removeWeightbtn"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removeWeight"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>');
}

function addPlateItem(){

$('.platetypeData').append('<div class="row removePlateItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePL[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePlateItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPlateItemDB(){

$('.platetypeDataDB').append('<div class="row removePlateItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePL[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePlateItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPiceItem(){
$('.picetypeData').append('<div class="row removePiceItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Pices</label><input type="number" name="piece[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePC[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePiceItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPiceItemDB(){
$('.picetypeDataDB').append('<div class="row removePiceItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Pices</label><input type="number" name="piece[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePC[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePiceItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}


function removeItemDB(id){
$.ajax({
url:"{{url('remove-deal-of-day-price-tbl')}}",
method:'POST',
data:{id:id,'_token':"{{csrf_token()}}"},
success:function(data){
$('.removeItemDB'+id).remove();
}
});
}



$('.qty_type').on('change',function(){
var previousQTYtype=$('#CheckQTYtype').val();

if($(this).val()=='weigth'){
var weighttext='';
weighttext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" min="1" name="weight[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addMoreWeight()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div></div>';
 $('.weighttypeData').html(weighttext);

if(previousQTYtype=='weigth'){
// alert(previousQTYtype);
  getPriceTable();
 $('.weighttypeDataDB').show();

 $('.weighttypeData').hide();
 $('.platetypeData').hide();
 $('.picetypeData').hide();
 $('.platetypeDataDB').hide();
 $('.picetypeDataDB').hide(); 
    }else{
 $('.weighttypeData').show();

 $('.weighttypeDataDB').hide();
 $('.platetypeData').hide();
 $('.picetypeData').hide();
 $('.platetypeDataDB').hide();
 $('.picetypeDataDB').hide(); 

    }



}else if($(this).val()=='plate'){
var platetext='';
platetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" min="1" name="platePL[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-success" onclick="addPlateItem()"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
$('.platetypeData').html(platetext);

if(previousQTYtype=='plate'){
    getPriceTable();
 $('.platetypeDataDB').show();
  $('.weighttypeData').hide();
  $('.picetypeData').hide();

  $('.platetypeData').hide();
  $('.weighttypeDataDB').hide();
  $('.picetypeDataDB').hide();

}else{
 $('.platetypeData').show();

  $('.platetypeDataDB').hide();
  $('.weighttypeData').hide();
  $('.picetypeData').hide();

  $('.weighttypeDataDB').hide();
  $('.picetypeDataDB').hide();
}



}else if($(this).val()=='piece'){

var picetext='';
picetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" min="1" name="piecePC[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addPiceItem()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
 $('.picetypeData').html(picetext);

if(previousQTYtype=='piece'){
    getPriceTable();
 $('.picetypeDataDB').show();
 $('.weighttypeDataDB').hide();
 $('.platetypeDataDB').hide();

 $('.picetypeData').hide();
 $('.weighttypeData').hide();
 $('.platetypeData').hide();
}else{

 $('.picetypeDataDB').hide();
 $('.weighttypeDataDB').hide();
 $('.platetypeDataDB').hide();

 $('.picetypeData').show();
 $('.weighttypeData').hide();
 $('.platetypeData').hide();

}

}else{
 $('.picetypeDataDB').hide();
 $('.weighttypeDataDB').hide();
 $('.platetypeDataDB').hide();

 $('.picetypeData').hide();
 $('.weighttypeData').hide();
 $('.platetypeData').hide();
}
});

</script>
@stop


      