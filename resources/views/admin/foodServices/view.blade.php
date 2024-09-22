@extends('admin.layout.layout')
@section('title','Add Product')
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
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
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
                  <h3 class="box-title">Add New Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @error("weight")<div class="validate_err">{{ $message }}</div>@enderror
@error("price")<div class="validate_err">{{ $message }}</div>@enderror

                <form role="form" method="post" id="servicesForm" action="{{url('product-store')}}" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                    <label for="service_img">Product Type</label>                      
                    <select name="productType" id="productType" class="form-control" required="">
                    <option value="">-- Select Product Type --</option> 
                    <option value="0">General Category</option>
                    <option value="1">Co-Brand Category</option>  
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
 <option value="{{$ebcCategorData->id}}">{{$ebcCategorData->category_name}}</option>
@endforeach
                    <!-- <option value="1">Heat & Eat</option>
                    <option value="2">Dips & Spices</option>
                    <option value="3">Frozen Packs</option>
                    <option value="4">Marinades</option>
                    <option value="5">Curries</option>
                    <option value="6">Fitness Food</option>
                    <option value="7">Cold Cuts</option>
                    <option value="8">Vegetarian</option>
                    <option value="9">Kebabs</option>
                    <option value="10">Tandoori</option>
                    <option value="11">Fresh & Raw Meats</option> -->
                    </select>
                    *Optional
                    </div>

                    <div class="form-group">
                      <label for="service_name">Product Name</label>
                      <input type="text" class="form-control" name="service_name" id="service_name" required>
                      @error('service_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    @csrf
                    <div class="form-group">
                      <label for="service_short_description">Product Short Description</label>
                     <textarea cols="12" rows="4" class="form-control" name="service_short_description" required>
                     </textarea>
                      @error('service_short_description')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
               
                    <div class="form-group">
                      <label for="service_img">Product Image</label>
                      <input type="file" id="service_img" class="form-control" name="service_img" required>
                      *Recommended Image Size 485*365
                        @error('service_img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="qty_type">Select Quantity Type</label>
                      <select name="qtytype" class="form-control qty_type" required>
                      <option value="">-- Select Quantity Type --</option>  
                      <option value="weigth">Weight wise</option>  
                      <option value="piece">Piece wise</option> 
                      <option value="plate">Plate wise</option>  
                      </select>
                        @error('qty_type')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="weighttypeData"></div>
                    <div class="platetypeData"></div>
                    <div class="picetypeData"></div>

                    <div class="form-group">
                      <label for="offer">Offer</label>
                      <input type="number" id="offer" name="offer" min="1" maxlength="5" class="form-control" required>
                      *Optional/Offer Used As Precentage
                        @error('offer')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>      

                    <div class="form-group">
                      <label for="tax">Tax</label>
                      <input type="number" id="tax" name="tax" min="1" maxlength="5" class="form-control" required>
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
 <option value="{{$cuttingVal->id}}">{{$cuttingVal->name}}</option>  
@endforeach 
</select>
*Optional
</div> 
<!-- 
<div class="form-group">
<label for="foodCity">Select Sides Addons</label>   
<select class="form-control" name="side_addons">
<option value="">-- Select Sides Addons --</option> 
 <option value="sides">Sides</option>  
 <option value="addones">Addons</option>  
</select>
*Optional
</div>  -->

   <div class="form-group">
                    <label for="foodCity">Select City</label>   
<select class="js-example-basic-multiple form-control" name="foodCity[]" multiple="multiple" required>
<option value="">-- Select City --</option> 
@foreach($availaleCity as $availaleCityVal)
 <option value="{{$availaleCityVal->id}}">{{$availaleCityVal->name}}</option>  
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



                  </div><!-- /.box-body -->
                 
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-foodCat">Submit</button>
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

$('.topbar-errmsg').hide();         
$('.js-example-basic-multiple').select2();
$('#servicesForm').validate({
 rules:{
  productType:{
   required:true,
  }, 
  foodCategory:{
  required:true,
  },
  service_img:{
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
  number:false,
  },
  service_short_description:{
  required:true,
  minlength:50,  
},
"price[]":{
maxlength:5,  
required:true,
number:true,
},
foodCity:{  
required:true,  
},
'piece[]':{
required:true,  
number:true,
maxlength:5,
required:true,  
},
'weight[]':{
  required:true,
  number:true,
  maxlength:5,
},
'plate[]':{
  required:true,
  number:true,
  maxlength:5,
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
  productType:{
   required:"*Please Select Product Type",
  },  
  actualWeight:{
  number:'*Product Weigh Should Be Integer',
  },
  foodCity:{
required:'*Please Select Available City',  
}, 
foodCategory:{
    required:'*Plese Select Product Category',
  },
  service_img:{
    required:'*Plese Choose Product Image',
  },
  service_name:{
  required:'*Plese Enter Product Name',
  },
  offer:{
    number:'*Product Offer Should Be Integer',
  },  
service_short_description:{
  required:'*Plese Enter Food Description',
  minlength:'*Product Description Should Be 30 Charactor',  
},
no_of_pices:{
number:'*Product Pices Should Be Integer',
},
price:{
required:'*Plese Enter Food Price',
number:'*Product Price Should Be Integer',
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

$('#productType').on('change',function(){
// alert($(this).val());
var productType=$(this).val();
$.ajax({
url:"{{url('getProductCateType')}}",
method:'POST',
data:{productType:productType,"_token":'{{csrf_token()}}'},
success:function(data){

$('#categoryType').html(data);
console.log(data);

}
});
});




$('.qty_type').on('change',function(){
if($(this).val()=='weigth'){

var weighttext='';
weighttext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" min="1" maxlength="5" name="weight[]" class="form-control" required="">@error("weight")<div class="validate_err">{{ $message }}</div>@enderror</div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" maxlength="5" name="price[]" class="form-control" required="">@error("price")<div class="validate_err">{{ $message }}</div>@enderror</div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addMoreWeight()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div></div>';
$('.weighttypeData').html(weighttext);
 $('.weighttypeData').show();
 $('.platetypeData').hide();
 $('.picetypeData').hide();

}else if($(this).val()=='plate'){
var platetext='';
platetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" min="1" maxlength="5" name="plate[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" maxlength="5" min="1" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-success" onclick="addPlateItem()"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
$('.platetypeData').html(platetext);

 $('.weighttypeData').hide();
 $('.platetypeData').show();
 $('.picetypeData').hide();

}else if($(this).val()=='piece'){

var picetext='';
picetext+='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" min="1" maxlength="5" name="piece[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" name="price[]" maxlength="5" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addPiceItem()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
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
});

function addMoreWeight(){
$('.weighttypeData').append('<div class="row removeWeightbtn"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" name="weight[]" min="1" maxlength="5" class="form-control" required="">@error("weight")<div class="validate_err">{{ $message }}</div>@enderror</div></div><div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option value="gram">Gram</option><option value="kilo-gram">Kilo Gram</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" maxlength="5" name="price[]" class="form-control" required="">@error("price")<div class="validate_err">{{ $message }}</div>@enderror</div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removeWeight"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>');
}

function addPlateItem(){

$('.platetypeData').append('<div class="row removePlateItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" min="1" maxlength="5" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" maxlength="5" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePlateItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

function addPiceItem(){
$('.picetypeData').append('<div class="row removePiceItemRow"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Pices</label><input type="number" name="piece[]" min="1" maxlength="5" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" maxlength="5" name="price[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger removePiceItem"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>');
}

</script>
@stop


      