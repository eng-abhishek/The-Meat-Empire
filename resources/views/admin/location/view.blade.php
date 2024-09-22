@extends('admin.layout.layout')
@section('title','Add Product Category')
@section('content')
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
                  <h3 class="box-title">Add New Sector</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="sector-store" action="{{url('sector-store')}}">                 
                  <div class="box-body">

                     <div class="form-group">
                     <label for="cityId">Select City</label>
                     <select name="cityId" class="form-control" required="">
                     <option value="">-- Select City --</option> 
                     @if($city)
                     @foreach($city as $citydata)
                     <option value="{{$citydata->id}}">{{$citydata->name}}</option>
                     @endforeach
                     @else
                     @endif
                     </select> 
                     </div>
   
                     <div class="form-group">
                      <label for="sectorname">Enter Sector Name</label>
                      <input type="text" class="form-control" name="sectorname" id="sectorname" required="">
                     </div>
                    @csrf
                  
                    </div>                  
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-foodCat">Submit</button>
                  </div>
                </form>
               </div><!-- /.box-body -->
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
$('#refundUser').hide();
$('.user_id').prop('required',false);

$('#category-store').validate({
 rules:{
  user_id:{
   required:true,
  },
  couponOffer:{
    required:true,
    number:true,
  },
  couponCode:{
   required:true,
   minlength:3, 
   maxlength:6,   
  }
  },
 messages:{
   couponCode:{
   required:'*Please Enter Coupon Code', 
   },
  user_id:{
   required:'*Please Select User',
  },    
 } 
});

});

function checkCouponType(type){
// alert(type);
if(type=="refundCoupon"){
$('#refundUser').show();
$('.user_id').prop('required',true);
}else{
$('#refundUser').hide();
$('.user_id').prop('required',false);
}
}    
</script>
@stop


      