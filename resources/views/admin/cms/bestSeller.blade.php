@extends('admin.layout.layout')
@section('title','Add Testimonial')
@section('content')
<?php 
use App\FoodService;
use App\Deal_of_day;
use App\FoodCategory;
$product=FoodService::where('status','1')->get()->toArray();
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
            <li class="active">CMS</li>
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
                  <h3 class="box-title">CMS- Best Seller</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="testimonialForm" action="{{url('store-cms-best-seller')}}" enctype="multipart/form-data">
                  <div class="box-body">

                <div class="row">
                <div class="col-md-12">
                <label for="clint_name">Select Product</label>
                </div>  
                </div>

<div class="row">
<div class="col-md-12">
                <select name="product[]" multiple="" required="" class="js-example-basic-multiple form-control productCount">
                     <option value=""> -- Select Product --</option>
                    @foreach($product as $productval)
                     <option value="{{$productval['id']}}">{{$productval['service_name']}}</option>   
                    @endforeach
                </select>     
                     @error('product')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
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
$('#testimonialForm').validate({
  rules:{
  product:{
  required:true, 
    },
    },
  messages:{
  product:{
  required:'*Please Select Product',
     }
     }
});

$('#testimonialForm').submit(function(){
var chkLength=$('select[name="product[]"] :selected').length;
if(chkLength>5){
if(chkLength>24){
alert('Please Select Any 24 Product');
return false;
}else{
return true;
}
}else{
alert('Please Select Any Twelve Product');
return false;
}
});

setTimeout(function(){
getDropdownData();
},500);

});

function getDropdownData(){
$.ajax({
 url:"{{url('get-update-best-seller-home-page-status')}}",
 method:'post',
 data:{"_token":'{{csrf_token()}}'},  
 success:function(data){
 console.log(data.id); 
 var arr=[];
 for(var i=0;i<data.length;i++){
arr[i]=data[i].id;
 }
$('.productCount').val(arr).change();
 }
 });
 }

</script>
@stop
      