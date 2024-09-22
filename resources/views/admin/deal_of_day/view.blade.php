@extends('admin.layout.layout')
@section('title','Add Food')
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
            <li class="active">Add</li>
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
                  <h3 class="box-title">Add New Deal Of Day</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="servicesForm" action="{{url('deal-of-day-store')}}" enctype="multipart/form-data">
                  <div class="box-body">
                   <div class="form-group">
                    <label for="foodName">Product Name</label>                      
                    <input type="text" id="foodName" class="form-control" name="foodName" required>
                        @error('foodName')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                   <div class="form-group">
                      <label for="qty_type">Select Quantity Type</label>
                      <select name="qtytype" class="form-control qty_type" required="">
                      <option value="">-- Select Quantity Type --</option>  
                      <option value="weigth">Weight wise</option>  
                      <option value="piece">Piece wise</option> 
                      <option value="plate">Plate wise</option>  
                      </select>
                    </div>

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

                    <div class="form-group">
                    <label for="foodName">Product Image</label>                      
                    <input type="file" id="productImg" class="form-control" name="productImg" required>
                    *Recommended Image Size 400*371
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
<option value="gram">Kilo-Gram</option>  
<option value="piece">Piece</option>
<option value="plate">Plate</option>  
</select>
                     @error('stoctQtyType')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>

<div class="col-md-6">  
<div class="form-group">
<label for="qtyStorage">Enter Quantity </label>   
 <input type="number" placeholder="Ex- 5" min="0" maxlength="10" name="qtyStorage" class="form-control">
                     @error('qtyStorage')
                    <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
</div>
</div>

                     @csrf
                  </div><!-- /.box-body -->
                 
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
$('.js-example-basic-multiple').select2();
$('#servicesForm').validate({
 rules:{
  productImg:{
  required:true,
  },
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
  productImg:{
  required:'*Please Choose Producr Image',
  },
foodName:{
  required:'*Please Enter Product Name',
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
});


$('.qty_type').on('change',function(){


if($(this).val()=='weigth'){
var weighttext='';
weighttext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addMoreWeight()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div></div>';
$('.weighttypeData').html(weighttext);
 $('.weighttypeData').show();
 $('.platetypeData').hide();
 $('.picetypeData').hide();

}else if($(this).val()=='plate'){
var platetext='';
platetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePL[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-success" onclick="addPlateItem()"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
$('.platetypeData').html(platetext);

 $('.weighttypeData').hide();
 $('.platetypeData').show();
 $('.picetypeData').hide();

}else if($(this).val()=='piece'){

var picetext='';
picetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" min="1" name="piece[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePI[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addPiceItem()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
 $('.picetypeData').html(picetext);
 $('.picetypeData').show();
 $('.weighttypeData').hide();
 $('.platetypeData').hide();

}else{
 $('.weighttypeData').hide();
 $('.picetypeData').hide();
 $('.platetypeData').hide();
}
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

function addMoreWeight(){
$('.weighttypeData').append('<div class="row removeWeightbtn"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" class="form-control" min="1" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removeWeight"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>');
}

function addPlateItem(){

$('.platetypeData').append('<div class="row removePlateItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePL[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePlateItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPiceItem(){
$('.picetypeData').append('<div class="row removePiceItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Pices</label><input type="number" name="piece[]" min="1" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="pricePI[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePiceItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

</script>
@stop


      